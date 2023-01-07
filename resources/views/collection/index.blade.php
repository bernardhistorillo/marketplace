@extends('layouts.app')

@section('title', $collection['name'])
@section('og_title', $collection['name'])
@section('og_image', asset('img/og/' . $collection['url_placeholder'] . '.png'))

@section('content')
    @include('collection.header')

    <div class="bg-color-18 position-relative">
        <div class="position-absolute" id="collection-tokens-top" style="top:-80px; left:0"></div>

        @if($collection['url_placeholder'] == 'titansofindustry')
        <div class="bg-color-6 font-size-100 font-size-md-120 collection-section" data-collection="titans-of-industry">
            <div class="container text-white text-center py-3">GET 20% DISCOUNT ON PURCHASES USING OWN TOKEN AS PAYMENT ON NEWLY MINTED TITANS OF INDUSTRY NFTS</div>
        </div>
        @endif

        <div class="container pt-4 pb-5">
            <div class="text-end px-md-3" id="view-options-container">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-custom-13 d-flex align-items-center" id="filter-by-properties" data-collection="{{ $collection['url_placeholder'] }}" style="height:47.2px" data-bs-toggle="collapse" data-bs-target="#collapse-properties" aria-expanded="false" aria-controls="collapse-properties">
                        <i class="fas fa-filter font-size-130 pe-2 "></i>
                        <span class="font-size-90">Filter by Properties</span>
                        <span class="badge bg-color-3 ms-2" id="property-filter-count"></span>
                    </button>
                </div>

                <div class="btn-group ps-2" role="group">
                    <button type="button" class="btn btn-custom-13 font-size-90 border-end-0" id="view-options" style="opacity:1; background-color:rgba(0,0,0,0); cursor:default" data-url="{{ route('collection.updateViewOption') }}">View Options:</button>
                    <button type="button" class="btn btn-custom-13 font-size-130 border-end-0 change-token-view {{ (session()->has('collection_view') && session()->get('collection_view') == 'large-grid') ? 'active' : '' }}" value="large-grid" data-bs-toggle="tooltip" title="Large Grid">
                        <i class="fas fa-grid-2"></i>
                    </button>
                    <button type="button" class="btn btn-custom-13 font-size-130 change-token-view {{ (!session()->has('collection_view') || (session()->has('collection_view') && session()->get('collection_view') == 'small-grid')) ? 'active' : '' }}" value="small-grid" data-bs-toggle="tooltip" title="Small Grid">
                        <i class="fas fa-grid"></i>
                    </button>
                </div>
            </div>

            <div class="px-md-3 collapse {{ count($filters) > 0 ? 'show' : '' }}" id="collapse-properties">
                <div class="card shadow-sm bg-color-18 mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="fw-bold text-color-5 pe-4">Properties</div>
                            <div class="text-color-7 px-2 cursor-pointer" data-bs-toggle="collapse" data-bs-target="#collapse-properties" aria-expanded="false" aria-controls="collapse-properties">
                                <i class="fas fa-times font-size-120"></i>
                            </div>
                        </div>

                        <hr>

                        <div class="row" id="property-filter-items">
                            @foreach($properties as $i => $property)
                                <div class="col-6 col-sm-4 col-md-3 col-xl-2 mb-3">
                                    <div class="text-color-5 font-size-90 px-1 mb-2">{{ $i }}</div>
                                    <div class="px-1" style="max-height:130px; overflow-y:scroll">

                                    @foreach($property as $j => $value)
                                        @php $isSelected = false; @endphp
                                        @foreach($filters as $filter)
                                            @if($i == $filter['property'] && $j == $filter['value'])
                                                @php $isSelected = true; @endphp
                                            @endif
                                        @endforeach
                                    <div class="form-check form-switch">
                                        <input class="form-check-input property-filter-item" type="checkbox" role="switch" id="{{ $i }}-{{ $j }}" data-property="{{ $i }}" data-value="{{ $j }}" {{ ($isSelected) ? 'checked' : '' }}>
                                        <label class="form-check-label font-size-80" for="{{ $i }}-{{ $j }}" style="margin-top:5px">{{ $j }} ({{ $value }})</label>
                                    </div>
                                    @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr class="mt-0">

                        <div class="d-flex flex-wrap" id="property-filter-selected-items">
                            @foreach($filters as $filter)
                            <div class="property-filter-selected-item d-flex align-items-center font-size-90 ps-4 pe-2 py-2 me-2 mb-2">
                                <div class="pe-2">{{ $filter['property'] }}:</div>
                                <div class="fw-bold">{{ $filter['value'] }}</div>
                                <div class="px-3 cursor-pointer remove-property-filter-selected-item" data-property="{{ $filter['property'] }}" data-value="{{ $filter['value'] }}">
                                    <i class="fas fa-times font-size-120"></i>
                                </div>
                            </div>
                            @endforeach

                            <div class="text-color-7 font-size-90 {{ (count($filters) > 0) ? 'd-none' : '' }}" id="no-selected-filters">No selected filters</div>
                        </div>

                        <hr>

                        <div class="">
                            <button class="btn btn-custom-4 btn-sm px-4 me-2 d-none" id="reset-property-filters" style="width:132px">Reset Filters</button>
                            <button class="btn btn-custom-1 btn-sm px-4" style="width:132px" data-bs-toggle="collapse" data-bs-target="#collapse-properties" aria-expanded="false" aria-controls="collapse-properties">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="position-relative d-none" id="collection-loading" style="margin:160px 0 0 0">
                <div id="loader"></div>

                <div class="position-absolute" style="top:50%; left:50%; margin-top:-35px; margin-left:-35px">
                    <img src="{{ asset('img/ownly/own-token.png') }}" width="70" />
                </div>
            </div>

            <div class="row mt-4" id="token-cards-container" data-url="{{ route('collection.getTokens', $collection['url_placeholder']) }}">
                @include('collection.tokenCards')
            </div>
        </div>

        @if($collection['url_placeholder'] != 'rewards' && $collection['url_placeholder'] != 'rascals')
            @include('collection.aboutTheArtist')
        @endif

        @if($collection['url_placeholder'] == 'pathfinders2d')
        <div class="bg-white py-5">
            <div class="container pt-3 pb-5">
                <div class="font-size-150 neo-bold mb-4 pb-2" id="meet-the-artist-text">RARITY CHART</div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="rarity-table">
                        <thead>
                        <tr>
                            <th class="text-center">Rank</th>
                            <th class="text-center">Token</th>
                            <th class="text-center">Percentage</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($rarities as $i => $rarity)
                            <tr>
                                <td class="align-middle text-center">{{ $i + 1 }}</td>
                                <td class="align-middle token-name">
                                    <div class="d-flex align-items-center">
                                        <div class="background-image-cover" style="width:50px; height:50px; background-position:0 0; border-radius:50%; background-image:url('{{ $rarity['thumbnail'] }}')"></div>
                                        <div class="flex-fill ps-3">
                                            <div class="mb-1">{{ $rarity['name'] }}</div>
                                            <div class="font-size-70">Token ID: {{ $rarity['token_id'] }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">{{ number_format($rarity['rarity_percentage'], 2) }}%</td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-custom-2 font-size-80 view-token-properties" data-properties="{{ json_encode($rarity['properties']) }}">Properties</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
