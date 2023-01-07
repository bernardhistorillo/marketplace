<?php

namespace App;

use App\Http\Controllers\TokenTransferController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Token extends Model
{
    public function collection() {
        return $this->belongsTo(Collection::class, 'collection_id', 'id')
            ->first();
    }

    public function thumbnail() {
        return json_decode($this->thumbnail, true);
    }

    public function ogImage() {
        $collection = $this->collection();
        $ogImage = $this->thumbnail()['jpg512'];

        if(in_array($collection['url_placeholder'], ['cryptosolitaire', 'inkvadyrz'])) {
            $tokenId = $this->token_id;

            while(strlen($tokenId) < 4) {
                $tokenId = '0' . $tokenId;
            }

            $ogImage = 'https://ownly.io/nft/collection/collection-' . $tokenId . '.png';
        } else if(in_array($collection['url_placeholder'], ['genesisblock'])) {
            $ogImage = 'https://ownly.io/nft/genesis-block/api/' . $this->token_id . '/image.png';
        } else if(in_array($collection['url_placeholder'], ['sagesrantcollectibles'])) {
            $ogImage = 'https://ownly.io/nft/the-sages-rant-collectibles/api/' . $this->token_id . '/image.png';
        } else if(in_array($collection['url_placeholder'], ['oha'])) {
            $ogImage = asset('img/collections/oha/' . $this->token_id . '.jpg');
        } else if(in_array($collection['url_placeholder'], ['rewards'])) {
            $ogImage = asset('img/collections/rewards/' . $this->token_id . '.png');
        }

        return $ogImage;
    }

    public function tokenTransfer() {
        $tokenTransfer = $this->belongsTo(TokenTransfer::class, 'token_transfer_id', 'id')
            ->first();

        if(!$tokenTransfer) {
            $collection = $this->collection();

            $tokenTransfer = TokenTransfer::where('chain_id', $collection['chain_id'])
                ->where('contract_address', $collection['contract_address'])
                ->where('token_id', $this->token_id)
                ->orderBy('signed_at', 'desc')
                ->first();

            $this->token_transfer_id = $tokenTransfer['id'];
            $this->update();
        }

        return $tokenTransfer;
    }

    public function transfers() {
        $collection = $this->collection();

        return TokenTransfer::where('chain_id', $collection['chain_id'])
            ->where('contract_address', $collection['contract_address'])
            ->where('token_id', $this->token_id)
            ->orderBy('signed_at', 'desc')
            ->get();
    }

    public function properties() {
        $properties = json_decode($this['attributes'], true);
        $collectionProperties = $this->collection()->properties();

        foreach($properties as $i => $property) {
            $totalTraitCount = 0;

            foreach($collectionProperties[$property['trait_type']] as $collectionPropertyTraitCount) {
                $totalTraitCount += $collectionPropertyTraitCount;
            }

            $properties[$i]['percentage'] = ($collectionProperties[$property['trait_type']][$property['value']] / $totalTraitCount) * 100;
        }

        return $properties;
    }

    public function favoriteCount() {
        return MarketItemFavorite::where('contract_address', $this->collection()['contract_address'])
            ->where('token_id', $this->token_id)
            ->where('status', 1)
            ->count();
    }

    public function favoriteStatus($account) {
        $status = MarketItemFavorite::where('address', $account)
            ->where('contract_address', $this->collection()['contract_address'])
            ->where('token_id', $this->token_id)
            ->where('status', 1)
            ->first();

        return (bool)$status;
    }

    public function owner() {
        $collection = $this->collection();

        $response = Http::post(config('ownly.nodejs_url') . '/web3/getTokenOwner', [
            'rpcUrl' => $collection->rpcUrl(),
            'abi' => $collection['abi'],
            'contractAddress' => $collection['contract_address'],
            'tokenId' => $this->token_id,
            'key' => config('ownly.api_key')
        ]);

        return $response['owner'];
    }

    public function marketItem() {
        $collection = $this->collection();

        if($collection->marketplaceContractAddress()) {
            $response = Http::post(config('ownly.nodejs_url') . '/web3/getMarketItem', [
                'rpcUrl' => $collection->rpcUrl(),
                'abi' => $collection->marketplaceContractAbi(),
                'marketplaceContractAddress' => $collection->marketplaceContractAddress(),
                'contractAddress' => $collection['contract_address'],
                'tokenId' => $this->token_id,
                'key' => config('ownly.api_key')
            ]);

            $marketItem = $response['marketItem'];
        } else {
            $marketItem = null;
        }

        return $marketItem;
    }

    public function updateTokenTransaction() {
        $owner = $this->owner();
        $collection = $this->collection();

        $transfer = TokenTransfer::where('chain_id', $collection['chain_id'])
            ->where('contract_address', 'LIKE', $collection['contract_address'])
            ->where('token_id', $this->token_id)
            ->orderBy('signed_at', 'desc')
            ->first();

        $chain_id = $collection['chain_id'];
        $contract_address = strtolower($collection['contract_address']);

        if(!$transfer || strtolower($transfer['to']) != strtolower($owner)) {
            $response = Http::get('https://api.covalenthq.com/v1/' . $collection['chain_id'] . "/tokens/" . $contract_address . '/nft_transactions/' . $this->token_id . '/?&key=ckey_994c8fdd549f44fa9b2b27f59a0');

            $currency = $collection->currency();

            if(isset($response['data']['items'])) {
                $items = $response['data']['items'];

                for($i = 0; $i < count($items); $i++) {
                    $nftTransactions = $items[$i]['nft_transactions'];

                    for($j = 0; $j < count($nftTransactions); $j++) {
                        $logEvents = $nftTransactions[$j]['log_events'];

                        for($k = 0; $k < count($logEvents); $k++) {
                            $decoded = $logEvents[$k]['decoded'];

                            // NFT transfer
                            if($decoded && strtolower($logEvents[$k]['sender_address']) != strtolower(config('ownly.contract_address_own_token'))) {
                                $params = $decoded['params'];

                                if(($collection['chain_id'] == 137 && $params[3]['value'] == $this->token_id) || ($collection['chain_id'] != 137 && $params[2]['value'] == $this->token_id)) {
                                    if(in_array($decoded['name'], ['Transfer', 'TransferSingle'])) {
                                        $transaction_hash = $logEvents[$k]['tx_hash'];
                                        $signed_at = $logEvents[$k]['block_signed_at'];
                                        $value = $nftTransactions[$j]['value'] ?? 0;

                                        $from = '';
                                        $to = '';

                                        for($l = 0; $l < count($params); $l++) {
                                            if(in_array($params[$l]['name'], ['from', '_from'])) {
                                                $from = $params[$l]['value'];
                                            } else if(in_array($params[$l]['name'], ['to', '_to'])) {
                                                $to = $params[$l]['value'];
                                            }
                                        }

                                        if($transaction_hash && $from && $to) {
                                            $transfer = TokenTransfer::where('transaction_hash', $transaction_hash)
                                                ->where('chain_id', $collection['chain_id'])
                                                ->where('token_id', $this->token_id)
                                                ->first();

                                            if(!$transfer) {
                                                $transfer = new TokenTransfer();

                                                $transfer->chain_id = $collection['chain_id'];
                                                $transfer->contract_address = $contract_address;
                                                $transfer->token_id = $this->token_id;
                                                $transfer->from = $from;
                                                $transfer->to = $to;
                                                $transfer->value = $value / pow(10, 18);
                                                $transfer->currency = $currency;
                                                $transfer->transaction_hash = $transaction_hash;
                                                $transfer->signed_at = Carbon::parse($signed_at);
                                                $transfer->save();

                                                $previous_token_transfer = TokenTransfer::where('contract_address', $transfer['contract_address'])
                                                    ->where('token_id', $transfer['token_id'])
                                                    ->where('from', $transfer['to'])
                                                    ->where('is_current', 1)
                                                    ->where('signed_at', '<', $transfer['signed_at'])
                                                    ->first();

                                                if($previous_token_transfer) {
                                                    $previous_token_transfer->is_current = 0;
                                                    $previous_token_transfer->update();

                                                    $transfer->is_current = 1;
                                                    $transfer->update();
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            // OWN token transfer
                            if($decoded && strtolower($logEvents[$k]['sender_address']) == strtolower(config('ownly.contract_address_own_token'))) {
                                $params = $decoded['params'];

                                if(in_array($decoded['name'], ['Transfer'])) {
                                    $transaction_hash = $logEvents[$k]['tx_hash'];

                                    $value = 0;

                                    for($l = 0; $l < count($params); $l++) {
                                        if(in_array($params[$l]['name'], ['value'])) {
                                            $value = $params[$l]['value'];
                                        }
                                    }

                                    if($transaction_hash && $value > 0) {
                                        $transfer = TokenTransfer::where('transaction_hash', $transaction_hash)
                                            ->where('chain_id', $collection['chain_id'])
                                            ->first();

                                        if($transfer) {
                                            $transfer->value = toEther($value);
                                            $transfer->currency = "OWN";
                                            $transfer->save();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $collection = Collection::where('chain_id', $chain_id)
            ->where('contract_address', $contract_address)
            ->first();

        $transfer = TokenTransfer::where('chain_id', $collection['chain_id'])
            ->where('contract_address', 'LIKE', $contract_address)
            ->where('token_id', $this->token_id)
            ->orderBy('signed_at', 'desc')
            ->first();

        if($transfer['id'] != $this->token_transfer_id) {
            $this->token_transfer_id = $transfer['id'];
            $this->update();
        }

        return $transfer;
    }
}
