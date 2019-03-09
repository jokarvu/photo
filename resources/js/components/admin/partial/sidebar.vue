<template>
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white fixed-top-mobile" :class="toggle_sidebar ? 'toggled' : ''" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand" href="">
                Dashboard
            </a>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            Actions
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link exact tag="a" to="/" class="nav-link active">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/categories" class="nav-link">
                            <i class="fas fa-user"></i> User
                        </router-link>
                    </li>
                    
                    <li class="nav-item">
                        <router-link tag="a" to="/articles/new" class="nav-link">
                            <i class="fas fa-camera-retro"></i> Photographer
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/articles/new" class="nav-link">
                            <i class="fas fa-receipt"></i> Order
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/articles/new" class="nav-link">
                            <i class="fas fa-map-marked-alt"></i> Location
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/articles/new" class="nav-link">
                            <i class="fas fa-tags"></i> Tags
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/articles/new" class="nav-link">
                            <i class="fas fa-images"></i> Gallery
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/articles/new" class="nav-link">
                            <i class="fas fa-smile"></i> Reviews
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/articles/new" class="nav-link">
                            <i class="fas fa-star"></i> Ratings
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/articles/new" class="nav-link">
                            <i class="fas fa-money-bill-wave-alt"></i> Income
                        </router-link>
                    </li>
                </ul>
                
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading text-muted">Quick Actions</h6>
                <!-- Navigation -->
            </div>
        </div>
    </nav>
</template>
<script>
export default {
    props: ['toggle_sidebar'],
    mounted () {

    }
    
}
</script>
<style>
@media screen and (min-width: 769px) {
    .toggled {
        display: none !important;
    }
}
@media screen and (max-width: 768px) {
    .fixed-top-mobile {
        position: fixed!important;
        width: 100%;
    }
    .toggled {
        display: block;
    }
}
</style>
