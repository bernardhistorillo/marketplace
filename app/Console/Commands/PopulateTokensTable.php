<?php

namespace App\Console\Commands;

use App\ChenInkToken;
use App\Collection;
use App\Http\Controllers\HelperController;
use App\Mustachio;
use App\Token;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class PopulateTokensTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:populate_tokens_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $out = new ConsoleOutput();

        $collection_inputs = [
//            [
//                'name' => 'CryptoSolitaire',
//                'chain_id' => 1,
//                'contract_address' => '0x804efc52BFa9B85A86219c191d51147566f3B327',
//                'contract_address_testnet' => '0x01d46447398Cc1ea64356d10D975f652874eF361',
//                'description' => 'Digital playing card deck created by Filipino artist, Chen Naje, also known as @chenandink on Instagram. For the clubs, tropical leaves to represent summer is used. For the spades, Chen Naje used maple leaves as symbol for the fall season. For the diamonds, he used ice crystals to represent winter which somehow also look like raw diamonds. Lastly, flowers for the hearts to represent their bloom during spring.',
//                'token_uri' => 'https://ownly.io/nft/api/',
//                'url_placeholder' => 'cryptosolitaire'
//            ],
//            [
//                'name' => 'Inkvadyrz',
//                'chain_id' => 1,
//                'contract_address' => '0x804efc52BFa9B85A86219c191d51147566f3B327',
//                'contract_address_testnet' => '0x01d46447398Cc1ea64356d10D975f652874eF361',
//                'description' => 'The deck is made up of twenty Cryptoart cards composed of three categories: common, uncommon, rare, and legendary. The card’s category shows its rarity, value, and benefits. The legendary cards are priced higher than the rare and common cards. There are also only 2 legendary cards compared to 5 rare cards, 6 uncommon cards, and 7 common cards. Most importantly, owning a legendary card gives the collector the possibility to get the reward piece by getting 9 other cards in the collection.',
//                'token_uri' => 'https://ownly.io/nft/api/',
//                'url_placeholder' => 'inkvadyrz'
//            ], [
//                'name' => 'Titans of Industry',
//                'chain_id' => 56,
//                'contract_address' => '0x804efc52BFa9B85A86219c191d51147566f3B327',
//                'contract_address_testnet' => '0xB9f74a918d3bF21be452444e65039e6365DF9B98',
//                'description' => 'Created by multimedia artist Eugene Oligo, our collaboration entitled Titans of Industry features the pioneers, entrepreneurs, and titans of the crypto space. This collection will surely help you recognize the big ones, their feats, and their impact on the blockchain world.',
//                'token_uri' => 'https://ownly.io/nft/titans-of-industry/api/',
//                'url_placeholder' => 'titans-of-industry'
//            ],
//            [
//                'name' => 'The Mustachios',
//                'chain_id' => 1,
//                'contract_address' => '0x9e7a3A2e0c60c70eFc115BF03e6c544Ef07620E5',
//                'contract_address_testnet' => '0x421dC2b62713223491Daf075C23B39EF0E340E94',
//                'description' => 'Boii Mustache, the artist behind these avatars, describes them as 100 mustached explorers living in a hidden, mysterious, and magical island called MustachioVerse. Each of these Mustachios lived and thrived for over a hundred years, waiting for their turn to tell their own unique tale of adventure. One day, ten brave Mustachios discovered a mysterious torn journal written by The Prospector — the first-ever Mustachio who conquered every possible feat in their universe. Stories have been told about his glory, but no one knows The Prospector’s identity. His Lost Diary mentioned that he discovered 9 valuable artifacts and a precious golden ‘stache — the key in solving the greatest mystery in the land: why do they all have a mustache?',
//                'token_uri' => 'https://ownly.tk/api/mustachio/',
//                'url_placeholder' => 'the-mustachios'
//            ],
//            [
//                'name' => 'Genesis Block',
//                'chain_id' => 1,
//                'contract_address' => '0x2C51aF2916eb9CF6392768158eAa39306779EE85',
//                'contract_address_testnet' => '0xbE76ACbd4fE046e1dD2e89f5978DA1c81C41f311',
//                'description' => 'Marso presents another collection of work combining the elegance of geometry and a vibrant color palette dubbed as the ‘Genesis Block’ of Blockchain, reminiscent of the ceiling of the famous Sistine Chapel. This collection can both stand alone as an individual piece or as a whole with every piece being unique leading to a culmination of the ‘creation’ and establishing of the whole blockchain space. With that being said, the whole collection can be viewed starting from the bottom left (Creation), bottom middle (Distribution), bottom right, (Progress), top left (Prosperity), top middle (Liberty & Freedom), top right (Community), middle right (Immersion), middle right (Integration), and ends in the middle (Eden).',
//                'token_uri' => 'https://ownlyio.github.io/nft/genesis-block/api/',
//                'url_placeholder' => 'genesis-block'
//            ],
//            [
//                'name' => 'The Sages Rant Collectibles',
//                'chain_id' => 1,
//                'contract_address' => '0x6BE5A289FADfFB9BC8ad508682dffBB6Fa440298',
//                'contract_address_testnet' => '0x3cAdd328751F218D00676a52fa37bd9DD907be43',
//                'description' => 'The Sages Rant Collectibles is a collection of single-edition, legendary pieces that can be acquired by participating in our auction happening this Q4 of 2021. Holders of these backgrounds and artifacts receive distinct strengths and can boost the rarity of their Mustachios — granting magical abilities and unlimited potentials.',
//                'token_uri' => 'https://ownlyio.github.io/nft/the-sages-rant-collectibles/api/',
//                'url_placeholder' => 'the-sages-rant-collectibles'
//            ],
//            [
//                'name' => 'Ownly House of Art',
//                'chain_id' => 1,
//                'contract_address' => '0xF8167889B4431d61e1eD667b836AFec84EB01576',
//                'contract_address_testnet' => '0x75862066c869875A3725B6669a30059F3C7D4C15',
//                'description' => 'Ownly House of Art (OHA) is a collection of tokenized physical art. It provides a solution to traditional artists that needs more exposure and collectors that need a frictionless acquisition of high-value physical art pieces. OHA, through the use of NFTs, creates a seamless, transparent, and more efficient sales process.',
//                'token_uri' => 'https://ownly.io/nft/oha/api/',
//                'url_placeholder' => 'oha'
//            ],
//            [
//                'name' => 'Ownly Rewards',
//                'chain_id' => 136,
//                'contract_address' => '0x3E191Ed002F3e62144f488d14Acf1B0B404bDF99',
//                'contract_address_testnet' => '0xe26Bbc6af3ec3c2b80971910A12eddd1626B28c1',
//                'description' => 'The collection composes of Ownly rewards for Private Sale and IDO participants, and top collectors for both Mustachio and Inkvadyrz collections.',
//                'token_uri' => 'https://ownly.io/nft/rewards/api/',
//                'url_placeholder' => 'rewards'
//            ]
//            [
//                'name' => 'Mustachio Pathfinders',
//                'chain_id' => 56,
//                'contract_address' => '0x7De755985E7079A07bfC4919c770450436D413a9',
//                'contract_address_testnet' => '0x2cc2D29c6514748b723eac6eFBff793Fb276c3f1',
//                'description' => 'A collection of 3D mustached NFT avatars called Mustachios created by the one and only Boii Mustache. The tales and adventures of these NFT avatars inspired Ownly’s upcoming play-and-earn game, Mustachio Quest.',
//                'token_uri' => 'https://ownly.market/api/mustachio-3d/',
//                'url_placeholder' => '3dmustachios'
//            ],
//            [
//                'name' => 'Dreaded Shrooms',
//                'chain_id' => 56,
//                'contract_address' => '0x7289190062cfB3E73fF41EEcD8449bF0a9041B25',
//                'contract_address_testnet' => '0x7Cd2127EBF14EAC6C546A54F2a92F4d503566bD1',
//                'description' => 'A one-of-a-kind concept, Dreaded Shrooms is perfect for collectors looking for unique and joy-sprouting art pieces. It’s good for the soul, that’s for sure.',
//                'token_uri' => 'https://ownly.io/nft/dreaded-shrooms/api/',
//                'url_placeholder' => 'dreadedshrooms'
//            ],
//            [
//                'name' => 'Boy Dibil',
//                'chain_id' => 56,
//                'contract_address' => '0xee25EB1FeC180A9122Ea3481506A83ceFE2a07Ba',
//                'contract_address_testnet' => '0x57A9cD941907746D9B929bcEA7b4BAD81CeFcBAa',
//                'description' => 'The Boy Dibil NFT collection follows Kcir Johan aka Boy Dibil, a former biological researcher’s journey from developing a compound that may enhance humans in several aspects to transforming into a wicked apathetic being with horns like a devil, and back to his restored true form.',
//                'token_uri' => 'https://ownly.io/nft/boy-dibil/api/',
//                'url_placeholder' => 'boydibil'
//            ]
//            [
//                'name' => 'Anito',
//                'chain_id' => 56,
//                'contract_address' => '0x4ad7d646dc0b25f3048d18355bc1df338facf59d',
//                'contract_address_testnet' => '0x4ad7d646dc0b25f3048d18355bc1df338facf59d',
//                'description' => 'Anito Legends incorporates gameplay inspired by roguelike dungeon crawlers and auto-battler genres. It incorporates Filipino folklore as its main theme with English as its method of delivery. The two main game modes that will be included at launch are PVE (player vs environment) and PVP (player vs player). To begin the game, players will need to purchase at least 3 Anito NFT units to fill out a party and begin adventuring. Anitos will be able to purchase weapons and other equipment to adjust to the different battle scenarios. Some of the end-game weapons and items can be minted as NFT’s as well.',
//                'token_uri' => 'https://api.anitolegends.com/api/metadata/',
//                'url_placeholder' => 'anito'
//            ]
            [
                'name' => 'Mustachios Rascals',
                'chain_id' => 1,
                'contract_address' => '0x3f5c11fF5C004313A5D1Bb0b5160551E05988569',
                'contract_address_testnet' => '0x3235981927E5Ba0283155a98A92c64381C4eB14B',
                'description' => 'Another set of Mustachio adventurers are joining the Pathfinders (2D and 3D Genesis Mustachios) and Marauders (Second Generation Mustachios) as they explore the Metaverse! Here comes the Mustachio Rascals, the next generation of our Mustachios. With a maximum supply of 10,000 Generated 3D NFTs, the Mustachio Rascals are the third generation of Mustachios. Of course, you may explore and play Mustachio Quest with your 3D Mustachio Rascal. Holders of these NFTs will also receive a reward of $OWN tokens for 4 quarters. And of course, these Mustachio Rascals will also have their own Augmented Reality soon!',
                'token_uri' => 'https://ownly.market/api/rascals/',
                'url_placeholder' => 'rascals'
            ]
        ];

        foreach($collection_inputs as $collection_input) {
            $out->writeln('Collection: ' . $collection_input['name']);

            $collection = Collection::where('chain_id', $collection_input['chain_id'])
                ->where(function($where) use ($collection_input) {
                    $where->where('contract_address', $collection_input['contract_address']);
                    $where->orWhere('contract_address', $collection_input['contract_address_testnet']);
                })
                ->where('url_placeholder', $collection_input['url_placeholder'])
                ->first();

            if(!$collection) {
                $collection = new Collection();
            }

            $collection->contract_address = (config('app.env') == 'production') ? $collection_input['contract_address'] : $collection_input['contract_address_testnet'];
            $collection->chain_id = $collection_input['chain_id'];
            $collection->name = $collection_input['name'];
            $collection->description = $collection_input['description'];
            $collection->token_uri = $collection_input['token_uri'];
            $collection->url_placeholder = $collection_input['url_placeholder'];

            $explorers = [
                '1' => [
                    'endpoint' => 'https://api.etherscan.io',
                    'key' => config('ownly.blockchain_explorer_api_key_eth')
                ],
                '56' => [
                    'endpoint' => 'https://api.bscscan.com',
                    'key' => config('ownly.blockchain_explorer_api_key_bsc')
                ],
                '136' => [
                    'endpoint' => 'https://api.polygonscan.com',
                    'key' => config('ownly.blockchain_explorer_api_key_matic')
                ]
            ];

            $response = Http::get($explorers[$collection['chain_id']]['endpoint'] . '/api?module=contract&action=getabi&address=' . $collection_input['contract_address'] . '&apikey=' . $explorers[$collection['chain_id']]['key']);

            if($response && $response['result']) {
                $collection->abi = $response['result'];
            }

            $collection->save();

            // Scan tokens with token uri
            $i = 0;
            while(true) {
                if($collection['chain_id'] == 1 && $collection['contract_address'] == '0x804efc52BFa9B85A86219c191d51147566f3B327') {
                    if($collection['url_placeholder'] == "cryptosolitaire" && $i > 53) {
                        break;
                    } else if($collection['url_placeholder'] == "inkvadyrz" && $i <= 53) {
                        $i = 54;
                    }
                }

//                $endpoint = $collection['token_uri'] . $i . '/?v=' . date('YmdHis');
//                $endpoint = $collection['token_uri'] . $i . '.json?v=' . date('YmdHis');
                $endpoint = $collection['token_uri'] . $i;
                $response = Http::get($endpoint);

                if(isset($response['name'])) {
                    $out->writeln('Fetching from ' . $endpoint);

                    $token = Token::where('collection_id', $collection['id'])
                        ->where('token_id', $i)
                        ->first();

                    if(!$token) {
                        $token = new Token();
                    }

                    $token->collection_id = $collection['id'];
                    $token->token_id = $i;
                    $token->name = $response['name'];
                    $token->description = $response['description'];
                    $token->image = $response['image'];
                    $token->attributes = json_encode($response['attributes']);

                    $this->customCollectionModification($collection, $i, $response, $token);

                    $token->save();
                } else {
                    break;
                }

                $i++;
            }
        }

        $out->writeln("Command Completed!");
    }

    public function customCollectionModification($collection, $i, $response, &$token) {
        if($collection['chain_id'] == 1 && $collection['contract_address'] == '0x804efc52BFa9B85A86219c191d51147566f3B327') {
            $id = $i;
            while(strlen($id) < 4) {
                $id = '0' . $id;
            }
            $token->thumbnail = 'https://ownly.io/nft/collection/collection-' . $id . '.png';

            $priorities = [43, 42, 41, 30, 29, 28, 17, 16, 15, 4, 3, 2];

            if(in_array($i, $priorities)) {
                $token->priority = array_search($i, $priorities) + 1;
            }
        } else if($collection['chain_id'] == 1 && $collection['contract_address'] == '0xF8167889B4431d61e1eD667b836AFec84EB01576') {
            $token->thumbnail = 'https://ownly.market/nft/oha/' . $i . '.webp';
        } else if($collection['chain_id'] == 1 && $collection['contract_address'] == '0x2C51aF2916eb9CF6392768158eAa39306779EE85') {
            $token->thumbnail = 'https://ownly.market/nft/genesis-block-v2/' . $i . '.webp';
        } else if($collection['chain_id'] == 1 && $collection['contract_address'] == '0x6BE5A289FADfFB9BC8ad508682dffBB6Fa440298') {
            $token->thumbnail = 'https://ownly.market/nft/the-sages-rant-collectibles/' . $i . '.webp';
        } else if($collection['chain_id'] == 56 && $collection['contract_address'] == '0x804efc52BFa9B85A86219c191d51147566f3B327') {
            $token->image = $response['asset'];
            $token->thumbnail = $response['image'];
        } else if($collection['chain_id'] == 1 && $collection['contract_address'] == '0x9e7a3A2e0c60c70eFc115BF03e6c544Ef07620E5') {
            $token->thumbnail = $response['thumbnail'];
            $token->trans_bg = $response['trans_bg'];
        } else if($collection['chain_id'] == 56 && $collection['contract_address'] == '0x7De755985E7079A07bfC4919c770450436D413a9') {
            $token->thumbnail = $response['image'];
        } else if($collection['chain_id'] == 56 && $collection['contract_address'] == '0x7289190062cfB3E73fF41EEcD8449bF0a9041B25') {
            $token->thumbnail = 'https://ownly.market/nft/dreadedshrooms/' . $token->name . '.webp';
        } else if($collection['chain_id'] == 56 && $collection['contract_address'] == '0xee25EB1FeC180A9122Ea3481506A83ceFE2a07Ba') {
            $token->thumbnail = 'https://ownly.market/nft/boydibil/' . $token->token_id . '.png';
        } else if($collection['chain_id'] == 1 && $collection['contract_address'] == '0x3f5c11fF5C004313A5D1Bb0b5160551E05988569') {
            $token->thumbnail = $response['image'];
        } else if($collection['chain_id'] == 136 && $collection['contract_address'] == '0x3E191Ed002F3e62144f488d14Acf1B0B404bDF99') {
            $opensea = [
                'https://storage.opensea.io/files/1ee326fe327c295a3913e2bc22403831.mp4#t=0.001',
                'https://storage.opensea.io/files/3c12d8cbdf43cd9641687759cf75526f.mp4#t=0.001',
                'https://storage.opensea.io/files/a18ce0fde4988a6101fc424981b0acdb.mp4#t=0.001',
                'https://storage.opensea.io/files/f5440dd321438d05066624b22e7f0a05.mp4#t=0.001',
                'https://storage.opensea.io/files/25b451ba13da0c6cd6d117beb76d61d1.mp4#t=0.001',
                'https://storage.opensea.io/files/c1fe46e46705ac7953643a0860f5665e.mp4#t=0.001',
                'https://storage.opensea.io/files/df5c01986f1e193823cc035f205e9537.mp4#t=0.001',
                'https://storage.opensea.io/files/44c42b2a4c8c8a4b1d717f4bdcf9e81b.mp4#t=0.001',
                'https://storage.opensea.io/files/e6c6f300cb032bf6972dab05afe3bf2a.mp4#t=0.001',
                'https://ownly.market/nft/rewards/rewards-0010.webp',
                'https://ownly.market/nft/rewards/rewards-0011.webp',
            ];

            if(isset($opensea[$i - 1]) && $opensea[$i - 1]) {
                $token->thumbnail = $opensea[$i - 1];
            } else {
                $id = $i;

                while(strlen($id) < 4) {
                    $id = '0' . $id;
                }

                $extension = '.mp4';

                if($i == 10) {
                    $extension = '.png';
                }

                if($i == 11) {
                    $extension = '.jpg';
                }

                $token->thumbnail = 'https://ownly.market/nft/rewards/rewards-' . $id . $extension;
            }

            $supplies = [5, 120, 17, 1, 1, 1, 1, 1, 1, 1, 1];
            $token->supply = $supplies[$i - 1];
        } else if($collection['chain_id'] == 56 && $collection['contract_address'] == '0x4ad7d646dc0b25f3048d18355bc1df338facf59d') {
            $last = DB::table('tokens')->latest()->first();

            $thumbnail['original'] = $token->image;
            $thumbnail['jpg512'] = HelperController::resizeImage($last->id + 1, $token->image, 'jpg', '512');
            $thumbnail['webp512'] = HelperController::resizeImage($last->id + 1, $token->image, 'webp', '512');
            $thumbnail['webp256'] = HelperController::resizeImage($last->id + 1, $token->image, 'webp', '256');

            $token->thumbnail = json_encode($thumbnail);
        }
    }
}
