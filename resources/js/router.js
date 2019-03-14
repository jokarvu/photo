import VueRouter from 'vue-router'

import App from './components/admin/app'
import Dashboard from './components/admin/pages/dashboard'

// Permission
import AddPermission from './components/admin/pages/permission/add'
import EditPermission from './components/admin/pages/permission/edit'

const routes = [
    {
        path: '/admin',
        component: App,
        children: [
            {path: '/', component: Dashboard},
            {path: 'permission/add', component: AddPermission},
            {path: 'permission/:name/edit', component: EditPermission, name: 'EditPermission'}
        ]
    }
]

const router = new VueRouter({
    routes: routes,
    mode: 'history'
})

export default router