import Vue from 'vue';

import VueRouter from 'vue-router';

// import VueAxios from 'vue-axios';
// import axios from 'axios';
//
// Vue.use(VueAxios, axios);

import App from './views/App';
import home from './components/Home';
//import Example from './components/Example.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            name: 'home',
            path: '/',
            component: home
        }
    ]
});

export default router;
