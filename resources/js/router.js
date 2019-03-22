import VueRouter from 'vue-router'

import Login from './components/login'
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
import ViewUser from './components/admin/pages/user/view'

// Group
import ListRole from './components/admin/pages/role/list'
import EditRole from './components/admin/pages/role/edit'
import AddRole from './components/admin/pages/role/add'
import ViewRole from './components/admin/pages/role/view'

// Tag
import ListTag from './components/admin/pages/tag/list'
import AddTag from './components/admin/pages/tag/add'
import EditTag from './components/admin/pages/tag/edit'
import ViewTag from './components/admin/pages/tag/view'

// Location
import ListLocation from './components/admin/pages/location/list'
import AddLocation from './components/admin/pages/location/add'
import EditLocation from './components/admin/pages/location/edit'
import ViewLocation from './components/admin/pages/location/view'


const routes = [
    {
        path: '/login',
        component: Login
    },
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
            {path: 'user/:id', component: ViewUser, name: 'ViewUser'},
            {path: 'user/:id/edit', component: EditUser, name: 'EditUser'},

            {path: 'role', component: ListRole},
            {path: 'role/add', component: AddRole},
            {path: 'role/:name', component: ViewRole, name: 'ViewRole'},
            {path: 'role/:name/edit', component: EditRole, name: 'EditRole'},

            {path: 'tag', component: ListTag},
            {path: 'tag/add', component: AddTag},
            {path: 'tag/:name', component: ViewTag, name: 'ViewTag'},
            {path: 'tag/:name/edit', component: EditTag, name: 'EditTag'},

            {path: 'location', component: ListLocation},
            {path: 'location/add', component: AddLocation},
            {path: 'location/:id', component: ViewLocation, name: 'ViewLocation'},
            {path: 'location/:id/edit', component: EditLocation, name: 'EditLocation'},
        ]
    }
]

const router = new VueRouter({
    routes: routes,
    mode: 'history',
    linkActiveClass: 'active'
})

export default router