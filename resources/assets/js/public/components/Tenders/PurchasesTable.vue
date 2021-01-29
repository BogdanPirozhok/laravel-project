<template>
    <div class="table__wrapper relative">
        <spin-loader v-if="pending" />
        <span class="table__main-title">Перечень постоянных закупок расходных материалов</span>

        <div class="table table-materials">
            <div class="table__cont">
                <div class="table__tr table__head">
                    <div class="table__td">
                        <span class="table__text">Наименование</span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">Ед. изм.</span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">Предполагаемый объем закупки в месяц</span>
                    </div>
                    <div class="table__td">
                        <span class="table__text">Описание</span>
                    </div>
                </div>

                <template v-if="purchases.length">
                    <div
                        v-for="(item, index) in purchases"
                        :key="index"
                        class="table__tr"
                    >
                        <div class="table__td">
                            <span class="table__text">{{ item.name }}</span>
                        </div>
                        <div class="table__td">
                            <span class="table__text">{{ item.unit }}</span>
                        </div>
                        <div class="table__td">
                            <span class="table__text">{{ item.volume }}</span>
                        </div>
                        <div class="table__td">
                            <span class="table__text">{{ item.description }}</span>

                            <!--                        <slide-up-down :active="active.includes(item.id)">-->
                            <!--                            <div class="table__show">-->
                            <!--                                <span-->
                            <!--                                    class="table__text"-->
                            <!--                                >-->
                            <!--                                    {{ material.additional_text }}-->
                            <!--                                </span>-->
                            <!--                            </div>-->
                            <!--                        </slide-up-down>-->

                            <!--                        <button-->
                            <!--                            type="button"-->
                            <!--                            class="table-btn-arrow"-->
                            <!--                            :class="{ 'active': active.includes(material.id) }"-->
                            <!--                            @click="toggle(material.id)"-->
                            <!--                        >-->
                            <!--                            <img-->
                            <!--                                src="/library/public/img/arrow-bottom.svg"-->
                            <!--                                alt=""-->
                            <!--                            >-->
                            <!--                        </button>-->
                            <!--                        -->
                        </div>
                    </div>
                </template>
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

export default {
    name: "PurchasesTable",
    components: {
        SpinLoader,
        Pagination
    },
    data() {
        return {
            active: [],
            purchases: [],
            pagination: 0,
            pending: false,
            meta: null,
        }
    },
    computed: {
        show() {
            return this.meta.per_page * (this.meta.current_page - 1) + this.purchases.length
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
                        type: 'purchase'
                    }
                });

                this.purchases = res.data.data;
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
