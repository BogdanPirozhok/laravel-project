<template>
    <div class="slider-technology">
        <transition
            name="slider"
            mode="out-in"
        >
            <div
                :key="step"
                class="slider-technology__cont"
            >
                <div class="slider-technology__text">
                    <span class="title--18-28">Наши технологии и процессы</span>
                    <h2>{{ sliderItems.title }}</h2>
                    <span class="slider-technology__description">{{ sliderItems.description }}</span>
                </div>
                <div class="slider-technology__img">
                    <img
                        :src="sliderItems.src"
                        alt=""
                    >
                </div>
            </div>
        </transition>

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
            <span class="slider-hero__number">{{ step + 1 }}/{{ slider.length }}</span>
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
	data() {
		return {
			step: 0,
			slider: [
				{
					src: 'library/public/img/slider-technology__img-1.png',
					title: 'Удаление костей сельди',
					description: 'Для получения филе сельди рыбные косточки удаляются на специальном оборудовании, а затем, при необходимости, филе дорабатывается вручную. Делси не использует химических растворов для растворения костей.'
				},
				{
					src: 'library/public/img/slider-technology__img-2.png',
					title: 'Шоковая заморозка полуфабрикатов',
					description: 'На заводе установлено высококлассное импортное оборудование шоковой заморозки Marel Food Systems. Ключевое преимущество шоковой заморозки в том, что эта технология позволяет максимально сохранить свежесть, вкус, текстуру и пищевую ценность продуктов, включая витамины и питательные вещества.'
				},
				{
					src: 'library/public/img/slider-technology__img-3.png',
					title: 'Особенности переработки кальмара',
					description: 'Вся продукция Делси с кальмаром изготовлена из дикого тихоокеанского кальмара (командорский кальмар). Этот кальмар обитает в холодных водах и не такой крупный как тепловодные кальмары, зато не нуждается в обработке химическими растворами для удаления аммиачного запаха, присущего тепловодным кальмарам. '
				},
			]
		}
	},
	computed: {
		sliderItems(){
			return this.slider[this.step]
		},
		nextStepValidation(){
			return this.step + 1 < this.slider.length
		},
		prevStepValidation(){
			return this.step > 0
		}
	}
}
</script>

<style scoped>

</style>
