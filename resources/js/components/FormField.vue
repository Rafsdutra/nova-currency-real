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
                       style="border-top-left-radius: 0;border-bottom-left-radius: 0;">{{formatPrice(field.value)}}</money>
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
                    // Leave the default attributes even though we can now specify
                    // whatever attributes we like because the old number field still
                    // uses the old field attributes
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
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || 0
            },
            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value || 0)
            },
            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            }
        },
        mounted() {
            this.value = parseFloat(this.value*100).toFixed(this.field.subUnits);

        },
    }
</script>