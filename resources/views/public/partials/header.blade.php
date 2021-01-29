<header-component v-slot:default="{ fixed, animate, open, opened, selected, mobile, mobileToggle }">
    <header
        ref="header"
        :class="{
            'active': opened || mobile ,
            'fixed': fixed,
            'animate': animate,
        }"
    >
        <div class="wrapper">
            <a
                href="/"
                class="logo"
            >
                <img
                    src="/library/img/logo.svg"
                    alt="DELSY"
                >
            </a>
            <ul class="menu">
                @foreach($mainItems as $item)
                    <li
                        class="menu__item"
                        :class="{
                            'active': {{$item->id}} === selected
                            }"
                    >
                        <a
                            href="{{ $item->item_url }}"
                            class="menu__link"
                            data-item-id="{{$item->id}}"
                            data-children="{{+isset($item->children)}}"
                            @click="open($event)"
                        >
                            {{ $item->item_caption }}
                            <svg
                                v-if="{{+isset($item->children)}}"
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
                @endforeach
                @if (Auth::check())
                    <li class="menu__item">
                        <a
                            href="/admin/profile"
                            class="menu__link to-cabinet"
                        >
                            В кабинет
                        </a>
                    </li>
                @endif

            </ul>
            <div
                class="menu-btn"
                @click="mobileToggle"
            >
                <div
                    class="menu-btn__hamburger"
                    :class="{active: mobile}"
                ></div>
            </div>

            <transition name="fade_15">
                <ul
                    v-if="mobile"
                    class="menu-mob"
                >
                    @foreach($mainItems as $item)
                        <li
                            class="menu-mob__li"
                        >
                            <a href="{{$item->item_url}}"
                               class="menu-mob__link"
                               data-item-id="{{$item->id}}"
                               data-children="{{+isset($item->children)}}"
                               :class="{active: {{$item->id}} === selected}"
                               @click="open($event)"
                            >
                                {{$item->item_caption}}
                                <img
                                    v-if="{{+isset($item->children)}}"
                                    src="/library/public/img/menu-mob__arrow.svg"
                                    alt=""
                                    class="menu-mob__arrow"
                                >
                            </a>

                            @if(isset($item->children))
                                <slide-up-down
                                    :duration="250"
                                    :active="{{$item->id}} === selected"
                                >
                                    <div
                                        class="menu-mob__show"
                                    >
                                        @foreach($item->children as $item)
                                            <a
                                                href="{{ $item->item_url }}"
                                                class="menu-mob__link"
                                            >
                                                {{ $item->item_caption }}
                                            </a>
                                        @endforeach
                                    </div>
                                </slide-up-down>
                            @endif

                        </li>
                    @endforeach
                    @if (Auth::check())
                        <li class="menu-mob__li">
                            <a
                                href="/admin/profile"
                                class="menu-mob__link"
                            >
                                В КАБИНЕТ
                            </a>
                        </li>
                    @endif
                </ul>
            </transition>
        </div>
        @foreach($subItems as $key => $item)
            <navbar-submenu
                :parent="{{ $key }}"
                :selected="selected"
                v-slot:default="{ active }"

            >
                <div
                    class="menu-show"
                    v-if="active"
                >
                    <div class="wrapper">
                        @foreach($item as $link)
                            <a
                                class="menu-show__box"
                                href="{{ $link->item_url }}"
                            >
                                <div class="menu-show__img">
                                    <img
                                        src="{{ $link->item_icon }}"
                                        alt=""
                                    >
                                </div>
                                <div class="menu-show__group">
                                    <span class="menu-show__title">{{ $link->item_caption }}</span>
                                    <span class="menu-show__text">{{ $link->item_description }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </navbar-submenu>
            @endforeach
            </template>
    </header>

</header-component>
