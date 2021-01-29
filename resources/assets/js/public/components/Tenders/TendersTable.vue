<template>
    <div class="table__wrapper table-tender relative">
        <spin-loader v-if="pending" />
        <span class="table__main-title">Перечень активных тендеров</span>
        <div class="table">
            <div class="table__cont">
                <div class="table__tr table__head">
                    <div class="table__td">
                        <span class="table__text">Наименование тендера</span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">Ед. изм.</span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">Предполагаемый объем работ / услуг</span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">Сроки подачи заявок</span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">Описание работ / услуг</span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">Содержание работ / услуг</span>
                    </div>
                </div>
                <div
                    v-for="(item, index) in tenders"
                    :key="index"
                    class="table__tr"
                >
                    <div class="table__td">
                        <span class="table__text">
                            {{ item.name }}
                        </span>

                        <modal-component>
                            <template #container:title>
                                Принять участие в тендере « {{ item.name }} »
                            </template>
                            <template #container:body="{ handleModal }">
                                <tender-request-form :tender-id="item.id" />
                                <div>
                                    <div
                                        class="over__close"
                                        @click="handleModal"
                                    >
                                        <svg
                                            width="357"
                                            height="357"
                                            viewBox="0 0 357 357"
                                            fill="white"
                                        >
                                            <path d="M357 35.7L321.3 0L178.5 142.8L35.7 0L0 35.7L142.8 178.5L0 321.3L35.7 357L178.5 214.2L321.3 357L357 321.3L214.2 178.5L357 35.7Z" />
                                        </svg>
                                    </div>
                                </div>
                            </template>
                            <template #activator="{ handleModal }">
                                <div />
                                <button
                                    class="btn-text"
                                    style="background: none;"
                                    @click="handleModal"
                                >
                                    Принять участие в тендере
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
                                </button>
                            </template>
                        </modal-component>
                    </div>
                    <div class="table__td">
                        <span class="table__text">
                            {{ item.unit }}
                        </span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">
                            {{ item.volume }}
                        </span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">
                            {{ item.deadline }}
                        </span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">
                            <template v-if="item.job_file">
                                Файл:
                                <a
                                    :href="item.job_file"
                                    target="_blank"
                                    class="table__link"
                                >
                                    Описание тендера
                                    <img :src="'/library/public/img/popout-outline.svg'">
                                </a>
                            </template>
                            <template v-else>
                                Файл не загружен
                            </template>
                        </span>
                    </div>
                    <div class="table__td">
                        <template v-if="item.work_file">
                            Файл:
                            <a
                                :href="item.work_file"
                                target="_blank"
                                class="table__link"
                            >
                                Описание тендера
                                <img :src="'/library/public/img/popout-outline.svg'">
                            </a>
                        </template>
                        <template v-else>
                            Файл не загружен
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <template v-if="meta">
            <div class="table__bottom">
                <span class="recipes__shown-text">Показано <b>{{ show }}</b> из <b>{{ meta.total }}</b> закупок</span>
                <pagination
                    :page.sync="pagination"
                    :list-data="meta.total"
                    :size="meta.per_page"
                />
            </div>
        </template>
    </div>
</template>

<script>
import axios from 'axios';
import Pagination from "../Pagination";
import SpinLoader from "../misc/SpinLoader";
import ModalComponent from "../Modals/ModalComponent";
import TenderRequestForm from "../Forms/TenderRequestForm";

export default {
    name: "TendersTable",
    components: {
        SpinLoader,
        Pagination,
        ModalComponent,
        TenderRequestForm,
    },
    data() {
        return {
            active: [],
            tenders: [],
            pagination: 0,
            pending: false,
            meta: null,
        }
    },
    computed: {
        show() {
            return this.meta.per_page * (this.meta.current_page - 1) + this.tenders.length
        }
    },
    watch: {
        pagination: function () {
            this.getPurchases();
        },
    },
    mounted() {
        this.getPurchases();
    },
    methods: {
        toggle(value) {
            if (this.active.includes(value)) {
                this.active.splice(this.active.indexOf(value), 1);
            } else {
                this.active.push(value)
            }
        },

        async getPurchases() {

            this.pending = true;

            try {
                let res = await axios.get('/purchases/ajax', {
                    params: {
                        page: this.pagination + 1,
                        type: 'tender'
                    }
                });

                this.tenders = res.data.data;
                this.meta = res.data.meta;


                console.log(res)
            } catch (e) {
                console.log(e);
            } finally {
                this.pending = false;
            }

        },
    }

}
</script>

<style scoped>

</style>
