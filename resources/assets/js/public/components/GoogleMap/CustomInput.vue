<template>
    <transition>
        <input
            :value="value"
            v-on="$listeners"
        >
    </transition>
</template>

<script>
export default {
    name: "CustomInput",
    props: {
        value: {
            type: String,
            default: '',
        }
    }
}
</script>

<style scoped>

</style>
