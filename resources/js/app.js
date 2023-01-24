// src/main.js

// import Vue from 'vue'
import Vue from 'vue/dist/vue.js';
import vuetify from '../plugins/vuetify' // path to vuetify export
import App from "../components/App.vue";

new Vue({
    vuetify,
    components: {
        App
    }
}).$mount('#app')
