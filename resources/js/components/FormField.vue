<template>
    <default-field :field="field">
        <template slot="field">
            <div class="flex flex-wrap items-stretch w-full relative">
                <div class="flex -mr-px">
                    <span class="flex items-center bg-30 rounded-r-none px-3 whitespace-no-wrap text-sm form-control form-input-bordered">R$ </span>

                </div>

                <money v-model="value"
                       v-bind="money"
                       class="flex-1 relative focus:border-blue focus:shadow form-control form-input form-input-bordered"
                       style="border-top-left-radius: 0;border-bottom-left-radius: 0;">{{(field.value)}}</money>
            </div>
            <div class = "flex-wrap items-stretch w-full relative">

            </div>
            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>

</template>

<script>
    import {Money} from 'v-money'
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [ FormField, HandlesValidationErrors],
        props: ['resourceName', 'resourceId', 'field'],
        components: {Money, FormField},



        data () {

            return {
                money: {
                    decimal: ',',
                    thousands: '.',
                    precision: 2,
                    masked: false,

                }
            }
        },


        computed: {
            defaultAttributes() {
                return {
                    type: this.field.type || 'number',
                    min: this.field.min,
                    max: this.field.max,
                    step: this.field.step,
                    pattern: this.field.pattern,
                    placeholder: this.field.placeholder || this.field.name,
                    class: this.errorClasses,
                }
            },
            extraAttributes() {
                const attrs = this.field.extraAttributes
                return {
                  
                    ...this.defaultAttributes,
                    ...attrs,
                }
            },
        },

        methods: {
            //
            formatPrice(value) {
                let val = (value).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            /*
             * Seta o valor inicial do campo
             */
            setInitialValue() {
                this.value = this.field.value || 0
            },
            /**
             * Preenche o FormData com o valor inicial indicado
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value || 0)
            },
            /**
             * Atualiza o valor interno do campo
             */
            handleChange(value) {
                this.value = value
            }
        },
        mounted() {
            /*
             * Multiplica o valor requisitado do banco por 100
             * para evitar que venha quebrado (por exemplo: o valor
             * 5.000,00 viria dividido por 100, ou seja, 50
             */
            this.value = parseFloat(this.value*100).toFixed(this.field.subUnits);

        },
    }
</script>
