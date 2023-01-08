<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Favorite;
use App\Token;
use App\TokenTransfer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokenController extends Controller
{
    public function index(Request $request) {
        $network = $request->network;
        $contractAddress = $request->collection;
        $tokenId = $request->tokenId;

        if($contractAddress == 'mustachio' || $contractAddress == 'mustachios') {
            return redirect()->route('token.index', ['pathfinders2d', $tokenId]);
        }

        if($contractAddress == '3dmustachios') {
            if($tokenId <= 100) {
                return redirect()->route('token.index', ['pathfinders3d', $tokenId]);
            } else {
                return redirect()->route('token.index', ['marauders', $tokenId]);
            }
        }

        $collection = Collection::where('url_placeholder', $contractAddress)
            ->first();

        if(!$collection) {
            $collection = Collection::where('chain_id', $network)
                ->where('contract_address', 'LIKE',  $contractAddress)
                ->first();
        }

        if(!$collection) {
            abort(404);
        }

        // if collection is the 3D version of mustachios
        if($collection['id'] == 9 || $collection['id'] == 11) {
            $tokenController = new TokenController();
            $tokenController->checkForNewlyMintedMustachio3DTokens();
        }

        $token = Token::where('collection_id', $collection['id'])
            ->where('token_id', $tokenId)
            ->first();

        if($collection['id'] == 4 && !$token) {
            $mustachio = Mustachio::find($tokenId);

            $token = new Token();
            $token->collection_id = $collection['id'];
            $token->token_id = $tokenId;
            $token->name = $mustachio['name'];
            $token->description = $mustachio['description'];
            $token->image = $mustachio['image'];
            $token->thumbnail = $mustachio['image'];
            $token->attributes = $mustachio['attributes'];
            $token->trans_bg = $mustachio['trans_bg'];
            $token->save();
        }

        if($collection['url_placeholder'] != 'rewards') {
            $token->updateTokenTransaction();
        }

        $token['token_transfer'] = $token->tokenTransfer();
        $token['owner'] = $token->owner();
        $token['marketItem'] = $token->marketItem();
        $token['transfers'] = $token->transfers();
        $token['ogImage'] = $token->ogImage();

        $view = 'small-grid';

        $relatedTokens = Token::where('collection_id', $collection['id'])
            ->where('token_id', '!=', $tokenId)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        foreach($relatedTokens as $relatedToken) {
            $relatedToken['collection'] = $relatedToken->collection();
        }

        return view('token.index', compact('collection', 'token', 'view', 'relatedTokens'));
    }

    public function getTokenActionButtons(Request $request) {
        $token = Token::find($request->token);

        $account = $request->address;

        $token['token_transfer'] = $token->tokenTransfer();
        $token['favorite_status'] = $token->favoriteStatus($account);
        $token['owner'] = $token->owner();
        $token['marketItem'] = $token->marketItem();

        $collection = $token->collection();
        $token->updateTokenTransaction();

        return view('token.action_buttons', compact('collection', 'token', 'account'));
    }

    public function updateFavoriteStatus(Request $request) {
        $request->validate([
            'address' => 'required',
            'signature' => 'required',
            'contract_address' => 'required',
            'token_id' => 'required'
        ]);

        $user = User::where('address', $request->address)
            ->first();

        if(!$user) {
            $user = new User();
            $user->address = $request->address;
            $user->signature = $request->signature;
            $user->save();
        }

        $marketItemFavorite = Favorite::where('address', 'LIKE', $request->address)
            ->where('contract_address', 'LIKE', $request->contract_address)
            ->where('token_id', $request->token_id)
            ->first();

        if(!$marketItemFavorite) {
            $marketItemFavorite = new Favorite;
            $marketItemFavorite->address = $request->address;
            $marketItemFavorite->contract_address = $request->contract_address;
            $marketItemFavorite->token_id = $request->token_id;
            $marketItemFavorite->status = $request->status;
            $marketItemFavorite->save();
        } else {
            $marketItemFavorite->status = $request->status;
            $marketItemFavorite->update();
        }

        return response()->json([
            'status' => $marketItemFavorite['status']
        ]);
    }

    public function search(Request $request) {
        $request->validate([
            'value' => 'required|string'
        ]);

//        $response = Http::get(config('ownly.nodejs_url') . '/web3/isAddress/' . $request->value);
//
//        if(isset($response['isAddress']) && $response['isAddress']) {
//            $contractAddress = $request->value;
//
//            $this->fetchTokenData($contractAddress, 0);
//
//            $result = Collection::addSelect('id')
//                ->addSelect('name')
//                ->addSelect('contract_address')
//                ->addSelect('chain_id')
//                ->addSelect('url_placeholder')
//                ->addSelect(DB::raw('logo as thumbnail'))
//                ->addSelect(DB::raw('null as collection'))
//                ->addSelect(DB::raw('"collection" as type'))
//                ->addSelect(DB::raw('"collection" as type'))
//                ->where('contract_address', 'LIKE', $contractAddress)
//                ->limit(20)
//                ->orderBy('type', 'asc')
//                ->orderBy('name', 'asc')
//                ->get();
//        } else {
        $search = '%' . $request->value . '%';

        $collections = Collection::addSelect('id')
            ->addSelect('name')
            ->addSelect('contract_address')
            ->addSelect('chain_id')
            ->addSelect('url_placeholder')
            ->addSelect(DB::raw('logo as thumbnail'))
            ->addSelect(DB::raw('null as collection'))
            ->addSelect(DB::raw('"collection" as type'))
            ->where('name', 'LIKE', $search);

        $tokens = Token::addSelect(DB::raw('token_id as id'))
            ->addSelect('tokens.name')
            ->addSelect('contract_address')
            ->addSelect('chain_id')
            ->addSelect('url_placeholder')
            ->addSelect('thumbnail')
            ->addSelect(DB::raw('collections.name as collection'))
            ->addSelect(DB::raw('"token" as type'))
            ->leftJoin('collections', 'collection_id', 'collections.id')
            ->where('tokens.name', 'LIKE', $search);

        $result = $collections->unionAll($tokens)
            ->limit(20)
            ->orderBy('type', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        foreach($result as $item) {
            if($item['type'] == 'token') {
                $item['url'] = config('ownly.marketplace_url') . $item['url_placeholder'] . '/' . $item['id'];
            } else {
                $item['url'] = config('ownly.marketplace_url') . $item['url_placeholder'];
            }

            unset($item['contract_address']);
            unset($item['chain_id']);
        }

        return response()->json([
            'data' => $result
        ]);
    }

    public function getTokens(Request $request) {
        $contract_address = $request->contractAddress;

        $collection = Collection::where('url_placeholder', $contract_address)
            ->first();

        if(!$collection) {
            $contract_address = explode(':', $contract_address);

            if(count($contract_address) == 2) {
                if($contract_address[0] == 'eth') {
                    $contract_address[0] = 1;
                } else if($contract_address[0] == 'bsc') {
                    $contract_address[0] = 56;
                } else if($contract_address[0] == 'matic') {
                    $contract_address[0] = 137;
                }

                $collection = Collection::where('chain_id', $contract_address[0])
                    ->where('contract_address', 'LIKE',  $contract_address[1])
                    ->first();
            }
        }

        if(!$collection) {
            if(count($contract_address) == 2) {
                $collection = Collection::where('url_placeholder', $contract_address[1])
                    ->first();
            }
        }

        // if collection is the 3D version of mustachios
        if($collection['id'] == 9 || $collection['id'] == 11) {
            $this->checkForNewlyMintedMustachio3DTokens();
        }

        $filters = json_decode($request->filters, true);
        $properties = [];

        if($filters) {
            foreach($filters as $filter) {
                if(!array_key_exists($filter['property'], $properties)) {
                    $properties[$filter['property']] = [];
                }

                array_push($properties[$filter['property']], $filter['value']);
            }
        }

        $tokens = [];
        if($collection) {
            $tokens = Token::select('tokens.id', 'tokens.token_id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
                ->where('collection_id', $collection['id'])
                ->where('tokens.token_id', '!=', $request->excludedToken)
                ->where(function($query) use ($properties, $filters) {
                    foreach($properties as $key => $property) {
                        $query->where(function($query_2) use ($key, $property) {
                            foreach($property as $i => $property_item) {
                                if($i == 0) {
                                    $query_2->where('attributes', 'LIKE', '%{"value": "' . $property_item . '", "trait_type": "' . $key . '"}%');
                                } else {
                                    $query_2->orWhere('attributes', 'LIKE', '%{"value": "' . $property_item . '", "trait_type": "' . $key . '"}%');
                                }
                            }
                        });
                    }
                })
                ->leftJoin('token_transfers', function($join) use ($collection) {
                    $join->on('token_transfers.id', 'token_transfer_id');
                });

                if($collection['id'] == 9 || $collection['id'] == 11) {
                    $tokens = $tokens->where('to', '!=', '0x672b733c5350034ccbd265aa7636c3ebdda2223b');
                }
            if($request->excludedToken == 0) {
                $tokens = $tokens->orderBy('priority', 'desc')
                    ->orderBy('tokens.id', 'asc')
                    ->paginate(12);
            } else {
                $tokens = $tokens->inRandomOrder()
                    ->paginate(10);
            }
        }

        foreach($tokens as $token) {
            $token['favorite_count'] = Favorite::where('contract_address', $collection['contract_address'])
                ->where('token_id', $token['token_id'])
                ->where('status', 1)
                ->count();

            $status = Favorite::where('address', $request->address)
                ->where('contract_address', $collection['contract_address'])
                ->where('token_id', $token['token_id'])
                ->where('status', 1)
                ->first();

            $token['favorite_status'] = $status ? true : false;
        }

        return response()->json([
            'collection' => $collection,
            'tokens' => $tokens
        ]);
    }

    public function getTokensPaginate(Request $request) {
        $collection = Collection::where('chain_id', $request->chainId)
            ->where('contract_address', $request->contractAddress)
            ->first();

        $tokens = [];

        if($collection) {
            $tokens = Token::where('collection_id', $collection['id'])
                ->orderBy('priority', 'desc')
                ->paginate(10);
        }

        return response()->json([
            'collection' => $collection,
            'tokens' => $tokens
        ]);
    }

    public function getToken($address, $contract_address, $id) {
        if(strtolower($contract_address) == strtolower(config('ownly.contract_address_3dmustachios'))) {
            $mustachioController = new MustachioController();
            $mustachioController->getMustachioPathfinderMarauder($id);
        }

        $collection = Collection::where('contract_address', 'LIKE', $contract_address)
            ->first();

        $token = Token::select('tokens.token_id', 'name', 'description', 'image', 'thumbnail', 'attributes', 'to', 'transaction_hash')
            ->where('collection_id', $collection['id'])
            ->leftJoin('token_transfers', 'token_transfers.id', 'token_transfer_id')
            ->where('tokens.token_id', $id)
            ->first();

        $token['favorite_count'] = Favorite::where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->count();

        $status = Favorite::where('address', $address)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->where('status', 1)
            ->first();

        $token['favorite_status'] = $status ? true : false;

        $bsc_chain_ids = [56, 97];

        $token['transfers'] = TokenTransfer::whereIn('chain_id', $bsc_chain_ids)
            ->where('contract_address', $contract_address)
            ->where('token_id', $id)
            ->orderBy('signed_at', 'desc')
            ->get();

        if($collection['id'] == 9 || $collection['id'] == 11) {
            if($token['token_id'] > 210) {
                abort(404);
            }
        }

        return $token;
    }

    public function getMustachios(Request $request, $address = null) {
        if($address) {
            if(strtolower($address) == strtolower('0x768532c218f4f4e6E4960ceeA7F5a7A947a1dd61') || strtolower($address) == strtolower('0x2d616A0D7104D5E837801dd25B50bA2246DCCe2e') || strtolower($address) == strtolower('0xf2C0499E209acd8FfF122f5B4E93E54C2e0b0ECA')) {
                $mustachios_temp = Token::select('tokens.token_id', 'name', 'description', 'image', 'thumbnail')
                    ->where(function($where) {
                        $where->where('collection_id', 9);
                        $where->orWhere('collection_id', 11);
                    })
                    ->whereIn('token_id', [1, 2, 3])
//                    ->whereIn('token_id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 46, 71, 72, 73, 75, 77, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130])
//                    ->+whereIn('token_id', [77])
                    ->get();
            } else {
                $mustachios_temp = Token::select('tokens.token_id', 'name', 'description', 'image', 'thumbnail')
                    ->where(function($where) {
                        $where->where('collection_id', 9);
                        $where->orWhere('collection_id', 11);
                    })
                    ->join('token_transfers', function($join) use ($address) {
                        $join->on('token_transfers.id', 'token_transfer_id');
                        $join->where('to', $address);
                    })
                    ->get();
            }
        } else {
            $mustachios_temp = Token::select('tokens.token_id', 'name', 'description', 'description', 'image', 'thumbnail')
                ->where(function($where) {
                    $where->where('collection_id', 9);
                    $where->orWhere('collection_id', 11);
                })
                ->orderBy('tokens.token_id')
                ->get();

            $mustachioRascals = Token::select('tokens.*')
                ->where('collection_id', 13)
                ->get();
        }

        $mustachios = [];

        foreach($mustachios_temp as $mustachio_temp) {
            array_push($mustachios, [
                'id' => $mustachio_temp['token_id'],
                'name' => $mustachio_temp['name'],
                'archetype' => ($mustachio_temp['token_id'] > 100) ? 'marauder' : 'pathfinder',
                'description' => $mustachio_temp['description'],
                'image' => $mustachio_temp['image'],
                'thumbnail' => $mustachio_temp['thumbnail']
            ]);
        }

        if(!$mustachioRascals) {
            $mustachioRascals = [];
        }

        if($address) {
            $mustachioRascals = Token::select('tokens.*')
                ->join('token_transfers', function($join) use ($address) {
                    $join->on('token_transfers.id', 'token_transfer_id');
                    $join->where('to', 'LIKE', $address);
                })
                ->where('collection_id', 13)
                ->get();
        }

        if($mustachioRascals) {
            $nodes = json_decode('[{"model":"h_afro","name":"Afro","relatedLines":[]},{"model":"h_bobcut","name":"Bob Cut","relatedLines":[]},{"model":"h_coiled","name":"Coiled","relatedLines":[]},{"model":"h_emo","name":"Emo","relatedLines":[]},{"model":"h_long_straight1","name":"Long Straight","relatedLines":[]},{"model":"h_mohawk","name":"Mohawk","relatedLines":[]},{"model":"h_pigtails","name":"Pigtails","relatedLines":[]},{"model":"h_pushed_back","name":"Pushed Back","relatedLines":[]},{"model":"h_sidepart","name":"Side Part","relatedLines":[]},{"model":"h_wavy","name":"Wavy","relatedLines":[]},{"model":"h_curly","name":"Curly","relatedLines":[]},{"model":"h_ponytail","name":"Ponytail","relatedLines":[]},{"model":"h_pompadour","name":"Pompadour","relatedLines":[]},{"model":"h_sidespikes","name":"Side Spikes","relatedLines":[]},{"model":"h_twintails","name":"Twin Tails","relatedLines":[]},{"model":"e_1","name":"Broad Elf","relatedLines":[]},{"model":"e_2","name":"Midget","relatedLines":[]},{"model":"e_3","name":"Human","relatedLines":[]},{"model":"e_4","name":"Elf","relatedLines":[]},{"model":"e_5","name":"Horn","relatedLines":[]},{"model":"e_6","name":"Fin","relatedLines":[]},{"model":"e_7","name":"Bone","relatedLines":[]},{"model":"e_8","name":"Sharp","relatedLines":[]},{"model":"e_9","name":"Pallid","relatedLines":[]},{"model":"e_10","name":"Hollow Broad","relatedLines":[]},{"model":"m_anchorman","name":"Anchorman","relatedLines":[]},{"model":"m_barber","name":"Barber","relatedLines":[]},{"model":"m_inspector","name":"Inspector","relatedLines":[]},{"model":"m_investigator","name":"Investigator","relatedLines":[]},{"model":"m_master","name":"Master","relatedLines":[]},{"model":"m_millionaire","name":"Millionaire","relatedLines":[]},{"model":"m_patron","name":"Patron","relatedLines":[]},{"model":"m_sanchez","name":"Sanchez","relatedLines":[]},{"model":"m_stranger","name":"Stranger","relatedLines":[]},{"model":"m_strongman","name":"Strongman","relatedLines":[]},{"model":"m_a","name":"Mouse","relatedLines":[]},{"model":"m_b","name":"Elder","relatedLines":[]},{"model":"m_c","name":"Thick Gunslinger","relatedLines":[]},{"model":"m_d","name":"Pyramid","relatedLines":[]},{"model":"m_e","name":"Long Handlebars","relatedLines":[]},{"model":"m_f","name":"French Man","relatedLines":[]},{"model":"m_g","name":"The Curly Cop","relatedLines":[]},{"model":"ew_aviator_1","name":"Tinted Aviator Glasses","relatedLines":[]},{"model":"ew_biker","name":"Biker Glasses","relatedLines":[]},{"model":"ew_round_1","name":"Tinted Round Glasses","relatedLines":[]},{"model":"ew_tiny_glasses","name":"Tiny Glasses","relatedLines":[]},{"model":"ew_aviator_2","name":"Sleepy With Aviator Glasses","relatedLines":[]},{"model":"eye_1","name":"Sleepy With Aviator Glasses","relatedLines":[]},{"model":"ew_aviator_2","name":"Scarred With Aviator Glasses","relatedLines":[]},{"model":"eye_3","name":"Scarred With Aviator Glasses","relatedLines":[]},{"model":"ew_aviator_2","name":"Anime With Aviator Glasses","relatedLines":[]},{"model":"eye_4","name":"Anime With Aviator Glasses","relatedLines":[]},{"model":"ew_aviator_2","name":"Big Round With Aviator Glasses","relatedLines":[]},{"model":"eye_5","name":"Big Round With Aviator Glasses","relatedLines":[]},{"model":"ew_aviator_2","name":"Squinting With Aviator Glasses","relatedLines":[]},{"model":"eye_6","name":"Squinting With Aviator Glasses","relatedLines":[]},{"model":"ew_round_2","name":"Normal With Round Glasses","relatedLines":[]},{"model":"mustachio_eyes","name":"Normal With Round Glasses","relatedLines":[]},{"model":"ew_round_2","name":"Sleepy With Round Glasses","relatedLines":[]},{"model":"eye_1","name":"Sleepy With Round Glasses","relatedLines":[]},{"model":"ew_round_2","name":"Scarred With Round Glasses","relatedLines":[]},{"model":"eye_3","name":"Scarred With Round Glasses","relatedLines":[]},{"model":"ew_round_2","name":"Anime With Round Glasses","relatedLines":[]},{"model":"eye_4","name":"Anime With Round Glasses","relatedLines":[]},{"model":"ew_round_2","name":"Big Round With Round Glasses","relatedLines":[]},{"model":"eye_5","name":"Big Round With Round Glasses","relatedLines":[]},{"model":"ew_round_2","name":"Squinting With Round Glasses","relatedLines":[]},{"model":"eye_6","name":"Squinting With Round Glasses","relatedLines":[]},{"model":"ew_tiny_glasses","name":"Normal With Tiny Glasses","relatedLines":[]},{"model":"mustachio_eyes","name":"Normal With Tiny Glasses","relatedLines":[]},{"model":"ew_tiny_glasses","name":"Scarred With Tiny Glasses","relatedLines":[]},{"model":"eye_3","name":"Scarred With Tiny Glasses","relatedLines":[]},{"model":"ew_tiny_glasses","name":"Anime With Tiny Glasses","relatedLines":[]},{"model":"eye_4","name":"Anime With Tiny Glasses","relatedLines":[]},{"model":"mustachio_eyes","name":"Normal","relatedLines":[]},{"model":"eye_1","name":"Sleepy","relatedLines":[]},{"model":"eye_2","name":"Patch","relatedLines":[]},{"model":"eye_3","name":"Scarred","relatedLines":[]},{"model":"eye_4","name":"Anime","relatedLines":[]},{"model":"eye_5","name":"Big Round","relatedLines":[]},{"model":"eye_6","name":"Squinting","relatedLines":[]},{"model":"eye_7","name":"X","relatedLines":[]},{"model":"c_cardigan_main","name":"Sleeveless Cardigan Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Sleeveless Cardigan Plus Pants","relatedLines":[]},{"model":"c_cardigan_main","name":"Cardigan Plus Pants","relatedLines":[]},{"model":"c_cardigan_sleeves","name":"Cardigan Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Cardigan Plus Pants","relatedLines":[]},{"model":"c_cardigan_main","name":"Sleeveless Cardigan Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Sleeveless Cardigan Plus Shorts","relatedLines":[]},{"model":"c_cardigan_main","name":"Cardigan Plus Shorts","relatedLines":[]},{"model":"c_cardigan_sleeves","name":"Cardigan Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Cardigan Plus Shorts","relatedLines":[]},{"model":"c_cardigan_main","name":"Sleeveless Cardigan Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Sleeveless Cardigan Plus Ripped Jeans","relatedLines":[]},{"model":"c_cardigan_main","name":"Cardigan Plus Ripped Jeans","relatedLines":[]},{"model":"c_cardigan_sleeves","name":"Cardigan Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Cardigan Plus Ripped Jeans","relatedLines":[]},{"model":"c_hoodie_main","name":"Sleeveless Hoodie Plus Pants","relatedLines":[]},{"model":"c_hoodie_shirt","name":"Sleeveless Hoodie Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Sleeveless Hoodie Plus Pants","relatedLines":[]},{"model":"c_hoodie_main","name":"Hoodie Plus Pants","relatedLines":[]},{"model":"c_hoodie_shirt","name":"Hoodie Plus Pants","relatedLines":[]},{"model":"c_hoodie_sleeves","name":"Hoodie Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Hoodie Plus Pants","relatedLines":[]},{"model":"c_hoodie_main","name":"Sleeveless Hoodie Plus Shorts","relatedLines":[]},{"model":"c_hoodie_shirt","name":"Sleeveless Hoodie Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Sleeveless Hoodie Plus Shorts","relatedLines":[]},{"model":"c_hoodie_main","name":"Hoodie Plus Shorts","relatedLines":[]},{"model":"c_hoodie_shirt","name":"Hoodie Plus Shorts","relatedLines":[]},{"model":"c_hoodie_sleeves","name":"Hoodie Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Hoodie Plus Shorts","relatedLines":[]},{"model":"c_hoodie_main","name":"Sleeveless Hoodie Plus Ripped Jeans","relatedLines":[]},{"model":"c_hoodie_shirt","name":"Sleeveless Hoodie Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Sleeveless Hoodie Plus Ripped Jeans","relatedLines":[]},{"model":"c_hoodie_main","name":"Hoodie Plus Ripped Jeans","relatedLines":[]},{"model":"c_hoodie_shirt","name":"Hoodie Plus Ripped Jeans","relatedLines":[]},{"model":"c_hoodie_sleeves","name":"Hoodie Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Hoodie Plus Ripped Jeans","relatedLines":[]},{"model":"c_jacket_main","name":"Sleeveless Jacket Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Sleeveless Jacket Plus Pants","relatedLines":[]},{"model":"c_jacket_main","name":"Jacket Plus Pants","relatedLines":[]},{"model":"c_jacket_sleeves","name":"Jacket Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Jacket Plus Pants","relatedLines":[]},{"model":"c_jacket_main","name":"Sleeveless Jacket Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Sleeveless Jacket Plus Shorts","relatedLines":[]},{"model":"c_jacket_main","name":"Jacket Plus Shorts","relatedLines":[]},{"model":"c_jacket_sleeves","name":"Jacket Plus Shorts","relatedLines":[]},{"model":"c_rippedjeans","name":"Jacket Plus Shorts","relatedLines":[]},{"model":"c_jacket_main","name":"Sleeveless Jacket Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Sleeveless Jacket Plus Ripped Jeans","relatedLines":[]},{"model":"c_jacket_main","name":"Jacket Plus Ripped Jeans","relatedLines":[]},{"model":"c_jacket_sleeves","name":"Jacket Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Jacket Plus Ripped Jeans","relatedLines":[]},{"model":"c_shirt_1","name":"Sleeveless Shirt Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Sleeveless Shirt Plus Pants","relatedLines":[]},{"model":"c_shirt_1","name":"Shirt Plus Pants","relatedLines":[]},{"model":"c_shirt_2","name":"Shirt Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Shirt Plus Pants","relatedLines":[]},{"model":"c_shirt_1","name":"Sleeveless Shirt Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Sleeveless Shirt Plus Shorts","relatedLines":[]},{"model":"c_shirt_1","name":"Shirt Plus Shorts","relatedLines":[]},{"model":"c_shirt_2","name":"Shirt Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Shirt Plus Shorts","relatedLines":[]},{"model":"c_shirt_1","name":"Sleeveless Shirt Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Sleeveless Shirt Plus Ripped Jeans","relatedLines":[]},{"model":"c_shirt_1","name":"Shirt Plus Ripped Jeans","relatedLines":[]},{"model":"c_shirt_2","name":"Shirt Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Shirt Plus Ripped Jeans","relatedLines":[]},{"model":"c_turtleneck_main","name":"Sleeveless Turtleneck Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Sleeveless Turtleneck Plus Pants","relatedLines":[]},{"model":"c_turtleneck_main","name":"Turtleneck Plus Pants","relatedLines":[]},{"model":"c_turtleneck_sleeves","name":"Turtleneck Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Turtleneck Plus Pants","relatedLines":[]},{"model":"c_turtleneck_main","name":"Sleeveless Turtleneck Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Sleeveless Turtleneck Plus Shorts","relatedLines":[]},{"model":"c_turtleneck_main","name":"Turtleneck Plus Shorts","relatedLines":[]},{"model":"c_turtleneck_sleeves","name":"Turtleneck Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Turtleneck Plus Shorts","relatedLines":[]},{"model":"c_turtleneck_main","name":"Sleeveless Turtleneck Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Sleeveless Turtleneck Plus Ripped Jeans","relatedLines":[]},{"model":"c_turtleneck_main","name":"Turtleneck Plus Ripped Jeans","relatedLines":[]},{"model":"c_turtleneck_sleeves","name":"Turtleneck Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Turtleneck Plus Ripped Jeans","relatedLines":[]},{"model":"c_varsity_main","name":"Sleeveless Varsity Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Sleeveless Varsity Plus Pants","relatedLines":[]},{"model":"c_varsity_main","name":"Varsity Plus Pants","relatedLines":[]},{"model":"c_varsity_sleeves","name":"Varsity Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Varsity Plus Pants","relatedLines":[]},{"model":"c_varsity_main","name":"Sleeveless Varsity Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Sleeveless Varsity Plus Shorts","relatedLines":[]},{"model":"c_varsity_main","name":"Varsity Plus Shorts","relatedLines":[]},{"model":"c_varsity_sleeves","name":"Varsity Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Varsity Plus Shorts","relatedLines":[]},{"model":"c_varsity_main","name":"Sleeveless Varsity Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Sleeveless Varsity Plus Ripped Jeans","relatedLines":[]},{"model":"c_varsity_main","name":"Varsity Plus Ripped Jeans","relatedLines":[]},{"model":"c_varsity_sleeves","name":"Varsity Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Varsity Plus Ripped Jeans","relatedLines":[]},{"model":"c_vneck_main","name":"Sleeveless V Neck Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Sleeveless V Neck Plus Pants","relatedLines":[]},{"model":"c_vneck_main","name":"V Neck Plus Pants","relatedLines":[]},{"model":"c_vneck_sleeves","name":"V Neck Plus Pants","relatedLines":[]},{"model":"c_pants","name":"V Neck Plus Pants","relatedLines":[]},{"model":"c_vneck_main","name":"Sleeveless V Neck Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Sleeveless V Neck Plus Shorts","relatedLines":[]},{"model":"c_vneck_main","name":"V Neck Plus Shorts","relatedLines":[]},{"model":"c_vneck_sleeves","name":"V Neck Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"V Neck Plus Shorts","relatedLines":[]},{"model":"c_vneck_main","name":"Sleeveless V Neck Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Sleeveless V Neck Plus Ripped Jeans","relatedLines":[]},{"model":"c_vneck_main","name":"V Neck Plus Ripped Jeans","relatedLines":[]},{"model":"c_vneck_sleeves","name":"V Neck Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"V Neck Plus Ripped Jeans","relatedLines":[]},{"model":"c_vest","name":"Vest Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Vest Plus Pants","relatedLines":[]},{"model":"c_vest","name":"Vest Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Vest Plus Shorts","relatedLines":[]},{"model":"c_vest","name":"Vest Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Vest Plus Ripped Jeans","relatedLines":[]},{"model":"c_overalls","name":"Overalls Plus Pants","relatedLines":[]},{"model":"c_overalls_shirt","name":"Overalls Plus Pants","relatedLines":[]},{"model":"c_overalls_sleeve","name":"Overalls Plus Pants","relatedLines":[]},{"model":"c_overalls_pocket","name":"Overalls Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Overalls Plus Pants","relatedLines":[]},{"model":"c_overalls","name":"Sleeveless Overalls Plus Pants","relatedLines":[]},{"model":"c_overalls_shirt","name":"Sleeveless Overalls Plus Pants","relatedLines":[]},{"model":"c_overalls_pocket","name":"Sleeveless Overalls Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Sleeveless Overalls Plus Pants","relatedLines":[]},{"model":"c_overalls","name":"Long Sleeved Overalls Plus Pants","relatedLines":[]},{"model":"c_overalls_shirt","name":"Long Sleeved Overalls Plus Pants","relatedLines":[]},{"model":"c_overalls_pocket","name":"Long Sleeved Overalls Plus Pants","relatedLines":[]},{"model":"c_jacket_sleeves","name":"Long Sleeved Overalls Plus Pants","relatedLines":[]},{"model":"c_pants","name":"Long Sleeved Overalls Plus Pants","relatedLines":[]},{"model":"c_overalls","name":"Overalls Plus Shorts","relatedLines":[]},{"model":"c_overalls_shirt","name":"Overalls Plus Shorts","relatedLines":[]},{"model":"c_overalls_sleeve","name":"Overalls Plus Shorts","relatedLines":[]},{"model":"c_overalls_pocket","name":"Overalls Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Overalls Plus Shorts","relatedLines":[]},{"model":"c_overalls","name":"Sleeveless Overalls Plus Shorts","relatedLines":[]},{"model":"c_overalls_shirt","name":"Sleeveless Overalls Plus Shorts","relatedLines":[]},{"model":"c_overalls_pocket","name":"Sleeveless Overalls Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Sleeveless Overalls Plus Shorts","relatedLines":[]},{"model":"c_overalls","name":"Long Sleeved Overalls Plus Shorts","relatedLines":[]},{"model":"c_overalls_shirt","name":"Long Sleeved Overalls Plus Shorts","relatedLines":[]},{"model":"c_overalls_pocket","name":"Long Sleeved Overalls Plus Shorts","relatedLines":[]},{"model":"c_jacket_sleeves","name":"Long Sleeved Overalls Plus Shorts","relatedLines":[]},{"model":"c_shorts","name":"Long Sleeved Overalls Plus Shorts","relatedLines":[]},{"model":"c_overalls","name":"Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_overalls_shirt","name":"Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_overalls_sleeve","name":"Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_overalls_pocket","name":"Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_overalls","name":"Sleeveless Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_overalls_shirt","name":"Sleeveless Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_overalls_pocket","name":"Sleeveless Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Sleeveless Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_overalls","name":"Long Sleeved Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_overalls_shirt","name":"Long Sleeved Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_overalls_pocket","name":"Long Sleeved Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_jacket_sleeves","name":"Long Sleeved Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"c_rippedjeans","name":"Long Sleeved Overalls Plus Ripped Jeans","relatedLines":[]},{"model":"f_chelsea_boots","name":"Chelsea Boots","relatedLines":[]},{"model":"f_boat","name":"Boat Shoes","relatedLines":[]},{"model":"f_canvas","name":"Canvas Sneakers","relatedLines":[]},{"model":"f_flip_flops","name":"Flip flops","relatedLines":[]},{"model":"f_high_boots","name":"High Boots","relatedLines":[]},{"model":"f_loafers","name":"Loafers","relatedLines":[]},{"model":"f_mule","name":"Mule","relatedLines":[]},{"model":"f_sandals","name":"Sandals","relatedLines":[]},{"model":"f_slipons","name":"Slip Ons","relatedLines":[]},{"model":"f_trainers","name":"Trainers","relatedLines":[]}]', true);
            $skinColors = json_decode('{"Ivory":{"r":0.9137254901960784,"g":0.796078431372549,"b":0.6627450980392157},"Porcelain":{"r":0.9372549019607843,"g":0.8196078431372549,"b":0.7176470588235294},"Pale Ivory":{"r":0.9686274509803922,"g":0.8666666666666667,"b":0.7607843137254902},"Warm Ivory":{"r":0.9686274509803922,"g":0.8862745098039215,"b":0.6705882352941176},"Sand":{"r":0.9333333333333333,"g":0.7764705882352941,"b":0.5843137254901961},"Rose Beige":{"r":0.9450980392156862,"g":0.7529411764705882,"b":0.5333333333333333},"Limestone":{"r":0.8980392156862745,"g":0.7333333333333333,"b":0.5686274509803921},"Beige":{"r":0.9254901960784314,"g":0.7490196078431373,"b":0.5176470588235295},"Sienna":{"r":0.8196078431372549,"g":0.611764705882353,"b":0.48627450980392156},"Honey":{"r":0.803921568627451,"g":0.5843137254901961,"b":0.39215686274509803},"Band":{"r":0.6784313725490196,"g":0.5450980392156862,"b":0.396078431372549},"Almond":{"r":0.5803921568627451,"g":0.3764705882352941,"b":0.23137254901960785},"Chestnut":{"r":0.5372549019607843,"g":0.32941176470588235,"b":0.20392156862745098},"Bronze":{"r":0.47058823529411764,"g":0.26666666666666666,"b":0.12156862745098039},"Umber":{"r":0.6901960784313725,"g":0.4117647058823529,"b":0.28627450980392155},"Golden":{"r":0.4980392156862745,"g":0.2823529411764706,"b":0.1607843137254902},"Espresso":{"r":0.3843137254901961,"g":0.22745098039215686,"b":0.09019607843137255},"Chocolate":{"r":0.19607843137254902,"g":0.12156862745098039,"b":0.06666666666666667}}', true);
            $hairColors = json_decode('{"Black":{"r":0,"g":0,"b":0},"Maastricht Blue":{"r":0.03137254901960784,"g":0.11764705882352941,"b":0.16862745098039217},"Granite Gray":{"r":0.3764705882352941,"g":0.4,"b":0.35294117647058826},"Brown Tumbleweed":{"r":0.3764705882352941,"g":0.4,"b":0.35294117647058826},"Bulgarian Rose":{"r":0.2980392156862745,"g":0.03137254901960784,"b":0.03137254901960784}}', true);
            $clothColors = json_decode('{"Cream":{"r":1,"g":0.8666666666666667,"b":0.3764705882352941},"Lilac Grey":{"r":0.6392156862745098,"g":0.5411764705882353,"b":0.5529411764705883},"Icy Blue":{"r":0.592156862745098,"g":0.7568627450980392,"b":0.9019607843137255},"Eggshell Blue":{"r":0.6196078431372549,"g":0.7764705882352941,"b":0.7607843137254902},"Warm Tan":{"r":0.7607843137254902,"g":0.6549019607843137,"b":0.5490196078431373},"African Violet":{"r":0.6980392156862745,"g":0.5176470588235295,"b":0.7450980392156863},"Burnt Sienna":{"r":0.9137254901960784,"g":0.4549019607843137,"b":0.3176470588235294},"Pastel Green":{"r":0.4666666666666667,"g":0.8666666666666667,"b":0.4666666666666667},"Rust":{"r":0.7176470588235294,"g":0.2549019607843137,"b":0.054901960784313725},"Flamingo Pink":{"r":0.9882352941176471,"g":0.5568627450980392,"b":0.6745098039215687},"Pale Green":{"r":0.596078431372549,"g":0.984313725490196,"b":0.596078431372549},"Medium Aquamarine":{"r":0.4,"g":0.803921568627451,"b":0.6666666666666666},"Turquoise":{"r":0.25098039215686274,"g":0.8784313725490196,"b":0.8156862745098039},"Deep Sky Blue":{"r":0,"g":0.7490196078431373,"b":1},"Cornsilk":{"r":1,"g":0.9725490196078431,"b":0.8627450980392157},"Sandy Brown":{"r":0.9568627450980393,"g":0.6431372549019608,"b":0.3764705882352941},"Orchid":{"r":0.8549019607843137,"g":0.4392156862745098,"b":0.8392156862745098},"Gold":{"r":1,"g":0.8431372549019608,"b":0},"Tomato":{"r":1,"g":0.38823529411764707,"b":0.2784313725490196},"Hot Pink":{"r":1,"g":0.4117647058823529,"b":0.7058823529411765},"Black":{"r":0,"g":0,"b":0},"Dark Slate Gray":{"r":0.1843137254901961,"g":0.30980392156862746,"b":0.30980392156862746},"Charcoal":{"r":0.13333333333333333,"g":0.12549019607843137,"b":0.12941176470588237},"Chocolate":{"r":0.16862745098039217,"g":0.09019607843137255,"b":0},"Denim":{"r":0.08235294117647059,"g":0.11764705882352941,"b":0.23921568627450981},"Medium Jungle Green":{"r":0.10980392156862745,"g":0.20784313725490197,"b":0.17647058823529413},"Mahogany":{"r":0.25882352941176473,"g":0.047058823529411764,"b":0.03529411764705882},"Brown":{"r":0.13725490196078433,"g":0.09019607843137255,"b":0.03529411764705882},"Rasin":{"r":0.1607843137254902,"g":0.03529411764705882,"b":0.08627450980392157},"Eerie Black":{"r":0.10588235294117647,"g":0.10588235294117647,"b":0.10588235294117647}}', true);
            $eyewearColors = json_decode('{"Blackberry":{"r":0.22745098039215686,"g":0.22745098039215686,"b":0.2196078431372549},"Vampire Gray":{"r":0.33725490196078434,"g":0.3137254901960784,"b":0.3176470588235294},"Smoky Black":{"r":0.33725490196078434,"g":0.3137254901960784,"b":0.3176470588235294},"Army Uniform":{"r":0.20784313725490197,"g":0.24705882352941178,"b":0.24313725490196078},"Gray Cloud":{"r":0.7137254901960784,"g":0.7137254901960784,"b":0.7058823529411765},"Granite":{"r":0.403921568627451,"g":0.403921568627451,"b":0.403921568627451},"Gray":{"r":0.5019607843137255,"g":0.5019607843137255,"b":0.5019607843137255},"Ebony":{"r":0.3333333333333333,"g":0.36470588235294116,"b":0.3137254901960784},"Charcoal":{"r":0.21176470588235294,"g":0.27058823529411763,"b":0.30980392156862746},"Black Eel":{"r":0.27450980392156865,"g":0.24313725490196078,"b":0.24705882352941178},"Black":{"r":0,"g":0,"b":0},"Dim Gray":{"r":0.4117647058823529,"g":0.4117647058823529,"b":0.4117647058823529}}', true);
            $mustacheColors = json_decode('{"Black":{"r":0,"g":0,"b":0},"Stone":{"r":0.34901960784313724,"g":0.47058823529411764,"b":0.5568627450980392},"Gold":{"r":1,"g":0.8431372549019608,"b":0},"Silver":{"r":0.7450980392156863,"g":0.7607843137254902,"b":0.796078431372549},"White":{"r":0.9803921568627451,"g":0.9803921568627451,"b":0.9803921568627451},"Coffee":{"r":0.43529411764705883,"g":0.3058823529411765,"b":0.21568627450980393},"Red Ochre":{"r":0.5686274509803921,"g":0.2196078431372549,"b":0.19215686274509805}}', true);
        }

        foreach($mustachioRascals as $mustachioRascal) {
//            $metadata = Http::get('https://ownly.market/api/rascals/' . $mustachioRascal['token_id']);
//            $mustachioRascal->attributes = json_encode($metadata['attributes']);
//            $mustachioRascal->update();

            $metadata = MustachioRascal::find($mustachioRascal['token_id'] + 1);

            $attributes = json_decode($metadata['attributes'], true);
            $newAttributes = [];

            for($i = 0; $i < 6; $i++) {
                $hasMatch = false;

                foreach($nodes as $node) {
                    if($attributes[$i]['value'] == $node['name']) {
                        $newAttributes[] = [
                            'trait_type' => $attributes[$i]['trait_type'],
                            'value' => $attributes[$i]['value'],
                            'model' => $node['model']
                        ];

                        $hasMatch = true;
                    }
                }

                if(!$hasMatch) {
                    $newAttributes[] = [
                        'trait_type' => $attributes[$i]['trait_type'],
                        'value' => $attributes[$i]['value'],
                        'model' => null
                    ];
                }
            }

            $isSkinTexture = (str_contains($attributes[6]['value'], 'Texture') || str_contains($attributes[6]['value'], 'Pattern'));
            $isUpperGarment1Texture = (str_contains($attributes[8]['value'], 'Texture') || str_contains($attributes[8]['value'], 'Pattern') || str_contains($attributes[8]['value'], 'Shirt'));
            $isUpperGarment2Texture = (str_contains($attributes[9]['value'], 'Texture') || str_contains($attributes[9]['value'], 'Pattern') || str_contains($attributes[9]['value'], 'Shirt'));
            $isLowerGarmentTexture = (str_contains($attributes[10]['value'], 'Texture') || str_contains($attributes[10]['value'], 'Pattern'));

            $materialTraits = [
                'Skin' => [
                    'type' => $isSkinTexture ? 'texture' : 'color',
                    'value' => $attributes[6]['value'],
                    'r' => !$isSkinTexture ? $skinColors[$attributes[6]['value']]['r'] : null,
                    'g' => !$isSkinTexture ? $skinColors[$attributes[6]['value']]['g'] : null,
                    'b' => !$isSkinTexture ? $skinColors[$attributes[6]['value']]['b'] : null
                ],
                'Hair' => [
                    'type' => 'color',
                    'value' => $attributes[7]['value'],
                    'r' => $hairColors[$attributes[7]['value']]['r'],
                    'g' => $hairColors[$attributes[7]['value']]['g'],
                    'b' => $hairColors[$attributes[7]['value']]['b']
                ],
                'Upper_garment_1' => [
                    'type' => $isUpperGarment1Texture ? 'texture' : 'color',
                    'value' => $attributes[8]['value'],
                    'r' => !$isUpperGarment1Texture ? $clothColors[$attributes[8]['value']]['r'] : 1,
                    'g' => !$isUpperGarment1Texture ? $clothColors[$attributes[8]['value']]['g'] : 1,
                    'b' => !$isUpperGarment1Texture ? $clothColors[$attributes[8]['value']]['b'] : 1
                ],
                'Upper_garment_2' => [
                    'type' => $isUpperGarment2Texture ? 'texture' : 'color',
                    'value' => $attributes[9]['value'],
                    'r' => !$isUpperGarment2Texture ? $clothColors[$attributes[9]['value']]['r'] : 1,
                    'g' => !$isUpperGarment2Texture ? $clothColors[$attributes[9]['value']]['g'] : 1,
                    'b' => !$isUpperGarment2Texture ? $clothColors[$attributes[9]['value']]['b'] : 1
                ],
                'Lower_Garment_Color' => [
                    'type' => $isLowerGarmentTexture ? 'texture' : 'color',
                    'value' => $attributes[10]['value'],
                    'r' => !$isLowerGarmentTexture ? $clothColors[$attributes[10]['value']]['r'] : 1,
                    'g' => !$isLowerGarmentTexture ? $clothColors[$attributes[10]['value']]['g'] : 1,
                    'b' => !$isLowerGarmentTexture ? $clothColors[$attributes[10]['value']]['b'] : 1
                ],
                'Eyewear' => [
                    'type' => 'color',
                    'value' => $attributes[11]['value'],
                    'r' => $eyewearColors[$attributes[11]['value']]['r'],
                    'g' => $eyewearColors[$attributes[11]['value']]['g'],
                    'b' => $eyewearColors[$attributes[11]['value']]['b']
                ],
                'Mustache' => [
                    'type' => 'color',
                    'value' => $attributes[12]['value'],
                    'r' => $mustacheColors[$attributes[12]['value']]['r'],
                    'g' => $mustacheColors[$attributes[12]['value']]['g'],
                    'b' => $mustacheColors[$attributes[12]['value']]['b']
                ],
                'Footwear_Color_1' => [
                    'type' => 'color',
                    'value' => $attributes[13]['value'],
                    'r' => $clothColors[$attributes[13]['value']]['r'],
                    'g' => $clothColors[$attributes[13]['value']]['g'],
                    'b' => $clothColors[$attributes[13]['value']]['b']
                ],
                'Footwear_Color_2' => [
                    'type' => 'color',
                    'value' => $attributes[14]['value'],
                    'r' => $clothColors[$attributes[14]['value']]['r'],
                    'g' => $clothColors[$attributes[14]['value']]['g'],
                    'b' => $clothColors[$attributes[14]['value']]['b']
                ]
            ];

            array_push($mustachios, [
                'id' => $mustachioRascal['token_id'],
                'name' => $mustachioRascal['name'],
                'archetype' => 'rascal',
                'description' => $mustachioRascal['description'],
                'image' => $mustachioRascal['image'],
                'thumbnail' => $mustachioRascal['image'],
                'attributes' => $newAttributes,
                'material_traits' => $materialTraits,
            ]);
        }

        return response()->json([
            'mustachios' => $mustachios
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'chainId' => 'required',
            'contractAddress' => 'required',
            'tokenId' => 'required',
            'metadata' => 'required',
            'apiKey' => 'required',
        ]);

        if($request->apiKey != config('ownly.api_key')) {
            abort(404);
        }

        $chainIds = ["1", "56", "137"];

        if(!in_array($request->chainId, $chainIds)) {
            abort(404);
        }

        $collection = Collection::where('contract_address', 'LIKE', $request->contractAddress)
            ->where('chain_id', $request->chainId)
            ->first();

        if(!$collection) {
            abort(404);
        }

        $token = Token::where('collection_id', $collection['id'])
            ->where('token_id', $request->tokenId)
            ->first();

        if(!$token) {
            $metadata = json_decode($request->metadata, true);

            $token = new Token();
            $token->collection_id = $collection['id'];
            $token->token_id = $request->tokenId;
            $token->name = $metadata['name'];
            $token->description = $metadata['description'];
            $token->image = $metadata['image'];
            $token->thumbnail = $metadata['image'];
            $token->attributes = json_encode($metadata['attributes']);
            $token->save();
        }

        return response()->json([
            'token' => $token
        ]);
    }

    public function checkForNewlyMintedMustachio3DTokens() {
        $mustachioPathfinderMarauders = MustachioPathfinderMarauder::where('exists', 0)
            ->get();

        foreach($mustachioPathfinderMarauders as $mustachioPathfinderMarauder) {
            $minted = MustachioController::check_if_minted($mustachioPathfinderMarauder, '56', '0x7De755985E7079A07bfC4919c770450436D413a9');

            if($minted && $minted['id'] > 100) {
                $collectionId = 11;
                $token = Token::where('collection_id', $collectionId)
                    ->where('token_id', $mustachioPathfinderMarauder['id'])
                    ->first();

                if(!$token) {
                    $token = new Token();
                }

                $token->collection_id = $collectionId;
                $token->token_id = $minted['id'];
                $token->name = $minted['name'];
                $token->description = $minted['description'];
                $token->image = $minted['image'];
                $token->thumbnail = $minted['image'];
                $token->attributes = $minted['attributes'];
                $token->save();
            }
        }
    }

    public function checkForNewlyMintedMustachioTokens() {
        $mustachios = Mustachio::where('exists', 0)
            ->get();

        foreach($mustachios as $mustachio) {
            $minted = MustachioController::check_if_minted($mustachio, '1', '0x9e7a3a2e0c60c70efc115bf03e6c544ef07620e5');

            if($minted) {
                $collectionId = 4;
                $token = Token::where('collection_id', $collectionId)
                    ->where('token_id', $mustachio['id'])
                    ->first();

                if(!$token) {
                    $token = new Token();
                }

                $token->collection_id = $collectionId;
                $token->token_id = $minted['id'];
                $token->name = $minted['name'];
                $token->description = $minted['description'];
                $token->image = $minted['image'];
                $token->thumbnail = $minted['image'];
                $token->attributes = $minted['attributes'];
                $token->save();

                break;
            }

            break;
        }
    }
}
