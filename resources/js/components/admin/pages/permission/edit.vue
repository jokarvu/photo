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
                description: ''
            }
        }
    },
    created () {
        var name = this.$route.params.name;
        axios.get('/api/admin/permission/' + name + '/edit').then(res => {
            this.permission = res.data.permission;
        })
    },
    methods: {
        editPermission () {
            var id = this.permission.id;
            console.log(this.permission.name);
            axios.patch('/api/admin/permission/' + id, this.permission).then(res => {
                toastr.success(res.data.message);
                this.$router.go(-1);
            }).catch(errors => {
                console.log(errors);
            })
        }
    }
}
</script>
