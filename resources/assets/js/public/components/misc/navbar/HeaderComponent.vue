<template>
    <transition>
        <slot v-bind="{ fixed, animate, opened, open, selected, mobile, mobileToggle }" />
    </transition>
</template>

<script>
export default {
    name: "HeaderComponent",
    data: function() {
        return {
            mobileMenu: false,
            fullScreen: window.innerHeight,
            direction: 'down',
            lastScrollTop: 0,
            selected: null,
            header: null,
            mobile: false,
        }
    },
    computed: {
        fixed() {
            return this.offsetTop > this.halfScreen;
        },
        animate() {
            return this.direction === 'up' && this.offsetTop > this.fullScreen;
        },
        opened() {
            return this.selected !== null;
        },
        halfScreen() {
            return this.fullScreen / 2;
        },
        offsetTop() {
            return this.$root.offsetTop;
        }
    },
    watch: {
        offsetTop: function() {
            this.direction = this.offsetTop > this.lastScrollTop ? 'down' : 'up';
            this.lastScrollTop = this.offsetTop;
            if (!this.header.classList.contains('animate')) {
                this.selected = null;
            }
        },
        mobile() {
            window.scroll_hidden();
        }
    },
    mounted() {
        window.addEventListener('resize', this.resize);
        this.$nextTick(function() {
            this.header = this.$scopedSlots.default()[0].context.$refs.header;
        });
    },
    methods: {
        resize() {
            this.fullScreen = window.innerHeight;
        },
        open(event) {
            if(parseInt(event.currentTarget.dataset.itemId) === this.selected) {
                event.preventDefault();
                this.selected = null;
            } else if (event.currentTarget.dataset.children === "1") {
                event.preventDefault();
                this.selected = parseInt(event.currentTarget.dataset.itemId);
            }
        },
        mobileToggle() {
            this.mobile = !this.mobile;
        }
    }
}
</script>

<style scoped>

</style>
