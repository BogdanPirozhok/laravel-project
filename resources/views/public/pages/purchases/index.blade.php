@extends('public.index', ['title' => $title])
@section('head')
    @include('public.partials.meta')


    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
    </script>
@endsection


@section('content')
    <main>

        @include('public.partials.body.page-heading', ['color_wave' => '#fff', 'background_color' => '#F9EFE6', 'image_bg_color' => 'rgb(235, 202, 173)', 'image_icon_url' => asset('/library/public/img/hook.svg')])

        <div class="wrapper">
            <div class="honor purchases-honor">
                <div class="purchases-honor__group">
                    <span class="purchases-honor__title">Информация о закупках рыбного сырья</span>
                    <span class="purchases-honor__subtitle">Приглашаем к сотрудничеству рыбодобывающие компании и крупных дистрибьютеров рыбы и морепродуктов.</span>
                </div>

                <div class="honor__cont">
                    <div class="honor__box">
                        <span class="honor__title">1 600 тонн</span>
                        <span class="honor__text">годовой объем перебатываемого сырья</span>
                    </div>

                    <div class="honor__box">
                        <span class="honor__title">30%</span>
                        <span class="honor__text">планируемое наращивание объемов производства</span>
                    </div>
                </div>

                <div class="purchases-honor__list">
                    <div class="purchases-honor__list-left">
                        <span class="purchases-honor__title">Закупаемая номенклатура:</span>
                        <ul class="quality-block__ul">
                            @foreach($body['purchased'] as $purchase)
                                <li class="quality-block__li">
                                    {{ $purchase }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="purchases-honor__list-right">
                        <span class="purchases-honor__title">Условия для поставщиков:</span>
                        <ul class="quality-block__ul">
                            @foreach($body['conditions'] as $condition)
                                <li class="quality-block__li">
                                    {{ $condition }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="purchases-block cneter">
                <span class="purchases-block__title">Ждем интересных и взаимовыгодных предложений</span>
            </div>

            <purchases-table></purchases-table>


            <div class="purchases-block between">
                <span class="purchases-block__title">Отдела закупки сырья и материально-технического снабжения</span>
                <div class="purchases-block__right">
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $body['department']['phone']) }}" class="purchases-block__link">
                        {{ $body['department']['phone'] }}
                    </a>
                    <a href="mailto:{{ $body['department']['email'] }}" class="purchases-block__link">
                        {{ $body['department']['email'] }}
                    </a>
                </div>
            </div>

            <tenders-table></tenders-table>
        </div>
    </main>
@endsection
