@extends('public.index', ['title' => $meta_title])

@section('head')
    @include('public.partials.meta')

@endsection

@section('content')
    <main>
        <div class="wrapper">
            <div class="bread-crumbs">
                @foreach ($response['paths'] as $item)
                    <a href="{{ $item['link'] }}"
                       class="bread-crumbs__text {{ $loop->last ? 'active' : '' }}">{{ $item['name'] }}</a>
                @endforeach
            </div>

            <section id="recipe" class="recipe">
                <div class="recipe__row">
                    <div class="recipe__left recipe__left--top">
                        <img src="{{ $response['data']['image_url'] }}" alt="" class="recipe__main-img"/>
                    </div>

                    <div class="recipe__right">
                        <span class="recipe__title noPrint">{{ $response['paths']['category']['name'] }}</span>
                        <h1 class="h2">{{ $response['data']['name'] }}</h1>

                        <div class="quick-facts">
                            <div class="quick-facts__box">
                                <img src="{{ asset('library/public/img/chef-outline.svg') }}" alt=""
                                     class="quick-facts__img"/>
                                <span class="quick-facts__text">{{ $response['data']['complexity'] }}</span>
                            </div>

                            <div class="quick-facts__box">
                                <img src="{{ asset('library/public/img/clock.svg') }}" alt="" class="quick-facts__img"/>
                                <span class="quick-facts__text">{{ $response['data']['cooking_time'] }}</span>
                            </div>

                            <div class="quick-facts__box">
                                <img src="{{ asset('library/public/img/food-tray.svg') }}" alt=""
                                     class="quick-facts__img"/>
                                <span class="quick-facts__text">{{ $response['data']['servings'] }}</span>
                            </div>
                        </div>

                        <div class="recipe__btn-group noPrint">
                            <div class="recipe__share">
                                <span class="recipe__title">Поделиться с друзьями:</span>
                                <div class="soc-seti blue">
                                    <template>
                                        <Share-Network
                                            network="facebook"
                                            url="href"
                                            title="Share Title"
                                        >
                                            <svg width="24" height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M13.8584 24V13.0533H17.5313L18.0824 8.78588H13.8584V6.06176C13.8584 4.82664 14.2 3.98492 15.9732 3.98492L18.231 3.98399V0.167076C17.8406 0.116334 16.5002 0 14.9403 0C11.6827 0 9.45258 1.98836 9.45258 5.63912V8.78588H5.76855V13.0533H9.45258V24H13.8584Z"/>
                                            </svg>
                                        </Share-Network>
                                    </template>
                                </div>
                            </div>
                            <div class="recipe__print">
                                <span class="recipe__title">Распечатать рецепт:</span>
                                <button @click="printDiv" type="button" class="print-btn">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#1C2545">
                                        <path
                                            d="M21.375 5.25H20.25V0H3.75V5.25H2.625C1.1625 5.25 0 6.4875 0 7.9875V15.975C0 17.475 1.1625 18.7125 2.625 18.7125H3.375V23.9625H20.625V18.75H21.375C22.8375 18.75 24 17.5125 24 16.0125V7.9875C24 6.4875 22.8375 5.25 21.375 5.25ZM5.25 1.5H18.75V5.25H5.25V1.5ZM19.125 22.5H4.875V15.375H19.125V22.5ZM22.5 16.0125C22.5 16.6875 22.0125 17.25 21.375 17.25H20.625V13.875H3.375V17.25H2.625C1.9875 17.25 1.5 16.6875 1.5 16.0125V7.9875C1.5 7.3125 1.9875 6.75 2.625 6.75H21.375C22.0125 6.75 22.5 7.3125 22.5 7.9875V16.0125Z"/>
                                        <path
                                            d="M19.875 7.5C18.825 7.5 18 8.325 18 9.375C18 10.425 18.825 11.25 19.875 11.25C20.925 11.25 21.75 10.425 21.75 9.375C21.75 8.325 20.925 7.5 19.875 7.5ZM19.875 9.75C19.65 9.75 19.5 9.6 19.5 9.375C19.5 9.15 19.65 9 19.875 9C20.1 9 20.25 9.15 20.25 9.375C20.25 9.6 20.1 9.75 19.875 9.75Z"/>
                                        <path d="M17.625 16.875H6.375V18.375H17.625V16.875Z"/>
                                        <path d="M17.625 19.5H6.375V21H17.625V19.5Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="recipe__row">
                    <div class="recipe__left">

                        <div class="recipe-ingredients">
                            <span class="recipe-ingredients__title">Ингредиенты:</span>

                            <div class="content-output">
                                {!! $response['data']['ingredients'] !!}
                            </div>
                        </div>

                    </div>
                    <div class="recipe__right">
                        <div class="recipe-article">
                            <span class="recipe-article__title">Шаги приготовления:</span>

                            <div class="content-output">
                                {!! $response['data']['body'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @if( count($response['data']['products']) )
                <div class="popular violet">
                    <span class="categories__main-title">Попробуйте заменить основной ингредиент одним из следующих продуктов:</span>

                    <slider-popular :slide="{{ $response['data']['products'] }}"></slider-popular>
                </div>
            @endif

            <a href="{{ $response['paths']['catalog']['link'] }}" class="btn-text-prev">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" stroke="#1C2545">
                    <path d="M8 17H24" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 17L16 9" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 17L16 25" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Вернуться на страницу с рецептами
            </a>
        </div>
    </main>
@endsection
