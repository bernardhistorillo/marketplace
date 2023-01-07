@extends('layouts.app')

@section('title', $token['name'] . ' - ' . $collection['name'] . ' | ' . config('app.name'))
@section('og_title', $token['name'] . ' - ' . $collection['name'] . ' | ' . config('app.name'))
@section('og_image', $token['ogImage'])

@section('content')
    <div class="container pb-5" style="padding-top:80px">
        <div class="row mb-5 token-card mt-3 mt-md-4">
            <div class="col-md-6 col-xxl-5 pe-lg-3 pe-xl-4">
                <div id="token-asset-container">
                    @if($collection['url_placeholder'] == 'pathfinders3d' || ($collection['url_placeholder'] == 'marauders' && ($token['token_id'] <= 175 || in_array($token['token_id'], [177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,201,250,251,252,254,255,258,260,261,286,298]))))
                    <div class="w-100 shadow-sm border-1 position-relative skeleton-loading mb-3" style="padding-top:100%; border:1px solid #cccccc; background-color:rgba(0,0,0,0.01); border-radius:10px">
                        @if($collection['url_placeholder'] == 'marauders')
                        <div class="position-absolute" style="bottom:0; left:0; width:22%; z-index:1">
                            <a href="{{ $token->thumbnail()['original'] }}" data-fancybox>
                                <img src="{{ $token->thumbnail()['webp512'] }}" class="w-100" alt="{{ $token['name'] }}" style="border-radius:0 10px 0 10px" />
                            </a>
                        </div>
                        @endif

                        <div class="d-flex justify-content-center align-items-center w-100 h-100" style="position:absolute; top:0; left:0">
                            <iframe src="{{ route('model.mustachio.index', $token['token_id']) }}?hideSettings=1" class="w-100 h-100" style="border-radius:10px"></iframe>
                        </div>
                    </div>
                    @else
                    <a href="{{ $token->thumbnail()['original'] }}?v=1" data-fancybox id="token-original-image">
                        <div class="w-100 background-image-contain token-image shadow-sm border-1 mb-3" style="background-image:url('{{ (isset($token->thumbnail()['webp512'])) ? $token->thumbnail()['webp512'] : $token->thumbnail()['gif'] }}?v=1'); padding-top:100%; border:1px solid #cccccc; background-color:rgba(0,0,0,0.01); border-radius:10px"></div>
                    </a>
                    @endif
                </div>

                <div class="mt-4">
                    <p class="font-size-90 text-color-7 text-center text-md-start">Features &amp; Additional Assets</p>
                    <div class="row justify-content-center justify-content-md-start px-1">
                        @if($collection['url_placeholder'] == 'marauders' || $collection['url_placeholder'] == 'pathfinders2d')
                        <div class="col-3 col-xl-2 px-2">
                            <div class="card w-100 position-relative mb-2" style="padding-top:100%; border-radius:10px">
                                <a href="{{ $token->thumbnail()['original'] }}?v=1" data-fancybox>
                                    <div class="position-absolute w-100 h-100 text-center" style="top:0; width:0">
                                        <img src="{{ $token->thumbnail()['webp256'] }}?v=1" class="h-100" alt="{{ $token['name'] }}" />
                                    </div>
                                </a>
                            </div>

                            <p class="text-color-7 font-size-60 text-center px-1">Hand-drawn 2D&nbsp;PFP</p>
                        </div>

                        <div class="col-3 col-xl-2 px-2">
                            <div class="card w-100 position-relative mb-2" style="padding-top:100%; border-radius:10px">
                                <a href="{{ asset('nft/mustachios-without-bg/' . $token['token_id'] . '.png') }}" data-fancybox>
                                    <div class="position-absolute w-100 h-100 text-center" style="top:0; width:0">
                                        <img src="{{ asset('nft/mustachios-without-bg/' . $token['token_id'] . '.png') }}" class="h-100" alt="{{ $token['name'] }}" />
                                    </div>
                                </a>
                            </div>

                            <p class="text-color-7 font-size-60 text-center px-1">Transparent Background</p>
                        </div>

                        <div class="col-3 col-xl-2 px-2">
                            <div class="card w-100 position-relative overflow-hidden mb-2" style="padding-top:100%; border-radius:10px">
                                <a href="https://mustachioverse.com/ar" target="_blank" rel="noreferrer">
                                    <div class="position-absolute w-100 h-100 text-center" style="top:0; width:0">
                                        <img src="{{ asset('img/mustachios/augmented-reality.png') }}" class="w-100 h-100" alt="Augmented Reality" />
                                    </div>
                                </a>
                            </div>

                            <p class="text-color-7 font-size-60 text-center px-1">Augmented Reality</p>
                        </div>
                        @endif

                        @if($collection['url_placeholder'] == 'marauders' || $collection['url_placeholder'] == 'pathfinders2d' || $collection['url_placeholder'] == 'rascals')
                        <div class="col-3 col-xl-2 px-2">
                            <div class="card w-100 position-relative overflow-hidden mb-2" style="padding-top:100%; border-radius:10px">
                                <a href="https://mustachioverse.com" target="_blank" rel="noreferrer">
                                    <div class="position-absolute w-100 h-100 text-center" style="top:0; width:0">
                                        <img src="{{ asset('img/mustachios/mustachio-quest.png') }}" class="w-100 h-100" alt="Mustachio Quest" />
                                    </div>
                                </a>
                            </div>

                            <p class="text-color-7 font-size-60 text-center px-1">Mustachio Quest</p>
                        </div>
                        @endif

                        @if($collection['url_placeholder'] == 'pathfinders2d' || $collection['url_placeholder'] == 'pathfinders3d' || $collection['url_placeholder'] == 'marauders')
                        <div class="col-3 col-xl-2 px-2">
                            <div class="card w-100 position-relative overflow-hidden mb-2" style="padding-top:100%; border-radius:10px">
                                <a href="https://mustachioverse.com/ar" target="_blank" rel="noreferrer">
                                    <div class="position-absolute w-100 h-100 text-center" style="top:0; width:0">
                                        <img src="{{ asset('img/mustachios/land-sale.png') }}" class="w-100 h-100" alt="Mutachio Quest Land Sale" />
                                    </div>
                                </a>
                            </div>

                            <p class="text-color-7 font-size-60 text-center px-1">Land Sale Discount</p>
                        </div>
                        @endif

                        @if($collection['url_placeholder'] == 'pathfinders2d')
                        <div class="col-3 col-xl-2 px-2">
                            <div class="card w-100 position-relative overflow-hidden mb-2" style="padding-top:100%; border-radius:10px">
                                <a href="https://tales.mustachioverse.com" target="_blank" rel="noreferrer">
                                    <div class="position-absolute w-100 h-100 text-center" style="top:0; width:0">
                                        <img src="{{ asset('img/mustachios/the-sages-rant.png') }}" class="h-100" alt="The Sages Rant" />
                                    </div>
                                </a>
                            </div>

                            <p class="text-color-7 font-size-60 text-center px-1">The Sages Rant</p>
                        </div>
                        @endif

                        @if($collection['url_placeholder'] == 'dreadedshrooms')
                        <div class="col-3 col-xl-2 px-2">
                            <div class="card w-100 position-relative overflow-hidden mb-2" style="padding-top:100%; border-radius:10px">
                                <a href="{{ asset('img/dreaded-shrooms/caricature-isma.png') }}" data-fancybox="caricature" data-caption="Sample Caricature<br/><b>Ismael Jerusalem, Founder & CEO - Ownly</b>">
                                    <div class="position-absolute w-100 h-100 text-center" style="top:0; width:0">
                                        <img src="{{ asset('img/dreaded-shrooms/caricature-isma.png') }}" class="h-100" alt="The Sages Rant" />
                                    </div>
                                </a>
                                <a href="{{ asset('img/dreaded-shrooms/caricature-rico.png') }}" class="d-none" data-fancybox="caricature" data-caption="Dreaded Shroom: Zoop Double B Holder<br/><b>Rico Zuñiga, Co-Founder & CTO - SparkPoint Technologies Inc.</b>"></a>
                            </div>

                            <p class="text-color-7 font-size-60 text-center px-1">Free Custom Caricature to First Owners</p>
                        </div>
                        @endif

                        <div class="col-3 col-xl-2 px-2">
                            <div class="card w-100 position-relative overflow-hidden mb-2" style="padding-top:100%; border-radius:10px">
                                <a href="{{ asset('img/ownly/discount.png') }}" data-fancybox>
                                    <div class="position-absolute w-100 h-100 text-center" style="top:0; width:0">
                                        <img src="{{ asset('img/ownly/discount.png') }}" class="w-100 h-100" alt="Ownly Market Discount" />
                                    </div>
                                </a>
                            </div>

                            <p class="text-color-7 font-size-60 text-center px-1">Purchase Discounts</p>
                        </div>

                        <div class="col-3 col-xl-2 px-2">
                            <div class="card w-100 position-relative overflow-hidden mb-2" style="padding-top:100%; border-radius:10px">
                                <a href="{{ asset('img/meetup/bicol-blockchain.png') }}" data-fancybox>
                                    <div class="position-absolute w-100 h-100 text-center background-image-contain" style="top:0; width:0; background-image:url('{{ asset('img/meetup/bicol-blockchain.png') }}')">

                                    </div>
                                </a>
                            </div>

                            <p class="text-color-7 font-size-60 text-center px-1">Free Access to Events</p>
                        </div>
                    </div>
                </div>

                <div class="card d-none mt-4" id="additional-assets-container">
                    <div class="card-header bg-white font-size-90">Additional Assets</div>
                    <div class="card-body">
                        <a href="#" data-fancybox class="btn btn-custom-5 w-100" id="transparent-bg-mustachio" style="border-width:2px">Mustachio with Transparent Background</a>
                        <img src="" class="d-none" id="transparent-bg-mustachio-preload" alt="Token" />
                    </div>
                </div>

