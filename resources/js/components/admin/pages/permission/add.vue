<template>
    <div class="container-fluid">
        <h1 class="h1-card">Add new permission</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="addPermission">
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
        return  {
            permission: {
                name: '',
                description: '',
                permission_roles: []
            },
            roles: []
        }
    },
    created () {
        axios.get('/api/admin/permission/create').then(res => {
            this.roles = res.data;
        })
    },
    methods: {
        addPermission () {
            axios.post('/api/admin/permission', this.permission).then(res => {
                toastr.success(res.data.message);
                this.$router.push({path: '/admin/permission'});
            }).catch(error => {
                Helper.error(error);
            })
        }
    }
}
</script>
