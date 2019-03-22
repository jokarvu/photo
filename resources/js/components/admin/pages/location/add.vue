<template>
    <div class="container-fluid">
        <h1 class="h1-card">Add new location</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="addLocation">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control form-control-alternative" v-model="location.name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description (Optional)</label>
                        <input type="text" id="description" class="form-control form-control-alternative" v-model="location.description">
                    </div>
                    <div class="form-group">
                        <label for="parent">Parent</label>
                        <select name="parent_id" id="parent" class="form-control form-control-alternative" v-model="location.parent_id">
                            <option value="0">None</option>
                            <option v-for="item in locations" :key="item.id" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
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
            locations: [],
            location: {
                name: '',
                parent_id: 0,
                description: '',
            }
        }
    },
    created () {
        axios.get('/api/admin/location/create').then(res => {
            this.locations = res.data;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$router.go(-1);
        })
    },
    methods: {
        addLocation () {
            axios.post('/api/admin/location', this.location).then(res => {
                toastr.success(res.data.message);
                this.$router.go(-1);
            }).catch(error => {
                Helper.error(error);
            })
        }
    }
}
</script>