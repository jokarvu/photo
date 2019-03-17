<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xl-6">
                <h1 class="h1-card">User Detail</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xl-6 text-right">
                <button @click="$router.go(-1)" class="btn btn-md btn-primary btn-card-h1"><i class="fas fa-arrow-left"></i> Go back</button>
            </div>
        </div>
        <div class="nav-wrapper mt--2">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="view-user-info-tab" data-toggle="tab" href="#view-user-info" role="tab" aria-controls="view-user-info" aria-selected="true">
                        <i class="fas fa-info-circle mr-2"></i> Detail
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="view-user-albums-tab" data-toggle="tab" href="#view-user-albums" role="tab" aria-controls="view-role-users" aria-selected="false">
                        <i class="fas fa-images mr-2"></i> Albums
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="view-user-permissions-tab" data-toggle="tab" href="#view-user-permissions" role="tab" aria-controls="view-role-roles" aria-selected="false">
                        <i class="fas fa-lock mr-2"></i> Permissions
                    </a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="view-user-info" role="tabpanel" aria-labelledby="view-user-info-tab">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <h3>Name</h3>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                {{user.name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <h3>Email</h3>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                {{user.email}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <h3>Role</h3>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                {{role.name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <h3>Created</h3>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                {{user.created_at}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <h3>Last updated</h3>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                {{user.updated_at}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="view-user-albums" role="tabpanel" aria-labelledby="view-user-albums-tab">
                        <table class="table table-responsive-lg table-responsive-xl mt-6 mb-4" id="view-user-albums-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in albums" :key="item.id" :id="'view-user-albums-item-'+item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'ViewAlbum', params: {id: item.id}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></router-link>
                                        <router-link :to="{name: 'EditAlbum', params: {id: item.id}}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></router-link>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" :data-target="'#view-user-albums-delete-item-' + item.id">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" :id="'view-user-albums-delete-item-' + item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="tab-pane fade" id="view-user-permissions" role="tabpanel" aria-labelledby="view-user-permissions-tab">
                        <table class="table table-responsive-lg table-responsive-xl mt-6 mb-4" id="view-user-permissions-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in permissions" :key="item.id" :id="'view-user-permissions-item-'+item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'ViewPermission', params: {name: item.name}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></router-link>
                                        <router-link :to="{name: 'EditPermission', params: {name: item.name}}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></router-link>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" :data-target="'#view-user-permissions-delete-item-' + item.id">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" :id="'view-user-permissions-delete-item-' + item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Deleting this permission might make you unable to take some actions. Do you still want to take action?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" @click="deletePermission(item.id)" class="btn btn-danger" data-dismiss="modal">Delete</button>
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
            user: {},
            role: {},
            permissions: [],
            albums: []
        }
    },
    created () {
        var id = this.$route.params.id;
        axios.get('/api/admin/user/'+id).then(res => {
            this.user = res.data.user;
            this.permissions = res.data.permissions;
            this.albums = res.data.albums;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$route.go(-1);
        })
    },
    updated () {
        this.permissions_table = $('#view-user-permissions-table').DataTable();
        this.albums_table = $('#view-user-albums-table').DataTable();
    },
    methods: {
        deletePermission (id) {
            axios.delete('/api/admin/permission/' + id).then(res => {
                toastr.success(res.data.message);
                this.permissions_table.rows('#view-user-permissions-item-'+id).remove().draw(false);
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
    }
}
</script>
