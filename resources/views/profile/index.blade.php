@extends('layouts.app')

@section('title', 'Profile')
@section('og_title', 'Profile')
@section('og_image', asset('img/og/home.png'))

@section('content')
    <div class="bg-color-18 position-relative" style="min-height:calc(100vh - 80px); margin-top:80px; background-position:66% 50%">
        <div class="container pt-4 pb-5">
            <div class="pt-3">
                <div class="" id="profile-guest-view">
                    <div class="d-flex flex-column align-items-center flex-sm-row align-items-sm-center">
                        <div class="pe-sm-5">
                            <div class="background-image-cover rounded-circle mb-3 position-relative bg-color-18 profile-photo" id="profile-photo-container" style="padding-top:100%; min-width:180px; border:3px solid #aaaaaa; background-image:url('{{ ($user && $user['photo']) ? $user['photo'] : "https://avatars.dicebear.com/api/bottts/" . $account . ".svg?scale=85" }}')"></div>
                        </div>

                        <div class="text-center text-sm-start">
                            <div class="neo-bold font-size-250 mb-2">
                                @if($user && $user['name'])
                                <span>{{ $user['name'] }}</span>
                                @else
                                <i>Name not set</i>
                                @endif
                            </div>
                            <div class="font-size-130 mb-2">
                                <a href="{{ config('ownly.blockchain_explorer_eth') }}/address/{{ $account }}" target="_blank" rel="noreferrer" class="link-color-3">{{ shortenAddress($account, 8, 8) }}</a>

                                <input type="hidden" name="account" value="{{ strtolower($account) }}" />
                                <input type="hidden" name="current_tab" value="{{ $tab }}" />
                                <input type="hidden" name="owned_tab_url" value="{{ route('profile.index', [$account, 'owned']) }}" />
                            </div>
                            <div class="font-size-120 mb-3">
                                @if($user && $user['bio'])
                                <span>{{ $user['bio'] }}</span>
                                @else
                                <i>Bio not set</i>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="pt-2"></div>
                </div>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item mb-3 me-2 d-none" id="account-settings-tab" role="presentation">
                        <a href="{{ route('profile.index', [$account]) }}" class="nav-link py-2 py-lg-3 px-3 px-lg-4 {{ (!$tab) ? 'active' : '' }}" id="pills-account-settings-tab">Account Settings</a>
                    </li>
                    <li class="nav-item mb-3 me-2" role="presentation">
                        <a href="{{ route('profile.index', [$account, 'owned']) }}" class="nav-link py-2 py-lg-3 px-3 px-lg-4 {{ ($tab == 'owned') ? 'active' : '' }}" id="pills-owned-tab">Owned</a>
                    </li>
                    <li class="nav-item mb-3" role="presentation">
                        <a href="{{ route('profile.index', [$account, 'favorites']) }}" class="nav-link py-2 py-lg-3 px-3 px-lg-4 {{ ($tab == 'favorites') ? 'active' : '' }}" id="pills-favorites-tab">Favorites</a>
                    </li>
                </ul>

                @if(!$tab)
                <div>
                    <form id="account-settings-form" action="{{ route('profile.save', $account) }}">
                        <div class="row">
                            <div class="col-lg-6 order-1 order-lg-0">
                                <div class="mb-4 mb-lg-5">
                                    <label class="neo-bold mb-2" for="username">Username</label>
                                    <input type="text" class="form-control py-2 py-lg-3 px-3" name="username" placeholder="Enter Username" id="username" value="{{ ($user) ? $user['name'] : '' }}" style="border-width:2px" required disabled />
                                </div>

                                <div class="mb-4 mb-lg-5">
                                    <label class="neo-bold mb-2" for="email-address">Email Address</label>
                                    <input type="text" class="form-control py-2 py-lg-3 px-3" name="email_address" placeholder="Enter Email Address" id="email-address" value="{{ ($user) ? $user['email'] : '' }}" style="border-width:2px" required disabled />
                                </div>

                                <div class="mb-5">
                                    <label class="neo-bold mb-2" for="bio">Bio</label>
                                    <input type="text" class="form-control py-2 py-lg-3 px-3" name="bio" placeholder="Enter who you are or your interests" id="bio" value="{{ ($user) ? $user['bio'] : '' }}" style="border-width:2px" disabled />
                                </div>

                                <div class="text-center text-lg-start mb-4 mb-lg-5">
                                    <button type="submit" class="btn btn-custom-6 py-2 py-lg-3 px-5 action-btn d-none" style="border-radius:29px">Save Changes</button>
                                </div>
                            </div>

                            <div class="col-lg-6 order-0 order-lg-1 mb-5 mb-lg-0">
                                <div class="mx-4 mx-sm-5 px-5 px-lg-0 px-xxl-5">
                                    <div class="mx-sm-5 px-md-5 px-lg-4">
                                        <div class="w-100 background-image-cover rounded-circle mb-4 position-relative bg-color-18 profile-photo" id="photo-container" style="padding-top:100%; border:3px solid #aaaaaa; background-image:url('{{ ($user && $user['photo']) ? $user['photo'] : "https://avatars.dicebear.com/api/bottts/" . $account . ".svg?scale=85&color=#000000" }}')"></div>
                                        <div class="text-center">
                                            <input type="file" class="d-none" name="photo" accept="image/*" />
                                            <button type="button" class="btn btn-custom-13 px-5 action-btn d-none" id="select-photo" style="border-radius:29px">Select Photo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @elseif($tab == 'owned')
                <div class="row mt-4">
                    @foreach($tokens as $token)
                        @include('collection.tokenCard')
                    @endforeach

                    <div class="d-flex justify-content-center font-size-80" id="token-pagination">{{ $tokens->onEachSide(1)->links() }}</div>
                </div>
                @elseif($tab == 'favorites')
                <div class="row mt-4">
                    @foreach($tokens as $token)
                        @include('collection.tokenCard')
                    @endforeach

                    <div class="d-flex justify-content-center font-size-80" id="token-pagination">{{ $tokens->onEachSide(1)->links() }}</div>
                </div>
               @endif
            </div>
        </div>
    </div>
@endsection
