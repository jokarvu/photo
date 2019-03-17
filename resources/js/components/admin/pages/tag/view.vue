<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xl-6">
                <h1 class="h1-card">Tag: {{ tag.name }}</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xl-6 text-right">
                <button @click="$router.go(-1)" class="btn btn-md btn-primary btn-card-h1"><i class="fas fa-arrow-left"></i> Go back</button>
            </div>
        </div>
        <div class="nav-wrapper mt--2">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="view-tag-users-tab" data-toggle="tab" href="#view-tag-users" role="tab" aria-controls="view-tag-users" aria-selected="true"><i class="fas fa-users mr-2"></i>Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="view-tag-albums-tab" data-toggle="tab" href="#view-tag-albums" role="tab" aria-controls="view-tag-albums" aria-selected="false"><i class="fas fa-images mr-2"></i>Albums</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="view-tag-locations-tab" data-toggle="tab" href="#view-tag-locations" role="tab" aria-controls="view-tag-locations" aria-selected="false"><i class="fas fa-map mr-2"></i>Locations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="view-tag-images-tab" data-toggle="tab" href="#view-tag-images" role="tab" aria-controls="view-tag-images" aria-selected="false"><i class="fas fa-camera mr-2"></i>Images</a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="view-tag-users" role="tabpanel" aria-labelledby="view-tag-users-tab">
                        <table class="table table-responsive-lg mt-6 mb-4" id="view-tag-users-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Created</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in users" :key="item.id" :id="'view-tag-users-item-' + item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>{{ item.role.name }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'ViewUser', params: {id: item.id}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></router-link>
                                        <router-link :to="{name: 'EditUser', params: {id: item.id}}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></router-link>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" :data-target="'#view-tag-users-delete-item-' + item.id">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" :id="'view-tag-users-delete-item-' + item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Deleting this user might make you unable to take some actions. Do you still want to take action?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" @click="deleteUser(item.id)" class="btn btn-danger" data-dismiss="modal">Delete</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="view-tag-albums" role="tabpanel" aria-labelledby="view-tag-albums-tab">
                        <table class="table table-responsive-lg table-responsive-xl mt-6 mb-4" id="view-tag-albums-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Owner</th>
                                    <th>Description</th>
                                    <th>Created</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in albums" :key="item.id" :id="'view-tag-albums-item-'+item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.owner.name }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'ViewAlbum', params: {id: item.id}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></router-link>
                                        <router-link :to="{name: 'EditAlbum', params: {id: item.id}}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></router-link>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" :data-target="'#view-tag-albums-delete-item-' + item.id">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" :id="'view-tag-albums-delete-item-' + item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you really want to delete this albums?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" @click="deleteAlbum(item.id)" class="btn btn-danger" data-dismiss="modal">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="view-tag-locations" role="tabpanel" aria-labelledby="view-tag-locations-tab">
                        <table class="table table-responsive-lg table-responsive-xl mt-6 mb-4" id="view-tag-locations-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Created</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in locations" :key="item.id" :id="'view-tag-locations-item-'+item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.slug }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'ViewLocation', params: {slug: item.slug}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></router-link>
                                        <router-link :to="{name: 'EditLocation', params: {slug: item.slug}}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></router-link>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" :data-target="'#view-tag-locations-delete-item-' + item.id">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" :id="'view-tag-locations-delete-item-' + item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you really want to delete this location?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" @click="deleteLocation(item.id)" class="btn btn-danger" data-dismiss="modal">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="view-tag-images" role="tabpanel" aria-labelledby="view-tag-images-tab">
                        <table class="table table-responsive-lg table-responsive-xl mt-6 mb-4" id="view-tag-images-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Album</th>
                                    <th>Owner</th>
                                    <th>Path</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in images" :key="item.id" :id="'view-tag-images-item-'+item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.album.name }}</td>
                                    <td>{{ item.owner.name }}</td>
                                    <td>{{ item.path }}</td>
                                    <td>{{ item.location.name }}</td>
                                    <td>{{ item.description }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'ViewImage', params: {id: item.id}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></router-link>
                                        <router-link :to="{name: 'EditImage', params: {id: item.id}}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></router-link>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" :data-target="'#view-tag-images-delete-item-' + item.id">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" :id="'view-tag-images-delete-item-' + item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you really want to delete this images?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" @click="deleteImages(item.id)" class="btn btn-danger" data-dismiss="modal">Delete</button>
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
            tag: {},
            users: [],
            albums: [],
            images: [],
            locations: []
        }
    },
    created () {
        var name = this.$route.params.name;
        axios.get('/api/admin/tag/' + name).then(res => {
            this.tag = res.data.tag;
            this.users = res.data.users;
            this.albums = res.data.albums;
            this.locations = res.data.locations;
            this.images = res.data.images;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$router.go(-1);
        })
    },
    updated () {
        this.users_table = $('#view-tag-users-table').DataTable();
        this.albums_table = $('#view-tag-albums-table').DataTable();
        this.locations_table = $('#view-tag-locations-table').DataTable();
        this.images_table = $('#view-tag-images-table').DataTable();
    },
    methods: {
        deleteUser (id) {
            axios.delete('/api/admin/user/' + id).then(res => {
                toastr.success(res.data.message);
                this.table.rows('#view-tag-users-item-'+id).remove().draw(false);
            }).catch(error => {
                toastr.error(error.response.data.message);
            })
        },
        deleteAlbum (id) {
            axios.delete('/api/admin/album/' + id).then(res => {
                toastr.success(res.data.message);
                this.table.rows('#view-tag-albums-item-'+id).remove().draw(false);
            }).catch(error => {
                toastr.error(error.response.data.message);
            })
        },
        deleteLocation (id) {
            axios.delete('/api/admin/location/' + id).then(res => {
                toastr.success(res.data.message);
                this.table.rows('#view-tag-locations-item-'+id).remove().draw(false);
            }).catch(error => {
                toastr.error(error.response.data.message);
            })
        },
        deleteImage (id) {
            axios.delete('/api/admin/image/' + id).then(res => {
                toastr.success(res.data.message);
                this.table.rows('#view-tag-images-item-'+id).remove().draw(false);
            }).catch(error => {
                toastr.error(error.response.data.message);
            })
        }
    }
}
</script>
