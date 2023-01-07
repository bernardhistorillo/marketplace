<div class="row h-100 align-items-center page-min-height">
    <div class="col-md-7 col-xl-8 py-5">
        <div class="position-relative">
            <h1 class="text-white rubik-bold font-size-280 font-size-lg-350 font-size-xl-450 font-size-xxl-500 text-center text-md-start mb-5">Mint and launch your NFT collection the easy way.</h1>
            <div class="text-center text-md-start">
                <a href="{{ route('launchpad.index') }}" class="d-inline-block btn btn-custom-2 px-5 py-3 mx-1 font-size-110 font-size-sm-120 line-height-120" style="min-width:257px; border-radius:35px; letter-spacing:0.05em">LAUNCH ARTIST LAUNCHPAD</a>
            </div>
        </div>
    </div>

    <div class="col-md-5 col-xl-4 pt-md-5 pb-5 ps-md-5">
        <hr class="bg-white mt-0 mb-5 d-block d-md-none" />

        <div class="px-4 px-md-0">
            <div class="card shadow-sm" style="border:1px solid #cccccc; border-radius:10px; background-color:rgba(255,255,255,0.3)">
                <div class="card-body">
                    <div class="bg-white px-3 pt-2 pb-3" style="border-top-left-radius:10px; border-top-right-radius:10px">
                        <p class="pt-2 font-size-100 mb-0 text-color-7 text-center">Featured NFT</p>
                    </div>
                    <a href="{{ route('collection.index', 'dreadedshrooms') }}">
                        <div class="w-100 background-image-contain bg-white" style="background-image:url('https://ownly.market/nft/dreadedshrooms/Melehune Ahe.webp'); padding-top:100%"></div>
                    </a>
                    <div class="bg-white px-3" style="border-bottom-left-radius:10px; border-bottom-right-radius:10px">
                        <a href="{{ route('collection.index', 'dreadedshrooms') }}" class="d-block text-decoration-none pt-2 font-size-80 mb-0 link-color-4 text-center">Dreaded Shrooms</a>
                        <a href="{{ route('token.index', ['dreadedshrooms', 9]) }}" class="d-block text-decoration-none pb-3 mb-0 font-size-120 fw-bold text-center link-color-4">Melehune Ahe</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
