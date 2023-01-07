@extends('layouts.app')

@section('title', 'Claim Badge')
@section('og_title', 'Claim Badge')

@section('content')
<div style="">
    <div class="container">
        <div class="row min-vh-100 align-items-center pb-5" style="padding-top:80px">
            <div class="col-lg-8 order-1 order-lg-0 pb-md-5">
                <div class="pe-lg-3">
                    <p class="neo-black text-center text-lg-start font-size-240 font-size-md-270 mb-4">What is the Elixir?</p>
                    <div class="bg-color-1 w-100 mb-4" style="height: 1px;"></div>
                    <p class="font-size-130 text-center text-lg-start line-height-150 pt-2 mb-5">The Elixir is a multiple edition NFT reward for the Ownly Fans who have shown their outright support to Ownly. The Elixir grants its holders 10% discount and access to a private channel in the Ownly Discord community. You can find this Elixir NFT in your Ownly Market and OpenSea account after minting.</p>
                    <div class="text-center text-lg-start">
                        <a href="#claim" class="btn btn-custom-2 font-size-120 px-5 py-2 fw-bold" style="width: initial;">GET THE ELIXIR</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-0 order-lg-1 mb-4 mb-lg-0 pt-4 pt-lg-0">
                <div class="mx-4 mx-sm-5 mx-lg-0 px-sm-5 px-lg-0">
                    <div class="mx-md-5 mx-lg-0 px-md-5 px-lg-0">
                        <div class="w-100 border-1 position-relative" style="padding-top:100%">
                            <div class="d-flex justify-content-center align-items-center w-100 h-100 overflow-hidden" style="position:absolute; top:0; left:0; border-radius:50% 50% 0 0">
                                <video autoplay loop muted preload class="w-100"><source src="{{ asset('img/elixir/elixir.mp4') }}" type="video/mp4"></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-color-7">
    <div class="container pt-5">
        <p class="neo-black text-center font-size-240 font-size-md-270 text-white mb-4 pb-2 pt-4">How do I get my Elixir?</p>

        <div class="position-relative">
            <div class="position-absolute invisible" id="claim" style="top:-230px"></div>
        </div>

        <div class="pb-5">
            <div class="row py-5">
                <div class="col-lg-4 pb-4">
                    <div class="card border-0 border-radius-0 h-100">
                        <div class="card-body py-5 px-4 px-xl-5">
{{--                            @php--}}
{{--                                session()->forget(['twitter_auth'])--}}
{{--                            @endphp--}}
                            <div class="d-flex justify-content-center mb-4">
                                <div class="{{ (session('twitter_auth')) ? 'bg-color-2' : 'bg-dark' }} d-flex align-items-center justify-content-center" style="border-radius: 50%; width: 80px; height: 80px;">
                                    <div class="text-white neo-black font-size-200">1</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mb-3 elixir-step-title">
                                <p class="text-center fw-bold font-size-140 mb-0">Sign in to your Twitter account</p>
                            </div>
                            <p class="text-center elixir-step-details mb-4">Authorize Ownly to access your Twitter app to complete this step. We will not, in any way, have any means to sign in on your behalf.</p>

                            <div class="text-center">
                                @if(session('twitter_auth'))
                                <button class="btn btn-custom-19 py-2 w-100 d-flex justify-content-between align-items-center" id="twitter-id" value="{{ session('twitter_auth') }}" style="height:47px" disabled>
                                    <div class="">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                    <div class="font-size-110 neo-bold px-3">Signed In</div>
                                    <div class="invisible">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                </button>
                                @else
                                <a href="{{ route('auth.twitter') }}" class="btn btn-custom-18 py-2 w-100 font-size-110 neo-bold" style="height:47px">Sign In</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pb-4">
                    <div class="card border-0 border-radius-0 h-100">
                        <div class="card-body py-5 px-4 px-xl-5">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="{{ (session('twitter_auth') && session('twitter_auth')['followed_ownly']) ? 'bg-color-2' : 'bg-dark' }} d-flex align-items-center justify-content-center" id="step-number-2" style="border-radius: 50%; width: 80px; height: 80px;">
                                    <div class="text-white neo-black font-size-200">2</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mb-3 elixir-step-title">
                                <p class="text-center fw-bold font-size-140 mb-0">Follow our Ownly Twitter account</p>
                            </div>
                            <p class="text-center elixir-step-details mb-4">After connecting your Twitter account, this button automatically leads you to Ownly’s Twitter profile where it determines whether or not you’ve followed us.</p>

                            <div class="text-center {{ (session('twitter_auth') && session('twitter_auth')['followed_ownly']) ? '' : 'd-none' }}" id="twitter-ownly-followed">
                                <button class="btn btn-custom-19 py-2 w-100 d-flex justify-content-between align-items-center" id="twitter-id" value="{{ session('twitter_auth') }}" style="height:47px" disabled>
                                    <div class="">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                    <div class="font-size-110 neo-bold px-3">Followed</div>
                                    <div class="invisible">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                </button>
                            </div>

                            @if(!((session('twitter_auth') && session('twitter_auth')['followed_ownly'])))
                            <div class="text-center" id="twitter-ownly-unfollowed">
                                <a href="https://twitter.com/ownlyio" target="_blank" class="btn btn-custom-18 py-2 w-100 d-flex justify-content-between align-items-center" id="check-follow-on-ownly-twitter-account" data-url="{{ route('elixir.checkTwitterAccountFollows', config('ownly.ownly_twitter_id')) }}" style="height:47px">
                                    <div class="loading invisible">
                                        <i class="fa-solid fa-spinner fa-spin font-size-120"></i>
                                    </div>
                                    <div class="font-size-110 neo-bold px-3">Follow</div>
                                    <div class="invisible">
                                        <i class="fa-solid fa-spinner fa-spin font-size-120"></i>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pb-4">
                    <div class="card border-0 border-radius-0 h-100">
                        <div class="card-body py-5 px-4 px-xl-5">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="{{ (session('twitter_auth') && session('twitter_auth')['followed_mustachioverse']) ? 'bg-color-2' : 'bg-dark' }} d-flex align-items-center justify-content-center" id="step-number-3" style="border-radius: 50%; width: 80px; height: 80px;">
                                    <div class="text-white neo-black font-size-200">3</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mb-3 elixir-step-title">
                                <p class="text-center fw-bold font-size-140 mb-0">Follow our MustachioVerse Twitter account</p>
                            </div>
                            <p class="text-center elixir-step-details mb-4">Similar to step number two, this button will direct you to the MustachioVerse Twitter account. MustachioVerse is Ownly’s project that includes NFT Art and Gaming.</p>

                            <div class="text-center {{ (session('twitter_auth') && session('twitter_auth')['followed_mustachioverse']) ? '' : 'd-none' }}" id="twitter-mustachioverse-followed">
                                <button class="btn btn-custom-19 py-2 w-100 d-flex justify-content-between align-items-center" id="twitter-id" value="{{ session('twitter_auth') }}" style="height:47px" disabled>
                                    <div class="">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                    <div class="font-size-110 neo-bold px-3">Followed</div>
                                    <div class="invisible">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                </button>
                            </div>

                            @if(!((session('twitter_auth') && session('twitter_auth')['followed_mustachioverse'])))
                            <div class="text-center" id="twitter-mustachioverse-unfollowed">
                                <a href="https://twitter.com/mustachioverse" target="_blank" class="btn btn-custom-18 py-2 w-100 d-flex justify-content-between align-items-center" id="check-follow-on-mustachioverse-twitter-account" data-url="{{ route('elixir.checkTwitterAccountFollows', config('ownly.mustachioverse_twitter_id')) }}" style="height:47px">
                                    <div class="loading invisible">
                                        <i class="fa-solid fa-spinner fa-spin font-size-120"></i>
                                    </div>
                                    <div class="font-size-110 neo-bold px-3">Follow</div>
                                    <div class="invisible">
                                        <i class="fa-solid fa-spinner fa-spin font-size-120"></i>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pb-4">
                    <div class="card border-0 border-radius-0 h-100">
                        <div class="card-body py-5 px-4 px-xl-5">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="bg-dark d-flex align-items-center justify-content-center" id="step-number-4" style="border-radius: 50%; width: 80px; height: 80px;">
                                    <div class="text-white neo-black font-size-200">4</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mb-3 elixir-step-title">
                                <p class="text-center fw-bold font-size-140 mb-0">Connect your MetaMask Wallet</p>
                            </div>
                            <p class="text-center elixir-step-details mb-4">Connect your Ethereum address through your MetaMask Wallet. Make sure to connect the address where you want your Elixir to be received.</p>

                            <div class="text-center" id="wallet-disconnected">
                                <button class="btn btn-custom-18 py-2 w-100 font-size-110 neo-bold" id="connect-ethereum-wallet" style="height:47px">Connect</button>
                            </div>

                            <div class="text-center d-none" id="wallet-connected">
                                <button class="btn btn-custom-19 py-2 w-100 d-flex justify-content-between align-items-center" id="twitter-id" value="{{ session('twitter_auth') }}" style="height:47px" disabled>
                                    <div class="">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                    <div class="font-size-110 neo-bold px-3">Connected</div>
                                    <div class="invisible">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pb-4">
                    <div class="card border-0 border-radius-0 h-100">
                        <div class="card-body py-5 px-4 px-xl-5">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="bg-dark d-flex align-items-center justify-content-center" id="step-number-5" style="border-radius: 50%; width: 80px; height: 80px;">
                                    <div class="text-white neo-black font-size-200">5</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mb-3 elixir-step-title">
                                <p class="text-center fw-bold font-size-140 mb-0">Sign a Message with your Wallet</p>
                            </div>
                            <p class="text-center elixir-step-details mb-4">Signing a message will validate that you truly are the owner of the address where you want the Elixir to be received.</p>

                            <div class="text-center" id="message-unsigned">
                                <button class="btn btn-custom-18 py-2 w-100 font-size-110 neo-bold" id="sign-badge-message" data-url="{{ route('elixir.validateAddress') }}" data-message="{{ config('ownly.badge_claim_message') }}" style="height:47px">Sign</button>
                            </div>

                            <div class="text-center d-none" id="message-signed">
                                <button class="btn btn-custom-19 py-2 w-100 d-flex justify-content-between align-items-center" id="twitter-id" value="{{ session('twitter_auth') }}" style="height:47px" disabled>
                                    <div class="">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                    <div class="font-size-110 neo-bold px-3">Signed</div>
                                    <div class="invisible">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pb-4">
                    <div class="card border-0 border-radius-0 h-100">
                        <div class="card-body py-5 px-4 px-xl-5">
                            <div class="d-flex justify-content-center mb-4">
                                <div class="bg-dark d-flex align-items-center justify-content-center" id="step-number-6" style="border-radius: 50%; width: 80px; height: 80px;">
                                    <div class="text-white neo-black font-size-200">6</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mb-3 elixir-step-title">
                                <p class="text-center fw-bold font-size-140 mb-0">Claim your Elixir</p>
                            </div>
                            <p class="text-center elixir-step-details mb-4">You may now claim your Elixir and enjoy the perks of having one. Congrats!</p>

                            <div class="text-center" id="elixir-unclaimed">
                                <button class="btn btn-custom-18 py-2 w-100 font-size-110 neo-bold" id="claim-elixir" style="height:47px" data-url="{{ route('elixir.claim') }}">Claim</button>
                            </div>

                            <div class="text-center d-none" id="elixir-claimed">
                                <button class="btn btn-custom-19 py-2 w-100 d-flex justify-content-between align-items-center" id="twitter-id" value="{{ session('twitter_auth') }}" style="height:47px" disabled>
                                    <div class="">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                    <div class="font-size-110 neo-bold px-3">Claimed</div>
                                    <div class="invisible">
                                        <i class="fa-regular fa-check-circle font-size-150"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
