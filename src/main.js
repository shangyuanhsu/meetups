import { createApp } from 'vue'
import store from './store'
import App from './App.vue'
import router from './router'
import VueGoogleMaps from '@fawmi/vue-google-maps'

createApp(App).use(router).use(store).use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDzsvI1A7KVhOkKCGk9x-d67_w3nyzHDWs',
        libraries: "places"
    },
}).mount('#app')