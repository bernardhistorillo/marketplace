<div class="{{ (session()->has('collection_view') && session()->get('collection_view') == 'large-grid') ? 'col-sm-6 col-xl-4' : 'col-6 col-sm-4 col-xl-3 font-size-80' }} mb-5 pb-md-3 px-lg-4 token-item">
    <div class="token-card">
        @if($token['collection']['url_placeholder'] == 'pathfinders3d' || ($token['collection']['url_placeholder'] == 'marauders' && ($token['token_id'] <= 175 || in_array($token['token_id'], [177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,201,250,251,252,254,255,258,260,261,286,298]))))
        <div class="w-100 shadow-sm border-1 position-relative skeleton-loading mb-3" style="padding-top:100%; border:1px solid #cccccc; background-color:rgba(0,0,0,0.01); border-radius:10px">
            @if($token['collection']['url_placeholder'] == 'marauders')
            <div class="position-absolute" style="bottom:0; left:0; width:22%; z-index:1">
                <a href="{{ $token->thumbnail()['webp512'] }}" data-fancybox>
                    <img src="{{ $token->thumbnail()['webp256'] }}?v=1" class="w-100" alt="{{ $token['name'] }}" style="border-radius:0 10px 0 10px" />
                </a>
            </div>
            @endif

            <a href="{{ route('token.index', [($token['collection']['url_placeholder']) ?? $token['collection']['contract_address'], $token['token_id']]) }}" class="text-decoration-none">
                <div class="d-flex justify-content-center align-items-center w-100 h-100" style="position:absolute; top:0; left:0">
                    <video autoplay loop muted preload class="w-100 h-100" style="border-radius:10px"><source src="{{ asset('img/collections/mustachios/3d/' . $token['token_id'] . '.mp4?v=1') }}" type="video/mp4"></video>
                </div>
            </a>
        </div>
        @else
        <a href="{{ route('token.index', [($token['collection']['url_placeholder']) ?? $token['collection']['contract_address'], $token['token_id']]) }}" class="link token-image-link">
            @if(str_contains($token->thumbnail()['original'], '.mp4'))
            <div class="w-100 shadow-sm border-1 position-relative skeleton-loading mb-3" style="padding-top:100%; border:1px solid #cccccc; background-color:rgba(0,0,0,0.01); border-radius:10px">
                <div class="d-flex justify-content-center align-items-center w-100 h-100" style="position:absolute; top:0; left:0">
                    <div>
                        <video autoplay loop muted preload class="w-100" style="border-radius:10px"><source src="{{ $token->thumbnail()['original'] }}" type="video/mp4"></video>
                    </div>
                </div>
            </div>
            @else
            <div class="w-100 background-image-contain token-image shadow-sm border-1 mb-3" style="background-image:url('{{ (isset($token->thumbnail()['webp512'])) ? $token->thumbnail()['webp512'] : $token->thumbnail()['gif'] }}'); padding-top:100%; border:1px solid #cccccc; background-color:rgba(0,0,0,0.01); border-radius:10px"></div>
            @endif
        </a>
        @endif
        <div class="d-flex flex-column justify-content-between h-100 token-header">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center mb-1" style="min-height:61px">
                    <a href="{{ route('token.index', [($token['collection']['url_placeholder']) ?? $token['collection']['contract_address'], $token['token_id']]) }}" class="font-size-160 neo-bold token-name link-color-4 text-decoration-none">{{ $token['name'] }}</a>
                </div>
                <div class="d-flex align-items-center py-1 ps-3 add-to-favorites-container">
                    <div class="">
                        <button class="btn add-to-favorites p-0 m-0" data-contract-address="{{ $token['collection']['contract_address'] }}" data-token-id="{{ $token['token_id'] }}" data-status="0" data-message="{{ config('ownly.add_to_favorites_message') }}" data-url="{{ route('token.updateFavoriteStatus') }}" style="width:24px; height:24px; border-radius:50%; box-shadow: none; border:0" disabled>
                            <i class="far fa-heart font-size-140 text-color-1"></i>
                        </button>
                    </div>
                    <div class="ps-2 font-size-90 text-color-1 favorites-count">{{ $token->favoriteCount() }}</div>
                </div>
            </div>
        </div>
        <div class="token-body">
            <div class="font-size-110 mb-2 pb-1">{{ ($token['supply'] || $token['supply'] == 1) ? '1 of 1 - Single Edition' : 'Multiple Editions' }}</div>
            <div class="font-size-90 mb-4 token-description-truncated overflow-hidden" style="{{ (session()->has('collection_view') && session()->get('collection_view') == 'large-grid') ? 'min-height:51px; max-height:51px' : 'min-height:43px; max-height:43px' }}">{{ $token['description'] }}</div>
        </div>

        <div class="token-action-buttons">
            <form class="collection-token-form d-none" action="{{ route('token.getTokenActionButtons') }}">
                <input type="hidden" name="token" value="{{ $token['id'] }}" />
                <input type="hidden" name="address" />
            </form>

            <div class="row align-items-center" style="min-height:69px">
                <div class="col-6 px-2">
                    <div class="w-100 skeleton-loading" style="height:50px"></div>
                </div>
                <div class="col-6 px-2">
                    <div class="w-100 skeleton-loading" style="height:50px"></div>
                </div>
            </div>
        </div>
    </div>
</div>
