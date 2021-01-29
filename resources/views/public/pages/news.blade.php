@extends('public.index', ['title' => $title])


@section('head')
    @include('public.partials.meta')

@endsection

@section('content')
    <main>
        <news-component></news-component>
    </main>
@endsection
