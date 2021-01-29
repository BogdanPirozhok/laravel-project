@extends('public.index', ['title' => $title])

@section('head')
    @include('public.partials.meta')
@endsection

@section('content')
    <main>

        @include('public.partials.body.page-heading', ['color_wave' => '#fff', 'background_color' => '#F9EFE6', 'image_icon_url' => asset('/library/public/img/icon-quality.svg'), 'image_bg_color' => 'rgb(235, 202, 173)'])

        <div class="wrapper">
            <div class="quality__container">
                <div class="quality-block">
                    <div class="quality-block__text-box">
                        <span class="quality-block__description">Как без качественного сырья и без точного соблюдения технологий, так и без контроля качества на всех этапах производства, нет вкусной, натуральной и полезной продукции. И в компании «Делси» это понимают как нигде, а потому придерживаются современного подхода к производству продукции, ключевые условия которого – чистые, оснащенные современным оборудованием цеха и гарантированно свежая продукция.<br><br>Все сырье, направляемое в производство, проходит ветеринарно-санитарную экспертизу и лабораторный контроль в специализированных лабораториях. Для изготовления рыбной продукции, пресервов и полуфабрикатов используются только разрешенные ингредиенты от проверенных отечественных и мировых производителей с обязательным подтверждением их качества.<br><br>Вся продукция компании «Делси» подвергается всестороннему контролю по органолептическим, химическим и бактериологическим показателям. Отбор проб и проведение анализов осуществляют в строгом соответствии с ГОСТами на данные анализы. Таким образом, все продукты имеют декларации соответствия и сертификаты по итогам лабораторного контроля.</span>
                    </div>

                    <div class="quality-block__img-box center">
                        <img src="{{ asset('/library/public/img/quality-block__img-1.png') }}" alt="" class="quality-block__img">
                    </div>
                </div>

                <div class="quality-block">
                    <div class="quality-block__text-box">
                        <span class="quality-block__title">Система менеджмента безопасности пищевой промышленности (HASSP)</span>
                        <span class="quality-block__description">Для обеспечения безопасности пищевой продукции на предприятии Делси внедрена и  оддерживается система ХАССП (HASSP) согласно действующему на территории ЕАЭС техническому регламенту «О безопасности пищевой продукции».<br><br>Система менеджмента ИСО (ISO) 22000 (ХАССП) помогает оптимизировать работу всех процессов управления в компании, благодаря чему создаются условия, позволяющие контролировать качество выпускаемой продукции на всех стадиях и минимизировать возможность наступления нарушений, а в случае наступления эффективно устранять их.</span>
                    </div>

                    <div class="quality-block__img-box center">
                        <img src="{{ asset('/library/public/img/quality-block__img-2.png') }}" alt="" class="quality-block__img">
                    </div>
                </div>

                <div class="quality-block">
                    <div class="quality-block__text-box">
                        <span class="quality-block__title">Енисейский стандарт</span>
                        <span class="quality-block__description">Ассоциация сельхозпроизводителей, переработчиков и торговли Красноярского края «Енисейский стандарт» при поддержке краевых властей и с участием местных производителей разработала программу борьбы с продажей продуктов, фактическое содержание которых отличается от заявленного. Задача «Енисейского стандарта» сделать качественную продукцию заметной, и по возможности обезопасить покупателя от фальсификата. Продукция, прошедшая сертификацию, отмечена специальным знаком качества «Енисейского стандарта».</span>
                        <a href="#" class="quality-block__link" target="_blank">
                            Продукция Делси имеет 4 сертификата качества на разные категории продукции
                            <img src="{{ asset('/library/public/img/popout-outline.svg') }}" alt="">
                        </a>
                    </div>

                    <div class="quality-block__img-box top">
                        <img src="{{ asset('/library/public/img/quality-block__img-3.png') }}" alt="" class="quality-block__img">

                        <gallery-component
                            :items="certificates"
                            block="certificates"
                        ></gallery-component>


                    </div>
                </div>

                <div class="quality-block">
                    <div class="quality-block__text-box">
                        <span class="quality-block__title">Аудит торговых сетей</span>
                        <span class="quality-block__description">Крупные федеральные сети заключают договоры о покупке продукции только на основании серьезных аудитов производства и продукции. Делси успешно пройдены профессиональные аудиты для торговых сетей:</span>

                        <ul class="quality-block__ul">
                            <li class="quality-block__li">"МЕТРО Кэш энд Керри Россия" (METRO Cash & Carry Russia Ltd.)  компанией GFSI Global Markets Manufacturing Production Protocol</li>
                            <li class="quality-block__li">X5 Retail Group N.V. ФТС "Пятёрочка"</li>
                        </ul>
                    </div>

                    <div class="quality-block__img-box center">
                        <img src="{{ asset('/library/public/img/quality-block__img-4.png') }}" alt="" class="quality-block__img">
                    </div>
                </div>

                <div class="quality-block">
                    <div class="quality-block__text-box">
                        <span class="quality-block__title">Лучший продовольственный товар 2019</span>
                        <span class="quality-block__description">Дважды победитель в конкурсе Красноярского края “Лучший продовольственный товар 2019 года” в категориях “Продукция рыбная и из морепродуктов” и “Пресервы рыбные”</span>
                    </div>

                    <div class="quality-block__img-box top">
                        <img src="{{ asset('library/public/img/quality-block__img-5.png') }}" alt="" class="quality-block__img">

                        <gallery-component
                            :items="awards"
                            block="awards"
                        ></gallery-component>
                    </div>
                </div>
            </div>

            <div class="desing-block quality-questionnaire">
                <img src="{{ asset('/library/public/img/icon-form__questionnaire.svg') }}" alt="" class="desing-block__img">
                <div class="desing-block__box">
                    <span class="desing-block__title">Анкета о качестве продукции</span>
                    <span class="desing-block__desrciption">Помогите и дальше радовать Вас высоким качеством нашей продукции. Ответьте на несколько вопросов и поделитесь своим мнением о качестве продукции.</span>

                    <a href="/quality/form" class="btn-border blue">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.75 15H1V2.25H7.25V1.25H0V16H14.75V8.75H13.75V15Z"/>
                            <path d="M4.25 8.30078V11.7508H7.7L14.7 4.75078L15.95 3.50078L12.5 0.0507812L11.25 1.30078L4.25 8.30078ZM5.25 9.70078L6.3 10.7508H5.25V9.70078ZM7.5 10.5508L5.45 8.50078L11.25 2.70078L13.3 4.75078L7.5 10.5508ZM12.5 1.45078L14.55 3.50078L14 4.05078L11.95 2.00078L12.5 1.45078Z"/>
                        </svg>
                        Заполнить анкету
                    </a>
                </div>
            </div>

            <section class="contact-desing">
                <div class="contact-desing__left">
                    <div class="contact-desing__img contact-desing__img--fish">
                        <img src="{{ asset('/library/public/img/contact-fish.png') }}" alt="">
                    </div>
                </div>
                <div class="contact-desing__right">
                    <h2>Телефон службы качества</h2>

                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $body['qs']['phone']) }}" class="contact-desing__link intro">{{ $body['qs']['phone'] }}</a>
                    <span class="contact-desing__text--16">(звонок по России бесплатный)</span>
                </div>
            </section>
        </div>
    </main>
@endsection
