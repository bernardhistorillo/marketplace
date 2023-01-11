let appUrl;
let currentRouteName;
let searchTimeout;
let address = null;
let mainWeb3 = null;

let pageOnload = async function() {
    await allOnload();

    if(currentRouteName === "home.index") {
        homeOnload();
    } else if(currentRouteName === "collection.index") {
        collectionOnload();
    } else if(currentRouteName === "token.index") {
        tokenOnload();
    } else if(currentRouteName === "profile.index") {
        profileOnload();
    } else if(currentRouteName === "sales.index") {
        salesOnload();
    } else if(currentRouteName === "email.signup.get") {
        emailSignupsOnload();
    }
};
let allOnload = async function() {
    appUrl = $("input[name='app_url']").val();
    currentRouteName = $("input[name='route_name']").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if($("#account-container").length) {
        initializeWalletConnect();

        await getConnectedAddress();
        fetchAccount();
    }

    initializeTooltip();

    // localStorage.removeItem("acceptCookie");
    if(currentRouteName !== "model.mustachio.index" && localStorage.getItem("acceptCookie") !== "1") {
        $("#cookie-popup").removeClass("d-none");
    }
};
let homeOnload = function() {
    $(".clamp").each(function() {
        new MultiClamp($(this), {
            ellipsis: '...',
            clamp: 3
        });
    });

    let width = $(window).width();

    let perPage = 1;
    if(width >= 992) {
        perPage = 3;
    } else if(width >= 768) {
        perPage = 2;
    }

    startCountdown();

    new Splide('.splide', {
        type: 'loop',
        start: 1,
        perPage: perPage,
        perMove: 1,
    }).mount();
};
let collectionOnload = function() {
    let page = findGetParameter('page');
    if(page) {
        $(document.documentElement).scrollTop($("#collection-tokens-top").offset().top);
    }

    fetchTokenActionButtons();

    if($('#rarity-table')[0]) {
        $('#rarity-table').DataTable();
    }

    startCountdown();
};
let tokenOnload = function() {
    fetchTokenActionButtons();
};
let profileOnload = function() {
    let account = $("input[name='account']").val();
    let currentTab = $("input[name='current_tab']").val();
    let ownedTabUrl = $("input[name='owned_tab_url']").val();

    if(account !== address.toLowerCase()) {
        if(!currentTab) {
            window.location.href = ownedTabUrl;
        }
    }

    if(account === address.toLowerCase()) {
        $("#account-settings-tab").removeClass("d-none");

        let accountSettingsForm = $("#account-settings-form");

        accountSettingsForm.find("input").prop("disabled", false);
        accountSettingsForm.find("[type='submit']").removeClass("d-none");
        accountSettingsForm.find(".action-btn").removeClass("d-none");
    }

    fetchTokenActionButtons();
};
let salesOnload = function() {
    let data = JSON.parse($("#sales-chart-container").attr("data-graph"));

    let ctx = document.getElementById('sales-chart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'OWN (per million)',
                data: data.own,
                backgroundColor: [
                    'rgba(22,185,154,0.3)'
                ],
                borderColor: [
                    '#16b99a'
                ],
                fill: true,
                tension: 0.3,
                borderWidth: 2
            },{
                label: 'ETH',
                data: data.eth,
                backgroundColor: [
                    'rgba(73,79,124,0.3)'
                ],
                borderColor: [
                    '#494f7c'
                ],
                fill: true,
                tension: 0.3,
                borderWidth: 2
            },{
                label: 'BNB',
                data: data.bnb,
                backgroundColor: [
                    'rgba(243,187,50,0.3)'
                ],
                borderColor: [
                    '#f3bb32'
                ],
                fill: true,
                tension: 0.3,
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
};
let emailSignupsOnload = function() {
    $('.table').DataTable({
        order: [[0, 'desc']],
    });
};

let numberFormat = function(x, decimal) {
    x = parseFloat(x);
    let parts = x;

    if(decimal !== false) {
        parts = parts.toFixed(decimal)
    }

    parts = parts.toString().split(".");

    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(decimal !== 0) {
        return parts.join(".");
    } else {
        return parts[0];
    }
};
let initializeReloadButton = function(link) {
    let modalSuccess = $("#modal-success");

    modalSuccess.attr("data-bs-backdrop", "static");
    modalSuccess.attr("data-bs-keyboard", "false");

    modalSuccess.find("button").removeAttr("data-bs-dismiss");
    modalSuccess.find("button").addClass("reload-page");

    modalSuccess.find("button").attr("data-link", link);
};
let initializeTooltip = function() {
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
};

$(document).ready(function() {
    pageOnload();
});

$(document).on("click", ".reload-page", function() {
    $(this).prop("disabled", true);
    let link = $(this).attr("data-link");

    if(link) {
        $(this).text("Redirecting");
        window.location.href = link;
    } else {
        $(this).text("Reloading Page");
        window.location.reload();
    }
});

// Home Page
let findGetParameter = (parameterName) => {
    let result = null,
        tmp = [];
    let items = location.search.substr(1).split("&");
    for (let index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
};
let padZeroes = (number) => {
    number = number.toString();

    while(number.length < 2) {
        number = "0" + number;
    }

    return number;
};
let startCountdown = () => {
    if($("#countdown")[0]) {
        $.ajax({
            url: appUrl + "/api/get-remaining-time/2022-11-01%2000:00:00",
            method: "GET"
        }).done(function(remaining_time) {
            let countDownDate = new Date().getTime() + (remaining_time * 1000);
            // countDownDate = new Date("Sep 30, 2021 17:00:00").getTime();

            let x = setInterval(function() {
                let now = new Date().getTime();
                let distance = countDownDate - now;

                let days = padZeroes(Math.floor(distance / (1000 * 60 * 60 * 24)));
                let hours = padZeroes(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                let minutes = padZeroes(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
                let seconds = padZeroes(Math.floor((distance % (1000 * 60)) / 1000));

                $("#days").text(days);
                $("#hours").text(hours);
                $("#minutes").text(minutes);
                $("#seconds").text(seconds);

                $("#days").removeClass("invisible");
                $("#hours").removeClass("invisible");
                $("#minutes").removeClass("invisible");
                $("#seconds").removeClass("invisible");

                if (distance < 0) {
                    clearInterval(x);
                    $("#days").text("00");
                    $("#hours").text("00");
                    $("#minutes").text("00");
                    $("#seconds").text("00");

                    clearInterval(x);

                    $("#countdown").addClass("invisible");
                }
            }, 500);
        }).fail(function(error) {
            console.log(error);
        });
    }
};

// Profile
$(document).on("click", "#select-photo", function() {
    $("input[name='photo']").trigger("click");
});

$(document).on("change", "input[name='photo']", function() {
    let reader = new FileReader();

    reader.onload = function(event) {
        let img = new Image();

        img.onload = function() {
            let photoContainer = $("#photo-container");

            photoContainer.html("");
            photoContainer.css("background-image", "url('" + img.src + "')");
        };

        img.src = event.target.result;
    };

    if($(this)[0].files.length) {
        reader.readAsDataURL($(this)[0].files[0]);
        $(".field-error-message[data-name='asa_certificate']").addClass("d-none");
    } else {
        $("#photo-container").css("background-image", "initial");
    }
});

$(document).on("submit", "#account-settings-form", async function(e) {
    e.preventDefault();

    let button = $(this).find("[type='submit']");

    mainWeb3 = new Web3(ethereum);

    let message = "I am confirming this action in Ownly Marketplace.";
    let signature = await mainWeb3.eth.personal.sign(message, ethereum.selectedAddress);

    if(signature) {
        let form_data = new FormData($(this)[0]);
        form_data.append('signature', signature);

        button.prop("disabled", true);
        button.text("Saving Changes");

        let url = $(this).attr("action");

        $.ajax({
            url: url,
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data
        }).done(function() {
            initializeReloadButton("");

            $("#modal-success .message").text("Changes Saved");
            $("#modal-success").modal("show");
        }).fail(function(error) {
            console.log(error);
        }).always(function() {
            button.prop("disabled", false);
            button.text("Save Changes");
        });
    }
});

// Collection
let fetchTokenActionButtons = function() {
    $(".collection-token-form").each(function() {
        let container = $(this).closest(".token-action-buttons");
        let formData = new FormData($(this)[0]);
        let url = $(this).attr("action");
        let tries = 0;

        let fetchTokenFooter = function() {
            $.ajax({
                url: url,
                method: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(async function(response) {
                container.html(response);

                let favorite_status = container.find("input[name='favorite_status']").val();
                let addToFavoritesButton = container.closest(".token-card").find(".add-to-favorites");
                let heart = container.closest(".token-card").find(".fa-heart");

                addToFavoritesButton.prop("disabled", false);

                if(favorite_status) {
                    heart.removeClass("far");
                    heart.addClass("fas");

                    addToFavoritesButton.attr("data-status", 1);
                }
            }).fail(function(error) {
                console.log(error);

                if(tries < 3) {
                    fetchTokenFooter(tries++);
                }
            });
        };

        fetchTokenFooter(tries++);
    });
};
let getFilteredTokensByProperties = function() {
    let filters = [];

    $(".property-filter-item:checked").each(function() {
        let property = $(this).attr("data-property");
        let value = $(this).attr("data-value");

        filters.push({
            property: property,
            value: value
        });
    });

    let formData = new FormData();
    formData.append('filters', JSON.stringify(filters));

    $.ajax({
        url: $("#token-cards-container").attr("data-url"),
        method: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData
    }).done(function(response) {
        $("#token-cards-container").html(response);
        fetchTokenActionButtons();

        $("#collection-loading").addClass("d-none");
        $(".property-filter-item").prop("disabled", false);
    }).fail(function(error) {
        console.log(error);
    });
};

$(document).on("click", ".change-token-view", function() {
    let view = $(this).val();
    let tokenItem = $(".token-item");

    $(".change-token-view").removeClass("active");

    if(view === 'small-grid') {
        tokenItem.removeClass(['col-sm-6 col-xl-4']);
        tokenItem.addClass(['col-6 col-sm-4', 'col-xl-3', 'font-size-10']);

        $(this).addClass("active");
    } else {
        tokenItem.removeClass(['col-6 col-sm-4', 'col-xl-3', 'font-size-10']);
        tokenItem.addClass(['col-sm-6 col-xl-4']);

        $(this).addClass("active");
    }

    let formData = new FormData();
    formData.append('view', view);

    $.ajax({
        url: $("#view-options").attr("data-url"),
        method: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData
    }).fail(function(error) {
        console.log(error);
    });
});

$(document).on("change", ".property-filter-item", function() {
    $(".property-filter-item").prop("disabled", true);
    $("#token-cards-container").html("");
    $("#collection-loading").removeClass("d-none");

    let property = $(this).attr("data-property");
    let value = $(this).attr("data-value");
    let propertyFilterSelectedItems = $("#property-filter-selected-items");

    if($(this).prop("checked")) {
        let content = ' <div class="property-filter-selected-item d-flex align-items-center font-size-90 ps-4 pe-2 py-2 me-2 mb-2">';
        content += '        <div class="pe-2">' + property + ':</div>';
        content += '        <div class="fw-bold">' + value + '</div>';
        content += '        <div class="px-3 cursor-pointer remove-property-filter-selected-item" data-property="' + property + '" data-value="' + value + '">';
        content += '            <i class="fas fa-times font-size-120"></i>';
        content += '        </div>';
        content += '    </div>';

        propertyFilterSelectedItems.append(content);

        $("#no-selected-filters").addClass("d-none");
    } else {
        $(".remove-property-filter-selected-item[data-property='" + property + "'][data-value='" + value + "']").closest(".property-filter-selected-item").remove();
    }

    let propertyFilterCount = $(".property-filter-item:checked").length;

    if(!propertyFilterCount) {
        $("#no-selected-filters").removeClass("d-none");
        $("#reset-property-filters").addClass("d-none");
    } else {
        $("#reset-property-filters").removeClass("d-none");
    }

    let propertyFilterCountElement = $("#property-filter-count");
    propertyFilterCountElement.html(propertyFilterCount);
    if(propertyFilterCount > 0) {
        propertyFilterCountElement.removeClass("d-none");
    } else {
        propertyFilterCountElement.addClass("d-none");
    }

    getFilteredTokensByProperties();
});

$(document).on("click", ".remove-property-filter-selected-item", function() {
    $(".property-filter-item").prop("disabled", true);
    $("#token-cards-container").html("");
    $("#collection-loading").removeClass("d-none");

    $(this).closest(".property-filter-selected-item").remove();

    let property = $(this).attr("data-property");
    let value = $(this).attr("data-value");

    $(".property-filter-item[data-property='" + property + "'][data-value='" + value + "']").prop("checked", false);

    let propertyFilterCount = $(".property-filter-item:checked").length;

    console.log(propertyFilterCount)

    if(!propertyFilterCount) {
        $("#no-selected-filters").removeClass("d-none");
        $("#reset-property-filters").addClass("d-none");
    } else {
        $("#reset-property-filters").removeClass("d-none");
    }

    let propertyFilterCountElement = $("#property-filter-count");
    propertyFilterCountElement.html(propertyFilterCount);
    if(propertyFilterCount > 0) {
        propertyFilterCountElement.removeClass("d-none");
    } else {
        propertyFilterCountElement.addClass("d-none");
    }

    getFilteredTokensByProperties();
});

$(document).on("click", "#reset-property-filters", function() {
    $(".property-filter-item").prop("disabled", true);

    $(".property-filter-item:checked").each(function() {
        let property = $(this).attr("data-property");
        let value = $(this).attr("data-value");

        $(".property-filter-item[data-property='" + property + "'][data-value='" + value + "']").prop("checked", false);
        $(".remove-property-filter-selected-item[data-property='" + property + "'][data-value='" + value + "']").closest(".property-filter-selected-item").remove();
    });

    $("#no-selected-filters").removeClass("d-none");
    $("#reset-property-filters").addClass("d-none")
    $("#property-filter-count").addClass("d-none");

    getFilteredTokensByProperties();
});

// Newsletter
$(document).on("submit", ".newsletter-form", function(e) {
    e.preventDefault();

    let newsletter_form = $(this);

    if(newsletter_form.find("#agreement").prop("checked")) {
        newsletter_form.find("[type='submit']").prop("disabled", true);

        let data = new FormData($(this)[0]);

        $.ajax({
            url: "https://ownly.market/api/store-mustachio-subscriber",
            // url: "http://ownly-api.test/api/store-mustachio-subscriber",
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: data
        }).done(function(response) {
            newsletter_form.find("input").val("");
            newsletter_form.find("#agreement").prop("checked", false)

            $("#modal-subscribe-success").modal("show");
        }).fail(function(error) {
            console.log(error);
        }).always(function() {
            newsletter_form.find("[type='submit']").prop("disabled", false);
        });
    } else {
        newsletter_form.find("#agreement").focus();
    }
});

// Search Function
$(document).on("input", ".search-field", function() {
    let search = $(this).val();
    let searchSuggestionsContainer = $(this).closest(".search-field-container").find(".search-suggestions-container");

    if(search.length > 1) {
        let content = ' <div class="card">';
        content += '        <div class="card-body">';
        content += '            <div class="d-flex justify-content-center align-items-center">';
        content += '                <div class="spinner-grow background-image-cover bg-transparent me-2" style="width:1.5rem; height:1.5rem; background-image:url(\'../img/ownly/own-token.png\')" role="status">';
        content += '                    <span class="visually-hidden">Loading...</span>';
        content += '                </div>';
        content += '                <div class="font-size-80">Loading</div>';
        content += '            </div>';
        content += '        </div>';
        content += '    </div>';

        searchSuggestionsContainer.html(content);
        searchSuggestionsContainer.removeClass("d-none");

        clearTimeout(searchTimeout);

        searchTimeout = setTimeout(function() {
            let searchForm = $("#search-form");
            let formData = new FormData(searchForm[0]);

            $.ajax({
                url: searchForm.attr("action"),
                method: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(async function(result) {
                result = result.data;

                content = '     <div class="list-group overflow-auto" style="max-height:400px">';
                for(let i = 0; i < result.length; i++) {
                    let thumbnail = JSON.parse(result[i].thumbnail);

                    content += '    <a href="' + result[i].url + '" class="list-group-item list-group-item-action">';
                    content += '        <div class="d-flex align-items-center">';
                    content += '            <div class="pe-3" style="min-width:55px; width:55px">';
                    content += '                <div class="background-image-contain bg-color-1" style="padding-top:100%; border:1px solid #dddddd; background-image:url(\'' + thumbnail.webp256 + '\')"></div>';
                    content += '            </div>';
                    content += '            <div class="flex-fill">';
                    if(result[i].type === "token") {
                        content += '            <div class="text-color-7 font-size-80 mb-1">' + result[i].collection + '</div>';
                    }
                    content += '                <div class="d-flex w-100 justify-content-between align-items-center">';
                    content += '                    <div class="font-size-90 pe-4">' + result[i].name + '</div>';
                    if(result[i].type === "token") {
                        content += '                <div class="text-color-7 font-size-70">ID:&nbsp;' + result[i].id + '</div>';
                    }
                    content += '                </div>';
                    content += '            </div>';
                    content += '         </div>';
                    content += '    </a>';
                }
                content += '    </div>';

                if(result.length === 0) {
                    content = '     <div class="card">';
                    content += '        <div class="card-body">';
                    content += '            <div class="text-center">';
                    content += '                <div class="font-size-80">No Result Found</div>';
                    content += '            </div>';
                    content += '        </div>';
                    content += '    </div>';
                }

                searchSuggestionsContainer.html(content);
            }).fail(function(error) {
                console.log(error);
            });
        }, 1000);
    } else {
        searchSuggestionsContainer.addClass("d-none");
    }
});

$(document).on("click", 'html', function(e) {
    if($(e.target).closest('#search-field').length || $(e.target).closest('.search-suggestions-container').length) {
        if($(".search-field").val().length > 1) {
            $(".search-suggestions-container").removeClass("d-none");
        }
    } else {
        $(".search-suggestions-container").addClass("d-none");
    }
});

// Wallet Connection
let walletConnectProvider;
let initializeWalletConnect = function() {
    let rpc;

    rpc = {
        1: "https://mainnet.infura.io/v3/9aa3d95b3bc440fa88ea12eaa4456161",
        56: "https://bsc-dataseed.binance.org/",
        137: "https://polygon-rpc.com/"
    };
    walletConnectProvider = new WalletConnectProvider.default({
        rpc: rpc
    });
};
let getConnectedAddress = async function() {
    if(!address) {
        try {
            let accounts = await ethereum.request({ method: 'eth_requestAccounts' });
            address = (accounts.length > 0) ? accounts[0] : false;

            ethereum.on('accountsChanged', (_chainId) => window.location.reload());
        } catch(e) {}
    }
};
let connectWallet = async function() {
    if(!mainWeb3) {
        try {
            await getConnectedAddress();
            fetchAccount();

            mainWeb3 = new Web3(ethereum);

            return true;
        } catch (error) {
            $("#modal-no-metamask-installed").modal("show");
            return false;
        }
    } else {
        return true;
    }
};
let connectWalletConnect = async function() {
    await walletConnectProvider.enable();

    //  Create Web3 instance
    mainWeb3 = new Web3(walletConnectProvider);

    let accounts = await mainWeb3.eth.getAccounts(); // get all connected accounts
    address = accounts[0];

    await updateConnectToWallet();
};
let fetchAccount = function() {
    let getAccountProfileForm = $("#get-account-profile-form");
    $("input[name='address']").val(address);

    let formData = new FormData(getAccountProfileForm[0]);

    // Get Account Profile
    $.ajax({
        url: getAccountProfileForm.attr("action"),
        method: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData
    }).done(async function(response) {
        $("#account-container").html(response);

        if($("#profile-link").attr("data-discount-signature") === "") {
            if(localStorage.getItem("closedClaimElixirPopup") && parseInt(localStorage.getItem("closedClaimElixirPopup")) < new Date().getTime()) {
                $("#elixir-alert").addClass("show");
            }
        }
    }).fail(function(error) {
        console.log(error);
    });
};
let checkNetwork = async function(chainId) {
    if(await connectWallet()) {
        let connectedChainId = await mainWeb3.eth.getChainId();

        if(connectedChainId === chainId) {
            return true;
        } else {
            return await switchNetwork(chainId);
        }
    }

    return false;
};
let switchNetwork = async function(chainId) {
    try {
        let chainIdInHex = "0x" + chainId.toString(16);

        await window.ethereum.request({
            method: 'wallet_switchEthereumChain',
            params: [{ chainId: chainIdInHex}],
        });

        return true;
    } catch (switchError) {
        // The network has not been added to MetaMask
        if (switchError.code === 4902) {
            return await addNetwork(chainId);
        } else {
            return false;
        }
    }
};
let addNetwork = async function(chainId) {
    try {
        let data;

        if(chainId === 56) {
            data = {
                chainId: '0x' + chainId.toString(16),
                chainName:'BNB Chain',
                rpcUrls:['https://bsc-dataseed.binance.org/'],
                blockExplorerUrls:['https://bscscan.com/'],
                nativeCurrency: {
                    symbol:'BNB',
                    decimals: 18
                }
            }
        } else if(chainId === 97) {
            console.log('0x' + chainId.toString(16));
            data = {
                chainId: '0x' + chainId.toString(16),
                chainName:'BNB Chain Testnet',
                rpcUrls:['https://data-seed-prebsc-1-s1.binance.org:8545/'],
                blockExplorerUrls:['https://testnet.bscscan.com/'],
                nativeCurrency: {
                    symbol:'BNB',
                    decimals: 18
                }
            }
        } else if(chainId === 137) {
            data = {
                chainId: '0x' + chainId.toString(16),
                chainName:'Polygon',
                rpcUrls:['https://polygon-rpc.com'],
                blockExplorerUrls:['https://polygonscan.com/'],
                nativeCurrency: {
                    symbol:'MATIC',
                    decimals: 18
                }
            }
        } else if(chainId === 80001) {
            data = {
                chainId: '0x' + chainId.toString(16),
                chainName:'Polygon Mumbai',
                rpcUrls:['https://rpc-mumbai.maticvigil.com/'],
                blockExplorerUrls:['https://mumbai-explorer.matic.today/'],
                nativeCurrency: {
                    symbol:'MATIC',
                    decimals: 18
                }
            }
        } else if(chainId === 1) {
            data = {
                chainId: '0x' + chainId.toString(16),
                chainName: 'Ethereum Mainnet',
                rpcUrls: ['https://mainnet.infura.io/v3/'],
                blockExplorerUrls: ['https://etherscan.io'],
                nativeCurrency: {
                    symbol: 'ETH',
                    decimals: 18
                }
            }
        } else if(chainId === 4) {
            data = {
                chainId: '0x' + chainId.toString(16),
                chainName:'Rinkeby Test Network',
                rpcUrls:['https://rinkeby.infura.io/v3/'],
                blockExplorerUrls:['https://rinkeby.etherscan.io'],
                nativeCurrency: {
                    symbol:'ETH',
                    decimals: 18
                }
            }
        }

        let networkIsAdded = await window.ethereum.request({
            method: 'wallet_addEthereumChain',
            params: [data]
        });

        return !!(networkIsAdded);
    } catch (err) {
        console.log(err);
        return false;
    }
};

$(document).on("click", "#connect-wallet", () => {
    $("#modal-wallet-options").modal("show");
});

$(document).on("click", ".wallet-options", async function () {
    let wallet = $(this).attr("data-wallet");

    $("#modal-wallet-options").modal("hide");

    if(wallet === "MetaMask") {
        await connectWallet();
    } else if(wallet === "WalletConnect") {
        await connectWalletConnect();
    }
});

// Create Market Item
$(document).on("click", ".create-market-item-confirmation", async function() {
    let button = $(this);
    button.prop("disabled", true);

    let tokenForm = $(this).closest(".token-action-buttons").find(".token-form");

    let chainId = tokenForm.find("input[name='chain_id']").val();
    let contractAddress = tokenForm.find("input[name='contract_address']").val();
    let contractAbi = tokenForm.find("input[name='contract_abi']").val();
    let tokenID = tokenForm.find("input[name='token_id']").val();
    let marketplaceContractAddress = tokenForm.find("input[name='marketplace_contract_address']").val();
    let marketplaceContractAbi = tokenForm.find("input[name='marketplace_contract_abi']").val();

    if(!await checkNetwork(parseInt(chainId))) {
        button.prop("disabled", false);
        return false;
    }

    let contract = new mainWeb3.eth.Contract(JSON.parse(contractAbi), contractAddress);
    contract.methods.isApprovedForAll(address, marketplaceContractAddress).call()
        .then(function(isApprovedForAll) {
            button.prop("disabled", false);

            let createMarketItemButton = $("#create-market-item");
            createMarketItemButton.attr("data-token-id", tokenID);
            createMarketItemButton.attr("data-contract-address", contractAddress);
            createMarketItemButton.attr("data-marketplace-contract-address", marketplaceContractAddress);
            createMarketItemButton.attr("data-marketplace-contract-abi", marketplaceContractAbi);

            if(isApprovedForAll) {
                $("#modal-create-market-item").modal("show");
            } else {
                let approveButton = $("#approve");

                approveButton.attr("data-contract-address", contractAddress);
                approveButton.attr("data-contract-abi", contractAbi);
                approveButton.attr("data-marketplace-contract-address", marketplaceContractAddress);

                $("#modal-approve").modal("show");
            }
        });
});

$(document).on("click", "#approve", async function() {
    let approveButton = $("#approve");
    approveButton.prop("disabled", true);

    let contractAddress = $(this).attr("data-contract-address");
    let contractAbi = $(this).attr("data-contract-abi");
    let marketplaceContractAddress = $(this).attr("data-marketplace-contract-address");

    console.log(contractAddress);
    console.log(contractAbi);

    $("#modal-approve").modal("hide");

    let contract = new mainWeb3.eth.Contract(JSON.parse(contractAbi), contractAddress);
    contract.methods.setApprovalForAll(marketplaceContractAddress, true)
        .send({
            from: mainWeb3.utils.toChecksumAddress(address)
        }).on('transactionHash', function(hash){
        $("#modal-processing").modal("show");
    }).on('error', function(error){
        $("#modal-processing").modal("hide");

        $("#modal-error .message").text(error.code + ": " + error.message);
        $("#modal-error").modal("show");
    }).then(function(receipt) {
        $("#modal-processing").modal("hide");
        $("#modal-create-market-item").modal("show");
    });
});

$(document).on("click", ".select-price-current", async function() {
    $("#price-currency img").attr("src", $(this).data("image"));
    $("#price-currency span").text($(this).data("currency"));
    $("#price-currency").val($(this).data("currency"));
});

$(document).on("click", "#create-market-item", async function() {
    let createMarketItemButton = $("#create-market-item");

    let contractAddress = createMarketItemButton.attr("data-contract-address");
    let tokenId = createMarketItemButton.attr("data-token-id");
    let marketplaceContractAddress = createMarketItemButton.attr("data-marketplace-contract-address");
    let marketplaceContractAbi = createMarketItemButton.attr("data-marketplace-contract-abi");

    let currency = $("#price-currency").val();
    let price = $("#price").val();

    if(price > 0) {
        $("#modal-create-market-item").modal("hide");

        let marketplaceContract = new mainWeb3.eth.Contract(JSON.parse(marketplaceContractAbi), marketplaceContractAddress);

        marketplaceContract.methods.getListingPrice().call()
            .then(function(listingPrice) {
                marketplaceContract.methods.createMarketItem(contractAddress, tokenId, mainWeb3.utils.toWei(price, 'ether'), currency, 0, 0)
                    .send({
                        from: mainWeb3.utils.toChecksumAddress(address),
                        value: listingPrice
                    }).on('transactionHash', function(transactionHash){
                    $("#modal-processing").modal("show");
                }).on('error', function(error){
                    $("#modal-processing").modal("hide");

                    $("#modal-error .message").text(error.code + ": " + error.message);
                    $("#modal-error").modal("show");
                }).then(function(receipt) {
                    $("#modal-processing").modal("hide");

                    initializeReloadButton("");

                    $("#modal-success .message").text("You have successfully posted your item for sale.");
                    $("#modal-success").modal("show");
                });
            });
    }
});

// Cancel Market Item
$(document).on("click", ".cancel-market-item-confirmation", function() {
    let tokenForm = $(this).closest(".token-action-buttons").find(".token-form");

    let chainId = tokenForm.find("input[name='chain_id']").val();
    let marketplaceContractAddress = tokenForm.find("input[name='marketplace_contract_address']").val();
    let marketplaceContractAbi = tokenForm.find("input[name='marketplace_contract_abi']").val();
    let version = tokenForm.find("input[name='version']").val();
    let itemID = tokenForm.find("input[name='item_id']").val();

    let cancelMarketItemButton = $("#cancel-market-item");

    cancelMarketItemButton.attr("data-chain-id", chainId);
    cancelMarketItemButton.attr("data-marketplace-contract-address", marketplaceContractAddress);
    cancelMarketItemButton.attr("data-marketplace-contract-abi", marketplaceContractAbi);
    cancelMarketItemButton.attr("data-version", version);
    cancelMarketItemButton.val(itemID);

    $("#modal-cancel-market-item").modal("show");
});

$(document).on("click", "#cancel-market-item", async function() {
    $("#modal-cancel-market-item").modal("hide");

    let chainId = $(this).attr("data-chain-id");
    let marketplaceContractAddress = $(this).attr("data-marketplace-contract-address");
    let marketplaceContractAbi = $(this).attr("data-marketplace-contract-abi");
    let itemID = $(this).val();

    if(!await checkNetwork(parseInt(chainId))) {
        return false;
    }

    let marketplaceContract = new mainWeb3.eth.Contract(JSON.parse(marketplaceContractAbi), marketplaceContractAddress);

    let transaction = marketplaceContract.methods.cancelMarketItem(itemID);

    transaction.send({
        from: mainWeb3.utils.toChecksumAddress(address)
    }).on('transactionHash', function(transactionHash){
        $("#modal-processing").modal("show");
    }).on('error', function(error){
        $("#modal-processing").modal("hide");

        $("#modal-error .message").text(error.code + ": " + error.message);
        $("#modal-error").modal("show");
    }).then(function(receipt) {
        $("#modal-processing").modal("hide");

        initializeReloadButton("");

        $("#modal-success .message").text("You have successfully cancelled your item for sale.");
        $("#modal-success").modal("show");
    });
});

// Create Market Sale
let updateBuyingToken = async function() {
    let buyingPriceLoadingContainer = $("#buying-price-loading-container");
    buyingPriceLoadingContainer.removeClass("d-none");

    $(".buying-price-container").addClass("d-none");

    let createMarketSale = $(".create-market-sale");
    let price = createMarketSale.attr("data-price");
    let currency = createMarketSale.attr("data-currency");

    let token = $("input[name='buy_through_token']:checked").val();

    if(currency === "BNB" && token === "OWN") {
        let sparkSwapContract = new (new Web3("https://bsc-dataseed.binance.org/")).eth.Contract([{"inputs":[{"internalType":"address","name":"_factory","type":"address"},{"internalType":"address","name":"_WETH","type":"address"}],"stateMutability":"nonpayable","type":"constructor"},{"inputs":[],"name":"WETH","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"tokenA","type":"address"},{"internalType":"address","name":"tokenB","type":"address"},{"internalType":"uint256","name":"amountADesired","type":"uint256"},{"internalType":"uint256","name":"amountBDesired","type":"uint256"},{"internalType":"uint256","name":"amountAMin","type":"uint256"},{"internalType":"uint256","name":"amountBMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"addLiquidity","outputs":[{"internalType":"uint256","name":"amountA","type":"uint256"},{"internalType":"uint256","name":"amountB","type":"uint256"},{"internalType":"uint256","name":"liquidity","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"token","type":"address"},{"internalType":"uint256","name":"amountTokenDesired","type":"uint256"},{"internalType":"uint256","name":"amountTokenMin","type":"uint256"},{"internalType":"uint256","name":"amountETHMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"addLiquidityETH","outputs":[{"internalType":"uint256","name":"amountToken","type":"uint256"},{"internalType":"uint256","name":"amountETH","type":"uint256"},{"internalType":"uint256","name":"liquidity","type":"uint256"}],"stateMutability":"payable","type":"function"},{"inputs":[],"name":"factory","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"},{"internalType":"uint256","name":"reserveIn","type":"uint256"},{"internalType":"uint256","name":"reserveOut","type":"uint256"}],"name":"getAmountIn","outputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"}],"stateMutability":"pure","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"uint256","name":"reserveIn","type":"uint256"},{"internalType":"uint256","name":"reserveOut","type":"uint256"}],"name":"getAmountOut","outputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"}],"stateMutability":"pure","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"}],"name":"getAmountsIn","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"}],"name":"getAmountsOut","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountA","type":"uint256"},{"internalType":"uint256","name":"reserveA","type":"uint256"},{"internalType":"uint256","name":"reserveB","type":"uint256"}],"name":"quote","outputs":[{"internalType":"uint256","name":"amountB","type":"uint256"}],"stateMutability":"pure","type":"function"},{"inputs":[{"internalType":"address","name":"tokenA","type":"address"},{"internalType":"address","name":"tokenB","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountAMin","type":"uint256"},{"internalType":"uint256","name":"amountBMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"removeLiquidity","outputs":[{"internalType":"uint256","name":"amountA","type":"uint256"},{"internalType":"uint256","name":"amountB","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"token","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountTokenMin","type":"uint256"},{"internalType":"uint256","name":"amountETHMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"removeLiquidityETH","outputs":[{"internalType":"uint256","name":"amountToken","type":"uint256"},{"internalType":"uint256","name":"amountETH","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"token","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountTokenMin","type":"uint256"},{"internalType":"uint256","name":"amountETHMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"removeLiquidityETHSupportingFeeOnTransferTokens","outputs":[{"internalType":"uint256","name":"amountETH","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"token","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountTokenMin","type":"uint256"},{"internalType":"uint256","name":"amountETHMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"},{"internalType":"bool","name":"approveMax","type":"bool"},{"internalType":"uint8","name":"v","type":"uint8"},{"internalType":"bytes32","name":"r","type":"bytes32"},{"internalType":"bytes32","name":"s","type":"bytes32"}],"name":"removeLiquidityETHWithPermit","outputs":[{"internalType":"uint256","name":"amountToken","type":"uint256"},{"internalType":"uint256","name":"amountETH","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"token","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountTokenMin","type":"uint256"},{"internalType":"uint256","name":"amountETHMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"},{"internalType":"bool","name":"approveMax","type":"bool"},{"internalType":"uint8","name":"v","type":"uint8"},{"internalType":"bytes32","name":"r","type":"bytes32"},{"internalType":"bytes32","name":"s","type":"bytes32"}],"name":"removeLiquidityETHWithPermitSupportingFeeOnTransferTokens","outputs":[{"internalType":"uint256","name":"amountETH","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"tokenA","type":"address"},{"internalType":"address","name":"tokenB","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountAMin","type":"uint256"},{"internalType":"uint256","name":"amountBMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"},{"internalType":"bool","name":"approveMax","type":"bool"},{"internalType":"uint8","name":"v","type":"uint8"},{"internalType":"bytes32","name":"r","type":"bytes32"},{"internalType":"bytes32","name":"s","type":"bytes32"}],"name":"removeLiquidityWithPermit","outputs":[{"internalType":"uint256","name":"amountA","type":"uint256"},{"internalType":"uint256","name":"amountB","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapETHForExactTokens","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactETHForTokens","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactETHForTokensSupportingFeeOnTransferTokens","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactTokensForETH","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactTokensForETHSupportingFeeOnTransferTokens","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactTokensForTokens","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactTokensForTokensSupportingFeeOnTransferTokens","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"},{"internalType":"uint256","name":"amountInMax","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapTokensForExactETH","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"},{"internalType":"uint256","name":"amountInMax","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapTokensForExactTokens","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"nonpayable","type":"function"},{"stateMutability":"payable","type":"receive"}], "0xeB98E6e5D34c94F56708133579abB8a6A2aC2F26");

        await sparkSwapContract.methods.getAmountsIn(price, ["0x7665CB7b0d01Df1c9f9B9cC66019F00aBD6959bA", "0xbb4cdb9cbd36b01bd1cbaebf2de08d9173bc095c"]).call()
            .then(async function(amounts) {
                let ownPrice = mainWeb3.utils.fromWei(amounts[0], "ether");

                let buyingPriceContainerBnbToOwn = $(".buying-price-container[data-currency='BNB-OWN']");
                buyingPriceContainerBnbToOwn.find(".bnb-price").text(mainWeb3.utils.fromWei(price, "ether"));
                buyingPriceContainerBnbToOwn.find(".own-price").text(numberFormat(ownPrice, 2));

                let discountedOwnPrice = ((BigInt(amounts[0]) * BigInt(8)) / BigInt(10)).toString();

                $("#discounted-own-price").text(numberFormat(mainWeb3.utils.fromWei(discountedOwnPrice, "ether"), 2));
                $("#discounted-own-price").attr("data-price", discountedOwnPrice);

                buyingPriceContainerBnbToOwn.removeClass("d-none");
            });
    } else if(currency === "BNB" && token === "BNB") {
        $("#bnb-price").text(numberFormat(mainWeb3.utils.fromWei(price, "ether"), 3));
        $(".buying-price-container[data-currency='BNB-BNB']").removeClass("d-none");
    } else if(currency === "OWN" && token === "OWN") {
        $("#own-price").text(numberFormat(mainWeb3.utils.fromWei(price, "ether"), 2));
        $(".buying-price-container[data-currency='OWN-OWN']").removeClass("d-none");
    } else if(currency === "OWN" && token === "BNB") {
        let sparkSwapContract = new (new Web3("https://bsc-dataseed.binance.org/")).eth.Contract([{"inputs":[{"internalType":"address","name":"_factory","type":"address"},{"internalType":"address","name":"_WETH","type":"address"}],"stateMutability":"nonpayable","type":"constructor"},{"inputs":[],"name":"WETH","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"tokenA","type":"address"},{"internalType":"address","name":"tokenB","type":"address"},{"internalType":"uint256","name":"amountADesired","type":"uint256"},{"internalType":"uint256","name":"amountBDesired","type":"uint256"},{"internalType":"uint256","name":"amountAMin","type":"uint256"},{"internalType":"uint256","name":"amountBMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"addLiquidity","outputs":[{"internalType":"uint256","name":"amountA","type":"uint256"},{"internalType":"uint256","name":"amountB","type":"uint256"},{"internalType":"uint256","name":"liquidity","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"token","type":"address"},{"internalType":"uint256","name":"amountTokenDesired","type":"uint256"},{"internalType":"uint256","name":"amountTokenMin","type":"uint256"},{"internalType":"uint256","name":"amountETHMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"addLiquidityETH","outputs":[{"internalType":"uint256","name":"amountToken","type":"uint256"},{"internalType":"uint256","name":"amountETH","type":"uint256"},{"internalType":"uint256","name":"liquidity","type":"uint256"}],"stateMutability":"payable","type":"function"},{"inputs":[],"name":"factory","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"},{"internalType":"uint256","name":"reserveIn","type":"uint256"},{"internalType":"uint256","name":"reserveOut","type":"uint256"}],"name":"getAmountIn","outputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"}],"stateMutability":"pure","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"uint256","name":"reserveIn","type":"uint256"},{"internalType":"uint256","name":"reserveOut","type":"uint256"}],"name":"getAmountOut","outputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"}],"stateMutability":"pure","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"}],"name":"getAmountsIn","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"}],"name":"getAmountsOut","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountA","type":"uint256"},{"internalType":"uint256","name":"reserveA","type":"uint256"},{"internalType":"uint256","name":"reserveB","type":"uint256"}],"name":"quote","outputs":[{"internalType":"uint256","name":"amountB","type":"uint256"}],"stateMutability":"pure","type":"function"},{"inputs":[{"internalType":"address","name":"tokenA","type":"address"},{"internalType":"address","name":"tokenB","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountAMin","type":"uint256"},{"internalType":"uint256","name":"amountBMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"removeLiquidity","outputs":[{"internalType":"uint256","name":"amountA","type":"uint256"},{"internalType":"uint256","name":"amountB","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"token","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountTokenMin","type":"uint256"},{"internalType":"uint256","name":"amountETHMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"removeLiquidityETH","outputs":[{"internalType":"uint256","name":"amountToken","type":"uint256"},{"internalType":"uint256","name":"amountETH","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"token","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountTokenMin","type":"uint256"},{"internalType":"uint256","name":"amountETHMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"removeLiquidityETHSupportingFeeOnTransferTokens","outputs":[{"internalType":"uint256","name":"amountETH","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"token","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountTokenMin","type":"uint256"},{"internalType":"uint256","name":"amountETHMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"},{"internalType":"bool","name":"approveMax","type":"bool"},{"internalType":"uint8","name":"v","type":"uint8"},{"internalType":"bytes32","name":"r","type":"bytes32"},{"internalType":"bytes32","name":"s","type":"bytes32"}],"name":"removeLiquidityETHWithPermit","outputs":[{"internalType":"uint256","name":"amountToken","type":"uint256"},{"internalType":"uint256","name":"amountETH","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"token","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountTokenMin","type":"uint256"},{"internalType":"uint256","name":"amountETHMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"},{"internalType":"bool","name":"approveMax","type":"bool"},{"internalType":"uint8","name":"v","type":"uint8"},{"internalType":"bytes32","name":"r","type":"bytes32"},{"internalType":"bytes32","name":"s","type":"bytes32"}],"name":"removeLiquidityETHWithPermitSupportingFeeOnTransferTokens","outputs":[{"internalType":"uint256","name":"amountETH","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"tokenA","type":"address"},{"internalType":"address","name":"tokenB","type":"address"},{"internalType":"uint256","name":"liquidity","type":"uint256"},{"internalType":"uint256","name":"amountAMin","type":"uint256"},{"internalType":"uint256","name":"amountBMin","type":"uint256"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"},{"internalType":"bool","name":"approveMax","type":"bool"},{"internalType":"uint8","name":"v","type":"uint8"},{"internalType":"bytes32","name":"r","type":"bytes32"},{"internalType":"bytes32","name":"s","type":"bytes32"}],"name":"removeLiquidityWithPermit","outputs":[{"internalType":"uint256","name":"amountA","type":"uint256"},{"internalType":"uint256","name":"amountB","type":"uint256"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapETHForExactTokens","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactETHForTokens","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactETHForTokensSupportingFeeOnTransferTokens","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactTokensForETH","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactTokensForETHSupportingFeeOnTransferTokens","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactTokensForTokens","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountIn","type":"uint256"},{"internalType":"uint256","name":"amountOutMin","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapExactTokensForTokensSupportingFeeOnTransferTokens","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"},{"internalType":"uint256","name":"amountInMax","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapTokensForExactETH","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amountOut","type":"uint256"},{"internalType":"uint256","name":"amountInMax","type":"uint256"},{"internalType":"address[]","name":"path","type":"address[]"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"deadline","type":"uint256"}],"name":"swapTokensForExactTokens","outputs":[{"internalType":"uint256[]","name":"amounts","type":"uint256[]"}],"stateMutability":"nonpayable","type":"function"},{"stateMutability":"payable","type":"receive"}], "0xeB98E6e5D34c94F56708133579abB8a6A2aC2F26");

        await sparkSwapContract.methods.getAmountsOut(price, ["0x7665CB7b0d01Df1c9f9B9cC66019F00aBD6959bA", "0xbb4cdb9cbd36b01bd1cbaebf2de08d9173bc095c"]).call()
            .then(async function(amounts) {
                let ownPrice = mainWeb3.utils.fromWei(amounts[0], "ether");

                let buyingPriceContainerBnbToOwn = $(".buying-price-container[data-currency='BNB-OWN']");
                buyingPriceContainerBnbToOwn.find(".bnb-price").text(mainWeb3.utils.fromWei(price, "ether"));
                buyingPriceContainerBnbToOwn.find(".own-price").text(numberFormat(ownPrice, 2));

                $("#bnb-price").text(numberFormat(mainWeb3.utils.fromWei(amounts[1], "ether"), 2));
                $(".buying-price-container[data-currency='OWN-BNB']").removeClass("d-none");
            });
    }

    buyingPriceLoadingContainer.addClass("d-none");
};

$(document).on("click", ".create-market-sale-confirmation", async function() {
    let tokenForm = $(this).closest(".token-action-buttons").find(".token-form");

    let chainId = tokenForm.find("input[name='chain_id']").val();
    let price = tokenForm.find("input[name='price']").val();
    let itemId = tokenForm.find("input[name='item_id']").val();
    let currency = tokenForm.find("input[name='currency']").val();
    let marketplaceContractAddress = tokenForm.find("input[name='marketplace_contract_address']").val();
    let marketplaceContractAbi = tokenForm.find("input[name='marketplace_contract_abi']").val();

    let createMarketSale = $(".create-market-sale");

    createMarketSale.attr("data-price", price);
    createMarketSale.attr("data-item-id", itemId);
    createMarketSale.attr("data-currency", currency);
    createMarketSale.attr("data-marketplace-contract-address", marketplaceContractAddress);
    createMarketSale.attr("data-marketplace-contract-abi", marketplaceContractAbi);

    if(!await checkNetwork(parseInt(chainId))) {
        return false;
    }

    $("#modal-buy-select-currency").modal("show");

    await updateBuyingToken();
});

$(document).on("change", "input[name='buy_through_token']", function() {
    let token = $("input[name='buy_through_token']:checked").val();

    $(".buy-through-token-label").removeClass("active");
    $(".buy-through-token-label[data-token='" + token + "']").addClass("active");
    $(".buy-through-token-image").addClass("d-none");
    $(".buy-through-token-image[data-token='" + token + "']").removeClass("d-none");

    updateBuyingToken();
});

$(document).on("click", ".create-market-sale", function() {
    let price = $(this).attr("data-price");
    let item_id = $(this).attr("data-item-id");
    let selectedCurrency = $("input[name='buy_through_token']:checked").val();

    let marketplaceContractAddress = $(this).attr("data-marketplace-contract-address");
    let marketplaceContractAbi = $(this).attr("data-marketplace-contract-abi");
    let marketplaceContract = new mainWeb3.eth.Contract(JSON.parse(marketplaceContractAbi), marketplaceContractAddress);

    let ownContractAddress = $("input[name='own_contract_address']").val();
    let ownContractAbi = $("input[name='own_contract_abi']").val();

    let ownContract = new mainWeb3.eth.Contract(JSON.parse(ownContractAbi), ownContractAddress);

    let createMarketSaleFunction = async function(_price) {
        marketplaceContract.methods.createMarketSale(item_id, selectedCurrency)
            .send({
                from: mainWeb3.utils.toChecksumAddress(address),
                value: _price
            }).on('transactionHash', function(transactionHash){
            $("#modal-processing").modal("show");
        }).on('error', function(error) {
            $("#modal-processing").modal("hide");

            $("#modal-error .message").text(error.code + ": " + error.message);
            $("#modal-error").modal("show");
        }).then(function(receipt) {
            $("#modal-processing").modal("hide");

            initializeReloadButton("");

            $("#modal-success .message").html("Congratulations!<br>You have successfully purchased your token.");
            $("#modal-success").modal("show");
        });
    };

    if($(this).attr("data-currency") === "OWN" && selectedCurrency === "OWN") {
        ownContract.methods.allowance(address, marketplaceContractAddress).call()
            .then(async function(allowance) {
                if(allowance !== price) {
                    ownContract.methods.approve(marketplaceContractAddress, price)
                        .send({
                            from: mainWeb3.utils.toChecksumAddress(address)
                        }).on('transactionHash', function(transactionHash){
                        $("#modal-processing").modal("show");
                    }).on('error', function(error){
                        $("#modal-processing").modal("hide");

                        $("#modal-error .message").text(error.code + ": " + error.message);
                        $("#modal-error").modal("show");
                    }).then(function(receipt) {
                        $("#modal-processing").modal("hide");

                        createMarketSaleFunction(0);
                    });
                } else {
                    createMarketSaleFunction(0);
                }
            });
    } else if($(this).attr("data-currency") === "BNB" && selectedCurrency === "OWN") {
        ownContract.methods.allowance(address, marketplaceContractAddress).call()
            .then(async function(allowance) {
                let priceWithSlippage = (BigInt($("#discounted-own-price").attr("data-price")) * BigInt(100001) / BigInt(100000)).toString();

                if(allowance < priceWithSlippage) {
                    ownContract.methods.approve(marketplaceContractAddress, priceWithSlippage)
                        .send({
                            from: mainWeb3.utils.toChecksumAddress(address)
                        }).on('transactionHash', function(transactionHash){
                        $("#modal-processing").modal("show");
                    }).on('error', function(error){
                        $("#modal-processing").modal("hide");

                        $("#modal-error .message").text(error.code + ": " + error.message);
                        $("#modal-error").modal("show");
                    }).then(function(receipt) {
                        $("#modal-processing").modal("hide");

                        createMarketSaleFunction(0);
                    });
                } else {
                    createMarketSaleFunction(0);
                }
            });
    } else {
        createMarketSaleFunction(price);
    }

    $("#modal-buy-select-currency").modal("hide");
});

// Favorites
$(document).on("click", ".add-to-favorites", async function() {
    await connectWallet();

    let message = $(this).attr("data-message");
    let signature = await mainWeb3.eth.personal.sign(message, address);
    // var signing_address = await mainWeb3.eth.personal.ecRecover(message, signature)

    let button = $(this);
    let url = button.attr("data-url");
    let contract_address = button.attr("data-contract-address");
    let token_id = button.attr("data-token-id");
    let status = parseInt(button.attr("data-status"));

    if(signature) {
        let new_status = (status) ? 0 : 1;

        let count = parseInt(button.closest(".add-to-favorites-container").find(".favorites-count").text());

        if(new_status === 1) {
            button.find("i").removeClass("far");
            button.find("i").addClass("fas");
            button.closest(".add-to-favorites-container").find(".favorites-count").text(count + 1);
        } else {
            button.find("i").removeClass("fas");
            button.find("i").addClass("far");
            button.closest(".add-to-favorites-container").find(".favorites-count").text(count - 1);
        }

        button.attr("data-status", new_status);

        let formData = new FormData();
        formData.append('address', address);
        formData.append('signature', signature);
        formData.append('contract_address', contract_address);
        formData.append('token_id', token_id);
        formData.append('status', new_status);

        $.ajax({
            url: url,
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData
        }).fail(function(error) {
            console.log(error);
        });
    }
});

// Sales
$(document).on("change", ".sales-date", async function() {
    let periodical = $("#periodical").val();

    let salesYear = $("#sales-year");
    let salesQuarter = $("#sales-quarter");
    let salesMonth = $("#sales-month");

    let year = salesYear.val();
    let quarter = salesQuarter.val();
    let month = salesMonth.val();

    salesQuarter.closest("div").addClass("d-none");
    salesMonth.closest("div").addClass("d-none");

    if(periodical === "Annual") {
        $("#sales-button").attr("href", appUrl + "/sales?year=" + year);
    } else if(periodical === "Quarterly") {
        salesQuarter.closest("div").removeClass("d-none");

        $("#sales-button").attr("href", appUrl + "/sales?year=" + year + "&quarter=" + quarter);
    } else if(periodical === "Monthly") {
        salesMonth.closest("div").removeClass("d-none");

        $("#sales-button").attr("href", appUrl + "/sales?year=" + year + "&month=" + month);
    }
});

$(document).on("click", ".view-token-properties", function() {
    let properties = $(this).data("properties");
    let content = ' <div class="d-flex justify-content-center mt-2 mb-3">';
    content +=          $(this).closest("tr").find(".token-name").html();
    content += '    </div>';

    for(let i = 0; i < properties.length; i++) {
        content += '    <div class="col-6 col-xl-4 p-2">';
        content += '        <div class="card bg-light h-100">';
        content += '            <div class="card-body h-100">';
        content += '                <div class="d-flex justify-content-center align-items-center h-100">';
        content += '                    <div class="text-center">';
        content += '                        <p class="neo-bold font-size-80 mb-1 text-uppercase text-decoration-none link-color-4">' + properties[i].trait_type + '</p>';
        content += '                        <div class="neo-bold font-size-100 text-color-6 mb-1">' + properties[i].value + '</div>';
        content += '                        <p class="font-size-80 text-color-7 mb-0">' + properties[i].percentage.toFixed(0) + '% have this trait</p>';
        content += '                    </div>';
        content += '                </div>';
        content += '            </div>';
        content += '        </div>';
        content += '    </div>';
    }

    $("#token-properties-container").html(content);
    $("#modal-token-properties").modal("show");
});

// Cookie Popup
$(document).on("click", "#remove-cookie-popup", function() {
    $("#cookie-popup").addClass("d-none");
});

$(document).on("click", "#accept-cookies", function() {
    localStorage.setItem("acceptCookie", '1');
    $("#cookie-popup").addClass("d-none");
});
