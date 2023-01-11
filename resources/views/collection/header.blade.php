@if($collection['url'] == 'cryptosolitaire')
<div class="position-relative" style="min-height:calc(100vh - 80px); margin-top:80px; background-position:66% 50%">
    <div class="d-flex w-100 py-4 background-image-cover" style="min-height:calc(100vh - 80px); background-image:url('{{ asset('img/bg/cryptosolitaire.jpg') }}')">
        <div class="container position-relative">
            <div class="position-absolute" style="bottom:20px; left:20px">
                <div class="mb-3 mb-md-4 text-white py-2 font-size-240 font-size-sm-300 font-size-md-500 font-size-lg-600" style="text-shadow:4px 4px 9px #000000">CryptoSolitaire</div>
                <div class="">
                    <a href="https://opensea.io/collection/ownly?search[stringTraits][0][name]=Artist&search[stringTraits][0][values][0]=Chen%20Naje" target="_blank" class="btn btn-custom-2 font-size-100 font-size-sm-110 font-size-lg-150 px-4 px-md-5 py-2 shadow-sm" style="border-radius:30px">View on OpenSea</a>
                </div>
            </div>
        </div>
    </div>
</div>

@elseif($collection['url'] == 'inkvadyrz')
<div class="position-relative" style="min-height:calc(100vh - 80px); margin-top:80px; background-position:66% 50%">
    <div class="d-flex w-100 py-4 background-image-cover" style="min-height:calc(100vh - 80px); background-image:url('{{ asset('img/bg/inkvadyrz-2.webp') }}'); background-position:bottom">
        <div class="container position-relative">
            <div class="position-absolute" style="bottom:20px; left:20px">
                <!--				<div class="mb-3 mb-md-4 text-white bg-color-6 px-4 py-2 font-size-210 font-size-sm-300 font-size-md-400 font-size-lg-450 shadow-sm">Inkvadyrz</div>-->
                <!--				<div class="">-->
                <!--					<a href="https://opensea.io/collection/ownly?search[stringTraits][0][name]=Artist&search[stringTraits][0][values][0]=Lei%20Melendres" target="_blank" class="btn btn-custom-3 font-size-120 font-size-sm-140 font-size-lg-200 px-4 px-md-5 py-2 shadow-sm" style="border-radius:30px">View on OpenSea</a>-->
                <!--				</div>-->
                <!--				<div class="mb-3 mb-md-4 text-white bg-color-6 px-4 py-2 font-size-320 font-size-sm-300 font-size-md-500 font-size-lg-600" style="text-shadow:4px 4px 9px #000000">Inkvadyrz</div>-->
                <div class="">
                    <a href="https://opensea.io/collection/ownly?search[stringTraits][0][name]=Artist&search[stringTraits][0][values][0]=Lei%20Melendres" target="_blank" class="btn btn-custom-6 font-size-100 font-size-sm-110 font-size-lg-150 px-4 px-md-5 py-2 shadow-sm" style="border-radius:30px">View on OpenSea</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{--  titansofindustry  --}}
