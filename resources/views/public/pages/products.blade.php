@extends('public.index')

@section('content')
    <main>
        @include('public.partials.body.page-heading', ['color_wave' => '#fff', 'background_color' => '#E9ECF6', 'image_bg_color' => 'rgb(197, 204, 231)', 'image_icon_url' => asset('/library/img/fish-icon.svg')])

        <catalog-component></catalog-component>
    </main>
@endsection
