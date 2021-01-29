<template>
    <div class="filter">
        <div class="filter-desktop">
            <div class="filter__group">
                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                >
                    <path
                        d="M16 8H4"
                        stroke="#1C2034"
                        stroke-width="2"
                    />
                    <path
                        d="M2 8H0"
                        stroke="#1C2034"
                        stroke-width="2"
                    />
                    <path
                        d="M2 13H0"
                        stroke="#1C2034"
                        stroke-width="2"
                    />
                    <path
                        d="M2 3H0"
                        stroke="#1C2034"
                        stroke-width="2"
                    />
                    <path
                        d="M16 13H4"
                        stroke="#1C2034"
                        stroke-width="2"
                    />
                    <path
                        d="M16 3H4"
                        stroke="#1C2034"
                        stroke-width="2"
                    />
                </svg>
                <span class="filter__text--16">Фильтры ({{ checkedItems.base.length }})</span>
                <button
                    class="button-text"
                    :disabled="!checkedItems.base.length"
                    @click="reset"
                >
                    Сбросить
                </button>
            </div>

            <div
                v-for="item in filterData"
                :key="item.id"
                class="filter__block"
            >
                <div
                    class="filter__btn"
                    :class="{ 'active': active.includes(item.id)}"
                    @click="checkedOrToggle('active', item.id)"
                >
                    <span class="filter__title">{{ item.name }}</span>
                    <div class="filter__plus" />
                </div>
                <slide-up-down :active="active.includes(item.id)">
                    <div class="filter__show">
                        <label
                            v-for="sub_item in item.descendants"
                            :key="sub_item.id"
                            class="checked-circle"
                        >
                            <input
                                v-model="checkedItems.base"
                                :value="sub_item.id"
                                name="filter[]"
                                type="checkbox"
                                class="checked-circle__input"
                            >
                            <span class="checked-circle__mark" />
                            <span class="checked-circle__name">{{ sub_item.name }}</span>
                        </label>
                    </div>
                </slide-up-down>
            </div>
        </div>

        <div class="filter-mobile">
            <button
                v-for="(item) in filterData"
                :key="item.id"
                type="button"
                class="filter-mobile__btn"
                :style="{'background-color': color}"
                @click="openModal(item.id)"
            >
                {{ item.name }}
            </button>
        </div>
        <transition name="fade_15">
            <div
                v-if="filterMobile"
                class="filter-mobile__show"
            >
                <div class="filter-mobile__group">
                    <span class="filter-mobile__title">{{ modalFilters.name }}</span>

                    <div
                        class="filter-mobile__close"
                        @click="filterMobile = false"
                    >
                        <svg
                            width="18"
                            height="18"
                            viewBox="0 0 18 18"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M1 1L17 17"
                                stroke="#1C2034"
                            />
                            <path
                                d="M1 17L17 1"
                                stroke="#1C2034"
                            />
                        </svg>
                    </div>
                </div>

                <label
                    v-for="item in modalFilters.descendants"
                    :key="item.id"
                    class="checked-circle"
                >
                    <input
                        v-model="checkedItems.mobile"
                        type="checkbox"
                        class="checked-circle__input"
                        :value="item.id"
                    >
                    <span class="checked-circle__mark" />
                    <span class="checked-circle__name">{{ item.name }}</span>
                </label>

                <button
                    type="button"
                    class="btn"
                    @click="applyFilter"
                >
                    Применить фильтр
                </button>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
	name: "FilterComponent",
	props: {
		filterItems: {
			type: Array,
			default() {
				return []
			}
		},
        filterGroupActive: {
            type: Array,
            default() {
                return []
            }
        },
        filterChose: {
            type: Array,
            default() {
                return []
            }
        },
		color: {
			type: String,
			default: null
		}
	},
	data() {
		return {
            checkedItems: {
                base: this.filterChose,
                mobile: []
            },
            active: this.filterGroupActive,
			filterMobile: false,
            choosedID: null
		}
	},
	computed: {
		modalFilters() {
            return this.filterItems.find(item => item.id === this.choosedID)
		},
        filterData() {
            return this.filterItems.filter(item => {
                return item.descendants.length
            })
        }
	},
    watch: {
        'checkedItems.base'() {
            this.$emit('update:filterChose', this.checkedItems.base);
        }
    },
	methods: {
		checkedOrToggle(array, value) {
			if (this[array].includes(value)) {
				this[array].splice(this[array].indexOf(value), 1);
			} else {
				this[array].push(value)
			}
		},
		openModal(id) {
			this.filterMobile = true;
			this.choosedID = id;
		},
        applyFilter() {
            this.checkedItems.base = this.checkedItems.mobile;
            this.filterMobile = false;
        },
        reset() {
            this.checkedItems.base = [];
        }
	}
}
</script>
