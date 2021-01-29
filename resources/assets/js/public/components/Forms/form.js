import filter from "lodash/filter";
import every from "lodash/every";
import each from "lodash/each";

/**
 * Mixin for form handling
 * Target component need to have recaptcha element
 * Target component deed to have "form" attribute in data method
 */
export default {
    data: function() {
        return {
        }
    },
    mounted() {
        console.log('mixin form loaded')
    },
    computed: {
        /**
         *
         * @returns {boolean} - return boolean which indicated if required form is validated
         */
        formValidated() {
            let inputs = filter(this.form, {required: true});
            return every(inputs, {validation: {validated: 1}});
        }
    },

    methods: {
        /**
         * Clear all inputs
         */
        clearInputs() {
            each(this.form, function(value) {
                value.value = '';
                value.validation.validated = 0;
                value.validation.message = '';
            })
        },
        /**
         *
         * @param {object} el - target DOM element
         * @param {string} path - name of input in this.data
         */
        fileHandler(el, path) {
            this.form[path].value = el.target.files[0]
            this.form[path].validation.callback();
        },
        /**
         * method for google recaptcha for refreshing token on expire
         */
        onExpired() {
            this.$refs.recaptcha.reset()
        },
        /**
         *
         * @param {object} error - Error object from catch()
         */
        handleResponseError(error) {
            /**
             * Iterating through error bag and set first error as message for input
             */
            if(error.response.data.errors) {
                each(error.response.data.errors, (el, key) => {
                    this.form[key].validation.message = el[0]
                    this.form[key].validation.validated = 2;
                })
            }

            /**
             * If error bag has message - setting it as global response message
             */
            if(error.response.data.message) {
                this.message = error.response.data.message
            }
        }
    }

};
