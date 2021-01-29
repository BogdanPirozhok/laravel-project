<template>
    <div class="pagination">
        <div
            class="pagination__arrow left"
            :disabled="isFirstPage"
            @click="prevPage"
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
        </div>
        <ul class="pagination__item">
            <li
                v-for="(item, index) in items"
                :key="'paging_' + index"
                class="pagination__number"
                :class="{ 'active': item == pageNumber + 1, 'numbers': typeof item === 'number'}"
                @click="toPage(item)"
            >
                {{ item }}
            </li>
        </ul>
        <div
            class="pagination__arrow right"
            :disabled="isLastPage"
            @click="nextPage"
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
        </div>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        page: {
            type: Number,
            required: true,
            default: 0
        },
        listData: {
            type: Number,
            required: true
        },
        size: {
            type: Number,
            required: false,
            default: 4
        }
    },
    data() {
        return {
            pageNumber: 0
        }
    },
    computed: {
        pageCount() {
            let l = this.listData,
                s = this.size;
            return Math.ceil(l / s);
        },
        items() {
            const maxLength = 6;

            if (this.pageCount <= maxLength || maxLength < 1) {
                return this.getRange(1, this.pageCount);
            }

            const even = maxLength % 2 === 0 ? 1 : 0;
            const left = Math.floor(maxLength / 2);
            const right = this.pageCount - left + 2 + even;

            if (this.pageNumber > left && this.pageNumber + 1 < right) {
                const start = this.pageNumber - left + 3;
                const end = this.pageNumber + left - even;

                return [1, '...', ...this.getRange(start, end), '...', this.pageCount];
            } else if (this.pageNumber === left) {
                const end = this.pageNumber + left - 1 - even;

                return [...this.getRange(1, end), '...', this.pageCount];
            } else if (this.pageNumber === right) {
                const start = this.pageNumber - left + 1;

                return [1, '...', ...this.getRange(start, this.pageCount)];
            } else {
                return [...this.getRange(1, left), '...', ...this.getRange(right, this.pageCount)];
            }
        },
        isLastPage() {
            return this.pageNumber === this.pageCount - 1

        },
        isFirstPage() {
            return this.pageNumber === 0;
        },

    },
    watch: {
        page(val) {
            this.pageNumber = val;
        },
        pageNumber() {
            this.$emit('update:page', this.pageNumber)
        },
    },
    methods: {
        getRange(from, to) {
            const range = [];
            from = from > 0 ? from : 1;
            for (let i = from; i <= to; i++) {
                range.push(i);
            }
            return range;
        },
        nextPage() {
            if (this.pageNumber < this.pageCount - 1) {
                this.pageNumber++;
            }
        },
        prevPage() {
            if (this.pageNumber > 0) {
                this.pageNumber--;
            }
        },
        toPage(val) {
            if (typeof val === 'number') {
                this.pageNumber = val - 1;
            }
        },
    }
}
</script>

<style scoped>

</style>
