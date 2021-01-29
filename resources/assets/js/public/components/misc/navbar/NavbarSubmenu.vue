<template>
    <transition
        name="menu-show"
        mode="out-in"
    >
        <slot
            v-if="desktop"
            v-bind="{ active }"
        />
    </transition>
</template>

<script>
export default {
    name: "NavbarSubmenu",
    props: {
        parent: {
            required: true,
            type: Number,
        },
        selected: {
            required: false,
            type: Number,
            default: null,
        },
    },
    data: function() {
        return {
            element: null,
            desktop: null,
        }
    },
    computed: {
        active() {
            return this.selected === this.parent;
        },
    },
    mounted() {
        this.isDesktop();
        window.addEventListener('resize', this.isDesktop)
    },
    methods: {
        click(event) {
            console.log('click', event)
            this.active = !this.active;
        },
        resize() {
            this.isDesktop = window.innerWidth > 768;
        },
        isDesktop() {
            if(window.innerWidth > 768){
                this.desktop = true;
            } else {
                this.desktop = false;
            }
        }
    }
}
</script>

<style scoped>

</style>
