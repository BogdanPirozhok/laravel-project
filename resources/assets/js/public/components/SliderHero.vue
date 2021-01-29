<template>
    <div class="slider-hero">
        <div class="slider-hero__container">
            <transition
                name="slider"
                mode="out-in"
            >
                <div
                    :key="step"
                    class="slider-hero__block"
                >
                    <div class="slider-hero__img">
                        <img
                            :src="sliderItems.src"
                            alt=""
                        >
                    </div>
                    <div class="slider-hero__group">
                        <h1 class="h2">
                            {{ sliderItems.title }}
                        </h1>
                        <span
                            class="slider-hero__description"
                        > {{ sliderItems.description }} </span>
                    </div>
                </div>
            </transition>
        </div>

        <div class="slider-hero__btn-group">
            <button
                :disabled="!prevStepValidation"
                type="button"
                class="slider-btn left"
                @click="step--"
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
            </button>
            <span class="slider-hero__number">{{ step + 1 }}/{{ slider_hero.length }}</span>
            <button
                :disabled="!nextStepValidation"
                type="button"
                class="slider-btn right"
                @click="step++"
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
            </button>
        </div>
    </div>
</template>

<script>
export default {
	name: "SliderFade",
    props: {
        // eslint-disable-next-line vue/prop-name-casing
        slider_hero: {
            required: true,
            type: Array,
        }
    },
	data() {
		return {
			step: 0,
		}
	},
	computed: {
		sliderItems(){
			return this.slider_hero[this.step]
		},
		nextStepValidation(){
			return this.step + 1 < this.slider_hero.length
		},
		prevStepValidation(){
			return this.step > 0
		}
	}
}
</script>

<style scoped>

</style>
