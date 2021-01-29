@extends('public.index', ['title' => $title])

@section('head')
    @include('public.partials.meta')

    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
@endsection

@section('content')
    <main class="contact__bg">

        @include('public.partials.body.page-heading', ['color_wave' => '#F1F2F9', 'background_color' => 'rgb(255, 255, 255)', 'image_bg_color' => 'rgb(197, 204, 231)', 'image_icon_url' => asset('/library/public/img/wave-blue.svg'), 'fish' => true])


        <section class="contact contact--padding-128">
            <div class="wrapper">
                @include('public.partials.body.contact-info', ['contact_title' => 'Предприятие на карте'])

                <div class="contact__map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d71145.86585972089!2d93.37186800000002!3d56.134481!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdf400faaeeb244a6!2z0JTQtdC70YHQuA!5e0!3m2!1sru!2sua!4v1602060877083!5m2!1sru!2sua" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </section>

        <div class="wrapper">
            <section class="have-questions">
                <div class="have-questions__left">
                    <h2>Остались вопросы? Заполните форму и мы с Вами свяжемся</h2>
                </div>
                <contact-form/>
            </section>
        </div>
    </main>
@endsection
