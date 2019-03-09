import VueRouter from 'vue-router'

import App from './components/admin/app'
import Dashboard from './components/admin/pages/dashboard'

const routes = [
    {
        path: '/admin',
        component: App,
        children: [
            {path: '/', component: Dashboard}
        ]
    }
]

const router = new VueRouter({
    routes: routes,
    mode: 'history'
})

export default router