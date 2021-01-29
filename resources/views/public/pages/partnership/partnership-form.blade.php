@extends('public.index')

@section('head')
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
    </script>
@endsection

@section('content')
    <main class="quality-form__bg">
        <div class="wrapper">
            <div class="bread-crumbs">
                <a href="/" class="bread-crumbs__text">Главная</a>
                <a href="/partnership" class="bread-crumbs__text">Партнёрам</a>
                <a href="#" class="bread-crumbs__text active">Получить каталог</a>
            </div>
        </div>

        <div class="wrapper wrapper--w-848">
            <catalog-request-form></catalog-request-form>
        </div>
    </main>
@endsection
