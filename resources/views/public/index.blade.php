<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/library/public/icons/favicon.ico') }}" rel="icon"/>
    <link href="{{ asset('/library/public/icons/16x16.png') }}" rel="icon" type="image/png" sizes="16x16">
    <link href="{{ asset('/library/public/icons/32x32.png') }}" rel="icon" type="image/png" sizes="32x32">
    <link href="{{ asset('/library/public/icons/48x48.png') }}" rel="icon" type="image/png" sizes="48x48">
    <link rel="manifest" href="{{ asset('/library/public/icons/manifest.json') }}">

    <title>Delsy {{ isset($title) ? '| ' . $title : ''}}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('/library/public/css/fonts.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ mix('/assets/css/public/app.css') }}"/>

    @yield('head')
</head>
<body>
<div id="app">

{{--    <header-item--}}
{{--        :scroll="offsetTop"--}}
{{--    ></header-item>--}}
    @include('public.partials.header')

    @yield('content')

    <footer class="footer">
        <div class="wrapper">

            @include('public.partials.footer')

            <div class="footer__bottom">
                <span class="footer__copyright">Делси © 2020</span>
            </div>
        </div>

        <waves
            class="wave--top"
            style="margin-top: 2px"
            :color-wave="'#1C2034'"
            :id="'in_header'"
        ></waves>
    </footer>

    <a
        href="#"
        class="scroll-top is-anchor"
        :class="{ 'active': offsetTop >= screenHeight * 2.5 }"
    ></a>

    <transition name="loader">
        <div class="loader"
             v-show="isLoading.show"
             :class="{'is-catalog': isLoading.complete}"
        >
            <img src="{{ asset('library/public/img/loader-fish.svg') }}" alt="" class="loader__img">
        </div>
    </transition>

</div>
<script>
    const response = @json($response ?? []);
    const body = @json($body ?? []);
</script>

<script src="{{ mix('assets/js/public/app.js') }}"></script>
@yield('script')

</body>
</html>
