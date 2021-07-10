<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Map</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <style>
        .geocoder {
            position: absolute;
            top: 55px;
            left: 38px;
            text-align: left;
            font-family: "Arial";
            margin: 0;
            font-size: 13px;
        }

        #instructions {
            position: absolute;
            height: 500px;
            margin-top: 20px;
            width: 25%;
            top: 22px;
            bottom: 0;
            padding: 20px;
            padding-top: 50px;
            background-color: rgba(255, 255, 255, 0.5);
            overflow-y: scroll;
            font-family: sans-serif;
        }

        #info {
            display: block;
            position: absolute;
            margin: 0px auto;
            width: 30%;
            padding: 5px;
            top:0;
            left: 450px;
            border: none;
            border-radius: 3px;
            font-size: 12px;
            text-align: center;
            color: #222;
            background-color: rgba(255, 255, 255, 0.5);
        }
        #back{
            position: absolute;
            top:0;
            left: 0;
            width: 25%;
            background-color: rgba(255, 255, 255, 0.5);
            color: white;
        }

    </style>
    
    <div id="app">
        @yield('content')
    </div>
    <pre id="info"></pre>
    <div class="geocoder">
        <div id="geocoder"></div>
    </div>
    <div id="instructions">
        <div id="calculated-line"></div>
    </div>
    <a href="/home" id="back" class="btn"><i class="fa fa-arrow-circle-left" style="font-size:24px; color: black;"></i></a>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}" defer></script>
</body>

</html>
