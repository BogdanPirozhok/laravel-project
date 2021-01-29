<template>
    <div class="slider-popular">
        <transition-group
            name="popular"
            class="slider-popular__container"
            tag="div"
        >
            <a
                v-for="item in slidesComputed"
                :key="item.id"
                :href="item.url"
                class="slider-popular__box"
                @touchstart="startSwipe($event)"
                @touchmove="moveSwipe($event)"
                @touchend="endSwipe()"
            >
                <img
                    :src="item.image_url"
                    class="slider-popular__img"
                >
                <span class="slider-popular__name">{{ item.name.ru }}</span>
            </a>
        </transition-group>

        <button
            type="button"
            class="slider-btn left"
            :disabled="(current_slide + 1) === 1"
            @click="sliderPrev"
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
        <button
            type="button"
            class="slider-btn right"
            :disabled="(current_slide + quantity) === slide.length || (current_slide + quantity) > slide.length"
            @click="sliderNext"
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

        <div class="slider-popular__progress">
            <span
                class="slider-popular__line"
                :style="{
                    'left': positionBar(),
                    'width': widthBar()
                }"
            />
        </div>
    </div>
</template>

<script>
export default {
	name: "SliderPopular",
	props: {
		slide: {
			type: Array,
			default() {
				return []
			}
		}
	},
	data() {
		return {
			progress_width: 0,
			current_slide: null,
			move: 'sliderL',
			quantity: 4,
			firstTouch: null,
			moving_to: null,
			slides: this.slide
		}
	},
	computed: {
		slidesComputed() {
			let slides = this.slides;
			let lastSlider = this.slides[this.slides.length - 1];
			let firstSlider = this.slides[0];
			if (this.current_slide >= 0 && this.move === 'sliderL' && this.current_slide !== null) {
				slides.pop();
				slides.unshift(lastSlider);
			}
			if (this.current_slide + 1 < this.slides.length && this.move === 'sliderR') {
				slides.shift();
				slides.push(firstSlider);
			}
			return slides.slice(0, this.quantity);
		}
	},
	watch: {
		progressWidth() {
			this.positionBar()
		}
	},
	mounted: function () {
		this.sliderWidth();
		window.addEventListener('resize', this.sliderWidth, false);
	},
	methods: {
		getTouches(evt) {
			return evt.touches;
		},
		startSwipe(evt) {
			window.scroll_hidden();
			const firstTouch = this.getTouches(evt)[0];
			this.firstTouch = firstTouch.clientX;
		},
		moveSwipe(evt) {
			window.scroll_hidden();
			this.moving_to = evt.touches[0].clientX;
		},
		endSwipe() {
			let xDiff = this.firstTouch - this.moving_to;
			if (xDiff > 0) {
				this.sliderNext();
			} else {
				this.sliderPrev();
			}
			this.firstTouch = null;
		},

        widthBar() {
            if((this.current_slide + this.quantity) > this.slide.length){
                return this.progress_width = '100%';
            } else {
                return this.progress_width = 100 / this.slide.length * this.quantity + '%'
            }
        },
        positionBar() {
            if((this.current_slide + this.quantity) > this.slide.length){
                return this.progress_width = '0%';
            } else {
                return this.progress_width = (100 / this.slide.length) * (this.current_slide) + '%'
            }
        },
		sliderWidth: function () {
			let w = window.innerWidth;
			if (w >= 992) {
				this.quantity = 4
			} else if (w <= 991 && w >= 768) {
				this.quantity = 3
			} else if (w <= 767 && w >= 481) {
				this.quantity = 2
			} else if (w <= 480) {
				this.quantity = 1
			}
		},
		sliderPrev: function () {
			this.current_slide--;
			this.move = 'sliderL';
		},
		sliderNext: function () {
			this.current_slide++
			this.move = 'sliderR';
		},
	}
}
</script>

<style scoped>

</style>
