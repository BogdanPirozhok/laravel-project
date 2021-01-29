@extends('public.index')


@section('content')
    <main class="quality-form__bg">
        <div class="wrapper">
            <div class="bread-crumbs">
                <a href="/" class="bread-crumbs__text">Главная</a>
                <a href="/partnership" class="bread-crumbs__text">Партнёрам</a>
                <a href="#" class="bread-crumbs__text active">Получить каталог</a>
            </div>
        </div>

        <div class="wrapper wrapper--w-848" style="margin-bottom: 150px">
            <modal-component>
                    <template v-slot:container:title>
                        bang bang
                    </template>
                    <template v-slot:container:body="{ handleModal }">
                        <tender-request-form :intes="'ayy bosssss'"></tender-request-form>
                        <button @click="handleModal">
                            close
                        </button>
                    </template>
                    <template v-slot:activator="{ isOpen, handleModal }">
                        <button @click="handleModal">
                            FUFUFUFUFUFUFUFU
                            click @{{ isOpen  }}
                        </button>
                    </template>
            </modal-component>
        </div>
    </main>
@endsection
