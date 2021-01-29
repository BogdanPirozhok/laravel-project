<template>
    <div>
        <div class="activator">
            <slot
                name="activator"
                :isOpen="isOpen"
                :handleModal="handleModal"
            />
        </div>
        <div
            v-if="isOpen"
            class="overlay overlay__vacancy"
        >
            <div class="modal">
                <div class="modal__body">
                    <div class="modal__title">
                        <slot name="container:title" />
                    </div>
                    <div class="modal__main">
                        <slot
                            name="container:body"
                            :handleModal="handleModal"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalComponent",
    data: function () {
        return {
            isOpen: false,
        }
    },
    watch: {
        isOpen() {
            window.scroll_hidden()
        }
    },
    methods: {
        handleModal() {
            this.isOpen = !this.isOpen
        }
    }
}
</script>

<style scoped>

</style>
