@extends('public.index', ['title' => $title])

@section('head')
    @include('public.partials.meta')
@endsection

@section('content')
    <main>

        @include('public.partials.body.page-heading', ['color_wave' => '#fff', 'background_color' => '#F1F2F9', 'image_bg_color' => 'rgb(197, 204, 231)', 'image_icon_url' => asset('/library/public/img/wave__about.svg'), 'fish' => true])

        <div class="honor about-honor">
            <div class="wrapper">
                <div class="honor__cont">
                    <div class="honor__box">
                        <span class="honor__title">25</span>
                        <span class="honor__text">лет на рынке</span>
                    </div>

                    <div class="honor__box">
                        <span class="honor__title">10 000</span>
                        <span class="honor__text">точек продаж</span>
                    </div>

                    <div class="honor__box">
                        <span class="honor__title">150</span>
                        <span class="honor__text">видов рыбной продукции</span>
                    </div>

                    <div class="honor__box">
                        <span class="honor__title">200</span>
                        <span class="honor__text">сотрудников</span>
                    </div>

                    <div class="honor__box">
                        <span class="honor__title">3000</span>
                        <span class="honor__text">квадратных метров производственных площадей</span>
                    </div>

                    <div class="honor__box">
                        <span class="honor__title">200</span>
                        <span class="honor__text">тонн сырья ежемесячно – производственная мощность</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="our-mission">
            <div class="wrapper">
                <div class="our-mission__left">
                    <span class="title--18-28">Наша миссия</span>
                    <img src="{{ asset('library/public/img/our-mission__boat.svg') }}" alt="" class="our-mission__img">
                    <span class="our-mission__subtitle">Современное производство рыбной продукции, которая соответствует самым высоким требованиям к качеству и вкусу, что дает возможность:</span>
                </div>
                <div class="our-mission__right">
                    <div class="our-mission__box">
                        <span class="our-mission__title">Обществу</span>
                        <span class="our-mission__test">Повышать качество жизни людей через высокие стандарты вкуса и качества продукции Делси и социальную ответственность бизнеса</span>
                    </div>

                    <div class="our-mission__box">
                        <span class="our-mission__title">Потребителям</span>
                        <span class="our-mission__test">Получать удовольствие от каждой покупки продукции Делси. </span>
                    </div>

                    <div class="our-mission__box">
                        <span class="our-mission__title">Партнерам</span>
                        <span class="our-mission__test">Строить честные, взаимовыгодные и долгосрочные отношения</span>
                    </div>

                    <div class="our-mission__box">
                        <span class="our-mission__title">Сотрудникам</span>
                        <span class="our-mission__test">Постоянно развиваться, быть частью профессиональной команды единомышленников, своим личным трудом и инициативой участвовать в создании качественного продукта, достигать новых высот в своей профессии и получать достойную оценку личного вклада</span>
                    </div>

                    <div class="our-mission__box">
                        <span class="our-mission__title">Акционерам</span>
                        <span class="our-mission__test">Получать материальные и нематериальные дивиденды от владения успешным предприятием, приносящим пользу людям</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div class="benefits about-benefits">
                <span class="title--18-28">Ценности нашей компании</span>

                <div class="benefits__row right">
                    <div class="benefits__text">
                        <h2>Высокие стандарты качества продукции</h2>
                        <p class="benefits__description">На всех этапах производства продукции мы делаем все необходимое для того, чтобы получить натуральную, вкусную и безопасную продукцию. Наши высокие требования к качеству сырья и ингредиентов, обеспечение идеальных условий для хранения сырья, бережное отношение к соблюдению технологии на каждом этапе производства продукции, внимание к правильному хранению готовой продукции и ее доставке в торговые точки позволяют нам достичь высоких стандартов качества продукции.</p>
                    </div>
                    <div class="benefits__img">
                        <img src="{{ asset('library/public/img/values__svg-1.svg') }}" alt="">
                    </div>
                </div>

                <div class="benefits__row">
                    <div class="benefits__img">
                        <img src="{{ asset('library/public/img/values__svg-2.svg') }}" alt="">
                    </div>
                    <div class="benefits__text">
                        <h2>Репутация компании</h2>
                        <p class="benefits__description">Делси является крупнейшим заводом по производству пресервов из рыбы и морепродуктов за Уралом и входит в 10 самых больших заводов России. Основа нашей стабильности – это производство качественной продукции и гибкий клиентоориентированнный подход к каждому нашему покупателю. Торговая марка Делси заслужила высокие  оценки потребителей, так как репутация компании для нас  -  это честность и ответственность перед потребителями, перед коллегами,  перед поставщиками и нашими покупателями.</p>
                    </div>
                </div>

                <div class="benefits__row right">
                    <div class="benefits__text">
                        <h2>Профессионализм, ответственность и эффективное взаимодействие</h2>
                        <p class="benefits__description">Делси – это опытный квалифицированный персонал, сплоченная дружная команда профессионалов. Наш коллектив - это люди, готовые взаимодействовать, сообща решать поставленные задачи и достигать общих целей. Готовность прийти на помощь, поделиться знаниями и опытом делает нас одним целым и на работе, и в жизни.</p>
                    </div>
                    <div class="benefits__img">
                        <img src="{{ asset('library/public/img/values__svg-3.svg') }}" alt="">
                    </div>
                </div>

                <div class="benefits__row">
                    <div class="benefits__img">
                        <img src="{{ asset('library/public/img/values__svg-4.svg') }}" alt="">
                    </div>
                    <div class="benefits__text">
                        <h2>Забота о сотрудниках</h2>
                        <p class="benefits__description">Каждый сотрудник ценен и важен для компании, мы всегда внимательно слушаем друг друга, вне зависимости от занимаемых должностей. Мы ценим честные правдивые отношения, искренность и добросовестность. Мы постоянно работаем над улучшением условий труда всех работников Делси и создаем самые комфортные условия труда для всех работников Делси. Мы стремимся повышать квалификацию работников через обучение и обмен опытом, через участие персонала компании в выставках и ярмарках.</p>
                    </div>
                </div>

                <div class="benefits__row right">
                    <div class="benefits__text">
                        <h2>Бережное отношение к ресурсам</h2>
                        <p class="benefits__description">Внедрение “Системы Бережливого Производства”, бережное отношение к технологическому, холодильному и производственному оборудованию, бережное отношение к спецодежде, инструменту и расходным материалам, бережное отношение к транспортным средствам, бережное отношение к имуществу компании, рациональное планирование складских запасов, обеспечение соотношения «цена-качество» при закупке материалов и запасных частей -  позволяет нам экономить материальные, людские и денежные ресурсы и создавать основу будущего стабильного развития компании Делси и благосостояния всех ее сотрудников.</p>
                    </div>
                    <div class="benefits__img">
                        <img src="{{ asset('library/public/img/values__svg-5.svg') }}" alt="">
                    </div>
                </div>
            </div>

            <slider-equipment></slider-equipment>

            <slider-technology></slider-technology>
        </div>

        <div class="map-delivery about-map">
            <div class="wrapper">
                <div class="map-delivery__text">
                    <div class="map-delivery__box">
                        <span class="map-delivery__title">География поставок</span>
                        <p class="map-delivery__desription">Географическое положение и многолетний опыт позволяют организовать быструю доставку свежей продукции в любой регион Сибири и Дальнего Востока. Сегодня завод обеспечивает регулярные поставки на Алтай, в республики Бурятия, Тыва,  Хакасия, Красноярский край,  Хабаровский край, Кемеровскую, Иркутскую, Томскую и Новосибирскую области. </p>
                    </div>

                    <div class="map-delivery__box">
                        <span class="map-delivery__title">Собственная доставка и контроль продукции</span>
                        <p class="map-delivery__desription">Максимально короткий срок от производства до появления на полке магазина. Из-за минимального содержания консервантов продукция Делси очень чувствительна к внешним условиям и не предназначена для длительного хранения, поэтому мы лично проверяем соблюдение температурного режима в местах продажи и в процессе доставки благодаря постоянному мониторингу.</p>
                    </div>
                </div>

                <img src="{{ asset('library/public/img/map-delivery.svg') }}" alt="" class="map-delivery__img">
            </div>
        </div>

        <div class="wrapper">
            <div class="more-about about-work">
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
                    <img src="{{ asset('library/public/img/more-about__img.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </main>
@endsection
