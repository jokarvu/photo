<template>
    <div class="container-fluid">
        <h1 class="h1-card">Edit role</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="editRole">
                    <div class="form-role">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-alternative" id="name" v-model="role.name">
                    </div>
                    <div class="form-role">
                        <label for="des">Description (Optional)</label>
                        <textarea class="form-control form-control-alternative" id="des" rows="3" v-model="role.description"></textarea>
                    </div>
                    <div class="form-role">
                        <label>Permission</label>
                        <div class="row pl-7 pr-7">
                            <div class="col-lg-4" v-for="item in permissions" :key="item.id">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input class="custom-control-input" :id="'role-item-'+item.id" type="checkbox" :value="item.id" v-model="role.role_permissions">
                                    <label class="custom-control-label" :for="'role-item-'+item.id">{{ item.name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
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
            role: {
                id: null,
                name: '',
                description: '',
                role_permissions: [],
            },
            permissions: [],
        }
    },
    created () {
        var name = this.$route.params.name;
        axios.get('/api/admin/role/' + name + '/edit').then(res => {
            this.role = res.data.role;
            this.role.role_permissions = Array();
            this.permissions = res.data.permissions;
            res.data.role_permissions.forEach(permission => {
                    this.role.role_permissions.push(permission.id);
            });
        })
    },
    methods: {
        editRole () {
            var id = this.role.id;
            axios.patch('/api/admin/role/' + id, this.role).then(res => {
                toastr.success(res.data.message);
                this.$router.go(-1);
            }).catch(error => {
                Helper.error(error);
            })
        }
    }
}
</script>
