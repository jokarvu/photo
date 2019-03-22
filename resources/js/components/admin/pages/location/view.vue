<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-xs-6">
                <h1 class="h1-card">Location Detail</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-xs-6 text-right">
                <button @click="$router.go(-1)" class="btn btn-md btn-primary btn-card-h1"><i class="fas fa-arrow-left"></i> Go back</button>
            </div>
        </div>
        <div class="nav-wrapper mt--2">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="view-location-info-tab" data-toggle="tab" href="#view-location-info" role="tab" aria-controls="view-location-info" aria-selected="true">
                        <i class="fas fa-info-circle mr-2"></i> Detail
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="view-location-images-tab" data-toggle="tab" href="#view-location-images" role="tab" aria-controls="view-location-users" aria-selected="false">
                        <i class="fas fa-images mr-2"></i> Images
                    </a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="view-location-info" role="tabpanel" aria-labelledby="view-location-info-tab">
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xl-3 col-xs-3">
                                <h3>Name</h3>
                            </div>
                            <div class="col-lg-9 col-xl-9 col-md-9 col-sm-9 col-xs-9">
                                {{location.name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xl-3 col-xs-3">
                                <h3>Parent</h3>
                            </div>
                            <div class="col-lg-9 col-xl-9 col-md-9 col-sm-9 col-xs-9">
                                {{location.father.name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xl-3 col-xs-3">
                                <h3>Description</h3>
                            </div>
                            <div class="col-lg-9 col-xl-9 col-md-9 col-sm-9 col-xs-9">
                                {{location.description}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xl-3 col-xs-3">
                                <h3>Created</h3>
                            </div>
                            <div class="col-lg-9 col-xl-9 col-md-9 col-sm-9 col-xs-9">
                                {{location.created_at}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xl-3 col-xs-3">
                                <h3>Last updated</h3>
                            </div>
                            <div class="col-lg-9 col-xl-9 col-md-9 col-sm-9 col-xs-9">
                                {{location.updated_at}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="view-location-images" role="tabpanel" aria-labelledby="view-location-images-tab">
                        <table class="table table-responsive-lg table-responsive-xl mt-6 mb-4" id="view-location-images-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Owner</th>
                                    <th>Album</th>
                                    <th>Path</th>
                                    <th>Description</th>
                                    <th>Created</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in images" :key="item.id" :id="'view-location-image-'+item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.owner.name }}</td>
                                    <td>{{ item.album.name }}</td>
                                    <td>{{ item.path }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'ViewImage', params: {id: item.id}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></router-link>
                                        <router-link :to="{name: 'EditImage', params: {id: item.id}}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></router-link>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" :data-target="'#view-location-users-delete-item-' + item.id">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" :id="'view-location-users-delete-item-' + item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Do you really want to remove this images from database?
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
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            location: {},
            images: [],
        }
    },
    created () {
        let id = this.$route.params.id;
        axios.get('/api/admin/location/'+id).then(res => {
            this.location = res.data.location;
            this.images = res.data.images;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$router.go(-1);
        })
    },
    updated () {
        this.images_table =  $('#view-location-images-table').DataTable();
    }
}
</script>
