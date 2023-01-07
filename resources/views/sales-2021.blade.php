<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mustachios</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="container py-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>ETH</th>
                        <th>BNB</th>
                        <th>OWN</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Amount in Crypto</td>
                        <td>{{ $eth['amount'] }}</td>
                        <td>{{ $bnb['amount'] }}</td>
                        <td>{{ $own['amount'] }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Amount in USD</td>
                        <td>{{ $eth['usd'] }}</td>
                        <td>{{ $bnb['usd'] }}</td>
                        <td>{{ $own['usd'] }}</td>
                        <td>{{ $total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
