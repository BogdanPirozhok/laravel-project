@extends('public.index', ['title' => $title])

@section('head')

    @include('public.partials.meta')


    <!-- google map-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvdUaEsv9GE9lfGm4VTukRrWI1KNRk2m4&language=ru®ion=RU">
    </script>
    <!-- google map markerclusterer-->
    <script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>
@endsection

@section('content')
    <main>

        @include('public.partials.body.page-heading', ['color_wave' => '#fff', 'background_color' => '#B8D8D8', 'image_bg_color' => 'rgb(137, 190, 190)', 'image_icon_url' => asset('/library/public/img/networks__mark.svg')])


        <div class="outlets">
            <div class="wrapper">
                <span class="networks__title">Торговые точки на карте</span>
            </div>

            <google-map/>
        </div>

        <div class="wrapper">
            <networks-component></networks-component>
        </div>
    </main>
@endsection
