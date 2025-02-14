<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="favicon icon" href="{{ asset('img/favicon.ico') }}" />
    <title>
        {{ $settings->name }} - {{ $title ?? '' }}
    </title>
    <!-- CSS files -->
    <x-styles />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{ $styles ?? '' }}
</head>

<body x-data>
    <div class="page">
        <!-- Navigation Bar -->
        <x-navigation />
        <div class="page-wrapper">
            <!-- Page header -->
            <x-header title="{{ $pageTitle ?? '' }}" />
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            <!-- Page footer -->
            <x-footer />
        </div>
    </div>
    <x-javascript />
    {{ $scripts ?? '' }}
</body>

</html>
