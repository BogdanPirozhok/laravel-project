<template>
    <div class="slider-carousel">
        <div class="slider-carousel__text">
            <span class="slider-carousel__title">
                <slot name="title" />
            </span>
            <p class="slider-carousel__description">
                <slot name="description" />
            </p>

            <div class="slider-carousel__btn-group">
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
                    :disabled="(current_slide + 1) === videos.length"
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
            </div>
        </div>

        <div
            ref="content"
            class="slider-carousel__cont"
        >
            <transition
                name="carousel"
                mode="out-in"
            >
                <div
                    ref="track"
                    class="slider-carousel__track"
                >
                    <div
                        v-for="(slide, index) in videos"
                        ref="block"
                        :key="index"
                        class="slider-carousel__block"
                        :style="{
                            'width': block_width / quantity_frames + 'px',
                            'min-width': block_width / quantity_frames + 'px',
                        }"
                        @click="openVideo(index)"
                        @touchstart="startSwipe($event)"
                        @touchmove="moveSwipe($event)"
                        @touchend="endSwipe($event)"
                    >
                        <img
                            :src="slide.preview_url"
                            alt=""
                            class="slider-carousel__img"
                        >
                    </div>
                </div>
            </transition>


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

        <transition name="fade_15">
            <div
                v-if="overlay"
                class="overlay"
            >
                <iframe
                    width="632"
                    height="356"
                    :src="videos[opened].video_url"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                />

                <div class="preloader">
                    <svg
                        class="preloader__spinner"
                        viewBox="0 0 66 66"
                    >
                        <circle
                            class="preloader__circle"
                            fill="none"
                            stroke-width="4"
                            stroke-linecap="round"
                            cx="33"
                            cy="33"
                            r="30"
                        />
                    </svg>
                    <svg
                        class="preloader__spinner-bg"
                        viewBox="0 0 66 66"
                    >
                        <circle
                            class="preloader__circle-bg"
                            fill="none"
                            stroke-width="4"
                            stroke-linecap="round"
                            cx="33"
                            cy="33"
                            r="30"
                        />
                    </svg>
                </div>

                <div
                    class="over__close"
                    @click="closeVideo"
                >
                    <svg
                        width="357"
                        height="357"
                        viewBox="0 0 357 357"
                        fill="white"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M357 35.7L321.3 0L178.5 142.8L35.7 0L0 35.7L142.8 178.5L0 321.3L35.7 357L178.5 214.2L321.3 357L357 321.3L214.2 178.5L357 35.7Z"
                        />
                    </svg>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "SliderCarousel",
    props: {
        videos: {
            required: true,
            type: Array,
        }
    },
    data() {
        return {
            current_slide: 0,
            block_width: 0,
            quantity_frames: 1.25,
            overlay: false,
            firstTouch: null,
            moving_to: null,
            opened: null,
        }
    },
    watch: {
        overlay() {
            setTimeout(() => {
                window.scroll_hidden('modal');
            }, 150)
        },
    },
    mounted() {
        this.sliderWidth();
        window.addEventListener('resize', this.sliderWidth, false);
    },
    methods: {
        openVideo(index) {
            this.opened = index;
            this.overlay = true;
        },
        closeVideo() {
            this.opened = null;
            this.overlay = false;
        },
        getTouches(evt) {
            return evt.touches;
        },
        startSwipe(evt) {
            const firstTouch = this.getTouches(evt)[0];
            this.firstTouch = firstTouch.clientX;
        },
        moveSwipe(evt) {
            this.moving_to = evt.touches[0].clientX;
        },
        endSwipe() {
            let xDiff = this.firstTouch - this.moving_to;
            if (this.overlay === false) {
                if (xDiff > 50) {
                    this.sliderNext();
                } else if (xDiff < -50) {
                    this.sliderPrev();
                }
            }

            this.firstTouch = null;
        },
        sliderWidth() {
            this.transform();
            this.block_width = this.$refs.content.offsetWidth
            let w = window.innerWidth;
            if (w >= 992) {
                this.quantity_frames = 1.25
            } else if (w <= 991 && w >= 768) {
                this.quantity_frames = 1.5
            } else if (w <= 767) {
                this.quantity_frames = 1
            }
        },
        widthBar() {
            return 100 / this.videos.length + '%'
        },
        positionBar() {
            return ((100 / this.videos.length) * (this.current_slide)) + '%'
        },
        transform() {
            let transform = ((this.$refs.block[this.current_slide].offsetWidth + 16) * this.current_slide);
            let transform_last = (this.$refs.block[this.current_slide].offsetWidth + 16) / this.quantity_frames;

            if (window.innerWidth >= 992 && (this.current_slide + 1) === this.videos.length) {
                this.$refs.track.style.transform = "translateX(-" + (transform - transform_last / (this.quantity_frames * 3) - 16) + "px)"
            } else if (window.innerWidth >= 768 && (this.current_slide + 1) === this.videos.length) {
                this.$refs.track.style.transform = "translateX(-" + (transform - transform_last / this.quantity_frames - 16) + "px)"
            } else {
                this.$refs.track.style.transform = "translateX(-" + transform + "px)";
            }
        },
        sliderPrev() {
            if (this.current_slide > 0) {
                this.current_slide--;
                this.transform()
            }
        },
        sliderNext() {
            if (this.current_slide + 1 < this.videos.length) {
                this.current_slide++
                this.transform()
            }
        },
    }
}
</script>
