import { createApp } from 'vue'
import store from './store'
import App from './App.vue'
import router from './router'
import VueGoogleMaps from '@fawmi/vue-google-maps'
import gAuthPlugin from './plugins/vue3-google-oauth2';

const gAuthOptions = { clientId: '984519505320-rfao5vb50ni8757cavvk97sn39icc4td.apps.googleusercontent.com', scope: 'email', prompt: 'consent', fetch_basic_profile: false }

createApp(App).use(router).use(store).use(gAuthPlugin, gAuthOptions).use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDzsvI1A7KVhOkKCGk9x-d67_w3nyzHDWs',
        libraries: ["places", "visualization"],
        language: 'zh-TW'
    },
}).mount('#app')