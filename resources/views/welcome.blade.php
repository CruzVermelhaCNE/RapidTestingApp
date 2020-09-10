<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Laravel</title>

    <!-- Fonts -->
    <link href="{{mix('css/app.css')}}" rel="stylesheet">
</head>

<body class="antialiased">
    <noscript>
        <strong>We're sorry but this application doesn't work properly without JavaScript enabled.
            Please enable it to continue.</strong>
    </noscript>
    <div id="app"></div>
    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
</body>

</html>