<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--Fevicon-->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/backend/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .login-page {
            margin-top: 5%;
        }

        .card {
            margin: 0 auto;
            width: 800px;
            min-height: 300px;
            border: 3px solid #fff;
            background: #eee;
            border-radius: 5px;
            padding: 10px;
        }

        .inner {
            padding: 25px 5px;
        }

        .inner h3 {
            text-align: center;
            font-size: 25px;
        }
    </style>
</head>

<body class="hold-transition login-page"
    style="background-image: url({{ url('public/img/login_bg.jpg') }});background-repeat: no-repeat;background-size: cover;">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($sections as $key => $section)
                        @if (Auth::user()->role_id == 1 ||
                            in_array(
                                $section->id,
                                Auth::user()->sections->pluck('section_id')->toArray(),
                            ))
                            <div class="col-lg-6 col-xs-6">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3> {{ $section->name }} </h3>
                                        <p class="text-center"> Dashboard </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="{{ route('go_to_dashboard', ['type' => $section->url_name]) }}"
                                        class="small-box-footer">
                                        Go to page <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="{{ asset('themes/backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('themes/backend/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function() {
            //
        });
    </script>
</body>

</html>
