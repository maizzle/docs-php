<!DOCTYPE html>
<html lang="en" class="bg-white antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#000000">

    <title>{{ $page->is_home ? $page->title : $page->title . ' - Maizzle PHP Email Framework Documentation' }}</title>
    <meta name="description" content="{!! $page->description !!}">

    <meta name="theme-color" content="#ffffff">
    @yield('meta')

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Hind+Madurai:400,500&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    @stack('styles')
</head>

<body class="font-sans font-normal text-black leading-normal">

@yield('body')

@if ($page->production)
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123145832-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-123145832-1');
    </script>
@endif

@stack('scripts')

</body>
</html>
