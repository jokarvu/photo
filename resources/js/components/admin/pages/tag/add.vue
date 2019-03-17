<template>
    <div class="container-fluid">
        <h1 class="h1-card">Add new tag</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="addTag">
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
                name: ''
            }
        }
    },
    methods: {
        addTag () {
            axios.post('/api/admin/tag', this.tag).then(res => {
                toastr.success(res.data.message);
                this.$router.go(-1);
            }).catch(error => {
                Helper.error(error);
            });
        }
    }
}
</script>

