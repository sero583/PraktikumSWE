<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Code Academy</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <!-- React root DOM -->
    <div id="app">
    </div>

    <!-- React JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