@elseif($collection['url'] == 'titansofindustry')
<div class="position-relative overflow-hidden" style="min-height:calc(100vh - 80px); margin-top:80px; background-position:66% 50%">
    <div class="bg-color-7 position-absolute h-100" style="top:0; left:0; width:100%; z-index:-1"></div>
    <div class="bg-white position-absolute h-100 d-none d-lg-block" style="top:0; left:70%; width:30%; z-index:-1"></div>

    <div class="container">
        <div class="d-flex w-100 py-4" style="min-height:calc(100vh - 80px)">
            <div id="banner-left" style="">
                <div class="d-flex flex-column justify-content-center h-100">
                    <div class="text-color-9 alegreya-italic font-size-160 font-size-md-200 mb-4"><span class="alegreya-bold-italic">OWNLY</span> PRESENTS</div>
                    <div class="text-white neo-bold font-size-360 font-size-md-470 font-size-xl-500 line-height-90 mb-2">TITANS of<br>INDUSTRY</div>
                    <div class="position-relative mb-3 mb-md-5 pb-4">
                        <div class="bg-color-19 neo-black text-color-6 font-size-160 font-size-md-200 py-2">by Eugene Oligo</div>
                        <div class="bg-color-19 neo-black text-color-6 font-size-160 font-size-md-200 py-2 position-absolute w-100" style="top:0; left:-99%; z-index:-1">&nbsp;</div>
                        <div class="bg-color-19 neo-black text-color-6 font-size-160 font-size-md-200 py-2 position-absolute w-100" style="top:0; right:-99%; z-index:-1">&nbsp;</div>
                    </div>
                    <div class="text-white neo-bold font-size-120 font-size-md-160 mb-4">ABOUT THE COLLECTION</div>
                    <div class="text-white font-size-80 mb-4">Created by multimedia artist Eugene Oligo, our collaboration entitled Titans of Industry features the pioneers, entrepreneurs, and titans of the crypto space. This collection will surely help you recognize the big ones, their feats, and their impact on the blockchain world.</div>
                    <div class="text-white font-size-80">
                        <a href="https://medium.com/ownlyio/ownlys-second-nft-collection-titans-of-the-industry-by-eugene-oligo-4ead34f50026" target="_blank" class="text-white">Read more</a>
                    </div>
                </div>
            </div>

            <div class="d-none d-lg-block py-2" id="banner-right" style="">
                <div class="background-image-contain" style="background-image:url('{{ asset('img/bg/Marketplace_Banner2.webp') }}'); height:calc(100% + 20px); width:calc(100% + 200px); z-index:99"></div>
            </div>
        </div>
    </div>
</div>
@endif

{{--  mustachios  --}}
@if($collection['url'] == 'pathfinders2d')
<div class="position-relative" style="min-height:calc(100vh - 80px); margin-top:80px; background-position:66% 50%">
    <div class="d-flex w-100 py-4 background-image-cover" style="min-height:calc(100vh - 80px); background-image:url('{{ asset('img/bg/Mustachios_GridBanner02.webp') }}')">
        <div class="container position-relative">
            <div class="position-absolute" style="bottom:20px; left:20px">
                <div class="mb-3">
                    <img src="{{ asset('img/mustachios/mustachios-text.png') }}" class="mustachios-text" />
                </div>
                <div class="ps-lg-4 mb-3">
                    <a href="https://mustachioverse.com" target="_blank" class="btn btn-custom-2 font-size-150 px-5 py-2 mb-2 mb-md-0 me-md-2" style="border-radius:30px; min-width:333px">Visit MustachioVerse</a>
                    <a href="https://opensea.io/collection/mustachioverse" target="_blank" class="btn btn-custom-2 font-size-150 px-5 py-2" style="border-radius:30px; min-width:333px">View on OpenSea</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{--  genesisblock  --}}
@if($collection['url'] == 'genesisblock')
<div class="position-relative" style="min-height:calc(100vh - 80px); margin-top:80px; background-position:66% 50%">
    <div class="d-flex w-100 py-4 background-image-cover" style="min-height:calc(100vh - 80px); background-image:url('{{ asset('img/genesis-block/bg.webp') }}')">
        <div class="container">
            <div class="d-flex h-100 align-items-end w-100" style="bottom:50px; left:20px">
                <div class="mb-5">
                    <div class="mb-5">
                        <div>
                            <span class="bg-color-20 text-white px-2 px-md-3 font-size-190 font-size-md-300 font-size-xl-400 neo-bold line-height-90">GENESIS BLOCK</span>
                        </div>
                        <div>
                            <span class="bg-color-20 text-white px-2 px-md-3 font-size-190 font-size-md-300 font-size-xl-400 neo-bold pb-1">NFT COLLECTION <span class="fst-italic">by Marso</span></span>
                        </div>
                        <div class="mt-4">
                            <span class="bg-white text-color-6 px-2 px-md-3 font-size-110 font-size-md-160 font-size-xl-200 neo-regular-italic pb-1">A 9-Piece Single-Edition NFT Collection</span>
                        </div>
                    </div>
                    <div class="">
                        <a href="https://opensea.io/collection/marsogenesisblock" target="_blank" class="btn btn-custom-12 font-size-100 font-size-sm-110 font-size-lg-150 px-4 px-md-5 py-2 shadow-sm" style="border-radius:30px">View on OpenSea</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{--  sagesrantcollectibles  --}}
