<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--Favicon-->
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />
    <!-- Bootstrap 3.3.7 -->
    {{-- <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}"> --}}
    <style>
        .row{
            width: 100%;
            display: block;
        }
        .col-xs-4{
            width: 33.33%;
            float: left;
            display: block;
            margin: 5px 0px;
            page-break-inside: avoid;
            /* padding: 2px; */
        }
        .col-xs-3{
            width: 25%;
            float: left;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="">
        <div class="row">
            @for ($i = 0; $i < $quantity; $i++)
                <div class="col-xs-4">
                    <div class="text-center">
                        {{ $product['name']}} <br>
                        <center>
                            {!! DNS1D::getBarcodeHTML($product['code'], 'C128', '2.5', '30') !!}
                            {{-- {!! DNS1D::getBarcodeSVG($product['code'], 'CODE11'); !!} --}}
                        </center>
                        {{ $product['code'] }}
                    </div>
                </div>
            @endfor
        </div>
    </div>


    <script>
        window.print();
        window.onafterprint = function(){ window.close()};
    </script>
</body>
</html>
