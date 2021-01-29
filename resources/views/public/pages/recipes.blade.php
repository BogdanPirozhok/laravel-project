@extends('public.index', ['title' => $title])

@section('head')
    @include('public.partials.meta')
@endsection


@section('content')
    <main>
        @include('public.partials.body.page-heading', ['color_wave' => '#fff', 'background_color' => '#B8D8D8', 'image_bg_color' => 'rgb(137, 190, 190)', 'image_icon_url' => asset('/library/img/icon-cook.svg')])

        <recipes-component></recipes-component>
    </main>
@endsection
