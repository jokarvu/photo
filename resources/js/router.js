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
import EditUser from './components/admin/pages/user/edit'
import AddUser from './components/admin/pages/user/add'

// Group
import ListRole from './components/admin/pages/role/list'
import EditRole from './components/admin/pages/role/edit'
import AddRole from './components/admin/pages/role/add'
import ViewRole from './components/admin/pages/role/view'

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
            {path: 'user/add', component: AddUser},
            {path: 'user/:user/edit', component: EditUser, name: 'EditUser'},

            {path: 'role', component: ListRole},
            {path: 'role/add', component: AddRole},
            {path: 'role/:name', component: ViewRole, name: 'ViewRole'},
            {path: 'role/:name/edit', component: EditRole, name: 'EditRole'},
        ]
    }
]

const router = new VueRouter({
    routes: routes,
    mode: 'history',
    linkActiveClass: 'active'
})

export default router