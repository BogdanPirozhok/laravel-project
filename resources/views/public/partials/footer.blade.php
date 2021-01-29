<div class="footer__top">
    <div class="footer__info">
        <a
            href="/"
            class="logo"
        >
            <img
                src="/library/public/img/logo-white.svg"
                alt=""
            >
        </a>
        <span class="footer__text">Производство рыбных продуктов</span>
        <span class="footer__text">г. Сосновоборск, ул. Заводская, 1 корпус 40</span>
        <a
            href="tel:88006005963"
            class="footer__text"
        >8 (800) 600-59-63 (служба качества)</a>
        <a
            href="mailto:info@delsy.ru "
            class="footer__text"
        >
            info@delsy.ru
        </a>

        <a
            href="#"
            class="footer__link"
        >
            Юридическая информация и публичная оферта
        </a>

        <div class="soc-seti white">
            @foreach($social_menu as $item)
                <a
                    href="{{ $item->item_url }}"
                    class="soc-seti__link"
                    target="{{ $item->item_target }}"
                >
                    <img src="{{ $item->item_icon }}" alt="{{ $item->item_caption }}">
                </a>
            @endforeach
        </div>
    </div>


    @foreach($footer_menu as $item)
        <div class="footer__column">
            <footer-menu-accordion>
                <template v-slot:activator="{ clicker, active }">
                    <span
                        @click="clicker"
                        class="footer__title"
                        :class="{'active': active}"
                    >
                        {{ $item->item_caption }}
                    </span>
                </template>
                <template v-slot:content>
                    <ul class="footer__list">
                        @foreach($item->children ?? [] as $child)
                            <li class="footer__item">
                                <a
                                    href="{{ $child->item_url }}"
                                    target="{{ $child->item_target }}"
                                    class="footer__link"
                                >
                                {{$child->item_caption}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </template>
            </footer-menu-accordion>
        </div>
    @endforeach
</div>
