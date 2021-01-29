@extends('public.index', ['title' => $meta_title])

@section('head')
    @include('public.partials.meta')

@endsection

@section('content')
    <main>
        <div class="wrapper">
            <div class="bread-crumbs">
                @foreach ($response['paths'] as $item)
                    <a href="{{ $item['link'] }}" class="bread-crumbs__text {{ $loop->last ? 'active' : '' }}">{{ $item['name'] }}</a>
                @endforeach
            </div>

            <section class="product">
                <div class="product__img-box">
                    <img src="{{ $response['data']['image_url'] }}" alt="" class="product__main-img" />

                    @if ($response['data']['tags'] && count($response['data']['tags']))
                        <div class="product__awards">
                            @foreach ($response['data']['tags'] as $tag)
                                <img src="{{ $tag['image_url'] }}" alt="" class="product__awards-img" />
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="product__info">
                    <h2>{{ $response['data']['name'] }}</h2>



                    @if ($response['data']['specs'] && count($response['data']['specs']))
                        @foreach ($response['data']['specs'] as $spec)
                            @if ($spec['type'] !== 'warn')
                                <div class="product__row">
                                    <span class="product__title">{{ $spec['caption'] }}:</span>
                                    <p class="product__description">{{ $spec['value'] }}</p>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    @if ($response['data']['package'])
                        <div class="product__row">
                            <span class="product__title">Вид упаковки:</span>
                            <p class="product__description">
                                {{ $response['data']['package']['name'] }}
                                <img src="{{ $response['data']['package']['image_url'] }}" alt="" />
                            </p>
                        </div>
                    @endif
                    @foreach ($response['data']['specs'] as $spec)
                        @if ($spec['type'] === 'warn')
                            <span class="recipe-article__note">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="11.5" stroke="#E74318"></circle> <path d="M13.04 5L12.58 13.64L11.64 13.74L11.48 13.56L11.46 5.06L11.62 4.86L12.84 4.8L13.04 5ZM11.9 16.24C12.1667 16.24 12.3733 16.32 12.52 16.48C12.68 16.64 12.76 16.86 12.76 17.14C12.76 17.4333 12.6733 17.6667 12.5 17.84C12.34 18.0133 12.12 18.1 11.84 18.1C11.5467 18.1 11.32 18.02 11.16 17.86C11.0133 17.7 10.94 17.4733 10.94 17.18C10.94 16.9 11.0267 16.6733 11.2 16.5C11.3733 16.3267 11.6067 16.24 11.9 16.24Z" fill="#E74318"></path></svg>
                                {{ $spec['value'] }}
                            </span>
                        @endif
                    @endforeach

                </div>
            </section>

            @if ($response['data']['similar_products'] && count($response['data']['similar_products']))
                <div class="similar-products">
                    <div class="similar-products__top">
                        <span class="title--18-28">Похожие продукты</span>
                        <a href="{{ $response['paths']['catalog']['link'] }}" class="btn-text">
                            Перейти в каталог
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M24 17H8" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M24 17L16 9" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M24 17L16 25" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </a>
                    </div>

                    <div class="dashed"></div>

                    <div class="similar-products__cont">
                        @foreach ($response['data']['similar_products'] as $product)
                            <a href="{{ $product['url'] }}" class="catalog-box">
                                <img src="{{ $product['image_url'] }}" alt="" class="catalog-box__img" />
                                <span class="catalog-box__name">{{ $product['name'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <section class="material">
            <div class="wrapper">
                <div class="material__info">
                    <span class="title--18-28">Из чего производим</span>
                    <h2>{{ $response['data']['material_title'] }}</h2>
                    <span class="material__text--italic">{{ $response['data']['material_sub_title'] }}</span>

                    <p class="material__description">{{ $response['data']['material_description'] }}</p>
                </div>

                <img src="{{ $response['data']['material_image_url'] }}" alt="" class="material__img" />
            </div>
        </section>

        @if ($response['recipes']['data'])
            <section class="quality">
                <div class="wrapper">
                    <div class="quality__cont">
                        <div class="similar-products__top">
                            <span class="title--18-28">Рецепты</span>
                            <a href="{{ $response['recipes']['link'] }}" class="btn-text">
                                Посмотреть все рецепты
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M24 17H8" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M24 17L16 9" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M24 17L16 25" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </a>
                        </div>
                        <div class="dashed dashed--margin-32"></div>

                        <div class="quality__block">
                            <div class="quality__img">
                                <img src="{{ $response['recipes']['data']['image_url'] }}" alt="" />
                            </div>

                            <div class="quality__text quality__text--512">
                                <h2>{{ $response['recipes']['data']['name'] }}</h2>

                                <div class="quick-facts">
                                    <div class="quick-facts__box">
                                        <img src="{{ asset('library/public/img/chef-outline.svg') }}" alt="" class="quick-facts__img">
                                        <span class="quick-facts__text">{{ $response['recipes']['data']['complexity'] }}</span>
                                    </div>

                                    <div class="quick-facts__box">
                                        <img src="{{ asset('library/public/img/clock.svg') }}" alt="" class="quick-facts__img">
                                        <span class="quick-facts__text">{{ $response['recipes']['data']['cooking_time'] }}</span>
                                    </div>

                                    <div class="quick-facts__box">
                                        <img src="{{ asset('library/public/img/food-tray.svg') }}" alt="" class="quick-facts__img">
                                        <span class="quick-facts__text">{{ $response['recipes']['data']['servings'] }}</span>
                                    </div>
                                </div>

                                <a href="{{ $response['recipes']['data']['url'] }}" class="btn-border blue">
                                    Перейти к рецепту
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
