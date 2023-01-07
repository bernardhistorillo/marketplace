@extends('layouts.app')

@section('title', 'Home')
@section('og_title', 'Ownly: Buy, own, collect, and trade 1 of 1 edition crypto artworks by talented artists.')
@section('og_image', asset('img/og/home.png'))

@section('content')
{{--    <div class="background-image-cover" style="background-image:url('{{ asset('img/bg/launchpad.png') }}')">--}}
{{--        <div class="container py-5" style="margin-top:40px">--}}
{{--            <div class="row align-items-lg-center py-5">--}}
{{--                <div class="col-lg-5 col-xl-4 mb-5 mb-lg-0">--}}
{{--                    <div class="mx-md-5 px-md-5 mx-lg-0 px-lg-0">--}}
{{--                        <div class="mx-4 mx-sm-5 mx-md-0 px-sm-5 pe-lg-4 ps-lg-0">--}}
{{--                            <video autoplay loop muted preload class="w-100 shadow-sm" style="border-radius:10px"><source src="{{ asset('img/collections/boy-dibil/teaser.mp4') }}" type="video/mp4"></video>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-7 col-xl-8">--}}
{{--                    <div class="ps-lg-3">--}}
{{--                        <p class="text-center text-lg-start font-size-150 font-size-xl-160 font-size-xxl-200 text-white mb-3">Ownly Artist Launchpad presents</p>--}}

{{--                        <p class="neo-black text-center text-lg-start font-size-320 font-size-xl-400 text-white mb-2">Boy Dibil</p>--}}
{{--                        <p class="text-center text-lg-start font-size-220 font-size-xl-240 font-size-xxl-260 mb-4">--}}
{{--                            <a href="https://www.facebook.com/johnrick.miranda.3" target="_blank" class="neo-black text-decoration-none text-white">By Kcir Johan</a>--}}
{{--                        </p>--}}

{{--                        <div class="bg-color-21 w-100 mb-4" style="height:1px"></div>--}}

{{--                        <p class="font-size-130 text-center text-lg-start line-height-150 text-white pt-2 mb-3">The Boy Dibil NFT collection follows Kcir Johan aka Boy Dibil, a former biological researcher’s journey from developing a compound that may enhance humans in several aspects to transforming into a wicked apathetic being with horns like a devil, and back to his restored true form.</p>--}}

{{--                        <p class="font-size-130 text-center text-lg-start line-height-150 text-white pt-2 mb-4">Dropping on 07/28</p>--}}

{{--                        <div class="d-flex justify-content-center justify-content-lg-start">--}}
{{--                            <div class="d-flex mb-4 mb-lg-0 text-white" id="countdown" style="margin-left:-17px">--}}
{{--                                <div class="text-center" style="width:72px">--}}
{{--                                    <div class="font-size-260" id="days">00</div>--}}
{{--                                    <div class="font-size-90">Days</div>--}}
{{--                                </div>--}}
{{--                                <div class="font-size-260">:</div>--}}
{{--                                <div class="text-center" style="width:72px">--}}
{{--                                    <div class="font-size-260" id="hours">00</div>--}}
{{--                                    <div class="font-size-90">Hours</div>--}}
{{--                                </div>--}}
{{--                                <div class="font-size-260">:</div>--}}
{{--                                <div class="text-center" style="width:72px">--}}
{{--                                    <div class="font-size-260" id="minutes">00</div>--}}
{{--                                    <div class="font-size-90">Minutes</div>--}}
{{--                                </div>--}}
{{--                                <div class="font-size-260">:</div>--}}
{{--                                <div class="text-center" style="width:72px">--}}
{{--                                    <div class="font-size-260" id="seconds">00</div>--}}
{{--                                    <div class="font-size-90">Seconds</div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="text-center text-lg-start pt-4">--}}
{{--                            <a href="{{ route('collection.index', 'boydibil') }}" class="btn btn-custom-2 px-5 py-2">BUY NOW</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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
                    <div class="px-5 mx-5 mb-5">
                        <div class="p-3" style="border:1px solid #ffffff">
                            <p class="prices-text text-white text-center figtree fw-bold font-size-120 font-size-md-130 mb-1">1-2 = 0.025 ETH / Rascal</p>
                            <p class="prices-text text-white text-center figtree fw-bold font-size-120 font-size-md-130 mb-1">3-4 = 0.018 ETH / Rascal</p>
                            <p class="prices-text text-white text-center figtree fw-bold font-size-120 font-size-md-130 mb-1">5-9 = 0.014 ETH / Rascal</p>
                            <p class="prices-text text-white text-center figtree fw-bold font-size-120 font-size-md-130 mb-0">10+ = 0.009 ETH / Rascal</p>
                        </div>
                    </div>
{{--                    <p class="text-white gotham-black text-center figtree font-weight-600 font-size-120 font-size-sm-130 font-size-md-150 mb-3">25% OFF until 31 OCT 2022!</p>--}}
{{--                    <div class="d-flex align-items-center justify-content-center flex-wrap mb-4 px-0 px-md-5" id="countdown">--}}
{{--                        <div class="countdown days" style="width:70px">--}}
{{--                            <p class="font-size-160 font-size-sm-180 font-size-lg-220 roboto font-weight-600 text-center mb-0" id="days" style="color:#cfcbcc">00</p>--}}
{{--                            <p class="font-size-70 text-center text-white mb-0">DAYS</p>--}}
{{--                        </div>--}}
{{--                        <div class="countdown hours" style="width:70px">--}}
{{--                            <p class="font-size-160 font-size-sm-180 font-size-lg-220 roboto font-weight-600 text-center mb-0" id="hours" style="color:#cfcbcc">00</p>--}}
{{--                            <p class="font-size-70 text-center text-white mb-0">HOURS</p>--}}
{{--                        </div>--}}
{{--                        <div class="countdown minutes" style="width:70px">--}}
{{--                            <p class="font-size-160 font-size-sm-180 font-size-lg-220 roboto font-weight-600 text-center mb-0" id="minutes" style="color:#cfcbcc">00</p>--}}
{{--                            <p class="font-size-70 text-center text-white mb-0">MINUTES</p>--}}
{{--                        </div>--}}
{{--                        <div class="countdown seconds" style="width:70px">--}}
{{--                            <p class="font-size-160 font-size-sm-180 font-size-lg-220 roboto font-weight-600 text-center mb-0" id="seconds" style="color:#cfcbcc">00</p>--}}
{{--                            <p class="font-size-70 text-center text-white mb-0">SECONDS</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="mx-auto text-center mb-4">
                        <a href="https://mustachioverse.com" class="btn btn-custom-7 figtree font-size-120 font-size-md-130 px-3 py-2 px-5 py-md-3 font-weight-700">MINT NOW!</a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-none d-lg-block"></div>
            </div>
        </div>
    </section>

    <div class="w-100">
        <div id="carousel-1" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="background-image-cover position-relative page-min-height" style="background-image:url('{{ asset('img/banners/Ownly.jpg') }}'">
                        <div class="position-absolute w-100 h-100" style="background-color:rgba(0,0,0,0.8)"></div>

                        <div class="container w-100">
                            @include('includes.home.carousel_content')
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="background-image-cover position-relative page-min-height" style="background-image:url('{{ asset('img/banners/NFT-Pioneer.jpg') }}')">
                        <div class="position-absolute w-100 h-100" style="background-color:rgba(0,0,0,0.8)"></div>

                        <div class="container w-100">
                            @include('includes.home.carousel_content')
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="background-image-cover position-relative page-min-height" style="background-image:url('{{ asset('img/banners/Globally-Competitive.jpg') }}')">
                        <div class="position-absolute w-100 h-100" style="background-color:rgba(0,0,0,0.8)"></div>

                        <div class="container w-100">
                            @include('includes.home.carousel_content')
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="background-image-cover position-relative page-min-height" style="background-image:url('{{ asset('img/banners/Amazing-NFT Artists.jpg') }}')">
                        <div class="position-absolute w-100 h-100" style="background-color:rgba(0,0,0,0.8)"></div>

                        <div class="container w-100">
                            @include('includes.home.carousel_content')
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="background-image-cover position-relative page-min-height" style="background-image:url('{{ asset('img/banners/Pool-Of-Creative-Talents.jpg') }}')">
                        <div class="position-absolute w-100 h-100" style="background-color:rgba(0,0,0,0.8)"></div>

                        <div class="container w-100">
                            @include('includes.home.carousel_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-color-2">
        <div class="container py-5">
            <div class="px-5 py-3">
                <div class="px-5">
                    <div class="position-relative search-field-container">
                        <div class="position-absolute" style="top:19px; left:22px">
                            <i class="fas fa-search font-size-130"></i>
                        </div>

                        <div class="d-flex">
                            <div class="flex-fill">
                                <input type="text" class="form-control font-size-110 search-field" placeholder="Search Collections and NFTs" style="padding-left:64px; height:60px; border-radius:15px 0 0 15px" />
                            </div>
                            <div class="">
                                <button class="btn btn-custom-1 px-5 font-size-110" style="border-radius:0 15px 15px 0; height:60px">SEARCH</button>
                            </div>
                        </div>

                        <div class="position-absolute w-100 d-none search-suggestions-container" style="top:60px; left:0; z-index:1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-color-18" id="collections">
        <div class="container py-5">
            <p class="text-center rubik-bold font-size-200 font-size-md-280 text-color-5 mb-4">COLLECTIONS</p>

            <div class="py-3" id="collections-container">
                <div class="splide splide--loop px-5 pb-5">
                    <div class="px-2">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach($collections as $collection)
                                <li class="splide__slide px-2">
                                    <a href="{{ route('collection.index', $collection['url_placeholder']) }}" class="text-decoration-none">
                                        <div class="card" style="border:1px solid #cccccc; border-radius:10px">
                                            <div class="w-100 background-image-cover" style="background-image:url('{{ $collection['banner'] }}'); padding-top:50%; background-color:#bbbbbb; border-top-left-radius:10px; border-top-right-radius:10px"></div>
                                            <div class="text-center mb-2" style="margin-top:-45px">
                                                <div class="d-inline-block shadow background-image-cover" style="background-image:url('{{ $collection['logo'] }}'); border:4px solid #ffffff; height:90px; width:90px; border-radius:50%"></div>
                                            </div>
                                            <div class="px-3">
                                                <p class="text-center text-color-6 fw-bold">{{ $collection['name'] }}</p>
                                                <p class="text-center text-color-7 font-size-90 clamp">{{ $collection['description'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
