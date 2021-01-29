<template>
    <transition>
        <slot v-bind="{ clicker }" />
    </transition>
</template>

<script>
export default {
    name: "NavbarMainMenu",
    data: function () {
        return {
            offsetTop: window.pageYOffset || document.documentElement.scrollTop,
        }
    },
    mounted() {
        console.log('shit loaded')
        console.log('asdasd', this.$refs)
    },
    methods: {
        clicker() {
            console.log('clicker workeddddd')
        }
    }
}
</script>

