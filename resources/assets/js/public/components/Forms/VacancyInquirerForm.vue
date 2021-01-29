<template>
    <div>
        <form
            class="work-form"
            style="margin: auto"
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
                <span class="box-input__title">Как к вам обращаться?</span>
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
                <span class="box-input__title">Ваш email</span>
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
                <span class="box-input__title">Укажите ваш телефон</span>
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
                :class="{'success': form.application_text.validation.validated === 1, 'error': form.application_text.validation.validated === 2}"
            >
                <span class="box-input__title">Почему вы хотите работать на этой позиции?</span>
                <textarea
                    v-model="form.application_text.value"
                    class="box-input__textarea"
                    @input="form.application_text.validation.callback()"
                />
                <span class="box-input__error">{{ form.application_text.validation.message }}</span>
            </div>

            <div
                class="box-input"
            >
                <label class="up-file">
                    <input
                        name="file"
                        type="file"
                        class="upload-file__input"
                        :required="form.resume.required"
                        @input="fileHandler($event, 'resume')"
                    >

                    <template v-if="form.resume.validation.validated === 0">
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
                        <span class="up-file__text">Прикрепить резюме <b>(в форматах:  {{ form.resume.validation.rules.ext.join(', ').toUpperCase() }}, не более 5Мб )</b></span>
                    </template>

                    <template v-else-if="form.resume.validation.validated === 1">
                        <svg
                            class="upload-file__clip"
                            width="16"
                            height="16"
                            viewBox="0 0 16 16"
                            fill="currentColor"
                        >
                            <path d="M15.1279 9.08251L15.0529 8.9769L7.906 1.42574C6.10677 -0.475248 3.18302 -0.475248 1.35881 1.42574C-0.465409 3.32673 -0.44042 6.44224 1.35881 8.34323L8.6057 16L9.3054 15.2607L2.05851 7.60396C1.3838 6.86469 1.00896 5.91419 1.00896 4.88449C1.00896 3.85479 1.3838 2.90429 2.05851 2.16502C3.4829 0.660066 5.78191 0.660066 7.18131 2.16502L13.1038 8.42244L14.3532 9.74257C15.2279 10.6667 15.2279 12.1716 14.3532 13.0957C13.9284 13.5446 13.3537 13.7822 12.7539 13.7822C12.1542 13.7822 11.5794 13.5446 11.1546 13.0957L4.00767 5.51815C3.83275 5.33333 3.75778 5.12211 3.75778 4.88449C3.75778 4.64686 3.85773 4.40924 4.03266 4.22442C4.35752 3.88119 4.90728 3.88119 5.25713 4.22442L12.4291 11.802L13.1288 11.0627L5.93184 3.45875C5.20716 2.69307 4.03266 2.69307 3.28298 3.48515C2.93313 3.85479 2.73322 4.35644 2.73322 4.88449C2.73322 5.41254 2.93313 5.91419 3.28298 6.28383L10.4549 13.8614C11.7294 15.2079 13.7785 15.2079 15.0529 13.8614C16.2774 12.5413 16.3274 10.429 15.1279 9.08251Z" />
                        </svg>
                        <span class="up-file__text"> {{ form.resume.value.name }} </span>
                    </template>

                    <template v-else-if="form.resume.validation.validated === 2">
                        <img
                            :src="'/library/public/img/up-file__close.svg'"
                            class="up-file__error"
                        >
                        <span class="up-file__text"> {{ form.resume.validation.message }} </span>
                    </template>
                </label>
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
                Отправить анкету
            </button>
        </form>
    </div>
</template>

<script>
import form from './form'
import each from "lodash/each";
import axios from "axios";
import VueRecaptcha from "vue-recaptcha";
import FormAction from "../misc/FormAction";

export default {
    name: "VacancyInquirerForm",
    components: {VueRecaptcha, FormAction},
    mixins: [form],
    props: {
        // eslint-disable-next-line vue/prop-name-casing
        vacancy_id: {
            type: Number,
            default: 0,
        }
    },
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
                resume: {
                    // todo FILE HANDLING png, jpeg, jpg
                    value: '',
                    required: false,
                    validation: {
                        rules: {
                            ext: ['pdf', 'docx', 'doc'],
                            // kb
                            size: 5000
                        },
                        validated: 0,
                        message: '',
                        callback: () => {
                            let ext = this.form.resume.value.name.split('.').pop();
                            if (!this.form.resume.validation.rules.ext.includes(ext)) {
                                this.form.resume.validation.message = 'Файл некорректного расширения. Подходят: '
                                    + this.form.resume.validation.rules.ext.join(', ').toUpperCase();
                                this.form.resume.validation.validated = 2;
                            } else if ((this.form.resume.value.size / 1000) > this.form.resume.validation.rules.size) {
                                this.form.resume.validation.message = 'Файл слишком большой. Размер должен быть меньше '
                                    + this.form.resume.validation.rules.size + ' кб'
                                this.form.resume.validation.validated = 2;
                            } else {
                                this.form.resume.validation.message = ''
                                this.form.resume.validation.validated = 1;
                            }
                        }
                    },

                },
                application_text: {
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
                            this.form.application_text.validation.validated = 1;
                        }
                    }
                },
                data_processing: {
                    value: false,
                    required: true,
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

            let formData = new FormData();
            formData.append('recaptcha-token', recaptchaToken)
            formData.append('vacancy_id', this.vacancy_id)
            each(this.form, function(value, key) {
                if(value.value || value.value === 0) {
                    formData.append(key,
                        typeof value.value === 'boolean' ?
                            +value.value :
                            value.value
                    )
                }
            })

            try {
                let res = await axios.post('/work/vacancy/', formData)

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
        }
    }
}
</script>
