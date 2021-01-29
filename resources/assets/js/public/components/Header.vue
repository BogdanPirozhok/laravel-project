<template>
    <header
        ref="header"
        v-click-outside="onClickOutside"
        :class="{
            active: opened !== null || menuMob,
            'fixed': scroll > half_screen,
            'animate': direction === 'up' && scroll > full_screen}"
    >
        <!-- вешаем сюда класс active когда открыто menu-show -->
        <div class="wrapper">
            <a
                href="/"
                class="logo"
            >
                <img
                    src="/library/public/img/logo.svg"
                    alt=""
                >
            </a>
            <ul class="menu">
                <li
                    v-for="(menu, index) in menus"
                    :key="index"
                    class="menu__item"
                    :class="{active: opened === index}"
                >
                    <a
                        class="menu__link"
                        :href="menu.href"
                        @click="openMenu(index, $event)"
                    >
                        {{ menu.title }}
                        <svg
                            v-if="menu.items"
                            class="menu__arrow"
                            width="10"
                            height="7"
                            viewBox="0 0 10 7"
                            fill="none"
                        >
                            <path
                                d="M9 5.5L5 1.5L1 5.5"
                                stroke-width="2"
                            />
                        </svg>
                    </a>
                    <svg
                        class="menu__svg"
                        width="48"
                        height="5"
                        viewBox="0 0 48 5"
                        fill="none"
                    >
                        <path
                            d="M0 4C3 4 3.18389 1 6 1C8.81611 1 9.18389 4 12 4C14.8161 4 15.1839 1 18 1C20.8161 1 21.1839 4 24 4C26.8161 4 27.1839 1 30 1C32.8161 1 33.1839 4 36 4C38.8161 4 39.1839 1 42 1C44.8161 1 45.5 4 48 4"
                        />
                    </svg>
                </li>
            </ul>

            <div
                class="menu-btn"
                @click="menuMob = !menuMob"
            >
                <div
                    class="menu-btn__hamburger"
                    :class="{active: menuMob}"
                />
            </div>

            <transition name="fade_15">
                <ul
                    v-if="menuMob"
                    class="menu-mob"
                >
                    <li
                        v-for="(menu, index) in menus"
                        :key="index"
                        class="menu-mob__li"
                    >
                        <a
                            class="menu-mob__link"
                            :class="{ active: active.includes(menu.title) }"
                            :href="menu.href"
                            @click="toggle(menu.title)"
                        >
                            {{ menu.title }}
                            <img
                                v-if="menu.items"
                                src="library/public/img/menu-mob__arrow.svg"
                                alt=""
                                class="menu-mob__arrow"
                            >
                        </a>

                        <slide-up-down
                            :duration="250"
                            :active="active.includes(menu.title)"
                        >
                            <div
                                v-if="menu.items"
                                class="menu-mob__show"
                            >
                                <a
                                    v-for="item in menu.items"
                                    :key="item.href"
                                    :href="item.href"
                                    class="menu-mob__link"
                                >{{
                                    item.title
                                }}</a>
                            </div>
                        </slide-up-down>
                    </li>
                </ul>
            </transition>
        </div>

        <transition
            name="menu-show"
            mode="out-in"
        >
            <div
                v-if="opened"
                :key="opened"
                class="menu-show"
            >
                <div class="wrapper">
                    <a
                        v-for="item in subMenu"
                        :key="item.href"
                        :href="item.href"
                        class="menu-show__box"
                    >
                        <div class="menu-show__img">
                            <img
                                :src="item.src"
                                alt=""
                            >
                        </div>
                        <div class="menu-show__group">
                            <span class="menu-show__title">{{ item.title }}</span>
                            <span class="menu-show__text">{{ item.text }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </transition>
    </header>
</template>

<script>
import Vue from "vue";
import vClickOutside from 'v-click-outside'

Vue.use(vClickOutside)

export default {
	name: "Header",
	props: {
		scroll: {
			type: Number,
			default: null
		}
	},
	data() {
		return {
			opened: null,
			active: [],
			isOpen: false,
			lastScrollTop: 0,
			half_screen: null,
			menuMob: false,
			full_screen: window.innerHeight,
			direction: 'down',
			menus: [
				{
					title: 'Продукция',
					href: '/categories',
				},
				{
					title: 'Бизнесу',
					href: '#',
					items: [
						{
							src: 'library/public/img/partners.svg',
							href: '/partnership',
							title: 'Партнёрам',
							text: 'Выгодные условия сотрудничества'
						},
						{
							src: 'library/public/img/procurement.svg',
							href: '/purchases',
							title: 'Закупки',
							text: 'Участие в тендерах'
						},
						/*{
                            src: 'library/public/img/shell.svg',
                            href: '#',
                            title: 'Реализация неликвидов',
                            text: 'Выгодные условия приобритения'
                        },*/
					]
				},
				{
					title: 'Рецепты',
					href: '/recipes',
				},
				{
					title: 'Новости',
					href: '/news',
				},
				{
					title: 'Работа',
					href: '/work',
				},
				{
					title: 'О компании',
					href: '#',
					items: [
						{
							src: 'library/public/img/heart.svg',
							href: '/about',
							title: 'О нас',
							text: 'Узнать о компании подробнее'
						},
						{
							src: 'library/public/img/like.svg',
							href: '/quality',
							title: 'Контроль качества',
							text: 'Высокие стандарты качества'
						},
						{
							src: 'library/public/img/map-ico.svg',
							href: '/networks',
							title: 'Сети и дистрибьюторы',
							text: 'Узнать где приобрести'
						},
						{
							src: 'library/public/img/phone.svg',
							href: '/contacts',
							title: 'Контакты',
							text: 'Связаться удобным способом'
						},
					]
				},
			]
		}
	},
	computed: {
		subMenu() {
			return this.menus[this.opened].items
		}
	},
	watch: {
		scroll: function () {
			this.direction = this.scroll > this.lastScrollTop ? 'down' : 'up';
			this.lastScrollTop = this.scroll;
			if (!this.$refs.header.classList.contains('animate')) {
				this.opened = null;
			}
		},
		menuMob() {
			window.scroll_hidden();
		}
	},
	mounted() {
		this.half_screen = this.full_screen / 2;
		window.addEventListener('resize', this.resize);
	},
	methods: {
		onClickOutside() {
			if (this.opened !== null) {
				this.opened = null
			}
		},
		openMenu(index, e) {
			if (this.opened === index) {
				e.preventDefault();
				this.opened = null;
			} else if (this.menus[index].items) {
				e.preventDefault();
				this.opened = index;
			}
		},
		toggle(value) {
			if (this.active.includes(value)) {
				this.active.splice(this.active.indexOf(value), 1);
			} else {
				this.active.push(value)
			}
		},
		resize: function () {
			this.full_screen = window.innerHeight;
		}
	}
}
</script>
