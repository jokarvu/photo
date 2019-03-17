<template>
    <div class="container-fluid">
        <h1 class="h1-card">Add new user</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="addUser">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-alternative" id="name" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control form-control-alternative" id="email" v-model="user.email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-alternative" id="password" v-model="user.password">
                    </div>
                    <div class="form-group">
                        <label for="password">Role</label>
                        <select name="role" id="role" v-model="user.role_id" class="form-control form-control-alternative">
                            <option class="form-control form-control-alternative" v-for="item in  roles" :key="item.id" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" @click="$router.go(-1)" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return  {
            roles: [],
            user: {
                name: '',
                email: '',
                status: 1,
                role_id: 1,
            }
        }
    },
    created () {
        axios.get('/api/admin/user/create').then(res => {
            this.roles = res.data;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$router.go(-1);
        })
    },
    methods: {
        addUser () {
            axios.post('/api/admin/user', this.user).then(res => {
                toastr.success(res.data.message);
                this.$router.push({path: '/admin/user'})
            }).catch(error => {
                Helper.error(error);
            })
        }
    }
}
</script>