@if($collection['url'] == 'sagesrantcollectibles')
<div class="position-relative" style="min-height:calc(100vh - 80px); margin-top:80px; background-position:66% 50%">
    <div class="d-flex w-100 py-4 background-image-cover" style="min-height:calc(100vh - 80px); background-image:url('{{ asset('img/bg/the-sages-rant-collectibles.webp') }}')">
        <div class="container">
            <div class="d-flex h-100 align-items-end w-100" style="bottom:50px; left:20px">
                <div class="row mb-5">
                    <div class="col-lg-7">
                        <div class="mb-4">
                            <img src="{{ asset('img/the-sages-rant-collectibles/text.webp') }}" class="w-100" />
                        </div>
                        <div class="text-center">
                            <a href="https://opensea.io/collection/thesagesrantcollectibles" target="_blank" class="btn btn-custom-11 font-size-100 font-size-sm-110 font-size-lg-150 px-4 px-md-5 py-2 shadow-sm" style="border-radius:30px">View on OpenSea</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{--  oha  --}}
@if($collection['url'] == 'oha')
<div class="position-relative" style="margin-top:80px">
    <div class="d-none">
        <div class="d-flex w-100 py-4 background-image-cover" style="min-height:calc(100vh - 80px); background-image:url('{{ asset('img/oha/bg.webp') }}'); background-position:top">
            <div class="container">
                <div class="d-flex align-items-center" style="min-height:calc(100vh - 80px)">
                    <div class="position-relative bg-white w-100 p-3">
                        <div class="position-absolute bg-white w-100 h-100" style="top:0; left:-99%"></div>

                        <div class="d-flex flex-lg-column">
                            <div class="text-lg-end helvetica-roman font-size-400 font-size-md-400 font-size-lg-620 font-size-xl-740 font-size-xxl-840 line-height-80 mb-3 mb-lg-0" style="letter-spacing:-3px; margin-right:2px">Exploits & Effects <span class="helvetica-roman line-height-80 d-inline-block d-lg-none">Exhibit</span></div>
                            <div class="text-lg-end helvetica-roman font-size-md-400 font-size-lg-620 font-size-xl-740 font-size-xxl-840 line-height-80 mb-3 d-none d-lg-block" style="letter-spacing:-3px">Exhibit</div>
                        </div>

                        <div class="d-flex flex-column flex-lg-row">
                            <div class="d-flex justify-content-between flex-fill order-1 order-lg-0 pe-4 pe-xl-5 flex-wrap" id="ene-left-side">
                                <div class="mb-4 mb-lg-0">
                                    <div class="mb-4">
                                        <div class="helvetica-light font-size-170 font-size-xl-200 line-height-90">Dan Vincent</div>
                                        <div class="helvetica-roman font-size-170 font-size-xl-200 line-height-90">Barotilla</div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="helvetica-light font-size-170 font-size-xl-200 line-height-90">Mel</div>
                                        <div class="helvetica-roman font-size-170 font-size-xl-200 line-height-90">Baranda</div>
                                    </div>

                                    <div class="">
                                        <div class="helvetica-light font-size-170 font-size-xl-200 line-height-90">Glenn</div>
                                        <div class="helvetica-roman font-size-170 font-size-xl-200 line-height-90">De Guzman</div>
                                    </div>
                                </div>

                                <div class="mb-5 mb-lg-0">
                                    <div class="mb-4 pb-2">
                                        <div class="helvetica-roman font-size-120 font-size-xl-150 line-height-110">12. 03 — 05</div>
                                        <div class="helvetica-roman font-size-120 font-size-xl-150 line-height-110">2021</div>
                                    </div>

                                    <div class="mb-4 pb-3">
                                        <div class="helvetica-roman font-size-120 font-size-xl-150 line-height-110">AYALA MALLS</div>
                                        <div class="helvetica-roman font-size-120 font-size-xl-150 line-height-110">LEGAZPI</div>
                                    </div>

                                    <div class="">
                                        <img src="{{ asset('img/oha/ownly-x-ayala.webp') }}" width="170" alt="Ownly X Ayala" />
                                    </div>
                                </div>

                                <div class="mb-5 mb-lg-0 pe-xxl-4">
                                    <div class="mb-4 pb-2">
                                        <div class="helvetica-roman font-size-120 font-size-xl-150 line-height-110">Join the Ownly Discord:</div>
                                        <div class="helvetica-roman font-size-120 font-size-xl-150 line-height-110"><a href="https://ownly.io/discord" target="_blank" class="text-decoration-none text-color-6">ownly.io/discord</a></div>
                                    </div>

                                    <form class="newsletter-form">
                                        <div class="mb-4 pb-2">
                                            <div class="helvetica-roman font-size-120 font-size-xl-150 line-height-110">Sign up for the</div>
                                            <div class="helvetica-roman font-size-120 font-size-xl-150 line-height-110 mb-2">newsletter</div>
                                            <div class="d-flex">
                                                <div>
                                                    <input type="email" class="form-control" placeholder="Enter Email" name="email_address" style="border:0; border-bottom:2px solid #222222" />
                                                </div>
                                                <div>
                                                    <button type="submit" class="btn btn-custom-8" style="border:1px solid black">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="order-0 order-lg-1" id="ene-right-side">
                                <div class="helvetica-roman font-size-140">Internal struggles</div>
                                <div class="helvetica-roman font-size-140">and discoveries</div>
                                <div class="helvetica-roman font-size-140 mb-3 mb-lg-5">in surrealism.</div>

                                <div class="d-flex justify-content-lg-between mb-4 mb-lg-0" id="countdown" style="margin-left:-17px">
                                    <div class="text-center" style="width:72px">
                                        <div class="helvetica-roman font-size-260" id="days">00</div>
                                        <div class="helvetica-roman font-size-110">Days</div>
                                    </div>
                                    <div class="helvetica-roman font-size-260">:</div>
                                    <div class="text-center" style="width:72px">
                                        <div class="helvetica-roman font-size-260" id="hours">00</div>
                                        <div class="helvetica-roman font-size-110">Hours</div>
                                    </div>
                                    <div class="helvetica-roman font-size-260">:</div>
                                    <div class="text-center" style="width:72px">
                                        <div class="helvetica-roman font-size-260" id="minutes">00</div>
                                        <div class="helvetica-roman font-size-110">Minutes</div>
                                    </div>
                                    <div class="helvetica-roman font-size-260">:</div>
                                    <div class="text-center" style="width:72px">
                                        <div class="helvetica-roman font-size-260" id="seconds">00</div>
                                        <div class="helvetica-roman font-size-110">Seconds</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center py-3">
                <div class="helvetica-roman pe-lg-3 mb-3 mb-lg-0">Tokenizing physical art is one of the benefits that we can enjoy through the emergence of NFTs. Aside from digital art and in-game collectibles, traditional artworks are one of the assets that NFTs can revolutionize.</div>
                <div class="">
                    <a href="https://medium.com/ownlyio/mechanics-on-getting-ownlys-tokenized-physical-art-collection-df6199c9e924" target="_blank" class="btn btn-custom-4 helvetica-roman">Check out the Mechanics on Getting Ownly’s Tokenized Physical Art Collection</a>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="d-none d-lg-block">
            <img src="{{ asset('img/oha/bg-2.webp') }}" class="w-100" alt="" />
        </div>

        <div class="d-none d-md-block d-lg-none">
            <img src="{{ asset('img/oha/bg-3.webp') }}" class="w-100" alt="" />
        </div>

        <div class="d-block d-md-none">
            <img src="{{ asset('img/oha/bg-4.webp') }}" class="w-100" alt="" />
        </div>

        <div class="container">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center py-3">
                <div class="helvetica-roman pe-lg-3 mb-3 mb-lg-0">Tokenizing physical art is one of the benefits that we can enjoy through the emergence of NFTs. Aside from digital art and in-game collectibles, traditional artworks are one of the assets that NFTs can revolutionize.</div>
                <div class="">
                    <a href="https://medium.com/ownlyio/mechanics-on-getting-ownlys-tokenized-physical-art-collection-df6199c9e924" target="_blank" class="btn btn-custom-4 helvetica-roman">Check out the Mechanics on Getting Ownly’s Tokenized Physical Art Collection</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{--  rewards  --}}
