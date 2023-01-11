<div>
    <form class="token-form">
        <input type="hidden" name="chain_id" value="{{ $collection['chain_id'] }}" />
        <input type="hidden" name="contract_address" value="{{ $collection['contract_address'] }}" />
        <input type="hidden" name="contract_abi" value="{{ $collection['abi'] }}" />
        <input type="hidden" name="token_id" value="{{ $token['token_id'] }}" />
        <input type="hidden" name="marketplace_contract_address" value="{{ $collection->marketplaceContractAddress() }}" />
        <input type="hidden" name="marketplace_contract_abi" value="{{ $collection->marketplaceContractAbi() }}" />
        <input type="hidden" name="favorite_status" value="{{ $token['favorite_status'] }}" />
        @if($token['marketItem'])
        <input type="hidden" name="item_id" value="{{ $token['marketItem']['itemId'] }}" />
        <input type="hidden" name="version" value="{{ $token['marketItem']['version'] }}" />
        <input type="hidden" name="price" value="{{ $token['marketItem']['price'] }}" />
        <input type="hidden" name="currency" value="{{ $token['marketItem']['currency'] }}" />
        @endif
    </form>

    @if(strtolower($token['owner']) == strtolower('0x672b733C5350034Ccbd265AA7636C3eBDDA2223B') && $collection['chain_id'] == config('ownly.chain_id_eth'))
    <div class="row align-items-center" style="min-height:69px">
        <div class="col-6">
        </div>
        <div class="col-6 button-container">
            <a href="https://opensea.io/assets/{{ $collection['contract_address'] }}/{{ $token['token_id'] }}" class="btn btn-custom-2 w-100 line-height-110 font-size-90 font-size-lg-100 font-size-xxl-110 py-3 font-size-xxl-120 neo-bold link" style="border-radius:15px">OWN NOW</a>
        </div>
    </div>
    @else
        @if($token['marketItem'] && $token['marketItem']['itemId'] != "0")
    <div class="row align-items-center" style="min-height:69px">
        <div class="col-6">
            <div class="d-flex align-items-end mb-1">
                <div class="font-size-100 font-size-md-110">Price:</div>
                <div class="ps-2 ms-1">
                    <img src="{{ asset('img/currencies/' . $token['marketItem']['currency'] . '.png') }}" width="20" />
                </div>
            </div>
            <div class="font-size-140 font-size-md-160 neo-black">{{ number_format($token['marketItem']['priceInEther']) }} <span class="font-size-90 neo-black">{{ $token['marketItem']['currency'] }}</span></div>
        </div>
        <div class="col-6 button-container">
            @if($token['owner'])
                @if($user && strtolower($token['owner']) == strtolower($user['address']))
            <button class="btn btn-custom-3 w-100 line-height-110 font-size-90 font-size-lg-100 font-size-xxl-110 py-3 font-size-xxl-120 neo-bold link cancel-market-item-confirmation" style="border-radius:15px">CANCEL</button>
                @else
            <button class="btn btn-custom-2 w-100 line-height-110 font-size-90 font-size-lg-100 font-size-xxl-110 py-3 neo-bold link create-market-sale-confirmation" style="border-radius:15px">OWN NOW</button>
                @endif
            @endif
        </div>
    </div>
    <div class="owner d-none">{{ $token['owner'] }}</div>
        @else
            @if($collection['chain_id'] != config('ownly.chain_id_matic'))
                @if($token['owner'] == "0x0000000000000000000000000000000000000000")
    <div class="row align-items-center justify-content-end" style="min-height:69px">
        <div class="col-6">
            <button class="btn btn-custom-4 w-100 line-height-110 font-size-90 font-size-lg-110 font-size-xl-110 font-size-xxl-120 neo-bold create-market-sale-confirmation" data-type="mint" style="border-radius:15px">MINT NOW</button>
        </div>
    </div>
                @else
    <div class="row align-items-center" style="min-height:69px">
        <div class="col-6">
            <div>
                <a href="{{ $collection->blockchainExplorerLink() }}tx/{{ $token['token_transfer']['transaction_hash'] }}" target="_blank" class="link-color-4 font-size-90 text-decoration-none transaction-hash">View on {{ $collection->blockchainExplorerName() }}</a>
            </div>
            <div class="font-size-100 neo-bold">Owner</div>
            <div class="font-size-90 owner-address"><a href="{{ route('profile.index', $token['owner']) }}" class="link-color-4 text-decoration-none">{{ shortenAddress($token['owner'], 5, 5) }}</a></div>
        </div>
        <div class="col-6 d-flex align-items-center">
                    @if($collection->network() == "bsc")
                        @if($token['owner'])
                            @if($user && strtolower($token['owner']) == strtolower($user['address']))
            <button class="btn btn-custom-4 w-100 line-height-110 font-size-90 font-size-lg-100 font-size-xxl-110 py-3 font-size-xxl-120 neo-bold create-market-item-confirmation" style="border-radius:15px">SELL NOW</button>
                            @else
            <button class="btn btn-custom-17 w-100 line-height-110 font-size-90 font-size-lg-100 font-size-xxl-110 py-3 neo-bold" style="border-radius:15px" disabled>SOLD</button>
                             @endif
                        @endif
                    @endif
                @endif
            @endif
        </div>
        @endif
    </div>
    @endif
</div>
