<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Ownly: Buy, own, collect, and trade 1 of 1 edition crypto artworks by talented artists." />
    <meta name="description" content="OWNLY is a metaverse-focused platform that allows creators and collectors to optimize ownership and utility through innovative applications of non-fungible tokens (NFT). Ownly is created to be a meeting place of artists, gamers, and collectors in the crypto and NFT space.">
    <meta name="author" content="Ownly">

    <meta property="og:type" content="website" />
    <meta property="og:title" content="Ownly: Buy, own, collect, and trade 1 of 1 edition crypto artworks by talented artists." />
    <meta property="og:description" content="OWNLY is a metaverse-focused platform that allows creators and collectors to optimize ownership and utility through innovative applications of non-fungible tokens (NFT). Ownly is created to be a meeting place of artists, gamers, and collectors in the crypto and NFT space." />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.0.0/css/all.css">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <title>Ownly Market</title>
</head>

<body class="position-relative overflow-hidden w-100 min-vh-100">
    <section id="loading-screen" style="z-index:9999">
        <div class="position-absolute" style="top:calc(50% - 200px); left:calc(50% - 200px)">
            <img src="{{ asset('img/mustachios/dancing-mexico.gif') }}" width="400" />
        </div>

        <div class="position-absolute w-100" style="bottom:0; left:0">
            <div class="d-flex justify-content-center">
                <div class="progress mb-2" style="width:250px">
                    <div class="progress-bar progress-bar-animated progress-bar-striped bg-color-3 font-size-90" id="loading-percentage" role="progressbar" aria-label="Example with label" style="width:0; transition:0s!important" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>

            <div class="text-center w-100 font-size-70 mb-3">Loading Assets</div>
        </div>
    </section>

    <div class="position-absolute w-100 {{ ($hideSettings == 1) ? 'd-none' : '' }}" id="visualizer-settings" style="top:0; max-width:300px; transition:0.5s; right:{{ ($hideSettings == 1) ? '-300px' : '0' }}">
        <div class="card min-vh-100" style="background-color:rgba(255,255,255,0.9); border-top-right-radius:0; ; border-bottom-right-radius:0">
            <div class="card-body h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="fw-bold mb-0">Settings</p>
                    <div class="">
                        <button class="d-flex justify-content-center align-items-center btn btn-custom-13 rounded-circle p-0" id="hide-visualizer-settings" style="width:35px; height:35px">
                            <i class="fa-solid fa-arrow-right d-block"></i>
                        </button>
                    </div>
                </div>

                <hr>

                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree" style="font-size:14px">
                                Mustachios
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionPanelsStayOpenExample">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <p class="font-size-80 mb-2">Search Mustachios and add to list</p>
                                    <input type="text" class="form-control font-size-80 mb-0" id="search-mustachio" placeholder="Search Mustachio" />

                                    <div class="card w-100 overflow-auto d-none" id="searched-mustachios-container" style="border-radius:0; margin-top:-1px; max-height:131px">
                                        <div class="card-body p-2" id="searched-mustachios-items"></div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <p class="font-size-80 mb-2">Or, enter 1 or more Mustachio Token IDs separated by commas:</p>
                                    <textarea class="form-control font-size-80 mb-3" id="mustachio-token-ids" placeholder="Enter Mustachio Token IDs"></textarea>
                                    <button class="btn btn-custom-2 font-size-80 py-1 update-mustachios">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne" style="font-size:14px">
                                Animations
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne" data-bs-parent="#accordionPanelsStayOpenExample">
                            <div class="accordion-body position-relative">
                                <div class="position-absolute" style="top:15px; right:35px">
                                    <button class="d-flex justify-content-center align-items-center btn btn-custom-13 rounded-circle p-0" id="change-animation" style="width:25px; height:25px">
                                        <i class="fa-solid fa-chevrons-down font-size-70 d-block"></i>
                                    </button>
                                </div>

                                <div class="overflow-auto ps-1" id="animations-container" style="max-height:285px"></div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="font-size:14px">
                                Scene
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionPanelsStayOpenExample">
                            <div class="accordion-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="d-block font-size-80 me-2" for="head">Background Color:</label>
                                    <div>
                                        <input type="color" class="cursor-pointer" style="width:41px; height:22px" id="scene-color" value="#e66465">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="d-block font-size-80 me-2" for="head">Shadow:</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input custom-form-check-input-1" style="width:2.5em; height:1.1em" type="checkbox" role="switch" id="shadow-switch" checked>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <p class="font-size-80 mb-2">Formations</p>
                                <div class="form-check">
                                    <input class="form-check-input custom-form-check-input-1 cursor-pointer" type="radio" name="formations" id="formations-in-rows" value="in-rows" checked>
                                    <label class="form-check-label font-size-80 cursor-pointer" style="padding-top:5px" for="formations-in-rows">In Rows</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input custom-form-check-input-1 cursor-pointer" type="radio" name="formations" id="formations-shifting" value="shifting">
                                    <label class="form-check-label font-size-80 cursor-pointer" style="padding-top:5px" for="formations-shifting">Shifting</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input custom-form-check-input-1 cursor-pointer" type="radio" name="formations" id="formations-partners" value="partners">
                                    <label class="form-check-label font-size-80 cursor-pointer" style="padding-top:5px" for="formations-partners">Partners</label>
                                </div>

                                <button class="btn btn-custom-2 font-size-80 py-1 mt-2 update-mustachios">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="position-absolute" style="top:17px; right:17px">
        <button class="d-flex justify-content-center align-items-center btn btn-custom-13 rounded-circle p-0 {{ ($hideSettings == 1) ? '' : 'd-none' }}" id="show-visualizer-settings" style="width:35px; height:35px">
            <i class="fa-solid fa-bars d-block"></i>
        </button>
    </div>

    <input type="hidden" name="route_name" value="{{ Route::currentRouteName() }}" />
    <input type="hidden" name="app_url" value="{{ config('app.url') }}" />
    <input type="hidden" name="token_id" value="{{ $tokenId }}" />
    <input type="hidden" name="bg_color" value="{{ $bgColor }}" />
    <input type="hidden" name="has_shadow" value="{{ $hasShadow }}" />
    <input type="hidden" name="download" value="{{ $download }}" />
    <input type="hidden" name="file" value="{{ $file }}" />
    <input type="hidden" name="token_ids" value="{{ $tokenIds }}" />
    <input type="hidden" name="token_ids_in" value="{{ $tokenIdsIn }}" />
    <input type="hidden" name="zoom" value="{{ $zoom }}" />
    <input type="hidden" name="animation" value="{{ $animation }}" />
    <input type="hidden" name="async" value="{{ $async }}" />
    <input type="hidden" name="update" value="{{ $update }}" />
    <input type="hidden" name="mustachios" value="{{ $mustachios }}" />
    <input type="hidden" name="rascalsMetadata" value="{{ $rascalsMetadata }}" />
    <input type="hidden" name="hideSettings" value="{{ $hideSettings }}" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="{{ asset('js/ccapture/CCapture.js') }}"></script>
    <script src="{{ asset('js/ccapture/gif.js') }}"></script>
    <script src="{{ asset('js/ccapture/tar.js') }}"></script>
    <script src="{{ asset('js/ccapture/download.js') }}"></script>
    <script src="{{ asset('js/ccapture/webm-writer-0.2.0.js') }}"></script>
    <script src="{{ asset(mix('js/app.js')) }}"></script>
</body>
</html>