@if($collection['url'] == 'rewards')
<div class="position-relative" style="min-height:calc(100vh - 80px); margin-top:80px; background-position:66% 50%">
    <div class="d-flex w-100 py-4 background-image-cover" style="min-height:calc(100vh - 80px); background-image:url('{{ asset('img/bg/rewards.gif') }}')">
        <div class="container position-relative">
            <div class="position-absolute" style="bottom:20px; left:20px">
                <div class="mb-3 mb-md-4 py-2 text-white font-size-240 font-size-sm-300 font-size-md-500 font-size-lg-600" style="text-shadow:4px 4px 9px #ffffff">Ownly Rewards</div>
                <div class="">
                    <a href="https://opensea.io/collection/ownly-rewards" target="_blank" class="btn btn-custom-3 font-size-100 font-size-sm-110 font-size-lg-150 px-4 px-md-5 py-2 shadow-sm" style="border-radius:30px">View on OpenSea</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{--  Pathfinders 3D & Marauders 2D+3D  --}}
@if($collection['url'] == 'pathfinders3d' || $collection['url'] == 'marauders')
<div class="" style="min-height:calc(100vh - 80px); margin-top:80px">
    <div class="w-100 bg-color-8 background-image-cover mt-0">
        <div class="container">
            <div class="row align-items-center page-min-height">
                <div class="col-12 col-lg-6 px-xl-4 px-xxl-5">
                    <div class="mq-banner-logo">
                        <img class="w-100" src="https://ownly.io/img/mq/MQ_logo_banner.png" alt="MQ Logo" />
                    </div>
                    <div class="text-white text-center font-size-100 font-size-sm-120 font-size-md-130 font-size-lg-140 mb-3"><span class="neo-black">Put your power to the test with Mustachio Quest!</span></div>
                    <div class="text-white text-center font-size-100 font-size-sm-120 font-size-md-130 font-size-lg-140 mb-3">Inspired by the tales and adventures of the Mustachios in The Sages Rant, Mustachio Quest is Ownly’s first NFT Play-And-Earn Game created inside MustachioVerse where players can play around using the 3D versions of their Mustachios.</div>
                    <div class="ps-lg-4 mb-5 mb-md-3">
                        <a href="https://mustachioverse.com" target="_blank" class="btn mq-banner-button font-size-100 font-size-md-150 px-5 py-3 mb-2 mb-md-0 me-md-2 w-100 line-height-120">ENTER MUSTACHIOVERSE</a>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-6">
                    <div class="mq-banner-assets">
                        <div class="mq-banner-portal">
                            <img class="w-100" src="https://ownly.io/img/mq/banner-portal.png" alt="MQ Portal" />
                        </div>
                        <div class="mq-banner-mustachios">
                            <img class="w-100" src="https://ownly.io/img/mq/mustachios.png" alt="MQ Mustachios" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- dreaded shrooms  --}}
