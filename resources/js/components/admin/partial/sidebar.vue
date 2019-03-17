<template>
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white fixed-top-mobile" :class="toggle_sidebar ? 'toggled' : ''" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand pr-4" href="">
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
                        <router-link exact tag="a" to="/admin" class="nav-link">
                            <i class="fas fa-chart-line"></i> 
                            <span class="label-hidden">Dashboard</span>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/admin/user" class="nav-link">
                            <i class="fas fa-user"></i> 
                            <span class="label-hidden">User</span>
                        </router-link>
                    </li>
                    
                    <li class="nav-item">
                        <router-link tag="a" to="/articles/new" class="nav-link">
                            <i class="fas fa-camera-retro"></i> 
                            <span class="label-hidden">Photographer</span>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/admin/order" class="nav-link">
                            <i class="fas fa-receipt"></i> 
                            <span class="label-hidden">Order</span>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/admin/location" class="nav-link">
                            <i class="fas fa-map-marked-alt"></i> 
                            <span class="label-hidden">Location</span>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/admin/tag" class="nav-link">
                            <i class="fas fa-tags"></i> 
                            <span class="label-hidden">Tags</span>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/admin/gallery" class="nav-link">
                            <i class="fas fa-images"></i> 
                            <span class="label-hidden">Gallery</span>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/admin/review" class="nav-link">
                            <i class="fas fa-smile"></i> 
                            <span class="label-hidden">Reviews</span>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/admin/rating" class="nav-link">
                            <i class="fas fa-star"></i> 
                            <span class="label-hidden">Ratings</span>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/admin/income" class="nav-link">
                            <i class="fas fa-money-bill-wave-alt"></i> 
                            <span class="label-hidden">Income</span>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/admin/permission" class="nav-link">
                            <i class="fas fa-lock"></i> 
                            <span class="label-hidden">Permission</span>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link tag="a" to="/admin/role" class="nav-link">
                            <i class="fas fa-users"></i> 
                            <span class="label-hidden">Group</span>
                        </router-link>
                    </li>
                </ul>
                
                <!-- Divider -->
                <hr class="my-3">
                <!-- Navigation -->
                <div class="col-lg-12 col-sm-12 text-center fix-toggle-button">
                    <label class="custom-toggle">
                        <input type="checkbox" id="hide_sidebar" v-model="checked">
                        <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
    props: ['toggle_sidebar'],
    data () {
        return {
            checked: this.toggle_sidebar
        }
    },
    mounted () {

    },
    watch: {
        checked: function (newval, oldval) {
            this.$emit('toggled', newval);
        }
    }
    
}
</script>
<style lang="scss" scoped>
    @media screen and (min-width: 769px) {
        .header {
            position: absolute;
            left: 0.6rem;
        }
        .toggled {
            .fix-toggle-button {
                margin-left: -1.8rem;
            }
            animation-name: hide_label;
            animation-duration: .2s;
            animation-fill-mode: forwards;
            .label-hidden {
                display: none;
            }
            @keyframes hide_label {
                to {width: 4.5rem}
            }
        }
        .toggled:hover {
            animation-name: show_label;
            animation-duration: .5s;
            animation-fill-mode: forwards;
            .fix-toggle-button {
                margin-left: 0;
            }
            .label-hidden {
                display: block;
            }
            @keyframes show_label {
                to {width: 250px}
            }
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
        .header {
            display: none;
        }
        .fix-toggle-button {
            display: none;
        }
    }
</style>
