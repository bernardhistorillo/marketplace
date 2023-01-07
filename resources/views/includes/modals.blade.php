<div class="position-fixed w-100 d-none" id="cookie-popup" style="bottom:0; left:0; z-index:1">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card position-relative mb-3">
                <div class="position-absolute" style="top:4px; right:8px">
                    <i class="fas fa-times cursor-pointer" id="remove-cookie-popup"></i>
                </div>

                <div class="card-body">
                    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-lg-between">
                        <div>
                            <p class="fw-bold font-size-90 mb-1">Cookies &amp; Privacy</p>
                            <p class="font-size-80 mb-2 mb-lg-0">This website uses cookies to ensure you get the best experience on our website.</p>
                        </div>
                        <div class="ps-lg-4 text-end">
                            <a href="https://ownly.io/privacypolicy" target="_blank" rel="noreferrer" class="btn btn-custom-20 font-size-70 font-size-lg-80 me-1">More Information</a>
                            <button class="btn btn-custom-2 font-size-70 font-size-lg-80 me-lg-2" id="accept-cookies">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-approve" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-3 mb-3">
                    <i class="fas fa-store font-size-400 text-color-3"></i>
                </div>
                <h5 class="w-100 fw-bold font-size-120 text-center text-color-3">Post Item For Sale</h5>
                <h5 class="w-100 font-size-100 text-center">This will give Ownly Marketplace an access to transfer your token once sold.</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-2" id="approve">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-market-item" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-3 mb-3">
                    <i class="fas fa-tag font-size-400 text-color-3"></i>
                </div>
                <h5 class="w-100 font-size-120 fw-bold text-center text-color-3 mb-4">Set Token Price</h5>

                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="price" id="price" placeholder="Enter price">
                    <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="price-currency" value="OWN">
                        <img src="{{ asset('img/ownly/own-token.png') }}" width="22" />
                        <span class="ps-2 pe-1">OWN</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="select-price-current" data-image="{{ asset('img/ownly/own-token.png') }}" data-currency="OWN">
                            <button type="button" class="dropdown-item d-flex align-items-center bg-white text-black-50">
                                <img src="{{ asset('img/ownly/own-token.png') }}" width="22" />
                                <span class="ps-2 fw-bold">OWN</span>
                            </button>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li class="select-price-current" data-image="{{ asset('img/bnb/bnb.webp') }}" data-currency="BNB">
                            <button type="button" class="dropdown-item d-flex align-items-center bg-white text-black-50">
                                <img src="{{ asset('img/bnb/bnb.webp') }}" width="22" />
                                <span class="ps-2 fw-bold">BNB</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-2" id="create-market-item">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-market-sale" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Purchase Token</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>Are you sure you want to purchase this token?</div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-2" id="create-market-sale">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-no-metamask-installed" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-3 mb-3">
                    <img src="{{ asset('img/logo/metamask.webp') }}" width="120" />
                </div>
                <h5 class="w-100 font-size-100 text-center">Metamask is currently not installed</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="https://metamask.io/download.html" target="_blank" class="btn btn-custom-2" id="install-metamask">Install Metamask</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-subscribe-success" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-3 mb-3">
                    <i class="fas fa-check-circle font-size-400 text-color-3"></i>
                </div>
                <h5 class="w-100 font-size-100 text-center">Thank you for subscribing!</h5>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-2 px-4" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-wrong-network" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-3 mb-3">
                    <i class="fas fa-exclamation-circle font-size-400 text-color-3"></i>
                </div>
                <h5 class="w-100 font-size-100 text-center">You are currently on the wrong network!</h5>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-cancel-market-item" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-3 mb-3">
                    <i class="fas fa-exclamation-circle font-size-400 text-color-4"></i>
                </div>
                <h5 class="w-100 font-size-100 text-center">Are you sure you want to cancel your item for sale?</h5>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-7 px-4" id="cancel-market-item">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-buy-select-currency" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body py-4">
                <h5 class="w-100 font-size-130 text-center neo-bold mb-4">Select Currency</h5>

                <div class="btn-group w-100" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="buy_through_token" id="buy-through-own" value="OWN" autocomplete="off" checked>
                    <label class="btn btn-custom-10 font-size-120 py-2 buy-through-token-label active" data-token="OWN" for="buy-through-own" style="width:50%; border-right:0">OWN</label>

                    <input type="radio" class="btn-check" name="buy_through_token" id="buy-through-bnb" value="BNB" autocomplete="off">
                    <label class="btn btn-custom-10 font-size-120 py-2 buy-through-token-label" data-token="BNB" for="buy-through-bnb" style="width:50%">BNB</label>
                </div>

                <div class="d-none" id="buying-price-loading-container">
                    <div class="pt-4 text-center">
                        <div class="spinner-grow background-image-cover bg-transparent"
                             style="width:5rem; height:5rem; background-image:url('{{ asset('img/ownly/own-token.png') }}')" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="buying-price-container d-none" data-currency="BNB-OWN">
                    <div class="card mt-4">
                        <div class="card-body py-2">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="d-flex justify-content-end align-items-center px-1">
                                    <div class="font-size-150 pe-2 bnb-price"></div>
                                    <div>
                                        <img src="{{ asset('img/bnb/bnb.webp') }}" data-token="bnb" width="25" />
                                    </div>
                                </div>

                                <div class="px-3">
                                    <i class="fas fa-equals font-size-110"></i>
                                </div>

                                <div class="d-flex justify-content-start align-items-center position-relative px-1">
                                    <div class="font-size-150 pe-2 own-price"></div>
                                    <div>
                                        <img src="{{ asset('img/ownly/own-token.webp') }}" data-token="BNB" width="25" />
                                    </div>

                                    <div class="position-absolute w-100 bg-color-6" style="height:4px; top:40%; left:0; opacity:0.8"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <div class="text-center text-white font-size-80 bg-color-2 px-4 py-1">20% Discounted Price</div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center mt-2">
                        <div class="font-size-220 pe-2" id="discounted-own-price"></div>
                        <div>
                            <img src="{{ asset('img/ownly/own-token.webp') }}" width="38" />
                        </div>
                    </div>
                </div>

                <div class="buying-price-container d-none" data-currency="OWN-BNB">
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <div class="font-size-220 pe-2" id="bnb-price"></div>
                        <div>
                            <img src="{{ asset('img/bnb/bnb.webp') }}" width="38" />
                        </div>
                    </div>
                </div>

                <div class="buying-price-container d-none" data-currency="BNB-BNB">
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <div class="font-size-220 pe-2" id="bnb-price"></div>
                        <div>
                            <img src="{{ asset('img/bnb/bnb.webp') }}" width="38" />
                        </div>
                    </div>
                </div>

                <div class="buying-price-container d-none" data-currency="OWN-OWN">
                    <div class="d-flex justify-content-center align-items-center mt-4 mb-3">
                        <div class="font-size-220 pe-2" id="own-price"></div>
                        <div>
                            <img src="{{ asset('img/ownly/own-token.webp') }}" width="38" />
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="https://ownly.io/pancake" target="_blank" rel="noreferrer" class="btn btn-custom-2">Get $OWN tokens!</a>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-4 px-4 create-market-sale">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-success" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-3 mb-3">
                    <i class="fas fa-check-circle font-size-400 text-color-3"></i>
                </div>
                <h5 class="w-100 font-size-100 text-center message"></h5>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-custom-2 px-4" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-error" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-3 mb-3">
                    <i class="fas fa-exclamation-circle font-size-400 text-color-1"></i>
                </div>
                <h5 class="w-100 font-size-100 text-center message"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom-1 px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-processing" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="py-5 text-center">
                    <div class="spinner-grow background-image-cover bg-transparent mb-4" style="width:6rem; height:6rem; background-image:url('{{ asset('img/ownly/own-token.png') }}')" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5 class="w-100 font-size-120 text-center message mb-0">Processing</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-wrong-network-2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-3 mb-3">
                    <i class="fas fa-exclamation-circle font-size-400 text-color-3"></i>
                </div>
                <h5 class="w-100 font-size-100 text-center message"></h5>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-transfer-token" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body py-4">
                <div class="text-center mt-3 mb-3">
                    <i class="fas fa-gift font-size-400 text-color-5"></i>
                </div>

                <h5 class="w-100 font-size-130 text-center neo-bold mb-3">Gift Your Token</h5>

                <div class="font-size-90 mb-1">Enter wallet address of the recipient</div>
                <input type="text" class="form-control" id="transfer-recipient-address" placeholder="e.g. 0x7ef4..." />

                <div class="alert alert-danger mt-3 mb-0 d-none" id="invalid-recipient-wallet-address-container">
                    <div class="d-flex align-items-center">
                        <div class="pe-3">
                            <i class="fas fa-exclamation-circle font-size-150"></i>
                        </div>
                        <div>Invalid Wallet Address</div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-custom-4 px-4" id="transfer-token">Transfer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-wallet-options" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-size-110">Select wallet:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body py-4">
                <div class="row justify-content-center px-2">
                    <div class="col-md-6 px-2 mb-3">
                        <div class="card wallet-options" data-wallet="MetaMask">
                            <div class="card-body">
                                <div class="text-center mb-2">
                                    <img src="{{ asset('img/logo/metamask.webp') }}" width="90" alt="Metamask" />
                                </div>
                                <div class="text-center text-color-7 font-size-90">Connect to your MetaMask Wallet</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 px-2 mb-3">
                        <div class="card wallet-options" data-wallet="MetaMask">
                            <div class="card-body">
                                <div class="text-center mb-2">
                                    <img src="{{ asset('img/logo/trust.png') }}" width="81" alt="Trust Wallet" />
                                </div>
                                <div class="text-center text-color-7 font-size-90">Connect to your Trust Wallet</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 px-2 mb-3">
                        <div class="card wallet-options" data-wallet="WalletConnect">
                            <div class="card-body">
                                <div class="text-center mb-2">
                                    <img src="{{ asset('img/logo/walletconnect.webp') }}" width="90" alt="Wallet Connect" />
                                </div>
                                <div class="text-center text-color-7 font-size-90">Scan with WalletConnect to connect</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-make-offer" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close invisible" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold font-size-130">Make an Offer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <p class="mb-1">Price</p>
                    <div class="input-group mb-2">
                        <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center px-4" id="make-offer-currency" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border:2px solid #ced4da; border-right:0; min-width:143px">
                            <div class="pe-2">
                                <img src="{{ asset('img/ownly/own-token.webp') }}" width="22" />
                            </div>
                            <div class="pe-2 selected">OWN</div>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button class="dropdown-item select-make-offer-currency">
                                    <div class="d-flex align-items-center">
                                        <div class="pe-2">
                                            <img src="{{ asset('img/ownly/own-token.webp') }}" width="22" />
                                        </div>
                                        <div class="pe-2 selected">OWN</div>
                                    </div>
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item select-make-offer-currency">
                                    <div class="d-flex align-items-center">
                                        <div class="pe-2">
                                            <img src="{{ asset('img/bnb/bnb.webp') }}" width="22" />
                                        </div>
                                        <div class="pe-2 selected">BNB</div>
                                    </div>
                                </button>
                            </li>
                        </ul>
                        <input type="number" class="form-control py-2 py-lg-3 px-3" id="offer-amount" placeholder="Amount" style="border-width:2px" required />
                    </div>
                    <div class="font-size-90 text-end mb-2 offer-currency-balance" data-value="OWN">OWN Balance:&nbsp;&nbsp;<span id="offer-own-balance">Loading...</span></div>
                    <div class="font-size-90 text-end mb-2 offer-currency-balance" data-value="BNB">BNB Balance:&nbsp;&nbsp;<span id="offer-bnb-balance">Loading...</span></div>

                    <p class="mb-1">Offer Expiration</p>
                    <div class="input-group mb-2">
                        <div class="input-group-text" style="min-width:143px">
                            <div class="text-center w-100">Days</div>
                        </div>
                        <input type="number" class="form-control py-2 py-lg-3 px-3" id="offer-expiration" placeholder="Offer Expiration" step="1" style="border-width:2px" min="1" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary py-2 px-4" data-bs-dismiss="modal" style="min-width:133px">Cancel</button>
                <button type="button" class="btn btn-custom-2 py-2 px-4" id="make-offer" style="min-width:133px">Make Offer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-token-properties" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row justify-content-center" id="token-properties-container">

                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-warning" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-3 mb-3">
                    <i class="fas fa-circle-exclamation font-size-400 text-warning"></i>
                </div>
                <h5 class="w-100 font-size-100 text-center">Confirm?</h5>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success submit">Confirm</button>
            </div>
        </div>
    </div>
</div>
