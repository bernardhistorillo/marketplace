<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top">
    <div class="container">
        <div class="d-flex align-items-center" style="min-height:63px">
            <a class="{{ route('home.index') }}" href="https://ownly.io/marketplace">
                <img src="{{ asset('img/ownly/own-token.webp') }}" class="add-public-url" width="53" alt="Ownly">
            </a>
            <div class="ps-2">
                <a href="{{ route('home.index') }}" class="link-color-1 text-decoration-none website-home-link">
                    <div class="">
                        <div class="d-flex align-items-center">
                            <div class="font-size-150 font-size-sm-200 rubik-black website-home-link line-height-90">OWNLY</div>
                            <div class="bg-color-6 text-center text-white py-1 px-2 ms-2">
                                <div class="font-size-60 font-size-sm-70 rubik-bold line-height-100" id="app-version">{{ config('ownly.version') }}</div>
                            </div>
                        </div>
                        <div class="font-size-70 font-size-sm-100 rubik-bold line-height-90" id="market-label">MARKET</div>
                    </div>
                </a>
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-100 justify-content-between" id="navbarSupportedContent" style="flex-grow:initial">
            <ul class="navbar-nav mb-2 mb-lg-0 ps-lg-3">
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle text-color-6" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Collections</a>
                    <ul class="dropdown-menu px-2" style="max-height:calc(100vh - 190px); overflow-x:hidden; overflow-y:auto" aria-labelledby="navbarDropdown" id="collection-dropdown">
                        <div class="row px-2">
                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'pathfinders2d') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/rascals.gif') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Mustachio Rascals</div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/ETH.png') }}" width="15" />
                                </div>
                            </div>

                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'pathfinders2d') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/11.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Mustachio Pathfinders<br><span class="font-size-80">(2D on ETH)</span></div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/ETH.png') }}" width="15" />
                                </div>
                            </div>
                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'pathfinders3d') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/9.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Mustachio Pathfinders<br><span class="font-size-80">(3D on BSC)</span></div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/BNB.png') }}" width="15" />
                                </div>
                            </div>
                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'marauders') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/12.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Mustachio Marauders<br><span class="font-size-80">(2D+3D on BSC)</span></div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/BNB.png') }}" width="15" />
                                </div>
                            </div>

                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'boydibil') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/boydibil.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Boy Dibil</div>
                                            <div class="flex-fill text-end">
                                                <span class="badge bg-color-6 font-size-60 py-2 px-2 me-4">NEW</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/BNB.png') }}" width="15" />
                                </div>
                            </div>

                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'dreadedshrooms') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/10.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Dreaded Shrooms</div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/BNB.png') }}" width="15" />
                                </div>
                            </div>
                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'oha') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/8.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Ownly House of Art</div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/ETH.png') }}" width="15" />
                                </div>
                            </div>
                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'genesisblock') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/2.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Genesis Block</div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/ETH.png') }}" width="15" />
                                </div>
                            </div>
                            <div class="position-relative col-md-6 px-1">
                                <li>
                                    <a href="{{ route('collection.index', 'titansofindustry') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/7.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Titans of Industry</div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/BNB.png') }}" width="15" />
                                </div>
                            </div>
                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'inkvadyrz') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/3.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Inkvadyrz</div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/ETH.png') }}" width="15" />
                                </div>
                            </div>
                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'cryptosolitaire') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/1.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">CryptoSolitaire</div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/ETH.png') }}" width="15" />
                                </div>
                            </div>
                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'sagesrantcollectibles') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/6.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">The Sages Rant Collectibles</div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/ETH.png') }}" width="15" />
                                </div>
                            </div>
                            <div class="position-relative col-md-6 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', 'rewards') }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ asset('img/collection-logos/4.webp') }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">Ownly Rewards</div>
                                        </div>
                                    </a>
                                </li>

                                <div class="position-absolute" style="top:10px; right:10px">
                                    <img src="{{ asset('img/tokens/MATIC.png') }}" width="15" />
                                </div>
                            </div>
                        </div>
                    </ul>
                </li>

                <li class="nav-item px-2">
                    <a class="nav-link text-color-6" href="{{ route('launchpad.index') }}">Artist&nbsp;Launchpad</a>
                </li>

                <li class="nav-item px-2">
                    <a class="nav-link text-color-6" href="{{ route('artists.index') }}">Artists</a>
                </li>

{{--                <li class="nav-item px-2">--}}
{{--                    <a class="nav-link text-color-6" href="{{ route('sales.index') }}">Sales</a>--}}
{{--                </li>--}}
            </ul>

            <div class="ps-lg-3 pe-lg-4 mb-3 mb-lg-0 w-100">
                <div class="position-relative search-field-container">
                    <div class="position-absolute" style="top:11px; left:14px">
                        <i class="fas fa-search"></i>
                    </div>

                    <form id="search-form" action="{{ route('token.search') }}" onsubmit="return false;">
                        <input type="text" name="value" class="form-control font-size-90 search-field" placeholder="Search NFTs" style="padding-left:42px; height:42px" />
                    </form>

                    <div class="position-absolute w-100 d-none search-suggestions-container" style="top:42px; left:0; z-index:1"></div>
                </div>
            </div>

            <form class="d-none" id="get-account-profile-form" action="{{ route('profile.getAccountContent') }}">
                <input type="hidden" name="address" />
            </form>

            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item" id="account-container">
                    <div class="skeleton-loading" style="width:152px; height:40px"></div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="position-fixed" style="top:100px; right:20px; z-index:10">
    <div class="alert alert-dark bg-white alert-dismissible fade px-3 py-2" id="elixir-alert" role="alert" style="max-width:100%">
        <div class="d-flex align-items-center">
            <div class="background-image-cover bg-color-18 profile-photo" style="background-image:url('{{ asset('img/collection-logos/elixir.gif') }}'); width:35px; height:35px; border-radius:50%"></div>
            <p class="font-size-90 mb-0 ms-3">Claim your Elixir now and enjoy discount on your purchases. <a href="{{ route('elixir.index') }}" class="link-color-3">Claim Now!</a></p>
            <div>
                <button type="button" class="btn-close position-relative" id="close-claim-elixir" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>
