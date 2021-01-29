window.axios = require('axios');

require('./helper')

import Vue from 'vue';
import MaskedInput from 'vue-masked-input';
import Waves from "./components/Waves";
import Header from "./components/Header";
import SliderHero from "./components/SliderHero";
import SliderPopular from "./components/SliderPopular";
import FilterComponent from "./components/FilterComponent";
import SlideUpDown from 'vue-slide-up-down'
import SliderTechnology from "./components/SliderTechnology";
import SliderCarousel from "./components/SliderCarousel";
import SliderEquipment from "./components/SliderEquipment";
import GalleryComponent from "./components/GalleryComponent";
import PurchasesTable from "./components/Tenders/PurchasesTable";
import TendersTable from "./components/Tenders/TendersTable";
import NewsComponent from "./components/NewsComponent";
import RecipesComponent from "./components/RecipesComponent";
import CatalogComponent from "./components/CatalogComponent";
import VacanciesComponent from "./components/VacanciesComponent";
import FooterTop from "./components/FooterTop";
import smoothscroll from 'smoothscroll-polyfill';
import ContactForm from "./components/Forms/ContactForm";
import QualityForm from "./components/Forms/QualityForm";
import CatalogRequestForm from "./components/Forms/CatalogRequestForm";
import TenderRequestForm from "./components/Forms/TenderRequestForm";
import ModalComponent from "./components/Modals/ModalComponent";
import VacancyInquirerForm from "./components/Forms/VacancyInquirerForm";
import FooterMenuAccordion from "./components/misc/FooterMenuAccordion";
import NavbarSubmenu from "./components/misc/navbar/NavbarSubmenu";
import NavbarMainMenu from "./components/misc/navbar/NavbarMainMenu";
import HeaderComponent from "./components/misc/navbar/HeaderComponent";
import GoogleMap from "./components/GoogleMap/Map";
import NetworksComponent from "./components/NetworksComponent";
import CommonMixin from './mixin/common.js';


import VueSocialSharing from 'vue-social-sharing'

Vue.use(VueSocialSharing)
Vue.component('SlideUpDown', SlideUpDown)
Vue.mixin(CommonMixin);

new Vue({
    el: '#app',
    components: {
        Waves,
        'social-sharing': VueSocialSharing,
        'header-item': Header,
        SliderHero,
        SliderPopular,
        SliderTechnology,
        SliderCarousel,
        SliderEquipment,
        FilterComponent,
        GalleryComponent,
        PurchasesTable,
        TendersTable,
        NewsComponent,
        RecipesComponent,
        CatalogComponent,
        VacanciesComponent,
        FooterTop,
        MaskedInput,
        ContactForm,
        QualityForm,
        CatalogRequestForm,
        TenderRequestForm,
        ModalComponent,
        VacancyInquirerForm,
        FooterMenuAccordion,
        NavbarSubmenu,
        NavbarMainMenu,
        HeaderComponent,
        GoogleMap,
        NetworksComponent
    },
    data() {
        return {
            sitekey: process.env.MIX_RECAPTCHA_SITE_KEY,
            workModal: false,
            pathname: window.location.pathname,
            href: window.location.href,
            offsetTop: window.pageYOffset || document.documentElement.scrollTop,
            screenHeight: window.innerHeight,
            isLoading: {
                show: true,
                complete: false
            },
            categoriesSlides: [
                {src: 'library/public/img/categories__img-1.png', title: 'Филе сельди слабосолёное в масле'},
                {src: 'library/public/img/categories__img-2.png', title: 'Форель слабосолёная филе-кусочки в масле'},
                {src: 'library/public/img/categories__img-3.png', title: 'Салат “Греческий” морская капуста с горохом'},
                {src: 'library/public/img/categories__img-4.png', title: 'Филе сельди слабосолёное в масле'},
                {src: 'library/public/img/categories__img-5.png', title: 'Филе сельди слабосолёное в масле'},
                {src: 'library/public/img/categories__img-6.png', title: 'Филе сельди слабосолёное в масле'},
            ],
            recipeSlides: [
                {src: 'library/public/img/categories__img-1.png', title: 'Филе сельди слабосолёное в масле'},
                {src: 'library/public/img/categories__img-2.png', title: 'Форель слабосолёная филе-кусочки в масле'},
                {src: 'library/public/img/categories__img-3.png', title: 'Салат “Греческий” морская капуста с горохом'},
                {src: 'library/public/img/categories__img-4.png', title: 'Филе сельди слабосолёное в масле'},
                {src: 'library/public/img/categories__img-5.png', title: 'Филе сельди слабосолёное в масле'},
                {src: 'library/public/img/categories__img-6.png', title: 'Филе сельди слабосолёное в масле'},
            ],
            certificates: [
                'library/public/img/certificate__img-1.jpg',
                'library/public/img/certificate__img-2.jpg',
                'library/public/img/certificate__img-3.jpg',
                'library/public/img/certificate__img-4.jpg',
            ],
            awards: [
                'library/public/img/certificate__img-5.jpg',
                'library/public/img/certificate__img-6.jpg',
            ],
        }
    },
    watch: {
        workModal() {
            window.scroll_hidden('modal');
        }
    },
    mounted() {
        window.scroll_hidden();
        let self = this;
        window.onload = function () {
            setTimeout(() => {
                self.isLoading.show = false;
                self.isLoading.complete = true;

                window.scroll_hidden();
            }, 1500)
        };
        smoothscroll.polyfill();
        window.addEventListener('scroll', this.handleScroll);
        document.querySelectorAll('a.is-anchor[href*="#"]').forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                document.body.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
    },
    methods: {
        printDiv() {
            let divContents = document.getElementById("recipe").innerHTML;
            let a = window.open('', '', 'height=1000, width=1000');
            a.document.write('<html><head>' +
                '<link rel="stylesheet" type="text/css" href="/library/css/print.css"/>'
            );
            a.document.write(divContents);
            a.document.write('</head></body></html>');
            a.document.close();
            a.print();
        },
        parallax() {
            let parallax = document.querySelectorAll('.parent-parallax div');

            parallax.forEach(el => {
                if (this.inView(el)) {
                    let scroll = (window.pageYOffset - el.offsetTop) / 10;
                    el.style.transform = "translate3d(0px, " + scroll + "px, 0px)";
                }
            })
        },
        inView(element) {
            let rect = element.getBoundingClientRect();
            return (
                rect.top >= 0 ||
                rect.bottom <= window.innerHeight
            );
        },
        handleScroll() {
            this.parallax();
            this.offsetTop = window.pageYOffset || document.documentElement.scrollTop;
        },
    }

})
