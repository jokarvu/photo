<template>
    <div class="container-fluid">
        <h1 class="h1-card">Edit permission</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="editPermission">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-alternative" id="name" v-model="permission.name">
                    </div>
                    <div class="form-group">
                        <label for="des">Description (Optional)</label>
                        <textarea class="form-control form-control-alternative" id="des" rows="3" v-model="permission.description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <div class="row text-center">
                            <div class="col-lg-4" v-for="item in roles" :key="item.id">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input class="custom-control-input" :id="'role-item-'+item.id" type="checkbox" :value="item.id" v-model="permission.permission_roles">
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
            permission: {
                id: null,
                name: '',
                description: '',
                permission_roles: [],
            },
            roles: [],
        }
    },
    created () {
        var name = this.$route.params.name;
        axios.get('/api/admin/permission/' + name + '/edit').then(res => {
            this.permission = res.data.permission;
            this.permission.permission_roles = Array();
            this.roles = res.data.roles;
            res.data.permission_roles.forEach(role => {
                    this.permission.permission_roles.push(role.id);
            });
        })
    },
    methods: {
        editPermission () {
            var id = this.permission.id;
            axios.patch('/api/admin/permission/' + id, this.permission).then(res => {
                toastr.success(res.data.message);
                this.$router.go(-1);
            }).catch(error => {
                Helper.error(error);
            })
        }
    }
}
</script>
