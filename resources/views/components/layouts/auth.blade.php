<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="favicon icon" href="{{
        $settings->getFirstMediaUrl('favicon') != '' ? $settings->getFirstMediaUrl('favicon') : asset('img/favicon.ico')
    }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    {{ $styles ?? '' }}
</head>

<body class="d-flex flex-column" x-data>
    <div class="page">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        {{ $slot ?? '' }}
                    </div>
                </div>
                @if(isset($image))
                    <div class="col-lg d-none d-lg-block">
                        {{ $image ?? '' }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @livewireScripts
    {{ $scripts ?? '' }}
</body>
</html>
