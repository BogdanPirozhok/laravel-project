<template>
    <div class="wrapper">
        <section class="latest-news">
            <h2>Последние события</h2>
            <transition
                name="slider"
                mode="out-in"
            >
                <div
                    :key="step"
                    class="slider-news"
                >
                    <a
                        v-if="sliderItems.cover_file_path"
                        href="#"
                        class="slider-news__left"
                        @click.prevent="goToHash(9)"
                    >
                        <img
                            :src="sliderItems.cover_file_path"
                            :alt="sliderItems.name"
                            class="slider-news__img"
                        >
                    </a>

                    <div class="slider-news__right">
                        <span class="news__text-red">{{ sliderItems.categories[0].name }}</span>
                        <a
                            href="#"
                            class="news__title"
                            @click.prevent="goToHash(9)"
                        >
                            {{ sliderItems.name }}
                        </a>

                        <div
                            class="content-output news__text"
                            v-html="sliderItems.body"
                        />

                        <slide-up-down :active="active.includes(sliderItems.id)">
                            <div
                                class="content-output news__text news__text--show"
                                v-html="sliderItems.additional"
                            />
                        </slide-up-down>

                        <button
                            v-if="sliderItems.additional"
                            type="button"
                            class="news-block__btn"
                            :class="{ 'active': active.includes(sliderItems.id) }"
                            @click="toggle(sliderItems.id)"
                        >
                            <span>
                                {{ active.includes(sliderItems.id) ? 'Скрыть' : 'Подробнее' }}
                            </span>
                            <img
                                :src="_asset('library/public/img/news__btn-arrow.svg')"
                                alt=""
                            >
                        </button>
                    </div>
                </div>
            </transition>
            <div class="slider-hero__btn-group">
                <button
                    :disabled="!prevStepValidation"
                    type="button"
                    class="slider-btn left"
                    @click="step--"
                >
                    <svg
                        width="32"
                        height="32"
                        viewBox="0 0 32 32"
                        stroke="#1C2545"
                        fill="none"
                    >
                        <path
                            d="M8 16H24"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M8 16L16 8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M8 16L16 24"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>
                <span class="slider-hero__number">{{ step + 1 }}/{{ slider_news.length }}</span>
                <button
                    :disabled="!nextStepValidation"
                    type="button"
                    class="slider-btn right"
                    @click="step++"
                >
                    <svg
                        width="32"
                        height="32"
                        viewBox="0 0 32 32"
                        stroke="#1C2545"
                        fill="none"
                    >
                        <path
                            d="M24 17H8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M24 17L16 9"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M24 17L16 25"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </button>
            </div>
        </section>

        <section class="news">
            <h2>Новости компании</h2>

            <div class="news__top">
                <span class="recipes__shown-text">Показано <b>5</b> из <b>23</b></span>

                <div class="select-box">
                    <span class="select__text">Показать:</span>

                    <select-component
                        :items="options"
                        :selected.sync="current_select"
                    />
                </div>
            </div>

            <div class="news__middle">
                <div
                    v-for="block in all_news"
                    :id="'news' + block.id"
                    :key="block.id"
                    ref="news"
                    class="news-block"
                >
                    <div
                        v-if="block.cover_file_path"
                        class="news-block__left"
                    >
                        <img
                            :src="block.cover_file_path"
                            alt="food"
                            class="news-block__img"
                        >
                        <span class="news-block__date">{{ block.update_at }}</span>
                    </div>

                    <div class="news-block__right">
                        <span class="news__text-red">{{ block.categories[0].name }}</span>
                        <span class="news__title">{{ block.name }}</span>

                        <div
                            class="content-output news__text"
                            v-html="block.body"
                        />

                        <slide-up-down :active="active.includes(block.id)">
                            <div
                                class="content-output news__text news__text--show"
                                v-html="block.additional"
                            />
                        </slide-up-down>

                        <button
                            v-if="block.additional"
                            type="button"
                            class="news-block__btn"
                            :class="{ 'active': active.includes(block.id) }"
                            @click="toggle(block.id)"
                        >
                            <span>
                                {{ active.includes(block.id) ? 'Скрыть' : 'Подробнее' }}
                            </span>
                            <img
                                :src="_asset('library/public/img/news__btn-arrow.svg')"
                                alt=""
                            >
                        </button>
                    </div>
                </div>
            </div>
            <div
                v-if="pager.total > pager.size"
                class="news__bottom"
            >
                <pagination
                    :page.sync="pager.current"
                    :list-data="pager.total"
                    :size="pager.size"
                />
            </div>
        </section>
    </div>
</template>

<script>
/* global response */
/* global axios */

import SelectComponent from "./SelectComponent";
import Pagination from "./Pagination";

export default {
	name: "NewsComponent",
	components: {
		SelectComponent,
		Pagination
	},
	data() {
		return {
			slider_news: response.featured,
			all_news: response.list.data,
            options: response.filter.items,
            base_path: response.base_path,
			current_select: response.filter.selected,
            step: 0,
			active: [],
            pager: {
                reset: false,
                current: response.list.current_page,
                size: response.list.per_page,
                total: response.list.total
            }
		}
	},
	computed: {
		sliderItems() {
			return this.slider_news[this.step]
		},
		nextStepValidation() {
			return this.step + 1 < this.slider_news.length
		},
		prevStepValidation() {
			return this.step > 0
		},
        pathFilter() {
            let category = this.options.find(item => {
                return item.id === this.current_select;
            })
            return category ? '/'+ category.slug : '';
        }
	},
    watch: {
        current_select() {
            if (this.pager.current) {
                this.pager.reset = true;
                this.pager.current = 0;
            }
            this.updateData();
        },
        'pager.current'() {
            if (!this.pager.reset) {
                this.updateData();
            }
            this.pager.reset = false;
        }
    },
	methods: {
		goToHash(val) {
            return val;
			// this.all_news.forEach((item, index) => {
			// 	if (item.id == val) {
			// 		let page = Math.ceil(index / this.size);
			// 		this.current_page = page;
			// 		let id = 'news' + val;
			// 		setTimeout(() => {
			// 			document.getElementById(id).scrollIntoView({
			// 				behavior: 'smooth',
			// 				block: 'start'
			// 			})
			// 		}, 1)
			// 	}
			// })
		},
		toggle(value) {
			if (this.active.includes(value)) {
				this.active.splice(this.active.indexOf(value), 1);
			} else {
				this.active.push(value)
			}
		},
        updateData: function () {
            let path = this.base_path + this.pathFilter,
                get = '?page='+ this.pager.current +'&json=true';

            window.history.replaceState(null, null, path);
            this.$root.isLoading.show = true;

            axios.get(path + get)
            .then(response => {
                const output = response.data;

                this.all_news = output.data;
                this.pager.current = output.current_page;
                this.pager.size = output.per_page;
                this.pager.total = output.total;
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                setTimeout(() => {
                    this.$root.isLoading.show = false;
                }, 750)
            })
        }
	}

}
</script>

<style scoped>

</style>
