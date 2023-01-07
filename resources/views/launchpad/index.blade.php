@extends('layouts.app')

@section('title', 'Launchpad')
@section('og_title', 'Launchpad')
@section('og_image', asset('img/og/launchpad.png'))

@section('content')
    <div class="background-image-cover" style="background-image:url('{{ asset('img/bg/launchpad.png') }}')">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center min-vh-100 py-5">
                <div>
                    <p class="text-white text-center font-size-160 font-size-sm-180 font-size-md-220 font-size-lg-250">Ownly Market</p>
                    <p class="text-color-10 neo-black text-center font-size-300 font-size-sm-440 font-size-md-500 font-size-lg-550 mb-4">ARTIST LAUNCHPAD</p>

                    <div class="px-sm-5 mx-5">
                        <div class="bg-color-21 w-100 mb-5" style="height:1px"></div>
                    </div>

                    <p class="text-white text-center font-size-150 font-size-sm-160 font-size-md-180 font-size-lg-220 alegreya-italic">Mint and launch your NFT collection the easy way.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row align-items-lg-center py-5">
            <div class="col-lg-5 col-xl-4 mb-5 mb-lg-0">
                <div class="mx-md-5 px-md-5 mx-lg-0 px-lg-0">
                    <div class="mx-4 mx-sm-5 mx-md-0 px-sm-5 pe-lg-4 ps-lg-0">
                        <video autoplay loop muted preload class="w-100 shadow-sm" style="border-radius:10px"><source src="{{ asset('img/collections/boy-dibil/teaser.mp4') }}" type="video/mp4"></video>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-xl-8">
                <div class="ps-lg-3">
                    <p class="text-center text-lg-start font-size-150 font-size-xl-160 font-size-xxl-200 mb-3">Ownly Artist Launchpad presents</p>

                    <p class="neo-black text-center text-lg-start font-size-320 font-size-xl-400 font-size-xxl-450 mb-2">Boy Dibil</p>
                    <p class="text-center text-lg-start font-size-220 font-size-xl-240 mb-4">
                        <a href="https://www.facebook.com/johnrick.miranda.3" target="_blank" class="neo-black text-decoration-none" style="color:#212529">By Kcir Johan</a>
                    </p>

                    <div class="bg-color-21 w-100 mb-4" style="height:1px"></div>

                    <p class="font-size-130 text-center text-lg-start line-height-150 pt-2 mb-3">The Boy Dibil NFT collection follows Kcir Johan aka Boy Dibil, a former biological researcher’s journey from developing a compound that may enhance humans in several aspects to transforming into a wicked apathetic being with horns like a devil, and back to his restored true form.</p>

{{--                    <p class="font-size-130 text-center text-lg-start line-height-150 pt-2 mb-4">Dropping on 07/28</p>--}}

