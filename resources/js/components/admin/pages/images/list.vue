<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6">
                <h1 class="h1-card">Gallery</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 text-right">
                <router-link to="/admin/image/add" class="btn btn-md btn-primary btn-card-h1"><i class="fas fa-plus"></i> New image</router-link>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl mt-6 mb-4" id="list-images-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <td>Preview</td>
                            <th>Album</th>
                            <th>Location</th>
                            <th>Owner</th>
                            <th>Path</th>
                            <th>Created</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in images" :key="item.id" :id="'list-images-item-'+item.id">
                            <td>{{ item.id  }}</td>
                            <td class="text-center">
                                <img :src="'/storage/'+item.path" width="150px">
                            </td>
                            <td>{{ item.album.name }}</td>
                            <td>{{ item.location.name }}</td>
                            <td>{{ item.owner.name }}</td>
                            <td>{{ item.path  }}</td>
                            <td>{{ item.created_at  }}</td>
                            <td>{{ item.updated_at  }}</td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" :data-target="'#list-permission-delete-item-' + item.id">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" :id="'list-permission-delete-item-' + item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Do you really want to delete this image?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" @click="deleteImage(item.id)" class="btn btn-danger" data-dismiss="modal">Delete</button>
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
            images: []
        }
    },
    created () {
        axios.get('/api/image').then(res => {
            this.images = res.data;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$route.go(-1);
        })
    },
    updated () {
        this.table = $('#list-images-table').DataTable();
    },
    methods: {
        deleteImage(id) {
            axios.delete('/api/image/'+id).then(res => {
                toastr.success(res.data.message);
                this.table.rows('#list-images-item-'+id).remove().draw(false);
            }).catch(error => {
                toastr.error(error.response.data);
            })
        }
    }
}
</script>
