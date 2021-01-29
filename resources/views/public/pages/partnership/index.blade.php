@extends('public.index', ['title' => $title])

@section('head')
    @include('public.partials.meta')
@endsection


@section('content')
    <main>

        @include('public.partials.body.page-heading', ['color_wave' => '#fff', 'background_color' => '#B8D8D8', 'image_icon_url' => asset('/library/public/img/icon-hero-partnership.svg'), 'image_bg_color' => 'rgb(137, 190, 190)'])

        <div class="honor">
            <div class="wrapper">
                <div class="honor__cont">
                    <div class="honor__box honor__box--width-312">
                        <span class="honor__title">3 000</span>
                        <span class="honor__text">квадратных метров производственных площадей завода</span>
                    </div>

                    <div class="honor__box honor__box--width-312">
                        <span class="honor__title">200</span>
                        <span class="honor__text">тонн сырья ежемесячно – производственная мощность завода</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div class="benefits">
                <span class="title--18-28">Преимущества сотрудничества</span>

                <div class="benefits__row">
                    <div class="benefits__img">
                        <img src="{{ asset('/library/public/img/benefists-partnership.svg') }}" alt="">
                    </div>
                    <div class="benefits__text">
                        <h2>Выгодный партнёр</h2>
                        <p class="benefits__description">Трафикообразующий товар – обновленная хорошо узнаваемая
                            упаковка и широкий ассортимент продуктов.<br><br>Рекомендованные товарные матрицы для
                            успешной продажи в торговых точках разного формата и разных каналов сбыта.<br><br>Предложение
                            для крупных торговых сетей и предприятий питания – производство под заказ СТМ на
                            индивидуальных условиях.</p>
                    </div>
                </div>

                <div class="benefits__row right">
                    <div class="benefits__text">
                        <h2>Хорошее местонахождение</h2>
                        <p class="benefits__description">Помимо прекрасных вкусовых качеств, сбалансированного
                            ассортимента и высокого качества продукции, важным преимуществом в ценообразовании Делси
                            является местонахождение завода - по сравнению с конкурентами мы ближе к местам вылова
                            основной части сырья и, одновременно, ко многим регионам продажи.</p>
                    </div>
                    <div class="benefits__img">
                        <img src="{{ asset('/library/public/img/benefists-map.svg') }}" alt="">
                    </div>
                </div>

                <div class="benefits__row">
                    <div class="benefits__img">
                        <img src="{{ asset('/library/public/img/benefists-lighthouse.svg') }}" alt="">
                    </div>
                    <div class="benefits__text">
                        <h2>Выгодный партнёр</h2>
                        <p class="benefits__description">Для роста узнаваемости и покупательского спроса, Делси
                            постоянно участвует в акциях торговых сетей и рекламных кампаниях:</p>
                        <ul class="recipe-ingredients__list">
                            <li class="recipe-ingredients__item">Ценовое промо</li>
                            <li class="recipe-ingredients__item">Масс-акции</li>
                            <li class="recipe-ingredients__item">Проведение дегустаций</li>
                            <li class="recipe-ingredients__item">Рекламная поддержка</li>
                            <li class="recipe-ingredients__item">Участие в выставках, ярмарках и форумах
                                производителей
                            </li>
                            <li class="recipe-ingredients__item">Активный Instagram и обновление web-сайта</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="map-delivery">
            <div class="wrapper">
                <div class="map-delivery__text">
                    <div class="map-delivery__box">
                        <span class="map-delivery__title">География поставок</span>
                        <p class="map-delivery__desription">Географическое положение и многолетний опыт позволяют
                            организовать быструю доставку свежей продукции в любой регион Сибири и Дальнего Востока.
                            Сегодня завод обеспечивает регулярные поставки на Алтай, в республики Бурятия, Тыва,
                            Хакасия, Красноярский край, Хабаровский край, Кемеровскую, Иркутскую, Томскую и
                            Новосибирскую области. </p>
                    </div>

                    <div class="map-delivery__box">
                        <span class="map-delivery__title">Собственная доставка и контроль продукции</span>
                        <p class="map-delivery__desription">Максимально короткий срок от производства до появления на
                            полке магазина. Из-за минимального содержания консервантов продукция Делси очень
                            чувствительна к внешним условиям и не предназначена для длительного хранения, поэтому мы
                            лично проверяем соблюдение температурного режима в местах продажи и в процессе доставки
                            благодаря постоянному мониторингу.</p>
                    </div>
                </div>

                <img src="{{ asset('/library/public/img/map-delivery.svg') }}" alt="" class="map-delivery__img">
            </div>
        </div>

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


            <slider-technology></slider-technology>

            <div class="goto-product">
                <img src="{{ asset('/library/public/img/image-fish-hook.png') }}" alt="" class="goto-product__img">

                <div class="goto-product__box">
                    <h2>Ознакомьтесь с нашей продукцией</h2>
                    <span class="goto-product__description">Перейдите на страницу каталога и воспользуйтесь удобными фильтрами, либо заполните небольшую анкету и скачайте каталог в удобном формате</span>

                    <div class="goto-product__group-btn">
                        <a href="/categories" class="btn">
                            Посмотреть каталог
                        </a>
                        <a href="/partnership/form" class="btn-border blue">
                            Получить каталог
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
