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
                            @foreach(collections() as $collection)
                            <div class="position-relative col-12 px-1">
                                <li style="border-bottom:1px solid #cccccc">
                                    <a href="{{ route('collection.index', $collection['url']) }}" class="dropdown-item collection-dropdown-item p-2">
                                        <div class="d-flex align-items-center">
                                            <div class="pe-3">
                                                <img src="{{ $collection['logo'] }}" class="shadow-sm rounded-3 add-public-url" width="40" />
                                            </div>
                                            <div class="font-size-90 pe-2">{{ $collection['name'] }}</div>
                                        </div>
                                    </a>
                                </li>
                            </div>
                            @endforeach
                        </div>
                    </ul>
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
