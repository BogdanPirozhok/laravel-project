<template>
    <form
        class="quality-form"
        @submit.prevent="onSubmit"
    >
        <transition name="loader">
            <div
                v-if="result >= 0"
                class="overlay"
            >
                <div class="modal-notify">
                    <form-action
                        :result.sync="result"
                        :content="notify"
                    />

                    <div
                        class="over__close"
                        @click="result = -1"
                    >
                        <svg
                            width="357"
                            height="357"
                            viewBox="0 0 357 357"
                            fill="white"
                        ><path d="M357 35.7L321.3 0L178.5 142.8L35.7 0L0 35.7L142.8 178.5L0 321.3L35.7 357L178.5 214.2L321.3 357L357 321.3L214.2 178.5L357 35.7Z" /></svg>
                    </div>
                </div>
            </div>
        </transition>
        <span class="quality-form__main-title">Анкета о качестве продукции Делси</span>

        <div class="quality-form__row">
            <div class="quality-form__left">
                <span class="quality-form__subtitle"><b>Уважаемый покупатель!</b></span>
                <span class="quality-form__text">Мы очень рады, что вы решили поделиться своим мнением о качестве продукции Делси!</span>
            </div>
        </div>

        <div class="dashed dashed dashed--margin-64" />

        <!--        wishes-->
        <div class="quality-form__row">
            <div class="quality-form__left">
                <span class="quality-form__text blue">Если ваше обращение не относится к конкретному продукту, носит общий характер, является предложением по улучшению ассортимента, упаковки, выкладки и подобное, пожалуйста, напишите его здесь:</span>
            </div>
            <div class="quality-form__right">
                <div
                    class="box-input textarea"
                    :class="{'success': form.wishes.validation.validated === 1, 'error': form.wishes.validation.validated === 2}"
                >
                    <span class="box-input__title">Комментарий</span>
                    <textarea
                        v-model="form.wishes.value"
                        class="box-input__textarea"
                        :required="requiredWishes"
                        @input="form.wishes.validation.callback()"
                    />

                    <span class="box-input__error">{{ form.wishes.validation.message }}</span>
                </div>
            </div>
        </div>

        <div class="dashed" />

        <span class="quality-form__text text--margin-32">Если вы хотите оставить свой отзыв относительно конкретного продукта Делси, пожалуйста, заполните короткую анкету, чтобы мы смогли определить продукт и принять необходимые меры.</span>
        <!--        purchase_date-->
        <div class="quality-form__row">
            <div class="quality-form__left">
                <span class="quality-form__text blue">Дата покупки (если не помните точную дату, укажите приблизительную).</span>
            </div>
            <div class="quality-form__right">
                <!-- на блок box-input вешаем класс success или error (в error инпут заносим ошибку)-->
                <div
                    class="box-input"
                    :class="{'success': form.purchase_date.validation.validated === 1, 'error': form.purchase_date.validation.validated === 2}"
                >
                    <span class="box-input__title">Дата покупки</span>
                    <input
                        v-model="form.purchase_date.value"
                        type="date"
                        name="purchase_date"
                        class="box-input__input box-input__input--data"
                        max="2100-12-31"
                        :required="form.purchase_date.required"
                        @input="form.purchase_date.validation.callback()"
                    >

                    <span class="box-input__error">{{ form.purchase_date.validation.message }}</span>
                </div>
            </div>
        </div>

        <!--        purchase_place_name-->
        <!--        purchase_place_address-->
        <div class="quality-form__row">
            <div class="quality-form__left">
                <span class="quality-form__text blue">Место покупки</span>
            </div>
            <div class="quality-form__right">
                <div
                    class="box-input"
                    :class="{'success': form.purchase_place_name.validation.validated === 1, 'error': form.purchase_place_name.validation.validated === 2}"
                >
                    <span class="box-input__title">Введите название магазина</span>
                    <input
                        v-model="form.purchase_place_name.value"
                        name="purchase_place_name"
                        type="text"
                        class="box-input__input"
                        :required="form.purchase_place_name.required"
                        @input="form.purchase_place_name.validation.callback()"
                    >

                    <span class="box-input__error">{{ form.purchase_place_name.validation.message }}</span>
                </div>

                <div
                    class="box-input"
                    :class="{'success': form.purchase_place_address.validation.validated === 1, 'error': form.purchase_place_address.validation.validated === 2}"
                >
                    <span class="box-input__title">Введите адрес магазина</span>
                    <input
                        v-model="form.purchase_place_address.value"
                        name="purchase_place_address"
                        type="text"
                        class="box-input__input"
                        :required="form.purchase_place_address.required"
                        @input="form.purchase_place_address.validation.callback()"
                    >

                    <span class="box-input__error"> {{ form.purchase_place_address.validation.message }} </span>
                </div>
            </div>
        </div>

        <!--        barcode_file-->
        <div class="quality-form__row">
            <div class="quality-form__left">
                <span class="quality-form__text blue text--margin-32">Загрузите фото черно-белой этикетки с датой производства</span>
            </div>
            <div class="quality-form__right">
                <label class="up-file">
                    <input
                        name="barcode_file"
                        type="file"
                        class="upload-file__input"
                        :required="form.barcode_file.required"
                        @input="fileHandler($event, 'barcode_file')"
                    >

                    <template v-if="form.barcode_file.validation.validated === 0">
                        <svg
                            class="upload-file__clip"
                            width="16"
                            height="16"
                            viewBox="0 0 16 16"
                            fill="currentColor"
                        >
                            <path
                                d="M15.1279 9.08251L15.0529 8.9769L7.906 1.42574C6.10677 -0.475248 3.18302 -0.475248 1.35881 1.42574C-0.465409 3.32673 -0.44042 6.44224 1.35881 8.34323L8.6057 16L9.3054 15.2607L2.05851 7.60396C1.3838 6.86469 1.00896 5.91419 1.00896 4.88449C1.00896 3.85479 1.3838 2.90429 2.05851 2.16502C3.4829 0.660066 5.78191 0.660066 7.18131 2.16502L13.1038 8.42244L14.3532 9.74257C15.2279 10.6667 15.2279 12.1716 14.3532 13.0957C13.9284 13.5446 13.3537 13.7822 12.7539 13.7822C12.1542 13.7822 11.5794 13.5446 11.1546 13.0957L4.00767 5.51815C3.83275 5.33333 3.75778 5.12211 3.75778 4.88449C3.75778 4.64686 3.85773 4.40924 4.03266 4.22442C4.35752 3.88119 4.90728 3.88119 5.25713 4.22442L12.4291 11.802L13.1288 11.0627L5.93184 3.45875C5.20716 2.69307 4.03266 2.69307 3.28298 3.48515C2.93313 3.85479 2.73322 4.35644 2.73322 4.88449C2.73322 5.41254 2.93313 5.91419 3.28298 6.28383L10.4549 13.8614C11.7294 15.2079 13.7785 15.2079 15.0529 13.8614C16.2774 12.5413 16.3274 10.429 15.1279 9.08251Z"
                            />
                        </svg>
                        <span class="up-file__text">Прикрепить изображение <b>(в форматах:  {{ form.barcode_file.validation.rules.ext.join(', ').toUpperCase() }}, не более 5Мб )</b></span>
                    </template>

                    <template v-else-if="form.barcode_file.validation.validated === 1">
                        <svg
                            class="upload-file__clip"
                            width="16"
                            height="16"
                            viewBox="0 0 16 16"
                            fill="currentColor"
                        >
                            <path d="M15.1279 9.08251L15.0529 8.9769L7.906 1.42574C6.10677 -0.475248 3.18302 -0.475248 1.35881 1.42574C-0.465409 3.32673 -0.44042 6.44224 1.35881 8.34323L8.6057 16L9.3054 15.2607L2.05851 7.60396C1.3838 6.86469 1.00896 5.91419 1.00896 4.88449C1.00896 3.85479 1.3838 2.90429 2.05851 2.16502C3.4829 0.660066 5.78191 0.660066 7.18131 2.16502L13.1038 8.42244L14.3532 9.74257C15.2279 10.6667 15.2279 12.1716 14.3532 13.0957C13.9284 13.5446 13.3537 13.7822 12.7539 13.7822C12.1542 13.7822 11.5794 13.5446 11.1546 13.0957L4.00767 5.51815C3.83275 5.33333 3.75778 5.12211 3.75778 4.88449C3.75778 4.64686 3.85773 4.40924 4.03266 4.22442C4.35752 3.88119 4.90728 3.88119 5.25713 4.22442L12.4291 11.802L13.1288 11.0627L5.93184 3.45875C5.20716 2.69307 4.03266 2.69307 3.28298 3.48515C2.93313 3.85479 2.73322 4.35644 2.73322 4.88449C2.73322 5.41254 2.93313 5.91419 3.28298 6.28383L10.4549 13.8614C11.7294 15.2079 13.7785 15.2079 15.0529 13.8614C16.2774 12.5413 16.3274 10.429 15.1279 9.08251Z" />
                        </svg>
                        <span class="up-file__text"> {{ form.barcode_file.value.name }} </span>
                    </template>

                    <template v-else-if="form.barcode_file.validation.validated === 2">
                        <img
                            :src="'/library/public/img/up-file__close.svg'"
                            class="up-file__error"
                        >
                        <span class="up-file__text"> {{ form.barcode_file.validation.message }} </span>
                    </template>

                    <!--                   todo: hz zachem ono tut-->
                    <!--                    <span class="preloader">-->
                    <!--                        <svg class="preloader__spinner" viewBox="0 0 66 66">-->
                    <!--                            <circle class="preloader__circle" fill="none" stroke-width="6"-->
                    <!--                                    stroke-linecap="round" cx="33" cy="33" r="30"></circle>-->
                    <!--                        </svg>-->
                    <!--                        <svg class="preloader__spinner-bg" viewBox="0 0 66 66">-->
                    <!--                            <circle class="preloader__circle-bg" fill="none" stroke-width="6"-->
                    <!--                                    stroke-linecap="round" cx="33" cy="33" r="30"></circle>-->
                    <!--                        </svg>-->
                    <!--                    </span>-->

                </label>
            </div>
        </div>

        <!--        purchase_product_date-->
        <div class="quality-form__row">
            <div class="quality-form__left">
                <span class="quality-form__text blue">Дата производства (если не помните точную дату, укажите приблизительную)</span>
            </div>
            <div class="quality-form__right">
                <!-- на блок box-input вешаем класс success или error (в error инпут заносим ошибку)-->
                <div
                    class="box-input"
                    :class="{'success': form.purchase_product_date.validation.validated === 1, 'error': form.purchase_product_date.validation.validated === 2}"
                >
                    <span class="box-input__title">Дата производства</span>
                    <input
                        v-model="form.purchase_product_date.value"
                        type="date"
                        name="purchase_date"
                        class="box-input__input box-input__input--data"
                        max="2100-12-31"
                        :required="form.purchase_product_date.required"
                        @input="form.purchase_product_date.validation.callback()"
                    >

                    <span class="box-input__error">{{ form.purchase_product_date.validation.message }}</span>
                </div>
            </div>
        </div>

        <!--        purchase_product_description-->
        <div class="quality-form__row">
            <div class="quality-form__left">
                <span class="quality-form__text blue">Пожалуйста, напишите ваш комментарий о качестве продукта или упаковки. Мы также рассматриваем и принимаем меры по сообщениям о нарушениях правил хранения продукции в точках продаж</span>
            </div>
            <div class="quality-form__right">
                <div
                    class="box-input textarea"
                    :class="{'success': form.purchase_product_description.validation.validated === 1, 'error': form.purchase_product_description.validation.validated === 2}"
                >
                    <span class="box-input__title">Комментарий</span>
                    <textarea
                        v-model="form.purchase_product_description.value"
                        class="box-input__textarea"
                        :required="form.purchase_product_description.required"
                        @input="form.purchase_product_description.validation.callback()"
                    />

                    <span class="box-input__error"> {{ form.purchase_product_description.validation.message }} </span>
                </div>
            </div>
        </div>

        <div class="dashed" />

        <!--        contact_me-->
        <div class="quality-form__row">
            <div class="quality-form__left">
                <span class="quality-form__text blue">Хотите чтобы мы с Вами связались?</span>
            </div>
            <div class="quality-form__right">
                <div class="checked-box">
                    <div
                        class="checked-box__group box-input"
                        :class="{'success': form.contact_me.validation.validated === 1, 'error': form.contact_me.validation.validated === 2}"
                    >
                        <label class="checked-circle">
                            <input
                                v-model="form.contact_me.value"
                                :value="1"
                                type="radio"
                                name="quality__yes-no"
                                class="checked-circle__input"
                            >
                            <span class="checked-circle__mark" />
                            <span class="checked-circle__name">Да</span>
                        </label>
                        <label class="checked-circle">
                            <input
                                v-model="form.contact_me.value"
                                :value="0"
                                type="radio"
                                name="quality__yes-no"
                                class="checked-circle__input"
                            >
                            <span class="checked-circle__mark" />
                            <span class="checked-circle__name">Нет</span>
                        </label>
                        <span class="box-input__error">{{ form.contact_me.validation.message }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!--        contact_name-->
        <!--        contact_attribute-->
        <div
            v-if="form.contact_me.value === 1"
            class="quality-form__row"
        >
            <div class="quality-form__left">
                <span class="quality-form__text blue">Укажите свое имя и контакты (e-mail или телефон):</span>
            </div>
            <div class="quality-form__right">
                <div
                    class="box-input"
                    :class="{'success': form.contact_name.validation.validated === 1, 'error': form.contact_name.validation.validated === 2}"
                >
                    <span class="box-input__title">Имя</span>
                    <input
                        v-model="form.contact_name.value"
                        name="contact_name"
                        type="text"
                        class="box-input__input"
                        :required="form.contact_name.required"
                        @input="form.contact_name.validation.callback()"
                    >

                    <span class="box-input__error">{{ form.contact_name.validation.message }}</span>
                </div>

                <div
                    class="box-input"
                    :class="{'success': form.contact_attribute.validation.validated === 1, 'error': form.contact_attribute.validation.validated === 2}"
                >
                    <span class="box-input__title">E-mail или телефон</span>
                    <input
                        v-model="form.contact_attribute.value"
                        type="text"
                        class="box-input__input"
                        :required="form.contact_attribute.required"
                        @input="form.contact_attribute.validation.callback()"
                    >

                    <span class="box-input__error">{{ form.contact_attribute.validation.message }}</span>
                </div>
            </div>
        </div>

        <div class="quality-form__row">
            <div class="quality-form__left">
                <span
                    class="quality-form__text"
                >
                    Ваши данные не будут использованы для рассылок и рекламных обращений!
                    <br><b>Большое спасибо за обращение!</b>
                </span>
            </div>
        </div>

        <div class="dashed dashed--margin-64" />

        <div class="quality-form__row quality-form__row--margin-32">
            <div class="quality-form__left">
                <span class="quality-form__text">Будьте уверены, мы обязательно проведём проверку и примем необходимые меры.<br><br>Мы возвращаем деньги за некачественный товар или заменяем его на новый.</span>
            </div>
            <vue-recaptcha
                ref="recaptcha"
                :sitekey="this.$root.sitekey"
                size="invisible"
                @verify="onVerify"
                @expired="onExpired"
            />
            <button
                type="submit"
                class="btn"
                :disabled="$root.isLoading.show"
            >
                Отправить
            </button>
        </div>

        <div class="quality-service">
            <span class="quality-service__title">Телефон службы качества</span>
            <a
                href="tel:88006005963"
                class="quality-service__phone"
            >8-800-600-59-63</a>
            <span class="quality-form__text">(звонок по России бесплатный)</span>
        </div>
    </form>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';
import each from 'lodash/each';
import axios from 'axios'
import form from "./form";
import FormAction from "../misc/FormAction";

export default {
    name: "QualityForm",
    components: {VueRecaptcha, FormAction},
    mixins: [form],
    data: function () {
        return {
            form: {
                wishes: {
                    value: '',
                    required: false,
                    validation: {
                        rules: {
                            min: 2,
                            max: 4096,
                        },
                        message: '',
                        validated: 0,
                        callback: () => {
                            if (this.form.wishes.value.length < 1) {
                                this.form.wishes.validation.validated = 2;
                                this.form.wishes.validation.message = '* Введите сопроводительный текст';
                            } else if (
                                this.form.wishes.validation.rules.min > this.form.wishes.value.length ||
                                this.form.wishes.validation.rules.max < this.form.wishes.value.length
                            ) {
                                this.form.wishes.validation.message = `* Минимум ${this.form.wishes.validation.rules.min} - максимум ${this.form.wishes.validation.rules.max} символов`;
                                this.form.wishes.validation.validated = 2;
                            } else {
                                this.form.wishes.validation.validated = 1;
                            }
                        }
                    }

                },
                purchase_date: {
                    value: '',
                    required: true,
                    pass_by_wishes: true,
                    validation: {
                        rules: {
                            length: 10
                        },
                        message: '',
                        validated: 0,
                        callback: () => {
                            if (this.form.purchase_date.value.length !== this.form.purchase_date.validation.rules.length || this.form.purchase_date.value.includes('_')) {
                                this.form.purchase_date.validation.validated = 2;
                                this.form.purchase_date.validation.message = '* Дата введена не полностью'
                            } else {
                                this.form.purchase_date.validation.validated = 1;
                                this.form.purchase_date.validation.message = ''
                            }
                        },
                    }
                },
                purchase_place_name: {
                    value: '',
                    required: true,
                    pass_by_wishes: true,

                    validation: {
                        rules: {
                            min: 2,
                            max: 250,
                        },
                        message: '',
                        validated: 0,
                        callback: () => {
                            if (this.form.purchase_place_name.value.length < 1) {
                                this.form.purchase_place_name.validation.validated = 2;
                                this.form.purchase_place_name.validation.message = '* Введите название магазина';
                            } else if (
                                this.form.purchase_place_name.validation.rules.min > this.form.purchase_place_name.value.length ||
                                this.form.purchase_place_name.validation.rules.max < this.form.purchase_place_name.value.length
                            ) {
                                this.form.purchase_place_name.validation.message = `* Минимум ${this.form.purchase_place_name.validation.rules.min} - максимум ${this.form.purchase_place_name.validation.rules.max} символов`
                                this.form.purchase_place_name.validation.validated = 2;
                            } else {
                                this.form.purchase_place_name.validation.validated = 1;
                            }
                        }
                    }
                },
                purchase_place_address: {
                    value: '',
                    required: true,
                    pass_by_wishes: true,

                    validation: {
                        rules: {
                            min: 2,
                            max: 250,
                        },
                        message: '',
                        validated: 0,
                        callback: () => {
                            if (this.form.purchase_place_address.value.length < 1) {
                                this.form.purchase_place_address.validation.validated = 2;
                                this.form.purchase_place_address.validation.message = '* Введите адрес магазина';
                            } else if (
                                this.form.purchase_place_address.validation.rules.min > this.form.purchase_place_address.value.length ||
                                this.form.purchase_place_address.validation.rules.max < this.form.purchase_place_address.value.length
                            ) {
                                this.form.purchase_place_address.validation.message = `* Минимум ${this.form.purchase_place_address.validation.rules.min} - максимум ${this.form.purchase_place_address.validation.rules.max} символов`
                                this.form.purchase_place_address.validation.validated = 2;
                            } else {
                                this.form.purchase_place_address.validation.validated = 1;
                            }
                        }
                    }
                },
                barcode_file: {
                    // todo FILE HANDLING png, jpeg, jpg
                    value: '',
                    required: true,
                    pass_by_wishes: true,
                    validation: {
                        rules: {
                            ext: ['png', 'jpeg', 'jpg'],
                            // kb
                            size: 5000
                        },
                        validated: 0,
                        message: '',
                        callback: () => {
                            let ext = this.form.barcode_file.value.name.split('.').pop();
                            if (!this.form.barcode_file.validation.rules.ext.includes(ext)) {
                                this.form.barcode_file.validation.message = 'Файл некорректного расширения. Подходят: '
                                    + this.form.barcode_file.validation.rules.ext.join(', ').toUpperCase();
                                this.form.barcode_file.validation.validated = 2;
                            } else if ((this.form.barcode_file.value.size / 1000) > this.form.barcode_file.validation.rules.size) {
                                this.form.barcode_file.validation.message = 'Файл слишком большой. Размер должен быть меньше '
                                    + this.form.barcode_file.validation.rules.size + ' кб'
                                this.form.barcode_file.validation.validated = 2;
                            } else {
                                this.form.barcode_file.validation.message = ''
                                this.form.barcode_file.validation.validated = 1;
                            }
                        }
                    },

                },
                purchase_product_date: {
                    value: '',
                    required: true,
                    pass_by_wishes: true,
                    validation: {
                        rules: {
                            length: 10
                        },
                        message: '',
                        validated: 0,
                        callback: () => {
                            if (this.form.purchase_product_date.value.length !== this.form.purchase_product_date.validation.rules.length || this.form.purchase_product_date.value.includes('_')) {
                                this.form.purchase_product_date.validation.validated = 2;
                                this.form.purchase_product_date.validation.message = '* Дата введена не полностью'
                            } else {
                                this.form.purchase_product_date.validation.validated = 1;
                                this.form.purchase_product_date.validation.message = ''
                            }
                        },
                    }

                },
                purchase_product_description: {
                    value: '',
                    required: true,
                    pass_by_wishes: true,
                    validation: {
                        rules: {
                            min: 2,
                            max: 4096,
                        },
                        message: '',
                        validated: 0,
                        callback: () => {
                            if (this.form.purchase_product_description.value.length < 1) {
                                this.form.purchase_product_description.validation.validated = 2;
                                this.form.purchase_product_description.validation.message = '* Введите сопроводительный текст';
                            } else if (
                                this.form.purchase_product_description.validation.rules.min > this.form.purchase_product_description.value.length ||
                                this.form.purchase_product_description.validation.rules.max < this.form.purchase_product_description.value.length
                            ) {
                                this.form.purchase_product_description.validation.message = `* Минимум ${this.form.purchase_product_description.validation.rules.min} - максимум ${this.form.purchase_product_description.validation.rules.max} символов`;
                                this.form.purchase_product_description.validation.validated = 2;
                            } else {
                                this.form.purchase_product_description.validation.validated = 1;
                            }
                        }
                    }

                },
                contact_me: {
                    value: 1,
                    required: true,
                    validation: {
                        validated: 1,
                        message: '',
                        callback: () => {
                            this.form.contact_me.validation.validated = 1
                        }
                    }
                },
                contact_name: {
                    value: '',
                    required: true,
                    validation: {
                        rules: {
                            min: 2,
                            max: 250
                        },
                        message: '',
                        validated: 0,
                        callback: () => {
                            if (this.form.contact_name.value.length < 1) {
                                this.form.contact_name.validation.validated = 2;
                                this.form.contact_name.validation.message = '* Введите свое ФИО';
                            } else if (
                                this.form.contact_name.validation.rules.min > this.form.contact_name.value.length ||
                                this.form.contact_name.validation.rules.max < this.form.contact_name.value.length
                            ) {
                                this.form.contact_name.validation.message = `* Минимум ${this.form.contact_name.validation.rules.min} - максимум ${this.form.contact_name.validation.rules.max} символов`
                                this.form.contact_name.validation.validated = 2;
                            } else {
                                this.form.contact_name.validation.validated = 1;
                            }
                        }
                    }
                },
                contact_attribute: {
                    value: '',
                    required: true,
                    validation: {
                        rules: {
                            min: 2,
                        },
                        message: '',
                        validated: 0,
                        callback: () => {
                            if (this.form.contact_attribute.value.length < 1) {
                                this.form.contact_attribute.validation.validated = 2;
                                this.form.contact_attribute.validation.message = '* Введите свою почту или телефонный номер';
                            } else {
                                this.form.contact_attribute.validation.validated = 1;
                                this.form.contact_attribute.validation.message = '';
                            }
                        }
                    }
                }
            },
            result: -1,
            notify: null
        }
    },
    computed: {
        requiredWishes() {
            return this.form.wishes.value.length > 0;
        },
    },
    watch: {
        'form.wishes.value': function(newVal) {
            if(newVal.length > 0) {
                each(this.form, (el) => {
                    if(el.pass_by_wishes) {
                        el.required = false;
                    }
                })
            } else {
                each(this.form, (el) => {
                    if(el.pass_by_wishes) {
                        el.required = true;
                    }
                })
            }
        },
        'form.contact_me.value': function(newVal) {
            if(newVal === 0){
                this.form.contact_name.value = '';
                this.form.contact_name.validation.validated = 0;
                this.form.contact_attribute.value = '';
                this.form.contact_attribute.validation.validated = 0;
            }
        },
        result(val){
            if(val === -1){
                each(this.form, function(value) {
                    value.validation.callback();
                })
            }
            if( val === 0){
                each(this.form, function(value) {
                    value.validation.validated = 0;
                })
            }
        }
    },
    methods: {
        onSubmit() {
            this.$root.isLoading.show = true;
            this.$refs.recaptcha.execute()
        },
        async onVerify(recaptchaToken) {
            this.$refs.recaptcha.reset();

            let formData = new FormData();
            formData.append('recaptcha-token', recaptchaToken)
            each(this.form, function(value, key) {
                if(value.value || value.value === 0 || value.length > 0) {
                    formData.append(key, value.value)
                }
            })

            try {
                let res = await axios.post('/quality/form', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                this.result = Number(res.data && res.data.success);

                if ( !this.result && (res.data && res.data.message) ) {
                    this.notify = {
                        title: 'Заявка отменена',
                        subtitle: res.data.message
                    };
                }
            } catch (error) {
                this.result = 0;
                this.handleResponseError(error)
            } finally {
                this.$root.isLoading.show = false;
            }

            if ( this.result ) {
                this.clearInputs();
                this.notify = {
                    title: 'Заявка успешно отправлена',
                    subtitle: 'Благодарим Вас за интерес к нашей компании, мы свяжемся с Вами в ближайшее время'
                };
            }else if (!this.notify) {
                this.notify = {
                    title: 'Произошла ошибка',
                    subtitle: 'Во время обработки запроса произошла ошибка, пожалуйста обновите страницу и попробуйте еще раз'
                };
            }
        },
    }
}
</script>
