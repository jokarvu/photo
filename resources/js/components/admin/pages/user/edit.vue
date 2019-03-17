<template>
    <div class="container-fluid">
        <h1 class="h1-card">Edit User</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="editUser">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-alternative" id="name" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control form-control-alternative" id="email" v-model="user.email">
                    </div>
                    <div class="form-group">
                        <label for="password">Role</label>
                        <select name="role" id="role" v-model="user.role_id" class="form-control form-control-alternative">
                            <option class="form-control form-control-alternative" v-for="item in  roles" :key="item.id" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control form-control-alternative" id="status" v-model="user.status">
                    </div>
                    <hr class="my-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" @click="$router.go(-1)" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            user: {
                id: 0,
                name: '',
                email: '',
                status: 0,
                role_id: 0,
            },
            roles: []
        }
    },
    created () {
        var user_id = this.$route.params.id;
        axios.get('/api/admin/user/' + user_id + '/edit').then(res => {
            this.user = res.data.user;
            this.roles = res.data.roles;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$router.go(-1);
        });
    },
    methods: {
        editUser() {
            var user_id = this.$route.params.user;
            console.log(this.user.role_id);
            axios.patch('/api/admin/user/' + user_id, this.user).then(res => {
                toastr.success(res.data.message);
                this.$router.go(-1);
            }).catch(error => {
                Helper.error(error);
            })
        }
    }
}
</script>
