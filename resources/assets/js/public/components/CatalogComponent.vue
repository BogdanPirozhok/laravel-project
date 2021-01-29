<template>
    <div class="catalog">
        <div class="wrapper">
            <filter-component
                :filter-items="catalogFilter"
                :filter-group-active="activeGroupFilter"
                :filter-chose.sync="choseFilter"
                color="#E9ECF6"
            />
            <div class="catalog__container">
                <template v-if="items.length">
                    <span class="recipes__shown-text">Показано <b>{{ shown }}</b> из <b>{{ pager.total }}</b></span>
                    <div class="catalog__grid">
                        <a
                            v-for="item in items"
                            :key="item.id"
                            :href="item.url"
                            class="catalog-box"
                        >
                            <img
                                :src="item.image_url"
                                alt=""
                                class="catalog-box__img"
                            >
                            <span class="catalog-box__name">{{ item.name.ru }}</span>
                        </a>
                    </div>

                    <!--<button
                        :disabled="current_page == Math.floor(items.length / size)"
                        type="button"
                        class="show-more"
                        @click="size += countByDevice"
                    >
                        <img
                            :src="_asset('library/public/img/refresh-outline.svg')"
                            alt=""
                            class="show-more__arrow"
                        >
                        Показать ещё <b> {{ countByDevice }} </b> рецептов
                    </button>-->
                    <template v-if="pager.total > pager.size">
                        <br>
                        <div class="dashed" />

                        <pagination
                            :page.sync="pager.current"
                            :list-data="pager.total"
                            :size="pager.size"
                        />
                    </template>
                </template>
                <template v-else>
                    <div class="not-result">
                        <span class="not-result__title">Ничего не найдено</span>
                        <span class="not-result__subtitle">Поиск по заданным параметрам не дал результатов</span>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import CatalogMixin from '../mixin/catalog.js';

    export default {
        mixins: [CatalogMixin]
    }
</script>
