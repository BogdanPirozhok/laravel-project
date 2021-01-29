<template>
    <div>
        <div class="certificate">
            <div
                v-for="(item, index) in items"
                :key="index"
                class="certificate__box"
                @click="choosePicture(item)"
            >
                <img
                    :src="item"
                    :alt="'picture' + index"
                    class="certificate__img"
                >
            </div>
        </div>
        <transition name="fade_15">
            <div
                v-if="current_picture"
                class="gallery"
            >
                <img
                    :src="current_picture"
                    alt="certificate"
                    class="gallery__img"
                >
                <div
                    class="over__close"
                    @click="current_picture = null"
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
	name: "GalleryComponent",
	props: {
		items: {
			type: Array,
			default: function () {
				return []
			}
		},
	},
	data() {
		return {
			current_picture: null
		}
	},
	watch: {
		current_picture() {
			window.scroll_hidden('modal')
		}
	},
	methods: {
		choosePicture(path) {
			this.current_picture = path;
		}
	}
}
</script>

<style scoped>

</style>
