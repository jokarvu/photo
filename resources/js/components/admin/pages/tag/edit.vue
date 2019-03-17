<template>
    <div class="container-fluid">
        <h1 class="h1-card">Edit tag</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="editTag">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control form-control-alternative" v-model="tag.name">
                    </div>
                    <button class="btn btn-success">Save</button>
                    <button class="btn btn-danger" type="button" @click="$router.go(-1)">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            tag: {
                id: 0,
                name: ''
            }
        }
    },
    created () {
        var name = this.$route.params.name;
        axios.get('/api/admin/tag/'+name+'/edit').then(res => {
            this.tag = res.data;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$router.go(-1);
        })
    },
    methods: {
        editTag () {
            var id = this.tag.id;
            axios.patch('/api/admin/tag/'+id, this.tag).then(res => {
                toastr.success(res.data.message);
                this.$router.go(-1);
            }).catch(error => {
                Helper.error(error);
            })
        }
    }
}
</script>
