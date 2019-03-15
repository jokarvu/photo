<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h1-card">Permission Detail</h1>
            </div>
            <div class="col-lg-6 text-right">
                <button @click="$router.go(-1)" class="btn btn-md btn-primary btn-card-h1"><i class="fas fa-arrow-left"></i> Go back</button>
            </div>
        </div>
        <div class="nav-wrapper mt--2">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="view-permission-info-tab" data-toggle="tab" href="#view-permission-info" role="tab" aria-controls="view-permission-info" aria-selected="true">
                        <i class="ni ni-cloud-upload-96 mr-2"></i> Detail
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="view-permission-users-tab" data-toggle="tab" href="#view-permission-users" role="tab" aria-controls="view-permission-users" aria-selected="false">
                        <i class="ni ni-bell-55 mr-2"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="view-permission-roles-tab" data-toggle="tab" href="#view-permission-roles" role="tab" aria-controls="view-permission-roles" aria-selected="false">
                        <i class="ni ni-calendar-grid-58 mr-2"></i> Roles
                    </a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="view-permission-info" role="tabpanel" aria-labelledby="view-permission-info-tab">
                        <div class="row">
                            <div class="col-lg-3">
                                <h3>Name</h3>
                            </div>
                            <div class="col-lg-9">
                                {{permission.name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <h3>Description</h3>
                            </div>
                            <div class="col-lg-9">
                                {{permission.description}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <h3>Created</h3>
                            </div>
                            <div class="col-lg-9">
                                {{permission.created_at}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <h3>Last updated</h3>
                            </div>
                            <div class="col-lg-9">
                                {{permission.updated_at}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="view-permission-users" role="tabpanel" aria-labelledby="view-permission-users-tab">
                        <table class="table table-responsive-lg table-responsive-xl mt-6 mb-4" id="view-permission-users-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in users" :key="item.id" :id="'view-permission-user-'+item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="view-permission-roles" role="tabpanel" aria-labelledby="view-permission-roles-tab">
                        <table class="table table-responsive-lg table-responsive-xl mt-6 mb-4" id="view-permission-roles-table">
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
                                <tr v-for="item in roles" :key="item.id" :id="'view-permission-roles-'+item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{ item.updated_at }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-primary btn-sm"><i class="fas fa-pen"></i></button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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
            permission: {},
            users: [],
            roles: []
        }
    },
    created () {
        var name = this.$route.params.name;
        axios.get('/api/admin/permission/' + name).then(res => {
            this.permission = res.data.permission;
            this.users = res.data.users;
            this.roles = res.data.roles;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$router.go(-1);
        })
    },
    updated () {
        $('#view-permission-users-table').DataTable();
        $('#view-permission-roles-table').DataTable();
    }
}
</script>