{{--                    <div class="d-flex justify-content-center justify-content-lg-start">--}}
{{--                        <div class="d-flex mb-4 mb-lg-0" id="countdown" style="margin-left:-17px">--}}
{{--                            <div class="text-center" style="width:72px">--}}
{{--                                <div class="font-size-260" id="days">00</div>--}}
{{--                                <div class="font-size-90">Days</div>--}}
{{--                            </div>--}}
{{--                            <div class="font-size-260">:</div>--}}
{{--                            <div class="text-center" style="width:72px">--}}
{{--                                <div class="font-size-260" id="hours">00</div>--}}
{{--                                <div class="font-size-90">Hours</div>--}}
{{--                            </div>--}}
{{--                            <div class="font-size-260">:</div>--}}
{{--                            <div class="text-center" style="width:72px">--}}
{{--                                <div class="font-size-260" id="minutes">00</div>--}}
{{--                                <div class="font-size-90">Minutes</div>--}}
{{--                            </div>--}}
{{--                            <div class="font-size-260">:</div>--}}
{{--                            <div class="text-center" style="width:72px">--}}
{{--                                <div class="font-size-260" id="seconds">00</div>--}}
{{--                                <div class="font-size-90">Seconds</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="text-center text-lg-start pt-4">
                        <a href="{{ route('collection.index', 'boydibil') }}" class="btn btn-custom-2 px-5 py-2">BUY NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="background-image-cover" style="background-image:url('{{ asset('img/bg/launchpad.png') }}')">
        <div class="container py-5">
            <div class="row align-items-xl-center py-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="mx-md-5 px-md-5 mx-lg-0 px-lg-0">
                        <div class="mx-4 mx-sm-5 mx-md-0 px-sm-5 pe-lg-4 ps-lg-0">
                            <div class="w-100 bg-color-21 position-relative" style="padding-top:100%">
                                <div class="d-flex align-items-center justify-content-center position-absolute w-100 h-100" style="top:0; left:0">
                                    <i class="fas fa-rocket-launch text-white font-size-800 font-size-sm-900 font-size-md-900 font-size-xl-1000 font-size-xxl-1300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="ps-lg-3">
                        <p class="neo-bold text-center text-lg-start font-size-250 font-size-md-300 text-white mb-4">About the Artist Launchpad</p>

                        <div class="bg-color-21 w-100 mb-4" style="height:1px"></div>

                        <p class="font-size-120 text-center text-lg-start line-height-150 text-white pt-2 mb-4 pb-2">In the hopes of bringing NFT artists and collectors together, Ownly develops a platform where gifted artists in the Crypto Art industry can mint and launch their NFT collections or projects the easy way. The Ownly Market Artist Launchpad bridges the gap between art, tech, marketing, and community. Through the Ownly Market Artist Launchpad, the artists can focus on doing what they do best, which is creating artworks and building their own unique portfolio in the metaverse.</p>

                        <div class="text-center text-lg-start">
                            <a href="https://ownly.io/discord" class="btn btn-custom-15 px-5 py-2 font-size-120">JOIN THE OWNLY DISCORD</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="background-image-cover" style="background-image:url('{{ asset('img/bg/launchpad-2.png') }}')">
        <div class="container py-5">
            <div class="row py-5">
                <div class="col-lg-4 pb-4">
                    <div class="card border-0 border-radius-0 h-100">
                        <div class="card-body p-5">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="bg-color-21 d-flex align-items-center justify-content-center" style="border-radius:50%; width:80px; height:80px">
                                    <i class="fas fa-rocket-launch font-size-180 text-white"></i>
                                </div>
                            </div>

                            <p class="text-center neo-bold font-size-140">Easiest Way to Launch</p>
                            <p class="text-center font-size-110">Gone are the days where you had to create your own minting website, smart contracts, and all the other bells and whistles just to launch your NFT collection. The Ownly Market Artist Launchpad takes care of all the tech so you don’t have to.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pb-4">
                    <div class="card border-0 border-radius-0 h-100">
                        <div class="card-body p-5">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="bg-color-21 d-flex align-items-center justify-content-center" style="border-radius:50%; width:80px; height:80px">
                                    <i class="fas fa-user-group font-size-180 text-white"></i>
                                </div>
                            </div>

                            <p class="text-center neo-bold font-size-140">Existing Community</p>
                            <p class="text-center font-size-110">Community building plays a big part in marketing your NFT collections. It’s not enough to have just any community. Ownly takes pride in having a community of collectors and enthusiasts that is actively nurtured through value-added content.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pb-4">
                    <div class="card border-0 border-radius-0 h-100">
                        <div class="card-body p-5">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="bg-color-21 d-flex align-items-center justify-content-center" style="border-radius:50%; width:80px; height:80px">
                                    <i class="fas fa-award font-size-180 text-white"></i>
                                </div>
                            </div>

                            <p class="text-center neo-bold font-size-140">Partner With a Pioneer</p>
                            <p class="text-center font-size-110">Through the years, Ownly has a proven track record in the crypto art industry that dates back to early 2019. We have partnered with credible organizations and brilliant artists, positioning the Ownly Market as the preferred Filipino NFT art marketplace.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row align-items-center py-5">
            <div class="col-lg-8 order-1 order-lg-0">
                <div class="pe-lg-3">
                    <p class="neo-bold text-center text-lg-start font-size-250 font-size-md-300 mb-4">Who is Crypto&nbsp;Art&nbsp;PH?</p>

                    <div class="bg-color-21 w-100 mb-4" style="height:1px"></div>

                    <p class="font-size-120 text-center text-lg-start line-height-150 pt-2">Crypto Art PH is a community-driven group supporting Filipino crypto artists. It aims to build and provide a platform for Filipino artists to bridge the gap between culture and web3 so they can tell the story of Filipino culture through EdTech focused on Filipino artists empowered by the blockchain-based economy.</p>
                    <p class="font-size-120 text-center text-lg-start line-height-150 mb-4">Most of the ideas in the community are developed inside the "talyer" channel on their Discord server. Artists share their ideas, knowledge, and expertise in art, technology, and personal experiences to learn from each other.</p>

                    <div class="text-center text-lg-start">
                        <a href="https://medium.com/ownlyio/ownly-partners-with-crypto-art-ph-in-nurturing-the-community-of-filipino-nft-artists-5862ac185ad0" class="btn btn-custom-15 px-5 py-2 font-size-120">READ MORE ABOUT CRYPTO ART PH</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 order-0 order-lg-1 mb-5 mb-lg-0">
                <div class="ps-lg-4">
                    <div class="mx-4 mx-sm-5 mx-lg-0 px-sm-5 px-lg-0">
                        <div class="mx-md-5 mx-lg-0 px-md-5 px-lg-0">
                            <div class="background-image-cover w-100" style="padding-top:100%; border-radius:50%; background-image:url('{{ asset('img/logo/cryptoartph.jpg') }}')">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-hidden">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="background-image-cover" style="background-image:url('{{ asset('img/bg/launchpad-2.png') }}'); background-position:0 0">
                        <div class="container py-4">
                            <div class="row py-5 min-vh-100 align-items-xl-center">
                                <div class="col-xl-8 order-1 order-xl-0">
                                    <p class="text-center text-xl-start text-color-10 fw-bold font-size-280 font-size-md-400 mb-4">Lei Melendres</p>
                                    <p class="text-center text-xl-start text-white fw-bold font-size-150 font-size-md-200 mb-4">“Saying Ownly helped me in a very big way is a huge understatement.”</p>
                                    <p class="text-center text-xl-start text-white font-size-100 font-size-md-120 mb-4 line-height-150 mb-4 pb-4">I am super thankful and grateful to them for not only helping me create NFTs, but they were also the one who introduced me to the world of crypto itself. Plus, we didn't just work on one NFT artwork but a full-blown 20 pcs Genesis NFT collection. Isma and his team were very patient and were always there to encourage, support, promote, and help me in my NFT journey every step of the way even until now and I owe them a lot for it.</p>

                                    <div class="text-center text-xl-start">
                                        <a href="{{ route('collection.index', 'inkvadyrz') }}" target="_blank" class="btn btn-custom-15 me-md-2 px-5 py-3 mb-2" style="min-width:249px">VIEW COLLECTION</a>
                                        <a href="https://www.youtube.com/watch?v=oBqwXkkYquw&t=1675s" target="_blank" class="btn btn-custom-16 px-5 py-3 mb-2">WATCH INTERVIEW</a>
                                    </div>
                                </div>

                                <div class="col-xl-4 ps-xl-5 order-0 order-xl-1 mb-5 mb-xl-0">
                                    <div class="mx-4 mx-sm-5 mx-xl-0 px-sm-5 px-xl-0">
                                        <div class="mx-md-5 mx-xl-0 px-md-5 px-xl-0">
                                            <div class="text-end">
                                                <img src="{{ asset('img/artists/Lei-Melendres.webp') }}" class="w-100" alt="Lei Melendres" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="background-image-cover" style="background-image:url('{{ asset('img/bg/launchpad-2.png') }}'); background-position:0 0">
                        <div class="container py-4">
                            <div class="row py-5 min-vh-100 align-items-xl-center">
                                <div class="col-xl-8 order-1 order-xl-0">
                                    <p class="text-center text-xl-start text-color-10 fw-bold font-size-280 font-size-md-400 mb-4">Eugene Oligo</p>
                                    <p class="text-center text-xl-start text-white fw-bold font-size-150 font-size-md-200 mb-4">“It was fun doing the Titans of Industry collection.”</p>
                                    <p class="text-center text-xl-start text-white font-size-100 font-size-md-120 mb-4 line-height-150 mb-4 pb-4">Thanks to Ownly, for giving me the opportunity to be part of this project. I've learned a lot about NFTs, how they work, and so on, it's cool. This is a great instrument to help other creatives be introduced to the world of NFTs. I hope for more success in your future projects!</p>

                                    <div class="text-center text-xl-start">
                                        <a href="{{ route('collection.index', 'titansofindustry') }}" class="btn btn-custom-15 px-5 py-3">VIEW COLLECTION</a>
                                    </div>
                                </div>

                                <div class="col-xl-4 ps-xl-5 order-0 order-xl-1 mb-5 mb-xl-0">
                                    <div class="mx-4 mx-sm-5 mx-xl-0 px-sm-5 px-xl-0">
                                        <div class="mx-md-5 mx-xl-0 px-md-5 px-xl-0">
                                            <div class="text-end">
                                                <img src="{{ asset('img/artists/Eugene-Oligo.webp') }}" class="w-100" alt="Eugene Oligo" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="background-image-cover" style="background-image:url('{{ asset('img/bg/launchpad-2.png') }}'); background-position:0 0">
                        <div class="container py-4">
                            <div class="row py-5 min-vh-100 align-items-xl-center">
                                <div class="col-xl-8 order-1 order-xl-0">
                                    <p class="text-center text-xl-start text-color-10 fw-bold font-size-280 font-size-md-400 mb-4">Marso</p>
                                    <p class="text-center text-xl-start text-white fw-bold font-size-150 font-size-md-200 mb-4">“Glad to work with a group of intellectuals who aspire to be one of the best in the nft space.”</p>
                                    <p class="text-center text-xl-start text-white font-size-100 font-size-md-120 mb-4 line-height-150 mb-4 pb-4">Ownly helped me kickstart one of my projects that helped me to create a masterpiece. Their team are really fun to work with. Will definitely love to work with them again.</p>

                                    <div class="text-center text-xl-start">
                                        <a href="{{ route('collection.index', 'genesisblock') }}" target="_blank" class="btn btn-custom-15 me-md-2 px-5 py-3 mb-2" style="min-width:249px">VIEW COLLECTION</a>
                                        <a href="https://www.youtube.com/watch?v=RVj8gPB3Itk&t=709s" target="_blank" class="btn btn-custom-16 px-5 py-3 mb-2">WATCH INTERVIEW</a>
                                    </div>
                                </div>

                                <div class="col-xl-4 ps-xl-5 order-0 order-xl-1 mb-5 mb-xl-0">
                                    <div class="mx-4 mx-sm-5 mx-xl-0 px-sm-5 px-xl-0">
                                        <div class="mx-md-5 mx-xl-0 px-md-5 px-xl-0">
                                            <div class="text-end">
                                                <img src="{{ asset('img/artists/Marso.webp') }}" class="w-100" alt="Marso" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="background-image-cover" style="background-image:url('{{ asset('img/bg/launchpad-2.png') }}'); background-position:0 0">
                        <div class="container py-4">
                            <div class="row py-5 min-vh-100 align-items-xl-center">
                                <div class="col-xl-8 order-1 order-xl-0">
                                    <p class="text-center text-xl-start text-color-10 fw-bold font-size-280 font-size-md-400 mb-4">Mel Baranda</p>
                                    <p class="text-center text-xl-start text-white fw-bold font-size-150 font-size-md-200 mb-4">“I'm so glad to be a part of it, its an amazing experience!”</p>
                                    <p class="text-center text-xl-start text-white font-size-100 font-size-md-120 mb-4 line-height-150 mb-4 pb-4">The venue is beautiful and presentable, impressive presentation of artworks and very knowledgeable.</p>

                                    <div class="text-center text-xl-start">
                                        <a href="{{ route('collection.index', 'oha') }}" class="btn btn-custom-15 px-5 py-3">VIEW COLLECTION</a>
                                    </div>
                                </div>

                                <div class="col-xl-4 ps-xl-5 order-0 order-xl-1 mb-5 mb-xl-0">
                                    <div class="mx-4 mx-sm-5 mx-xl-0 px-sm-5 px-xl-0">
                                        <div class="mx-md-5 mx-xl-0 px-md-5 px-xl-0">
                                            <div class="text-end">
                                                <img src="{{ asset('img/artists/Mel-Baranda.webp') }}" class="w-100" alt="Mel Baranda" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="background-image-cover" style="background-image:url('{{ asset('img/bg/launchpad-2.png') }}'); background-position:0 0">
                        <div class="container py-4">
                            <div class="row py-5 min-vh-100 align-items-xl-center">
                                <div class="col-xl-8 order-1 order-xl-0">
                                    <p class="text-center text-xl-start text-color-10 fw-bold font-size-280 font-size-md-400 mb-4">Boii Mustache</p>
                                    <p class="text-center text-xl-start text-white fw-bold font-size-150 font-size-md-200 mb-4">“Within 12 hours after the release, we sold 45 out of 100 NFTs. It was unexpected.”</p>
                                    <p class="text-center text-xl-start text-white font-size-100 font-size-md-120 mb-4 line-height-150 mb-4 pb-4">When I was asked to have a collaborative project with Ownly with my Mustachio character, I had 100+ Mustachio drawings in my Drive and I thought it would be a great idea to use it on our NFT project. The team made sure that the collection release was a blast, and it really was. Few hours after the release, we sold almost half of the entire collection. It was really unexpected. Who would have thought that those artworks sitting on my Drive would sell for thousands? I can’t even sell paintings at the same price. I was really happy about this experience with Ownly. I’m getting paid for doing what I love, which is creating art, without thinking about where to find my next commission so I could pay my bills. They’re also developing a game based on my character and the progress is really promising.</p>

                                    <div class="text-center text-xl-start">
                                        <a href="{{ route('collection.index', 'mustachios') }}" class="btn btn-custom-15 px-5 py-3">VIEW COLLECTION</a>
                                        <a href="https://medium.com/ownlyio/meet-the-secretive-artist-behind-the-mustachios-e94a9c335774" target="_blank" class="btn btn-custom-16 px-5 py-3 mb-2">GET TO KNOW BOII MUSTACHE</a>
                                    </div>
                                </div>

                                <div class="col-xl-4 ps-xl-5 order-0 order-xl-1 mb-5 mb-xl-0">
                                    <div class="mx-4 mx-sm-5 mx-xl-0 px-sm-5 px-xl-0">
                                        <div class="mx-md-5 mx-xl-0 px-md-5 px-xl-0">
                                            <div class="text-end">
                                                <img src="{{ asset('img/artists/Boii-Mustache.jpg') }}" class="w-100" alt="Boii Mustache" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev ms-4" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next me-4" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="bg-color-22">
        <div class="container py-5">
            <div class="py-5">
                <p class="neo-bold text-center font-size-300 text-color-10 mb-4">The Process</p>

                <div class="d-flex justify-content-center">
                    <div class="bg-color-21 w-100 mb-4" style="height:1px; max-width:500px"></div>
                </div>

                <div class="row pt-5">
                    <div class="col-lg-4 pb-4">
                        <div class="h-100">
                            <div class="p-4 p-xl-5">
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="bg-white d-flex align-items-center justify-content-center" style="border-radius:50%; width:80px; height:80px">
                                        <span class="font-size-200 neo-black">1</span>
                                    </div>
                                </div>

                                <p class="text-center text-white font-size-110">Join the Crypto Art PH Discord community and their exclusive channel: Ownly Market Artist Launchpad. Casually say hi and introduce yourself! Get handpicked by Kapitan Jopet Arias, the Art Consultant of Crypto Art PH, responsible for curating the artists and their NFT collections within the community. He is considering traditional artists with an existing body of works who are influential in their respective fields but are new in crypto art.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 pb-4">
                        <div class="h-100">
                            <div class="p-4 p-xl-5">
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="bg-white d-flex align-items-center justify-content-center" style="border-radius:50%; width:80px; height:80px">
                                        <span class="font-size-200 neo-black">2</span>
                                    </div>
                                </div>

                                <p class="text-center text-white font-size-110">Prepare your NFT collection with the guidance of Kap Jopet, ensuring a smooth minting and launching process in the Ownly Market Artist Launchpad. Through our platform, you’ll be able to reach a global scale, build a legacy in the industry, and even create staking reward benefits for the community.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 pb-4">
                        <div class="h-100">
                            <div class="p-4 p-xl-5">
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="bg-white d-flex align-items-center justify-content-center" style="border-radius:50%; width:80px; height:80px">
                                        <span class="font-size-200 neo-black">3</span>
                                    </div>
                                </div>

                                <p class="text-center text-white font-size-110">And launch! Smart contracts? Minting websites? Those are things from the past. For someone who’s new in the crypto art industry, these requirements are overwhelming. Good for you, the Ownly Market Artist Launchpad provides not just the platform but also topnotch security in the blockchain, backed with a transparent team of experienced professionals in the crypto space.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="py-5">
            <p class="neo-bold text-center font-size-300 text-color-10 mb-4">Frequently Asked Questions</p>

            <div class="d-flex justify-content-center mb-4">
                <div class="bg-color-21 w-100 mb-4" style="height:1px; max-width:900px"></div>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button font-size-80" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            I’m new in the crypto art space. Where do I go?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show bg-color-1" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body font-size-130 p-4">The Ownly Market Artist Launchpad is welcome to everyone. Whether you’re new or a veteran in the space, you can join us on the <a href="https://ownly.io/discord" target="_blank" class="link-color-5">Ownly Discord community</a> and <a href="https://discord.gg/D8MRzAtsKv" target="_blank" class="link-color-5">Crypto Art PH Discord</a> community to connect with like-minded NFT enthusiasts who either got the same questions or have the answers to your questions. Either way, you’re not alone!</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button font-size-80 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-controls="collapseTwo">
                            I’m an NFT collector. How can I support these artists?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse bg-color-1" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body font-size-130 p-4">This is great to hear! Thank you for your interest in supporting these brilliant artists. To show your support, you can check out the existing NFT collections in the <a href="{{ route('home.index', 'titansofindustry') }}" target="_blank" class="link-color-5">Ownly Market</a> and #OWN some artworks from our distinguished artists.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button font-size-80 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-controls="collapseThree">
                            How does the Ownly Market Artist Launchpad work?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse bg-color-1" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body font-size-130 p-4">The Ownly Market Artist Launchpad is a platform where gifted artists in the Crypto Art industry can mint and launch their NFT collections without the hustle of creating minting websites and smart contracts. All you need to do as an artist is to prepare, mint, and launch your NFT collection on the platform and Ownly will handle the rest.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button font-size-80 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-controls="collapseFour">
                            What is the Ownly x Crypto Art PH partnership about?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse bg-color-1" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body font-size-130 p-4">As part of our Ownly Market Artist Launchpad launch, Crypto Art PH will help curate the artists and their NFT collections from within the community. This will further improve the NFT scene in the Philippines as the Ownly Market Artist Launchpad aims to showcase works from gifted artists all over the nation, while providing them with a platform that does the work for them. <a href="https://discord.gg/D8MRzAtsKv" target="_blank" class="link-color-5">Join the Crypto Art PH Discord community here</a>.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button font-size-80 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-controls="collapseFive">
                            Who should I reach if I encounter any issues?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse bg-color-1" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body font-size-130 p-4">If you encounter any issues, please don’t hesitate to reach out to us via email at support@ownly.io and we’ll get back to you the soonest we’re available to respond. We also have a Discord channel exclusive to provide support to the community. To access, please join our <a href="https://ownly.io/discord" target="_blank" class="link-color-5">Ownly Discord community</a> and browse through the channels. You can find the <b>support</b> channel under Community Feedback.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="background-image-cover" style="background-image:url('{{ asset('img/bg/launchpad.png') }}')">
        <div class="container py-5">
            <div class="row flex-column align-items-center py-5">
                <div class="col-md-7 col-lg-6 mb-4">
                    <img src="{{ asset('img/logo/crypto-art-ph-white.png') }}" class="w-100" alt="Crypto Art PH">
                </div>

                <div class="col-md-8 col-lg-6">
                    <div class="text-center px-5 mb-5">
                        <a href="https://discord.gg/D8MRzAtsKv" class="btn btn-custom-15 px-5 py-3 font-size-120 w-100">JOIN CRYPTO ART PH'S DISCORD TO APPLY</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
