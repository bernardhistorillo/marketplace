<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mustachios</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row mt-4">
                @foreach($mustachios as $mustachio)
                <div class="col-6 col-md-4 col-xl-3 pb-4" style="min-height:100%">
                    <div class="card h-100 mb-4">
                        <div class="card-body">
                            <img src="{{ $mustachio['thumbnail'] }}" class="w-100" />
                        </div>
                        <div class="card-footer fw-bold">{{ $mustachio['name'] }}</div>
                        <div class="card-footer fs-6" style="height:100%">{{ $mustachio['description'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
