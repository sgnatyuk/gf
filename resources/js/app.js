import Vue from 'vue';
import App from './App.vue';
import router from './router'
import http from './plugins/http';

Vue.config.productionTip = false;

Vue.prototype.$http = http;

Vue.directive('phone', {
    bind(el) {
        el.oninput = function (e) {

            if (!e.isTrusted)
                return;

            let x = this.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);

            this.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');

            el.dispatchEvent(new Event('input'));
        };
    },
});

new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