@if($collection['url'] == 'dreadedshrooms')
<div class="bg-color-23">
    <div class="container">
        <div class="row align-items-center" style="min-height:calc(100vh - 80px); margin-top:80px">
            <div class="col-md-6 col-lg-7 order-1 order-md-0 mb-5 mb-md-0">
                <div class="text-center text-md-start text-color-9 text-white alegreya-italic font-size-160 font-size-md-200 mb-4"><span class="alegreya-bold-italic">Ownly Market</span> presents</div>
                <div class="text-center text-md-start text-white neo-black font-size-360 font-size-md-470 font-size-xl-500 line-height-90 mb-4 position-relative" style="z-index:3">DREADED<br>SHROOMS</div>
                <div class="position-relative mb-3 mb-md-5">
                    <div class="bg-color-24 text-center text-md-start py-2 position-relative" style="z-index:2">
                        <a href="https://www.facebook.com/PandangNoypi" class="neo-black text-white font-size-160 font-size-md-200 text-decoration-none" target="_blank" rel="noreferrer">by Panda Noypi</a>
                    </div>
                    <div class="bg-color-24 neo-black text-color-6 font-size-160 font-size-md-200 py-2 position-absolute w-100" style="top:0; left:-99%; z-index:1">&nbsp;</div>
                </div>

                <p class="text-white neo-bold font-size-150 text-center text-md-start mb-3">About the Collection</p>
                <p class="text-white font-size-110 text-center text-md-start mb-5">A one-of-a-kind concept, Dreaded Shrooms is perfect for collectors looking for unique and joy-sprouting art pieces. It’s good for the soul, that’s for sure.</p>

                <div class="row align-items-center">
                    <div class="col-md-8 col-xl-7 col-xxl-6 mb-4 mb-md-0">
                        <p class="text-white font-size-140 text-center text-md-start mb-0">Get a custom caricature by Panda Noypi as a gift to all first owners!</p>
                    </div>
                    <div class="col-md-4 col-xxl-6 text-center text-md-start">
                        <a href="{{ asset('img/collection-logos/caricature-isma.webp') }}" data-fancybox id="token-original-image">
                            <img src="{{ asset('img/collection-logos/caricature-isma.webp') }}" width="70" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 order-0 order-md-1 mb-5 mb-md-0">
                <div class="px-xl-3 px-xxl-4">
                    <div class="px-xl-4 px-xxl-5 mt-4 mt-md-0">
                        <img src="{{ asset('img/collection-logos/dreadedshrooms.webp') }}" class="w-100" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- boy dibil  --}}
