<template>
    <div
        ref="news_select"
        v-click-outside="closeEvent"
        class="select"
        :class="{active: select}"
        @click="select = !select"
    >
        <div class="select__btn">
            <span class="select__title">{{ data.name }}</span>
        </div>

        <transition name="select">
            <ul
                v-if="select"
                class="select__ul"
            >
                <li
                    v-for="option in list"
                    :key="option.id"
                    class="select__li"
                    @click="chooseSelect(option.id)"
                >
                    {{ option.name }}
                </li>
            </ul>
        </transition>
    </div>
</template>

<script>
import Vue from 'vue';

Vue.directive('click-outside', {
	bind: function (el, binding, vnode) {
		el.event = function (event) {
			if (!(el == event.target || el.contains(event.target))) {
				vnode.context[binding.expression](event);
			}
		};
		document.body.addEventListener('click', el.event)
	},
	unbind: function (el) {
		document.body.removeEventListener('click', el.event)
	},
});

export default {
	name: "SelectComponent",
	props: {
		items: {
			type: Array,
			default(){return []}
		},
		selected: {
			type: Number,
			default: 0
		}
	},
	data() {
		return {
			select: false,
			current_select: this.selected
		}
	},
    computed: {
        data() {
            return this.list.find(item => {
                return item.id === this.current_select;
            });
        },
        list() {
            return [...this.items, {
                id: 0,
                name: 'Все'
            }];
        }
    },
	watch: {
		current_select() {
			this.$emit('update:selected', this.current_select)
		},
	},
	methods: {
		closeEvent() {
			if (this.select) {
				this.select = false;
			}
		},
		chooseSelect(val) {
			this.current_select = val;
		}
	}
}
</script>

<style scoped>

</style>
