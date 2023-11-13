require('./login_bootstrap');
import {
    createApp
} from 'vue';

// Import Validation...
import validate from "simple-vue-validator";
const Validator = validate.Validator;
window.Validator = Validator;

// Import Plugin...
import toast_plugin from './plugin/toast'
import global_mixin from "./mixins/global"
import utils_mixin from "./mixins/utils"

// Import Mixin...
import crud_mixin from "./mixins/crud"

// Import Vuex...
import store from './store'


// App Initialize...
const app = createApp({
    data() {
        return {
            baseurl: laravel.baseurl,
            spinner: false,
            site: "",
        }
    },
    methods: {
        async getInitializeSystems() {
            await axios.get('app/initialize-systems').then(res => {
                this.site = res.data.site;
            });
            return this.site;
        },
    },
    created() {
        this.getInitializeSystems();
    }
});

import loadCustomComponents from './plugin/custom'
loadCustomComponents(app)

import login from './views/auth/login.vue'
app.component("login", login)
app.mixin(crud_mixin)
app.use(validate)
app.use(toast_plugin)
app.use(store)
app.mount('#app');
