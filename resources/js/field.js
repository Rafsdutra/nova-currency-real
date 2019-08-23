Nova.booting((Vue, router, store) => {
    Vue.component('index-currency-field', require('./components/IndexField'))
    Vue.component('detail-currency-field', require('./components/DetailField'))
    Vue.component('form-currency-field', require('./components/FormField'))

})
