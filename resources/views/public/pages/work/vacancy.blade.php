@extends('public.index')

@section('head')
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
    </script>
@endsection


@section('content')
    <main>
        <div class="wrapper">
            <div class="bread-crumbs">
                <a href="/" class="bread-crumbs__text">Главная</a>
                <a href="/work" class="bread-crumbs__text">Работа</a>
                <a href="#" class="bread-crumbs__text active">Вакансия</a>
            </div>
        </div>

        <div class="wrapper wrapper--w-848">
            <div class="vacancy">
                <img src="{{ asset('/library/public/img/logo-vacancy.svg') }}" alt="" class="vacancy__logo">
                <span class="vacancy__main-title">{{$data->name}} <b>({{$data->payment}})</b></span>

                <div class="dashed"></div>

                <div class="vacancy__block">
                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Место работы:</span>
                        <span class="vacancy__text">{{$data->city}}</span>
                    </div>
                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Тип занятости:</span>
                        <span class="vacancy__text">{{$data->employment_type}}<span>
                    </div>
                </div>

                <div class="dashed"></div>

                {!! $html !!}

                <div class="vacancy__group-btn">
                    <a href="/work" class="btn-text-prev">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" stroke="#1C2545">
                            <path d="M8 17H24" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8 17L16 9" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8 17L16 25" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        Вернуться на страницу вакансий
                    </a>

                    <modal-component>
                        <template #container:title>
                            <span class="quality-form__main-title">Заполните анкету и не забудьте прикрепить резюме</span>
                        </template>
                        <template #container:body="{ handleModal }">
                            <vacancy-inquirer-form :vacancy_id="{{$data->id}}"></vacancy-inquirer-form>

                            <div>
                                <div
                                    class="over__close"
                                    @click="handleModal"
                                >
                                    <svg width="357" height="357" viewBox="0 0 357 357" fill="white">
                                        <path d="M357 35.7L321.3 0L178.5 142.8L35.7 0L0 35.7L142.8 178.5L0 321.3L35.7 357L178.5 214.2L321.3 357L357 321.3L214.2 178.5L357 35.7Z"/>
                                    </svg>
                                </div>
                            </div>
                        </template>
                        <template #activator="{ handleModal }">

                            <button
                                type="button"
                                class="btn"
                                @click="handleModal"
                            >
                                Откликнуться
                            </button>
                        </template>
                    </modal-component>


                </div>
            </div>
        </div>
    </main>
@endsection
