require('./bootstrap');
import { createApp } from 'vue/dist/vue.esm-bundler';
import App from './components/App.vue'
createApp({
    components: {
        App
    }
}).mount("#app")

