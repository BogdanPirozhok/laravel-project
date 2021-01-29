<template>
    <div class="retail-chains">
        <span class="networks__title">Торговые точки на карте</span>

        <div class="retail-chains__cont">
            <div
                v-for="item in paginatedData"
                :key="item.id"
                class="retail-chains__block"
            >
                <div class="retail-chains__img">
                    <img
                        :src="item.logo_image_path"
                        alt=""
                    >
                </div>
                <span class="retail-chains__text">{{ item.name }}</span>
                <span class="retail-chains__text">{{ item.description }}</span>
                <a
                    :href="item.external_url"
                    class="btn-text"
                >
                    Сайт магазина
                    <svg
                        width="32"
                        height="32"
                        viewBox="0 0 32 32"
                        fill="none"
                    >
                        <path
                            d="M24 17H8"
                            stroke="#1C2545"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M24 17L16 9"
                            stroke="#1C2545"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M24 17L16 25"
                            stroke="#1C2545"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </a>
            </div>
        </div>

        <div class="retail-chains__bottom">
            <span class="recipes__shown-text">Показано <b>{{ paginatedData.length }}</b> из <b>{{ data.length }}</b> магазинов</span>

            <button
                v-if="data.length > paginatedData.length"
                type="button"
                class="show-more"
                @click="size += countByDevice"
            >
                <img
                    :src="_asset('/library/public/img/refresh-outline.svg')"
                    alt=""
                    class="show-more__arrow"
                >
                Показать ещё <b> {{ getSize }} </b> {{ declOfNum(getSize, ['магазин', 'магазина', 'магазинов']) }}
            </button>
        </div>
    </div>
</template>

<script>
/* global response */

export default {
    data() {
        return {
            data: response.data,
            current_page: 0,
            size: 5,
            mobile: false
        }
    },
    computed: {
        countByDevice() {
            return this.mobile ? 3 : 5;
        },
        paginatedData() {
            let start = this.current_page * this.size,
                end = start + this.size;
            return this.data.slice(start, end);
        },
        getSize() {
            let delta = this.data.length - this.paginatedData.length;

            return this.countByDevice <= delta ? this.countByDevice : delta;
        }
    },
    watch: {
        mobile() {
            this.mobile ? this.size = 3 : this.size = 5;
        }
    },
    mounted() {
        this.resizeByDevice()
        window.addEventListener('resize', this.resizeByDevice);
    },
    methods: {
        resizeByDevice() {
            window.innerWidth >= 767 ? this.mobile = false : this.mobile = true;
        }
    }
}
</script>
