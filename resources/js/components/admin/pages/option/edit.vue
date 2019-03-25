<template>
    <div class="container-fluid">
        <h1 class="h1-card">Edit option</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="editOption">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-alternative" v-model="option.name">
                        </div>
                        <div class="form-group">
                            <label for="name">Price</label>
                            <input type="text" class="form-control form-control-alternative" v-model="option.price">
                        </div>
                        <div class="form-group">
                            <label for="name">Description</label>
                            <input type="text" class="form-control form-control-alternative" v-model="option.description">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" @click="$router.go(-1)">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            option: {
                name: '',
                price: 0,
                description: ''
            }
        }
    },
    created () {
        let id = this.$route.params.id;
        axios.get('/api/option/'+id+'/edit').then(res => {
            this.option = res.data;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$router.go(-1);
        })
    },
    methods: {
        editOption () {
            let id = this.$route.params.id;
            axios.patch('/api/option/'+id, this.option).then(res => {
                toastr.success(res.data.message);
            }).catch(error => {
                Helper.error(error);
            })
        } 
    }
}
</script>
