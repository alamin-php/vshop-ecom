import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import DataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import Sweetalert from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
const options = {
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
};
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
        app.use(plugin)
        app.component('DataTable', DataTable)
        app.use(Sweetalert, options)
        window.Swal = app.config.globalProperties.$swal
        app.use(ElementPlus)
        app.use(ZiggyVue)
        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
