<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6">
                <h1 class="h1-card">Option</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 text-right">
                <router-link to="/admin/option/add" class="btn btn-md btn-primary btn-card-h1"><i class="fas fa-plus"></i> New option</router-link>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive-lg table-responsive-xl mt-6 mb-4" id="list-options-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in options" :key="item.id" :id="'list-option-item-'+item.id">
                            <td>{{ item.id }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.price }}</td>
                            <td>{{ item.description }}</td>
                            <td>{{ item.created_at }}</td>
                            <td>{{ item.updated_at }}</td>
                            <td class="text-center">
                                <router-link :to="{name: 'EditOption', params: {id: item.id}}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></router-link>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" :data-target="'#list-option-delete-item-' + item.id">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" :id="'list-option-delete-item-' + item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Do you really want to delete this option?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" @click="deleteOption(item.id)" class="btn btn-danger" data-dismiss="modal">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            options: []
        }
    },
    created () {
        axios.get('/api/option').then(res => {
            this.options = res.data;
        }).catch(error => {
            toastr.error(error.response.data.message);
            // this.$router.go(-1);
        })
    },
    updated () {
        this.table = $('#list-options-table').DataTable();
    },
    methods: {
        deleteOption (id) {
            axios.delete('/api/option/'+id).then(res => {
                toastr.success(res.data.message);
                this.table.rows('#list-option-item-'+id).remove().draw(false);
            }).catch(error => {
                toastr.error(error.response.data.message);
            })
        }
    }
}
</script>
