
import toast from "izitoast";
import 'izitoast/dist/css/iziToast.min.css'

export default {
    install: function (app) {
        app.config.globalProperties.toast = toast;

        app.mixin({
            methods: {
                $toast(message, type, title = '') {

                    // Will it be here!
                    this.toast[type]({
                        position: 'topCenter',
                        title: title ? title : type.toUpperCase() + " !!",
                        message,
                    });

                    // this.toast[type]({
                    //     title: title ? title : type.toUpperCase() + " !!",
                    //     message,
                    // });
                }
            },
        })
    }
};
