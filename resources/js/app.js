require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import AppLayout from "./Layouts/AppLayout"
import Container from "./Layouts/Partials/Container"

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => {
        const page = require(`./Pages/${name}`).default
        page.layout = page.layout || AppLayout
        return page
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .component('Container', Container)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
