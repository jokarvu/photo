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
                name: '',
                description: ''
            }
        }
    },
    methods: {
        addPermission () {
            axios.post('/api/admin/permission', this.permission).then(res => {
                console.log('ok');
            }).catch(errors => {
                console.log(errors);
            })
        },
        goback () {
            this.$router.go(-1);
        }
    }
}
</script>
