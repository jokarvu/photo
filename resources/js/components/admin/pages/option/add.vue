<template>
    <div class="container-fluid">
        <h1 class="h1-card">Add new option</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="addOption">
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
    methods: {
        addOption () {
            axios.post('/api/option', this.option).then(res => {
                toastr.success(res.data.message);
                this.$router.go(-1);
            }).catch(erorr => {
                Helper.error(error);
            })
        }
    }
}
</script>
