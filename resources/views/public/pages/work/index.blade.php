@extends('public.index', ['title' => $title])

@section('head')
    @include('public.partials.meta')

<script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
@endsection

@section('content')
    <main>
    @include('public.partials.body.page-heading', ['color_wave' => '#fff', 'background_color' => '#F9EFE6', 'image_bg_color' => 'rgb(235, 202, 173)', 'image_icon_url' => asset('/library/public/img/icon-anchor.svg')])

    <div class="wrapper">
        <slider-carousel
            :videos="{{ json_encode($body['video']) }}"
        >
            <template v-slot:title>
                Делси - продукция сделанная людьми для людей
            </template>

            <template v-slot:description>
                Наши сотрудники рассказывают о себе и своей работе в компании
            </template>
        </slider-carousel>

        <vacancies-component></vacancies-component>

        <div class="desing-block resume">
            <img src="{{ asset('/library/public/img/icon-resume.svg') }}" alt="" class="desing-block__img">
            <div class="desing-block__box">
                <span class="desing-block__title">Не нашли подходящую вакансию? Оставьте своё резюме!</span>


                <modal-component>
                    <template #container:title>
                        <span class="quality-form__main-title">Заполните анкету и не забудьте прикрепить резюме</span>
                    </template>
                    <template #container:body="{ handleModal }">
                        <vacancy-inquirer-form></vacancy-inquirer-form>

                        <div>
                            <div
                                class="over__close"
                                @click="handleModal"
                            >
                                <svg width="357" height="357" viewBox="0 0 357 357" fill="white">
                                    <path
                                        d="M357 35.7L321.3 0L178.5 142.8L35.7 0L0 35.7L142.8 178.5L0 321.3L35.7 357L178.5 214.2L321.3 357L357 321.3L214.2 178.5L357 35.7Z"/>
                                </svg>
                            </div>
                        </div>
                    </template>
                    <template #activator="{ handleModal }">

                        <label
                            class="upload-file"
                            @click="handleModal"
                        >
                            <template>
                                <svg class="upload-file__clip" width="16" height="16" viewBox="0 0 16 16"
                                     fill="currentColor">
                                    <path
                                        d="M15.1279 9.08251L15.0529 8.9769L7.906 1.42574C6.10677 -0.475248 3.18302 -0.475248 1.35881 1.42574C-0.465409 3.32673 -0.44042 6.44224 1.35881 8.34323L8.6057 16L9.3054 15.2607L2.05851 7.60396C1.3838 6.86469 1.00896 5.91419 1.00896 4.88449C1.00896 3.85479 1.3838 2.90429 2.05851 2.16502C3.4829 0.660066 5.78191 0.660066 7.18131 2.16502L13.1038 8.42244L14.3532 9.74257C15.2279 10.6667 15.2279 12.1716 14.3532 13.0957C13.9284 13.5446 13.3537 13.7822 12.7539 13.7822C12.1542 13.7822 11.5794 13.5446 11.1546 13.0957L4.00767 5.51815C3.83275 5.33333 3.75778 5.12211 3.75778 4.88449C3.75778 4.64686 3.85773 4.40924 4.03266 4.22442C4.35752 3.88119 4.90728 3.88119 5.25713 4.22442L12.4291 11.802L13.1288 11.0627L5.93184 3.45875C5.20716 2.69307 4.03266 2.69307 3.28298 3.48515C2.93313 3.85479 2.73322 4.35644 2.73322 4.88449C2.73322 5.41254 2.93313 5.91419 3.28298 6.28383L10.4549 13.8614C11.7294 15.2079 13.7785 15.2079 15.0529 13.8614C16.2774 12.5413 16.3274 10.429 15.1279 9.08251Z"/>
                                </svg>
                                <span class="upload-file__text">Прикрепить резюме</span>
                            </template>
                        </label>
                    </template>
                </modal-component>

            </div>
        </div>
    </div>

    <div class="more-about">
        <div class="wrapper">
            <div class="more-about__block">
                    <span class="more-about__title">
                        {{ $body['about_company']['title'] }}
                    </span>
                <span class="more-about__subtitle">
                        {{ $body['about_company']['sub_title'] }}
                    </span>

                @foreach($body['about_company']['buttons'] as $button)
                    <a href="{{ $button['url'] }}" class="btn-text">
                        {{ $button['title'] }}
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M24 17H8" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M24 17L16 9" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M24 17L16 25" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>

                @endforeach
            </div>
            <div class="more-about__img">
                <img src="{{ $body['about_company']['image_url'] }}" alt="">
            </div>
        </div>
    </div>

    <div class="wrapper">
        <section class="contact-desing">
            <div class="contact-desing__left">
                <div class="contact-desing__img">
                    <img src="{{ $body['hr']['photo'] }}" alt="">
                </div>
                <span class="contact-desing__name">
                    {{ $body['hr']['name'] }}
                </span>
                <span class="contact-desing__position">
                    {{ $body['hr']['position'] }}
                </span>
            </div>
            <div class="contact-desing__right">
                <h2>
                    {{ $body['hr']['title'] }}
                </h2>
                <span class="contact-desing__text">
                    {{ $body['hr']['sub_title'] }}
                </span>

                <a href="tel:{{ preg_replace('/[^0-9]/', '', $body['hr']['phone']) }}" class="contact-desing__link">
                    {{ $body['hr']['phone'] }}
                </a>
                <a href="mailto:{{ $body['hr']['email'] }}" class="contact-desing__link">
                    {{ $body['hr']['email'] }}
                </a>
            </div>
        </section>
    </div>
    </main>
@endsection
