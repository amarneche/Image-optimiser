<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Optimisze and compress JPEG PNG WebP photos and images</title>
    <meta name="twitter:title" content="Optimisze and compress JPEG PNG WebP photos and images ">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:type" content="website">
    <meta name="description" content="You need to improve your website perfomance by serving smaller well optimized pictures and images.
we offer you the perfect website to achieve that.">
    <meta property="og:image" content="{{ asset('img/featured_image.webp') }}">
    <meta name="twitter:image" content="{{ asset('img/featured_image.webp') }}">
    <link rel="icon" type="image/webp" sizes="512x512" href="{{ asset('img/favicon.webp') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body style="color: rgb(33, 37, 41);font-weight: normal;font-style: normal;font-family: Poppins, sans-serif;">
    @include('layouts.header')
    @yield('content')

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
