<template>
    <section class="current-vacancies">
        <h2>Текущие вакансии</h2>

        <div
            v-for="vacancy in paginatedData"
            :key="vacancy.id"
            class="current-vacancies__block"
        >
            <span class="current-vacancies__name">{{ vacancy.name }}</span>
            <span class="current-vacancies__city">{{ vacancy.city }}</span>
            <span class="current-vacancies__money">{{ vacancy.payment }}</span>
            <a
                :href="vacancy.link"
                target="_blank"
                class="btn-text"
            >
                Подробнее
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
        <div class="current-vacancies__bottom">
            <span class="recipes__shown-text">Показано <b>{{ paginatedData.length }}</b> из <b>{{ vacancies.length }}</b> вакансий</span>

            <button
                v-if="vacancies.length > paginatedData.length"
                type="button"
                class="show-more"
                @click="size += countByDevice"
            >
                <img
                    :src="_asset('/library/public/img/refresh-outline.svg')"
                    alt=""
                    class="show-more__arrow"
                >
                Показать ещё <b> {{ getSize }} </b> {{ declOfNum(getSize, ['рецепт', 'рецепта', 'рецептов']) }}
            </button>
        </div>
    </section>
</template>

<script>
import axios from 'axios'

export default {
    name: "VacanciesComponent",
    data() {
        return {
            vacancies: [],
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
            return this.vacancies.slice(start, end);
        },
        getSize() {
            let delta = this.vacancies.length - this.paginatedData.length;

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
        this.getVacancyList()
    },
    methods: {
        resizeByDevice() {
            window.innerWidth >= 767 ? this.mobile = false : this.mobile = true;
        },
        async getVacancyList() {
            try {
                let res = await axios.get('/work/vacancy');
                this.vacancies = res.data.data
            } catch (error) {
                console.log(error)
            }
        }
    }
}
</script>

<style scoped>

</style>
