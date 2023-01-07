@extends('layouts.app')

@section('title', 'Sales')
@section('og_title', 'Sales')
@section('og_image', asset('img/og/home.png'))

@section('content')
    <div class="container" style="margin-top:80px">
        <div class="pt-4 pb-5 mb-5">
            <h3 class="mb-4">Ownly NFT Sales</h3>

            <div class="row mt-3 mb-5">
                <div class="col-12 mb-3 mb-md-0">
                    <div class="card bg-color-1 h-100">
                        <div class="card-body pb-2">
                            <div class="d-flex flex-wrap align-items-end">
                                <div class="font-size-100 mb-3 me-3 pe-3" style="border-right:2px solid #333333">
                                    <select class="form-select font-size-120 py-1 neo-bold sales-date" id="periodical" style="background-color:rgba(0,0,0,0); max-width:150px">
                                        <option value="Annual">Annual</option>
                                        <option value="Quarterly">Quarterly</option>
                                        <option value="Monthly">Monthly</option>
                                    </select>
                                </div>

                                <div class="d-flex flex-wrap align-items-end mb-3">
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="font-size-90 pe-2">Year: </div>
                                        <select class="form-select font-size-70 py-1 sales-date me-3" id="sales-year" style="background-color:rgba(0,0,0,0)">
                                            <option value="2020">2020</option>
                                            <option value="2021" selected>2021</option>
                                        </select>
                                    </div>

                                    <div class="d-flex align-items-center mt-2 d-none">
                                        <div class="font-size-90 pe-2">Quarter: </div>
                                        <select class="form-select font-size-70 py-1 sales-date me-3" id="sales-quarter" style="background-color:rgba(0,0,0,0)">
                                            <option value="01">1st Quarter</option>
                                            <option value="04">2nd Quarter</option>
                                            <option value="07">3rd Quarter</option>
                                            <option value="10" selected>4th Quarter</option>
                                        </select>
                                    </div>

                                    <div class="d-flex align-items-center mt-2 d-none">
                                        <div class="font-size-90 pe-2">Month: </div>
                                        <select class="form-select font-size-70 py-1 sales-date me-3" id="sales-month" style="background-color:rgba(0,0,0,0)">
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>

                                    <div class="d-flex align-items-center mt-2">
                                        <a href="#" class="btn btn-custom-2 font-size-70 py-1" id="sales-button">Submit</a>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-0">

                            <div class="row w-100 mb-1">
                                <div class="col-sm-6 col-md-4 col-xl-3 d-flex align-items-center mb-2 pe-4 pe-xl-5">
                                    <div><img src="{{ asset('img/tokens/OWN.png') }}" class="pe-3" width="60" alt="OWN" /></div>
                                    <div class="font-size-160 font-size-lg-180 neo-bold" id="sales-own">{{ number_format($sales['sales_per_token']['own'],2) }}</div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-3 d-flex align-items-center mb-2 pe-4 pe-xl-5">
                                    <div><img src="{{ asset('img/tokens/ETH.png') }}" class="pe-3" width="60" alt="ETH" /></div>
                                    <div class="font-size-160 font-size-lg-180 neo-bold pe-1" id="sales-eth">{{ number_format($sales['sales_per_token']['eth'],2) }}</div>

                                </div>
                                <div class="col-sm-6 col-md-4 col-xl-3 d-flex align-items-center mb-2">
                                    <div><img src="{{ asset('img/tokens/BNB.png') }}" class="pe-3" width="60" alt="BNB" /></div>
                                    <div class="font-size-160 font-size-lg-180 neo-bold pe-1" id="sales-bnb">{{ number_format($sales['sales_per_token']['bnb'],2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5" id="sales-chart-container" data-graph="{{ json_encode($sales['graph']) }}">
                <canvas id="sales-chart" class="w-100" style="max-height:400px"></canvas>
            </div>

            <div class="table-responsive mb-2">
                <table class="table table-bordered table-striped font-size-80 font-size-md-90 font-size-xl-100">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Collection</th>
                            <th>Name</th>
                            <th>Token ID</th>
                            <th>Value</th>
                            <th>Transaction Hash</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales['pagination'] as $sale)
                        <tr>
                            <td class="align-middle" style="min-width:100px">{{ $sale['formatted_date'] }}</td>
                            <td class="align-middle">
                                <a class="link-color-4 text-decoration-none" href="{{ route('collection.index', $sale['collection']['url_placeholder']) }}">{{ $sale['collection']['name'] }}</a>
                            </td>
                             <td class="align-middle">
                                <a class="link-color-4 text-decoration-none" href="{{ route('token.index', [$sale['collection']['url_placeholder'], $sale['token_id']]) }}">{{ $sale['token']['name'] }}</a>
                            </td>
                            <td class="align-middle text-end">{{ $sale['token_id'] }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="pe-1">{{ number_format($sale['value'], 2) }}</div>
                                    <div class="pe-1"><img src="{{ asset('img/tokens/' . $sale['currency'] . '.png') }}" width="20" alt="{{ $sale['currency'] }}"></div>
                                    <div class="font-size-80">({{ $sale['currency'] }})</div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <a class="link-color-4 text-decoration-none" href="{{ $sale['collection']->blockchainExplorerLink() }}tx/{{ $sale['transaction_hash'] }}" target="_blank">{{ shortenAddress($sale['transaction_hash'], 5, 5) }}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center font-size-80" id="token-pagination">{{ $sales['pagination']->onEachSide(1)->links() }}</div>
        </div>
    </div>
@endsection
