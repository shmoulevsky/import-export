import axios from "./services/axios";
import VueAxios from "vue-axios";
import store from './store';


require('./bootstrap');

import {createApp} from 'vue'
import router from "./router";
import App from './views/App.vue'


createApp(App)
    .use(router)
    .use(VueAxios, axios)
    .use(store)
    .mount("#app")
