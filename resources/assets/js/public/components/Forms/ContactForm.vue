<template>
    <div>
        <form
            class="have-questions__form"
            @submit.prevent="onSubmit"
        >
            <form-action
                :result.sync="result"
                :content="notify"
            />
            <div
                class="box-input"
                :class="{'success': form.name.validation.validated === 1, 'error': form.name.validation.validated === 2}"
            >
                <span class="box-input__title">Ваше имя, фамилия</span>
                <input
                    v-model="form.name.value"
                    name="name"
                    type="text"
                    class="box-input__input"
                    :required="form.name.required"
                    @input="form.name.validation.callback()"
                >
                <span class="box-input__error">
                    {{ form.name.validation.message }}
                </span>
            </div>

            <div
                class="box-input"
                :class="{'success': form.email.validation.validated === 1, 'error': form.email.validation.validated === 2}"
            >
                <span class="box-input__title">Ваша почта</span>
                <input
                    v-model="form.email.value"
                    name="email"
                    type="text"
                    class="box-input__input"
                    :required="form.email.required"
                    @input="form.email.validation.callback()"
                >
                <span class="box-input__error">{{ form.email.validation.message }}</span>
            </div>

            <div
                class="box-input"
                :class="{'success': form.phone.validation.validated === 1, 'error': form.phone.validation.validated === 2}"
            >
                <span class="box-input__title">Ваш телефон</span>
                <input
                    v-model="form.phone.value"
                    name="phone"
                    type="text"
                    :required="form.phone.required"
                    class="box-input__input"
                    @input="form.phone.validation.callback()"
                >
                <span class="box-input__error">{{ form.phone.validation.message }}</span>
            </div>

            <div
                class="box-input textarea"
                :class="{'success': form.text.validation.validated === 1, 'error': form.text.validation.validated === 2}"
            >
                <span class="box-input__title">Оставьте свое сообщение:</span>
                <textarea
                    v-model="form.text.value"
                    class="box-input__textarea"
                    @input="form.text.validation.callback()"
                />
                <span
                    v-if="form.text.required"
                    class="box-input__error"
                >{{ form.text.validation.message }}</span>
            </div>

            <label class="checked-circle">
                <input
                    v-model="form.data_processing.value"
                    type="checkbox"
                    class="checked-circle__input"
                    @input="form.data_processing.validation.callback()"
                >
                <span class="checked-circle__mark" />
                <span class="checked-circle__name">Я даю разрешение на
                    <a
                        href="#"
                        class="work-form__link"
                        target="_blank"
                    >
                        обработку моих персональных данных
                    </a>
                </span>
            </label>

            <!--        disabled for button not working in this wrapper-->
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
                :disabled="!formValidated || $root.isLoading.show"
            >
                Отправить
            </button>
        </form>
    </div>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';
import each from 'lodash/each';
import axios from 'axios';
import form from './form'
import FormAction from "../misc/FormAction";

export default {
    name: "ContactForm",
    components: {VueRecaptcha, FormAction},
    mixins: [form],
    data: function () {
        return {
            form: {
                name: {
                    value: '',
                    required: true,
                    validation: {
                        rules: {
                            min: 2,
                            max: 250,
                        },
                        message: '',
                        validated: 0,
                        callback: () => {
                            if (this.form.name.value.length < 1) {
                                this.form.name.validation.validated = 2;
                                this.form.name.validation.message = '* Введите ваше ФИО';
                            } else if (
                                this.form.name.validation.rules.min > this.form.name.value.length ||
                                this.form.name.validation.rules.max < this.form.name.value.length
                            ) {
                                this.form.name.validation.message = `* Минимум ${this.form.name.validation.rules.min} - максимум ${this.form.name.validation.rules.max} символов`
                                this.form.name.validation.validated = 2;
                            } else {
                                this.form.name.validation.validated = 1;
                            }
                        },
                    }
                },
                email: {
                    value: '',
                    required: true,
                    validation: {
                        message: '',
                        validated: 0,
                        callback: () => {
                            let re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                            let isValid = re.test(this.form.email.value);
                            if (isValid) {
                                this.form.email.validation.validated = 1;
                            } else {
                                this.form.email.validation.validated = 2;
                                this.form.email.validation.message = '* Почта не валидна!';
                            }
                        }
                    }
                },
                phone: {
                    value: '',
                    required: true,
                    validation: {
                        validated: 0,
                        message: '',
                        callback: () => {
                            if(this.form.phone.value < 1) {
                                this.form.phone.validation.validated = 2;
                                this.form.phone.validation.message = 'Телефон обязателен к заполнению';
                            } else {
                                this.form.phone.validation.validated = 1;
                            }
                        }
                    }
                },
                text: {
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
                            if(this.form.text.required){
                                if (this.form.text.value.length < 1) {
                                    this.form.text.validation.validated = 2;
                                    this.form.text.validation.message = '* Введите сопроводительный текст';
                                } else if (
                                    this.form.text.validation.rules.min > this.form.text.value.length ||
                                    this.form.text.validation.rules.max < this.form.text.value.length
                                ) {
                                    this.form.text.validation.message = `* Минимум ${this.form.text.validation.rules.min} - максимум ${this.form.text.validation.rules.max} символов`;
                                    this.form.text.validation.validated = 2;
                                } else {
                                    this.form.text.validation.validated = 1;
                                }
                            }
                        }
                    }
                },
                data_processing: {
                    value: false,
                    validation: {
                        validated: 0,
                        callback: () => {
                            setTimeout(() => {
                                console.log(this.form.data_processing.value)
                                if(this.form.data_processing.value === true) {
                                    this.form.data_processing.validation.validated = 1
                                } else {
                                    this.form.data_processing.validation.validated = 2
                                }
                            }, 150)
                        }
                    }
                }
            },
            result: -1,
            notify: null
        }
    },
    watch: {
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
        async onSubmit() {
            this.$root.isLoading.show = true;
            this.$refs.recaptcha.execute()
        },
        async onVerify(recaptchaToken) {
            this.$refs.recaptcha.reset()

            let filtered = {};
            each(this.form, function(value, key) {
                filtered[key] = value.value
            })

            try {
                let res = await axios.post('/contacts', {
                    'recaptcha-token': recaptchaToken,
                    ...filtered,
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

<style scoped>

</style>
