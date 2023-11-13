require('./web_bootstrap');
import { createApp } from 'vue';

// Import Plugin...
import toast_plugin from "./plugin/toast"
import filters from "./plugin/filters"

// Import Mixin...
import global_mixin from "./mixins/global"
import crud_mixin from "./mixins/crud"
import utils_mixin from "./mixins/utils"

// Import Vuex...
import store from './store'

// App Initialize...
const app = createApp({
    data() {
        return {
            baseurl: laravel.baseurl,
        }
    },
});

import example from './views/website/Example.vue';
app.component('example', example);
app.mixin(global_mixin)
app.use(toast_plugin)
app.use(filters)
app.use(store)

import loadThirdPartyPlugins from './plugin/third_party'
loadThirdPartyPlugins(app)

app.mount('#app');

