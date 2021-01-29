@extends('public.index')

@section('head')
    @include('public.partials.meta')
@endsection

@section('content')

    @if(isset($body['header']))
        @include('public.partials.body.page-heading', [
            'color_wave' => '#fff',
            'background_color' => '#F1F2F9',
            'image_bg_color' => 'rgb(197, 204, 231)',
            ])
    @endif


    <main style="min-height: 100vh">

        <div class="wrapper ck-editor">
            {!! $body['html'] !!}
        </div>
    </main>
@endsection
