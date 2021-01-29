<template>
    <div class="recipes">
        <div class="wrapper">
            <filter-component
                :filter-items="catalogFilter"
                :filter-group-active="activeGroupFilter"
                :filter-chose.sync="choseFilter"
                color="#E9ECF6"
            />

            <div class="recipes__container">
                <template v-if="items.length">
                    <span class="recipes__shown-text">Показано <b>{{ shown }}</b> из <b>{{ pager.total }}</b></span>

                    <div class="recipes__grid">
                        <a
                            v-for="item in items"
                            :key="item.id"
                            :href="item.url"
                            class="recipes-box"
                        >
                            <img
                                :src="item.image_url"
                                alt=""
                                class="recipes-box__img"
                            >
                            <div class="recipes-box__text">
                                <span class="recipes-box__name">{{ item.name.ru }}</span>
                            </div>
                        </a>
                    </div>

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
