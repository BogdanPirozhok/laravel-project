@extends('public.index')

@section('content')
    <main>
        @include('public.partials.body.page-heading', ['color_wave' => '#fff', 'background_color' => '#F1F2F9'])

        <section class="honor">
            <div class="wrapper">
                <h2>Нам есть чем гордиться</h2>
                <div class="honor__cont">
                    <div class="honor__box">
                        <span class="honor__title">25</span>
                        <span class="honor__text">лет на рынке</span>
                    </div>

                    <div class="honor__box">
                        <span class="honor__title">10 000</span>
                        <span class="honor__text">точек продаж в 7 регионах</span>
                    </div>

                    <div class="honor__box">
                        <span class="honor__title">150</span>
                        <span class="honor__text">видов рыбной продукции</span>
                    </div>

                    <div class="honor__box">
                        <span class="honor__title">200</span>
                        <span class="honor__text">сотрудников</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="parent-parallax">
            <div class="home__bg-img"></div>
        </div>

        <section class="our-production">
            <div class="wrapper">
                <div class="our-production__block">
                    <img src="{{ asset('/library/public/img/image-prod.svg') }}" alt="" class="our-production__img">
                    <div class="our-production__group">
                        <h2>Наша продукция</h2>
                        <span class="our-production__desription">Завтрак, снеки, отдых с друзьями, семейный обед или торжесвенный ужин, в ассортименте Делси легко найдется подходящий вкусный и полезный продукт. Мы всегда стараемся радовать своих покупателей вкусными и полезными новинками. </span>
                        <a href="/categories" class="btn-border blue">
                            Перейти в каталог
                        </a>
                    </div>
                </div>
            </div>
        </section>

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

        <section class="quality">
            <div class="wrapper">
                <div class="quality__cont">
                    <div class="quality__block">
                        <div class="quality__img">
                            <img class="quality__img--trimmed"
                                 src="{{ asset('/library/public/img/quality__img-1.jpg') }}" alt="">
                            <div class="quality__square"></div>
                        </div>

                        <div class="quality__text">
                            <h2>Высокие стандарты качества</h2>
                            <p class="quality__description">Благодаря тщательному отбору сырья и ингредиентов,
                                современному высокотехнологичному оборудованию и полному циклу производства, продукция
                                Делси соответствует самым высоким стандартам качества, что подтверждается сертификацией
                                HACCP и “Енисейский стандарт”, а также аудитами торговых сетей. Продукты Делси признаны
                                лучшими товарами Красноярского края в 2019 году в двух номинациях.</p>
                            <a href="/quality" class="btn-border blue">
                                Узнать подробнее
                            </a>
                        </div>
                    </div>

                    <div class="quality__brand">
                        <div class="quality__brand-img">
                            <img src="{{ asset('/library/public/img/quality__logo-1.png') }}" alt="">
                        </div>
                        <div class="quality__brand-img">
                            <img src="{{ asset('/library/public/img/quality__logo-2.png') }}" alt="">
                        </div>
                        <div class="quality__brand-img">
                            <img src="{{ asset('/library/public/img/quality__logo-3.svg') }}" alt="">
                        </div>
                        <div class="quality__brand-img quality__brand-img--190">
                            <img src="{{ asset('/library/public/img/quality__logo-4.png') }}" alt="">
                        </div>
                        <div class="quality__brand-img quality__brand-img--180">
                            <img src="{{ asset('/library/public/img/quality__logo-5.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="work-partnership">
            <div class="work-partnership__box">
                <span class="work-partnership__title">партнёрам</span>
                <img src="{{ asset('/library/public/img/icon-partnership.svg') }}" alt="" class="work-partnership__img">
                <h2>Работайте с нами!</h2>
                <p class="work-partnership__description">Удобное географическое расположение, современные технологии
                    производства, а также большой опыт делают сотрудничество с нашей компанией выгодным и надёжным.</p>
                <a href="/partnership" class="btn-text">
                    Перейти на страницу для партнёров
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M24 17H8" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M24 17L16 9" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M24 17L16 25" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="work-partnership__box">
                <span class="work-partnership__title">Соискателям</span>
                <img src="{{ asset('/library/public/img/icon-work.svg') }}" alt="" class="work-partnership__img">
                <h2>Работайте у нас!</h2>
                <p class="work-partnership__description">История компании - это не только рост объемов производства,
                    числа постоянных покупателей и узнаваемости бренда, но и история профессионального развития команды
                    Делси.</p>
                <a href="/work" class="btn-text">
                    Перейти на страницу вакансий
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M24 17H8" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M24 17L16 9" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M24 17L16 25" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </section>

        <section class="cook-delsy">
            <img src="{{ asset('/library/public/img/image-recipe.jpg') }}" alt="" class="cook-delsy__img-bg">
            <h2>Готовьте с Делси</h2>

            <a href="/recipes" class="btn-border white">
                смотреть рецепты
            </a>
        </section>

        <section class="contact contact--padding-178">
            <div class="wrapper">
                @include('public.partials.body.contact-info', ['contact_title' => 'Наши контакты'])


                <div class="contact__map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d71145.86585972089!2d93.37186800000002!3d56.134481!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdf400faaeeb244a6!2z0JTQtdC70YHQuA!5e0!3m2!1sru!2sua!4v1602060877083!5m2!1sru!2sua"
                        width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                        aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </section>
    </main>
@endsection