@if($collection['url'] == 'boydibil')
<div style="background-color:#101327">
    <div class="container">
        <div class="row align-items-center" style="min-height:calc(100vh - 80px); margin-top:80px">
            <div class="col-md-6 col-lg-7 order-1 order-md-0 mb-5 mb-md-4 pb-3">
                <div class="text-center text-md-start text-color-9 text-white alegreya-italic font-size-160 font-size-md-200 mb-4"><span class="alegreya-bold-italic">Ownly Market</span> presents</div>
                <div class="text-center text-md-start text-white neo-black font-size-360 font-size-md-470 font-size-xl-500 line-height-90 mb-4 position-relative" style="z-index:3">BOY DIBIL</div>
                <div class="position-relative mb-3 mb-md-5">
                    <div class="text-center text-md-start py-2 position-relative" style="z-index:2; background-color:#124561">
                        <a href="https://www.facebook.com/PandangNoypi" class="neo-black text-white font-size-160 font-size-md-200 text-decoration-none" target="_blank" rel="noreferrer">by Kcir Johan</a>
                    </div>
                    <div class="neo-black text-color-6 font-size-160 font-size-md-200 py-2 position-absolute w-100" style="top:0; left:-99%; z-index:1; background-color:#124561">&nbsp;</div>
                </div>

                <p class="text-white neo-bold font-size-150 text-center text-md-start mb-4 pt-3">About the Collection</p>
                <p class="text-white font-size-110 text-center text-md-start mb-0 line-height-150">The Boy Dibil NFT collection follows Kcir Johan aka Boy Dibil, a former biological researcher’s journey from developing a compound that may enhance humans in several aspects to transforming into a wicked apathetic being with horns like a devil, and back to his restored true form.</p>
            </div>

            <div class="col-md-6 col-lg-5 order-0 order-md-1 mb-5 mb-md-4">
                <div class="px-xl-3 px-xxl-4">
                    <div class="px-xl-4 px-xxl-5 mt-4 mt-md-0">
                        <img src="{{ asset('img/collections/boy-dibil/bdwithlogo.webp') }}" class="w-100" style="border:6px solid #124561" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- rascals  --}}
