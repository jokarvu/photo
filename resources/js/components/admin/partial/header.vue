<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Photography</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-default">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            Photography
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>

                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fab fa-facebook-square"></i>
                            <span class="nav-link-inner--text d-lg-none pl-3">Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#">
                            <i class="fab fa-twitter"></i>
                            <span class="nav-link-inner--text d-lg-none pl-3">Twitter</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-icon" href="#" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                            <span class="nav-link-inner--text d-lg-none pl-3">Settings</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                            <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Privacy</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" @click="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</template>
<script>
export default {
    methods: {
        logout () {
            axios.get('/api/auth/logout').then(res => {
                toastr.warning(res.data.message);
                this.$router.push({path: '/login'});
            }).catch(error => {
                toastr.error(error.response.data.message);
            })
        }
    }
}
</script>
