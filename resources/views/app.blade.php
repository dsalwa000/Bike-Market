<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Używane rowery, nowe rowery, Scott, Cannondale, Trek, GT, KTM, Ghost, Author, Merida, Felt, Orbea, Canyon, Superior, Kross, Sprawdź!">
    <meta name="keywords" content="używane rowery, rowery, rower, Scott, Cannondale, Trek, GT, KTM, Ghost, Author, Merida, Felt, Orbea, Canyon, Superior, Kross">
    
    <title>BikeMarket</title>
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    {{-- for css --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Boostrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- css --}}
    <link rel="stylesheet" href={{ asset("css/390px.css") }}>
    <link rel="stylesheet" href={{ asset("css/768px.css") }}>
    <link rel="stylesheet" href={{ asset("css/1024px.css") }}>
    <link rel="stylesheet" href={{ asset("css/1440px.css") }}>
    <link rel="stylesheet" href={{ asset("css/1920px.css") }}>
    <link rel="stylesheet" href={{ asset("css/styles.css") }}>
    {{-- End css --}}


    {{-- Google fonts --}}

        {{-- Inter --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat&family=Raleway:wght@100&display=swap"
            rel="stylesheet">

        {{-- Epilogue --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">

        {{-- Open Sans --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    {{-- End Google Font --}}

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>

@yield('sketch')

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
{{-- End Bootstrap JS --}}

</body>
</html>
