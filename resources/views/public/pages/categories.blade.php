@extends('public.index', ['title' => $title])

@section('head')
    @include('public.partials.meta')
@endsection


@section('content')
    <main class="categories-bg">
        <section class="categories-hero hero--100vh">
            <slider-hero
                :slider_hero="{{json_encode($body['product_slider'])}}"
            ></slider-hero>

            <waves
                class="wave--bottom"
                :color-wave="'#F9EFE6'"
                :id="'in_header'"
            ></waves>
        </section>

        <div class="wrapper">
            <div class="categories">
                <span class="categories__main-title">Категории</span>
                <p class="categories__description">Выберите подходящую категорию или перейдите на страницу всей продукции и воспользуйтесь удобными фильтрами.</p>

                <div class="categories__container">
                    @foreach ($response['categories'] as $category)
                        <a href="{{ $category->url }}" class="categories__box">
                            <span class="categories__name"><b>{{ $category->name }}</b></span>
                            <img src="{{ $category->image_url }}" alt="" class="categories__img" />
                        </a>
                    @endforeach

                    <a href="{{ $response['catalog_url'] }}" class="categories__box btn-next">
                        <span class="btn-text">
                            Посмотреть всю продукцию
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M24 17H8" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M24 17L16 9" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M24 17L16 25" stroke="#1C2545" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>

            @if( count($response['products']) )
                <div class="popular white">
                    <span class="categories__main-title">Популярное</span>
                    <slider-popular :slide="{{ $response['products'] }}"></slider-popular>
                </div>
            @endif
        </div>
    </main>
@endsection
