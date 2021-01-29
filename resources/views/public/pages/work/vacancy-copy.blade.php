@extends('public.index')

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
                <span class="vacancy__main-title">Обработчик рыбы и морепродуктов (участок тиромат) <b>(от 20 000 руб.)</b></span>

                <div class="dashed"></div>

                <div class="vacancy__block">
                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Место работы:</span>
                        <span class="vacancy__text">г. Сосновоборск</span>
                    </div>
                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Тип занятости:</span>
                        <span class="vacancy__text">Полная занятость</span>
                    </div>
                </div>

                <div class="dashed"></div>

                <div class="vacancy__block">
                    <span class="vacancy__title">Требования к кандидату</span>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Образование:</span>
                        <span class="vacancy__text">—</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Требуемый опыт работы:</span>
                        <span class="vacancy__text">—</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Прохождение медицинского осмотра:</span>
                        <span class="vacancy__text">—</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Основные компетенции:</span>
                        <span class="vacancy__text">—</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Специальные навыки:</span>
                        <span class="vacancy__text">—</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Личные качества:</span>
                        <span class="vacancy__text">—</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Особые требования:</span>
                        <span class="vacancy__text">Отсутствие заболеваний опорно-двигательного аппарата, хорошее зрение</span>
                    </div>
                </div>

                <div class="dashed"></div>

                <div class="vacancy__block">
                    <span class="vacancy__title">Обязанности</span>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Трудовые функции:</span>
                        <span class="vacancy__text">Фасовка готового продукта в тару, взвешивание, протирка швов перед спайкой, наклейка этикеток, проверка качества швов, палетирование, упаковка в гофротару</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Наличие подчиненных:</span>
                        <span class="vacancy__text">Нет</span>
                    </div>
                </div>

                <div class="dashed"></div>

                <div class="vacancy__block">
                    <span class="vacancy__title">Предложение работодателя</span>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">График работы:</span>
                        <span class="vacancy__text">2 дня через 2, с 8.00 до 20.00, три перерыва для приема пищи и отдыха</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Характер работы:</span>
                        <span class="vacancy__text">Монотонность трудового процесса, работа в условиях повышенной физической нагрузки, работа в условиях повышенной ответственности за конечный результат</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Заработная плата:</span>
                        <span class="vacancy__text">От 20.000руб. с выплатами 2 раза в месяц на банковскую карту</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Испытательный срок:</span>
                        <span class="vacancy__text">3 месяца</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Наличие командировок:</span>
                        <span class="vacancy__text">Нет</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Обучение:</span>
                        <span class="vacancy__text">На рабочем месте путем прикрепления к наставнику из числа опытных работников</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Оснащенность рабочего места:</span>
                        <span class="vacancy__text">Оснащено необходимым инвентарем и материалами</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Спецодежда:</span>
                        <span class="vacancy__text">Выдается на заводе, стирается и дезинфицируется в заводской прачечной</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Доставка служебным транспортом:</span>
                        <span class="vacancy__text">Да</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Предоставление питания:</span>
                        <span class="vacancy__text">Горячее питание в заводской столовой</span>
                    </div>

                    <div class="vacancy__row">
                        <span class="vacancy__text vacancy__text--fw-500">Возможность карьерного роста:</span>
                        <span class="vacancy__text">Бригадир участка, мастер, начальник смены</span>
                    </div>
                </div>

                <div class="vacancy__group-btn">
                    <a href="/work" class="btn-text-prev">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" stroke="#1C2545">
                            <path d="M8 17H24" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8 17L16 9" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8 17L16 25" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        Вернуться на страницу вакансий
                    </a>
                    <button type="button" class="btn"
                        v-on:click="workModal = true"
                    >
                        Откликнуться
                    </button>
                </div>
            </div>
        </div>

        <template>
            <transition name="fade_15">
                <div class="overlay overlay__vacancy"
                    v-if="workModal"
                     v-on:click.self="workModal = false"
                >
                    <div class="work-modal">
                        <form action="#" method="post" class="work-form">
                            <span class="quality-form__main-title">Заполните анкету и не забудьте прикрепить резюме</span>

                            <div class="box-input">
                                <span class="box-input__title">Как к вам обращаться?</span>
                                <input type="text" class="box-input__input">
                                <span class="box-input__error">Текст для ошибки</span>
                            </div>

                            <div class="box-input">
                                <span class="box-input__title">Ваш email</span>
                                <input type="text" class="box-input__input">
                                <span class="box-input__error">Текст для ошибки</span>
                            </div>

                            <div class="box-input">
                                <span class="box-input__title">Укажите ваш телефон</span>
                                <input type="text" class="box-input__input">
                                <span class="box-input__error">Текст для ошибки</span>
                            </div>

                            <div class="box-input textarea">
                                <span class="box-input__title">Почему вы хотите работать на этой позиции?</span>
                                <textarea class="box-input__textarea"></textarea>
                                <span class="box-input__error">Текст для ошибки</span>
                            </div>

                            <label class="up-file">
                                <input type="file" class="upload-file__input">

                                <template>
                                    <svg class="upload-file__clip" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                        <path d="M15.1279 9.08251L15.0529 8.9769L7.906 1.42574C6.10677 -0.475248 3.18302 -0.475248 1.35881 1.42574C-0.465409 3.32673 -0.44042 6.44224 1.35881 8.34323L8.6057 16L9.3054 15.2607L2.05851 7.60396C1.3838 6.86469 1.00896 5.91419 1.00896 4.88449C1.00896 3.85479 1.3838 2.90429 2.05851 2.16502C3.4829 0.660066 5.78191 0.660066 7.18131 2.16502L13.1038 8.42244L14.3532 9.74257C15.2279 10.6667 15.2279 12.1716 14.3532 13.0957C13.9284 13.5446 13.3537 13.7822 12.7539 13.7822C12.1542 13.7822 11.5794 13.5446 11.1546 13.0957L4.00767 5.51815C3.83275 5.33333 3.75778 5.12211 3.75778 4.88449C3.75778 4.64686 3.85773 4.40924 4.03266 4.22442C4.35752 3.88119 4.90728 3.88119 5.25713 4.22442L12.4291 11.802L13.1288 11.0627L5.93184 3.45875C5.20716 2.69307 4.03266 2.69307 3.28298 3.48515C2.93313 3.85479 2.73322 4.35644 2.73322 4.88449C2.73322 5.41254 2.93313 5.91419 3.28298 6.28383L10.4549 13.8614C11.7294 15.2079 13.7785 15.2079 15.0529 13.8614C16.2774 12.5413 16.3274 10.429 15.1279 9.08251Z"/>
                                    </svg>
                                    <span class="up-file__text">Прикрепить резюме <b>(в форматах:  PDF, DOC, DOCX)</b></span>
                                </template>

                                <!--<template v-if="">
                                    <span class="preloader">
                                        <svg class="preloader__spinner" viewBox="0 0 66 66">
                                            <circle class="preloader__circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                                        </svg>
                                        <svg class="preloader__spinner-bg" viewBox="0 0 66 66">
                                            <circle class="preloader__circle-bg" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                                        </svg>
                                    </span>
                                </template>

                                <template>
                                    <svg class="upload-file__clip" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                        <path d="M15.1279 9.08251L15.0529 8.9769L7.906 1.42574C6.10677 -0.475248 3.18302 -0.475248 1.35881 1.42574C-0.465409 3.32673 -0.44042 6.44224 1.35881 8.34323L8.6057 16L9.3054 15.2607L2.05851 7.60396C1.3838 6.86469 1.00896 5.91419 1.00896 4.88449C1.00896 3.85479 1.3838 2.90429 2.05851 2.16502C3.4829 0.660066 5.78191 0.660066 7.18131 2.16502L13.1038 8.42244L14.3532 9.74257C15.2279 10.6667 15.2279 12.1716 14.3532 13.0957C13.9284 13.5446 13.3537 13.7822 12.7539 13.7822C12.1542 13.7822 11.5794 13.5446 11.1546 13.0957L4.00767 5.51815C3.83275 5.33333 3.75778 5.12211 3.75778 4.88449C3.75778 4.64686 3.85773 4.40924 4.03266 4.22442C4.35752 3.88119 4.90728 3.88119 5.25713 4.22442L12.4291 11.802L13.1288 11.0627L5.93184 3.45875C5.20716 2.69307 4.03266 2.69307 3.28298 3.48515C2.93313 3.85479 2.73322 4.35644 2.73322 4.88449C2.73322 5.41254 2.93313 5.91419 3.28298 6.28383L10.4549 13.8614C11.7294 15.2079 13.7785 15.2079 15.0529 13.8614C16.2774 12.5413 16.3274 10.429 15.1279 9.08251Z"/>
                                    </svg>
                                    <span class="up-file__text">Майборода-Александр Резюме.pdf</span>
                                </template>

                                <template>
                                    <img src="{{ asset('/library/public/img/up-file__close.svg') }}" alt="" class="up-file__error">
                                    <span class="up-file__text">Ошибка, попробуйде ещё раз.</span>
                                </template>-->
                            </label>

                            <label class="checked-circle">
                                <input type="checkbox" checked class="checked-circle__input">
                                <span class="checked-circle__mark"></span>
                                <span class="checked-circle__name">Я даю разрешение на <a href="#" class="work-form__link" target="_blank">обработку моих персональных данных</a></span>
                            </label>

                            <button type="submit" class="btn">Отправить анкету</button>
                        </form>
                    </div>

                    <div class="over__close"
                         v-on:click="workModal = false"
                    >
                        <svg width="357" height="357" viewBox="0 0 357 357" fill="white">
                            <path d="M357 35.7L321.3 0L178.5 142.8L35.7 0L0 35.7L142.8 178.5L0 321.3L35.7 357L178.5 214.2L321.3 357L357 321.3L214.2 178.5L357 35.7Z"/>
                        </svg>
                    </div>
                </div>
            </transition>
        </template>
    </main>
@endsection