{{--                <div class="card mt-4 d-none">--}}
{{--                    <div class="card-header bg-white fw-bold font-size-110 py-3">Offers</div>--}}

{{--                    <div id="offers-container">--}}
{{--                        <div class="d-flex justify-content-center py-5">--}}
{{--                            <div class="spinner-grow background-image-cover bg-transparent" style="width:3rem; height:3rem; background-image:url('../img/ownly/own-token.png')" role="status">--}}
{{--                                <span class="visually-hidden">Loading...</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>

            <div class="col-md-6 col-xxl-7 ps-lg-3 ps-xl-4 mt-4">
                <div class="font-size-120 text-center text-md-start mb-2">
                    <a href="{{ route('collection.index', $collection['url_placeholder']) }}" class="link-color-4 text-decoration-none neo-bold">{{ $collection['name'] }}</a>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center mb-1" style="min-height:61px">
                        <div class="neo-black font-size-200 font-size-md-250 mb-1 token-name link text-color-6 text-decoration-none" id="token-name">{{ $token['name'] }}</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="pe-2 d-none" id="transfer-token-container">
                            <button type="button" class="btn btn-custom-14 font-size-130 change-token-view" id="transfer-token-show-modal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Gift">
                                <i class="fas fa-gift"></i>
                            </button>
                            <!--					<button class="btn p-0 m-0 link-color-4" id="transfer-token-show-modal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Transfer" style="width:24px; height:24px; border-radius:50%; box-shadow: none">-->
                            <!--						<i class="fas fa-gift font-size-140"></i>-->
                            <!--					</button>-->
                        </div>

                        <div class="d-flex align-items-center py-1 ps-3 add-to-favorites-container">
                            <div class="">
                                <button class="btn add-to-favorites p-0 m-0" data-contract-address="{{ $collection['contract_address'] }}" data-token-id="{{ $token['token_id'] }}" data-status="0" data-message="{{ config('ownly.add_to_favorites_message') }}" data-url="{{ route('token.updateFavoriteStatus') }}" style="width:24px; height:24px; border-radius:50%; box-shadow: none; border:0" disabled>
                                    <i class="far fa-heart font-size-140 text-color-1"></i>
                                </button>
                            </div>
                            <div class="ps-2 font-size-90 text-color-1 favorites-count">{{ $token->favoriteCount() }}</div>
                        </div>
                    </div>
                </div>

                <div class="font-size-110 neo-bold mb-4 pb-1">{{ ($token['supply'] || $token['supply'] == 1) ? '1 of 1 - Single Edition' : 'Multiple Editions' }}</div>

                <div class="token-action-buttons mb-4">
                    <form class="collection-token-form d-none" action="{{ route('token.getTokenActionButtons') }}">
                        <input type="hidden" name="token" value="{{ $token['id'] }}" />
                        <input type="hidden" name="address" />
                    </form>

                    <div class="row align-items-center" style="min-height:69px">
                        <div class="col-6 px-2">
                            <div class="w-100 skeleton-loading" style="height:50px"></div>
                        </div>
                        <div class="col-6 px-2">
                            <div class="w-100 skeleton-loading" style="height:50px"></div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center d-none mb-5" id="create-market-sale-container">
                    <div class="col-6">
                        <div class="d-flex align-items-end mb-2">
                            <div class="font-size-110 font-size-md-120 fw-bold">Price:</div>
                            <div class="ps-2 ms-1">
                                <img src="{{ asset('img/ownly/own-token.png') }}" class="token-price-currency" width="30" />
                            </div>
                        </div>
                        <div class="font-size-200 font-size-md-250 neo-black token-price line-height-90"></div>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-custom-2 font-size-90 font-size-lg-100 font-size-xxl-110 py-3 neo-bold px-4 px-md-5 link create-market-sale-confirmation" data-type="sale" style="border-radius:15px">OWN NOW</button>
                    </div>
                </div>

                <div class="row align-items-center d-none mb-4" id="cancel-market-item-container">
                    <div class="col-6">
                        <div class="d-flex align-items-end mb-2">
                            <div class="font-size-110 font-size-md-120 fw-bold">Price:</div>
                            <div class="ps-2 ms-1">
                                <img src="{{ asset('img/ownly/own-token.png') }}" class="token-price-currency" width="30" />
                            </div>
                        </div>
                        <div class="font-size-200 font-size-md-250 neo-black token-price"></div>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-custom-3 font-size-110 font-size-md-120 neo-bold px-4 px-md-5 link cancel-market-item-confirmation" style="border-radius:15px">CANCEL</button>
                    </div>
                </div>

                <div class="row align-items-center d-none mb-4" id="create-market-item-container">
                    <div class="col-6">
                        <div>
                            <a href="#" target="_blank" class="font-size-90 text-decoration-none d-none token-bscscan-transaction-hash">View on BscScan</a>
                        </div>
                        <div class="font-size-100 neo-bold">Owner</div>
                        <div class="font-size-90 owner-address"></div>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-custom-4 w-100 font-size-90 font-size-lg-100 font-size-xxl-110 py-3 neo-bold create-market-item-confirmation" style="border-radius:15px">SELL NOW</button>
                    </div>
                </div>

                <div class="row align-items-center d-none mb-4" id="sold-out-container">
                    <div class="col-6">
                        <div>
                            <a href="#" target="_blank" class="font-size-90 text-decoration-none d-none token-bscscan-transaction-hash">View on BscScan</a>
                        </div>
                        <div class="font-size-100 neo-bold">Owner</div>
                        <div class="font-size-90 owner-address"></div>
                    </div>
                    <div class="col-6">
                        <!--					<button class="btn btn-custom-6 w-100 line-height-110 font-size-90 font-size-lg-110 neo-bold py-3 make-offer-show-modal" data-contract-address="' + contractAddress + '" data-token-id="' + i + '" style="border-radius:15px">MAKE OFFER</button>-->
                        <button class="btn btn-custom-17 w-100 line-height-110 font-size-90 font-size-lg-110 neo-bold py-3" style="border-radius:15px" disabled>SOLD</button>
                    </div>
                </div>

                <!--			<div class="mb-4 d-none">-->
                <!--				<button class="btn btn-secondary px-4" id="create-market-item-confirmation">POST ITEM FOR SALE</button>-->
                <!--			</div>-->

                <!--			<button class="btn btn-secondary w-100 sell-token-confirmation d-none">Sell</button>-->

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button neo-bold font-size-60" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Description
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                            <div class="accordion-body">
{{--                                <div class="d-flex align-items-center mb-3">--}}
{{--                                    <div class="text-color-7">Created by</div>--}}
{{--                                    <div class="ps-2">--}}
{{--                                        <img src="../img/ownly/own-token.webp" width="30" alt="Ownly" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="font-size-100 line-height-140 mb-1" id="token-description">{{ $token['description'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button neo-bold font-size-60" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Properties
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
                            <div class="accordion-body px-4">
                                <div class="row">
                                    @foreach($token->properties() as $property)
                                    <div class="col-md-6 col-xl-4 p-2">
                                        <a href="{{ route('collection.index', $collection['url_placeholder']) . '?filters=[{"property":"' . $property['trait_type'] . '","value":"' . $property['value'] . '"}]' }}" class="text-decoration-none">
                                            <div class="card bg-light h-100">
                                                <div class="card-body h-100">
                                                    <div class="d-flex justify-content-center align-items-center h-100">
                                                        <div class="text-center">
                                                            <p class="neo-bold font-size-80 mb-1 text-uppercase text-decoration-none link-color-4">{{ $property['trait_type'] }}</p>
                                                            <div class="neo-bold font-size-100 text-color-6 mb-1">{{ $property['value'] }}</div>
                                                            <p class="font-size-80 text-color-7 mb-0">{{ number_format($property['percentage']) }}% have this trait</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button neo-bold font-size-60 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                About the Collection
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                            <div class="accordion-body">
                                @if($collection['url_placeholder'] == 'titansofindustry')
                                <div>
                                    Created by multimedia artist Eugene Oligo, our collaboration entitled Titans of Industry features the pioneers, entrepreneurs, and titans of the crypto space. This collection will surely help you recognize the big ones, their feats, and their impact on the blockchain world.
                                </div>
                                @elseif($collection['url_placeholder'] == 'oha')
                                <div>
                                    Ownly House of Art (OHA) is a collection of tokenized physical art. It provides a solution to traditional artists that needs more exposure and collectors that need a frictionless acquisition of high-value physical art pieces. OHA, through the use of NFTs, creates a seamless, transparent, and more efficient sales process.
                                </div>
                                @elseif($collection['url_placeholder'] == 'genesisblock')
                                <div>
                                    <p>Marso presents another collection of work combining the elegance of geometry and a vibrant color palette dubbed as the ‘Genesis Block’ of Blockchain, reminiscent of the ceiling of the famous Sistine Chapel.</p>
                                    <p>This collection can both stand alone as an individual piece or as a whole with every piece being unique leading to a culmination of the ‘creation’ and establishing of the whole blockchain space.</p>
                                    <p>With that being said, the whole collection can be viewed starting from the bottom left (Creation), bottom middle (Distribution), bottom right, (Progress), top left (Prosperity), top middle (Liberty & Freedom), top right (Community), middle right (Immersion), middle right (Integration), and ends in the middle (Eden).</p>
                                </div>
                                @elseif($collection['url_placeholder'] == 'pathfinders2d')
                                <div>
                                    Boii Mustache, the artist behind these avatars, describes them as 100 mustached explorers living in a hidden, mysterious, and magical island called MustachioVerse. Each of these Mustachios lived and thrived for over a hundred years, waiting for their turn to tell their own unique tale of adventure. One day, ten brave Mustachios discovered a mysterious torn journal written by The Prospector — the first-ever Mustachio who conquered every possible feat in their universe. Stories have been told about his glory, but no one knows The Prospector’s identity. His Lost Diary mentioned that he discovered 9 valuable artifacts and a precious golden ‘stache — the key in solving the greatest mystery in the land: why do they all have a mustache?
                                </div>
                                @elseif($collection['url_placeholder'] == 'cryptosolitaire')
                                <div>
                                    Digital playing card deck created by Filipino artist, Chen Naje, also known as @chenandink on Instagram. For the clubs, tropical leaves to represent summer is used. For the spades, Chen Naje used maple leaves as symbol for the fall season. For the diamonds, he used ice crystals to represent winter which somehow also look like raw diamonds. Lastly, flowers for the hearts to represent their bloom during spring.
                                </div>
                                @elseif($collection['url_placeholder'] == 'inkvadyrz')
                                <div>
                                    The deck is made up of twenty Cryptoart cards composed of three categories: common, uncommon, rare, and legendary. The card’s category shows its rarity, value, and benefits. The legendary cards are priced higher than the rare and common cards. There are also only 2 legendary cards compared to 5 rare cards, 6 uncommon cards, and 7 common cards. Most importantly, owning a legendary card gives the collector the possibility to get the reward piece by getting 9 other cards in the collection.
                                </div>
                                @elseif($collection['url_placeholder'] == 'rewards')
                                <div>
                                    The collection composes of Ownly rewards for Private Sale and IDO participants, and top collectors for both Mustachio and Inkvadyrz collections.
                                </div>
                                @elseif($collection['url_placeholder'] == 'sagesrantcollectibles')
                                <div>
                                    The Sages Rant Collectibles is a collection of single-edition, legendary pieces that can be acquired by participating in our auction happening this Q4 of 2021. Holders of these backgrounds and artifacts receive distinct strengths and can boost the rarity of their Mustachios — granting magical abilities and unlimited potentials.
                                </div>
                                @elseif($collection['url_placeholder'] == 'pathfinders3d' || $collection['url_placeholder'] == 'marauders')
                                <div>
                                    A collection of 3D mustached NFT avatars called Mustachios created by the one and only Boii Mustache. The tales and adventures of these NFT avatars inspired Ownly’s upcoming play-and-earn game, Mustachio Quest. Check out <a href="https://mustachioverse.com" class="link-color-4">mustachioverse.com</a> for more details.
                                </div>
                                @elseif($collection['url_placeholder'] == 'dreadedshrooms')
                                <div>
                                    A one-of-a-kind concept, Dreaded Shrooms is perfect for collectors looking for unique and joy-sprouting art pieces. It’s good for the soul, that’s for sure.
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button neo-bold font-size-60 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Token Details
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
                            <div class="accordion-body">
                                <table>
                                    <tr>
                                        <td class="neo-bold pe-3 py-1">Token:</td>
                                        <td class="py-1">{{ $collection->tokenType() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="neo-bold pe-3 py-1">Blockchain:</td>
                                        <td class="py-1">{{ $collection->networkName() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="neo-bold pe-3 py-1">Contract Address:</td>
                                        <td class="py-1">
                                            <a href="{{ $collection->blockchainExplorerLink() }}address/{{ $collection['contract_address'] }}" target="_blank" class="link-color-3">{{ shortenAddress($collection['contract_address'], 5, 5) }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="neo-bold pe-3 py-1">Token ID:</td>
                                        <td class="py-1">{{ $token['token_id'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="neo-bold pe-3 py-1">Owner Address</td>
                                        <td class="py-1">
                                            <a href="{{ $collection->blockchainExplorerLink() }}address/{{ $token['owner'] }}" target="_blank" class="link-color-3">{{ shortenAddress($token['owner'], 5, 5) }}</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button neo-bold font-size-60" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                Transfer History
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse show" aria-labelledby="headingFive">
                            <div class="accordion-body">
                                <div class="table-responsive py-2">
                                    <table class="table table-bordered font-size-80 mb-0">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align:middle">From</th>
                                                <th style="vertical-align:middle">To</th>
                                                <th style="vertical-align:middle">Price</th>
                                                <th style="vertical-align:middle; min-width:110px">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($token['transfers'] as $transfer)
                                            <tr>
                                                <td style="vertical-align:middle">
                                                    <a href="{{ $collection->blockchainExplorerLink() }}address/{{ $transfer['from'] }}" target="_blank" class="link-color-3">{{ shortenAddress($transfer['from'], 4, 4) }}</a>
                                                </td>
                                                <td style="vertical-align:middle">
                                                    <a href="{{ $collection->blockchainExplorerLink() }}address/{{ $transfer['to'] }}" target="_blank" class="link-color-3">{{ shortenAddress($transfer['to'], 4, 4) }}</a>
                                                </td>
                                                <td class="text-end" style="vertical-align:middle">{{ number_format($transfer['value'], 2) }} <img src="{{ asset('img/tokens/' . $transfer['currency'] . '.png') }}" class="me-1" width="20" alt="{{ $transfer['currency'] }}" /> ({{ $transfer['currency'] }})</td>
                                                <td style="vertical-align:middle">
                                                    <a href="{{ $collection->blockchainExplorerLink() }}tx/{{ $transfer['transaction_hash'] }}" target="_blank" class="link-color-3">{{ \Carbon\Carbon::parse($transfer['signed_at'])->isoFormat('llll') }}</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-color-18 pb-md-5">
        <div class="container py-5">
            <div class="neo-bold font-size-130 font-size-lg-160 text-center mb-4 mb-md-5">YOU MIGHT LIKE ON THIS COLLECTION</div>
            <div class="row flex-nowrap overflow-auto" id="related-tokens-container">
                @foreach($relatedTokens as $token)
                    @include('collection.tokenCard')
                @endforeach
            </div>
        </div>
    </div>

    <style>
        #meet-the-artist {
            background-color:#f4f1ec!important
        }
        #meet-the-artist .container {
            padding-top:0!important
        }
    </style>

    <div id="token-page-about-the-artist">
        @if($collection['url_placeholder'] != 'rewards' && $collection['url_placeholder'] != 'rascals')
            @include('collection.aboutTheArtist')
        @endif
    </div>
@endsection
