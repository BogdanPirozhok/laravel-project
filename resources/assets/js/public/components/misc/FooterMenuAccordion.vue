<template>
    <div>
        <slot
            name="activator"
            v-bind="{ clicker, active }"
        />
        <slide-up-down :active="active">
            <slot
                name="content"
            />
        </slide-up-down>
    </div>
</template>

<script>
import 'vue-slide-up-down'

export default {
    name: "FooterAccordion",
    data: function () {
        return {
            active: false,
            desktop: true,
        }
    },
    mounted() {
        this.isDesktop();
        window.addEventListener('resize', this.isDesktop)
    },
    methods: {
        clicker() {
            if(!this.desktop) {
                this.active = !this.active;
            }
        },
        isDesktop() {
            if(window.innerWidth > 768){
                this.desktop = true;
                this.active = true;
            } else {
                this.active = false;
                this.desktop = false;
            }
        }
    }
}
</script>

<style scoped>

</style>
