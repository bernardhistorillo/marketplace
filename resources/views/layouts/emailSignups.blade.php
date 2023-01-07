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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <title>Ownly Market</title>
</head>

<body>
    <div class="container pt-3 pb-5">
        <div class="font-size-150 neo-bold mt-4 mb-4 pb-2" id="meet-the-artist-text">Email Signups</div>

        <nav class="mb-4">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach($emailSignupTypes as $i => $emailSignupType)
                <button class="nav-link {{ ($i == 0) ? 'active' : '' }}" id="nav-{{ $i }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $i }}" type="button" role="tab" aria-controls="nav-{{ $i }}" {{ ($i == 0) ? 'aria-selected="true"' : '' }}>{{ strtoupper($emailSignupType) }}</button>
                @endforeach
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            @foreach($emailSignupTypes as $i => $emailSignupType)
            <div class="tab-pane fade {{ ($i == 0) ? 'show active' : '' }}" id="nav-{{ $i }}" role="tabpanel" aria-labelledby="nav-{{ $i }}-tab" tabindex="0">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Email</th>
                                <th>Data</th>
                                <th>Date &amp; Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emailSignups[$emailSignupType] as $j => $emailSignup)
                            <tr>
                                <td class="align-middle">{{ count($emailSignups[$emailSignupType]) - $j }}</td>
                                <td class="align-middle">{{ $emailSignup['email'] }}</td>
                                <td class="align-middle">{{ $emailSignup['data'] }}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($emailSignup['created_at'])->setTimezone('Asia/Manila')->isoFormat('llll') }}</td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <input type="hidden" name="route_name" value="{{ Route::currentRouteName() }}" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
