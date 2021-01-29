<template>
    <div class="slider-equipment">
        <div class="slider-equipment__left">
            <span class="slider-equipment__main-title">Оборудование и  производственные подразделения</span>
            <span class="slider-equipment__subtitle">Изначально завод был задуман и построен как высокотехнологичное предприятие. Оборудование ведущих европейских производителей составляет основную часть производственных мощностей предприятия.</span>

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
                <span class="slider-hero__number">{{ step + 1 }}/{{ equipments.length }}</span>
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

        <div class="slider-equipment__right">
            <transition
                name="slider"
                mode="out-in"
            >
                <div
                    :key="step"
                    class="slider-equipment__block"
                >
                    <span class="slider-equipment__title">{{ sliderItems.title }}</span>
                    <ul
                        v-if="sliderItems.items"
                        class="quality-block__ul"
                    >
                        <li
                            v-for="(item,index) in sliderItems.items"
                            :key="index"
                            class="quality-block__li"
                        >
                            {{ item }}
                        </li>
                    </ul>
                    <span
                        v-else
                        class="slider-equipment__text"
                    >{{ sliderItems.text }}</span>
                    <img
                        :src="sliderItems.image"
                        alt=""
                        class="slider-equipment__img"
                    >
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
export default {
	name: "SliderEquipment",
	data() {
		return {
			step: 0,
			equipments: [
				{
					title: 'Высокотехнологичные линии',
					items: [
						'по разделке красной рыбы и сельди: Marel Food Systems (чистка, филетирование, порционирование) Carnitech от Marel Food Systems;',
						'по упаковке в вакууме, по технологии skin и технологии упаковки в модифицированной газовой среде: одна линия Multivac, две линии Tiromat, технология skin на multivac',
						'оборудование шоковой заморозки Marel Food Systems'
					],
					image: 'library/public/img/slider-equipment__img-1.png'
				},
				{
					title: 'Сертифицированная физико-химическая лаборатория',
					text: 'Контроль сырья, рассолов и соусов, а также продукции в процессе производства, на стадии готовности, контрольные испытания в течение срока хранения.',
					image: 'library/public/img/quality__img-1.jpg'
				},
			]
		}
	},
	computed: {
		sliderItems() {
			return this.equipments[this.step]
		},
		nextStepValidation() {
			return this.step + 1 < this.equipments.length
		},
		prevStepValidation() {
			return this.step > 0
		}
	}
}
</script>

<style scoped>

</style>
