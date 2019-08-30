import Vue from 'vue'

import VueRouter from 'vue-router'

import App from './components/App'
import Home from './components/HomeComponent'

Vue.use(VueRouter)

export default new VueRouter(
    {
        routes: [
            {path: '/', component: App},
            {path: '/home', component: Home},
        ],
        mode: 'history',
    },
)
