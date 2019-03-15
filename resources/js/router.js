import VueRouter from 'vue-router'

import App from './components/admin/app'
import Dashboard from './components/admin/pages/dashboard'

// Permission
import ListPermission from './components/admin/pages/permission/list'
import AddPermission from './components/admin/pages/permission/add'
import EditPermission from './components/admin/pages/permission/edit'
import ViewPermission from './components/admin/pages/permission/view'

// User
import ListUser from './components/admin/pages/user/list'

const routes = [
    {
        path: '/admin',
        component: App,
        children: [
            {path: '/', component: Dashboard},

            {path: 'permission', component: ListPermission},
            {path: 'permission/add', component: AddPermission},
            {path: 'permission/:name', component: ViewPermission, name: 'ViewPermission'},
            {path: 'permission/:name/edit', component: EditPermission, name: 'EditPermission'},

            {path: 'user', component: ListUser},
        ]
    }
]

const router = new VueRouter({
    routes: routes,
    mode: 'history',
    linkActiveClass: 'active'
})

export default router