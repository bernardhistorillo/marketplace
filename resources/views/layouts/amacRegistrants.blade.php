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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.0.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <title>Ownly Market</title>
</head>

<body>
    <div class="container pt-3 pb-5">
        <div class="font-size-150 neo-bold mt-4 mb-4 pb-2">AMAC Registrants</div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Organization</th>
                        <th>Shirt Size</th>
                        <th>Payment</th>
                        <th>Ticket Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($amacRegistrants as $i => $amacRegistrant)
                    <tr>
                        <td class="align-middle">{{ $amacRegistrant['firstname'] . ' ' . $amacRegistrant['lastname'] }}</td>
                        <td class="align-middle">{{ $amacRegistrant['contact_number'] }}</td>
                        <td class="align-middle">{{ $amacRegistrant['email'] }}</td>
                        <td class="align-middle">{{ $amacRegistrant['address'] }}</td>
                        <td class="align-middle">{{ $amacRegistrant['organization'] }}</td>
                        <td class="align-middle">{{ $amacRegistrant['shirt'] }}</td>
                        <td class="align-middle text-center">
                            <a href="{{ $amacRegistrant['payment'] }}" data-fancybox class="btn btn-sm btn-primary btn-sm px-2">View</a>
                        </td>
                        <td class="align-middle text-end" style="min-width:162px">
                            @if($amacRegistrant['is_validated'] == 0)
                            <button class="btn btn-sm btn-warning decline-registrant-confirm" value="{{ $amacRegistrant['id'] }}">Decline</button>
                            <button class="btn btn-sm btn-success approve-registrant-confirm" value="{{ $amacRegistrant['id'] }}">Approve</button>
                            @elseif($amacRegistrant['is_validated'] == -1)
                            Declined
                            @else
                            {{ str_pad($amacRegistrant['is_validated'], 3, "0", STR_PAD_LEFT) }}
                            @endif
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <input type="hidden" name="route_name" value="{{ Route::currentRouteName() }}" />

    @include('includes.modals')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