@if($collection['url'] == 'rascals')
<section id="hero" class="background-image-cover" style="background-image: url('{{ asset('img/collections/rascals/rascals-in-group.png') }}')">
    <div class="container h-100">
        <div class="row align-items-center justify-content-center min-vh-100" style="padding-top:80px">
            <div class="col-12 col-lg-6">
                <div class="mx-5 px-5">
                    <div class="mx-5 px-4">
                        <img src="{{ asset('img/collections/rascals/rascals-logo.png') }}" alt="Rascals Logo" class="w-100">
                    </div>
                </div>
                <p class="hero-desc font-size-110 font-size-lg-140 figtree font-weight-300 text-center text-white line-height-160">10,000 3D Generative Mustachio Rascals NFT</p>
                <div class="px-5 mx-5 mb-3">
                    <div class="p-3" style="border:1px solid #ffffff">
                        <p class="prices-text text-white text-center figtree font-size-110 font-size-md-120 mb-0">1-2 = <s class="hero-striked-price figtree font-size-80 font-size-md-90">0.025 ETH</s> <b class="figtree">0.01875 ETH</b> / Rascal</p>
                        <p class="prices-text text-white text-center figtree font-size-110 font-size-md-120 mb-0">3-4 = <s class="hero-striked-price figtree font-size-80 font-size-md-90">0.018 ETH</s> <b class="figtree">0.0135 ETH</b> / Rascal</p>
                        <p class="prices-text text-white text-center figtree font-size-110 font-size-md-120 mb-0">5-9 = <s class="hero-striked-price figtree font-size-80 font-size-md-90">0.014 ETH</s> <b class="figtree">0.0105 ETH</b> / Rascal</p>
                        <p class="prices-text text-white text-center figtree font-size-110 font-size-md-120 mb-0">10+ = <s class="hero-striked-price figtree font-size-80 font-size-md-90">0.009 ETH</s> <b class="figtree">0.00675 ETH</b> / Rascal</p>
                    </div>
                </div>
                <p class="text-white gotham-black text-center figtree font-weight-600 font-size-120 font-size-sm-130 font-size-md-150 mb-3">25% OFF until 31 OCT 2022!</p>
                <div class="d-flex align-items-center justify-content-center flex-wrap mb-4 px-0 px-md-5" id="countdown">
                    <div class="countdown days" style="width:70px">
                        <p class="font-size-160 font-size-sm-180 font-size-lg-220 roboto font-weight-600 text-center mb-0" id="days" style="color:#cfcbcc">00</p>
                        <p class="font-size-70 text-center text-white mb-0">DAYS</p>
                    </div>
                    <div class="countdown hours" style="width:70px">
                        <p class="font-size-160 font-size-sm-180 font-size-lg-220 roboto font-weight-600 text-center mb-0" id="hours" style="color:#cfcbcc">00</p>
                        <p class="font-size-70 text-center text-white mb-0">HOURS</p>
                    </div>
                    <div class="countdown minutes" style="width:70px">
                        <p class="font-size-160 font-size-sm-180 font-size-lg-220 roboto font-weight-600 text-center mb-0" id="minutes" style="color:#cfcbcc">00</p>
                        <p class="font-size-70 text-center text-white mb-0">MINUTES</p>
                    </div>
                    <div class="countdown seconds" style="width:70px">
                        <p class="font-size-160 font-size-sm-180 font-size-lg-220 roboto font-weight-600 text-center mb-0" id="seconds" style="color:#cfcbcc">00</p>
                        <p class="font-size-70 text-center text-white mb-0">SECONDS</p>
                    </div>
                </div>

                <div class="mx-auto text-center">
                    <a href="https://mustachioverse.com" class="btn btn-custom-7 figtree font-size-120 font-size-md-130 px-3 py-2 px-5 py-md-3 font-weight-700">MINT NOW!</a>
                </div>
            </div>
            <div class="col-12 col-lg-6 d-none d-lg-block"></div>
        </div>
    </div>
</section>
@endif
