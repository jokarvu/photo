<template>
    <main>
        <section class="section section-shaped section-lg">
            <div class="shape shape-style-1 bg-gradient-default">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="container py-9">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card bg-secondary shadow border-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <small>Sign in to Photography</small>
                                </div>
                                <form @submit.prevent="login">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" type="email" v-model="user.email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" type="password" v-model="user.password">
                                        </div>
                                    </div>
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id=" customCheckLogin" type="checkbox" v-model="user.remember">
                                        <label class="custom-control-label" for=" customCheckLogin">
                                        <span>Remember me</span>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <router-link to="/forgot" class="text-light">
                                <small>Forgot password?</small>
                                </router-link>
                            </div>
                            <div class="col-6 text-right">
                                <router-link to="/register" class="text-light">
                                <small>Create new account</small>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
export default {
    data () {
        return {
            user: {
                email: '',
                password: '',
                remember: 0
            }
        }
    },
    methods: {
        login () {
            axios.post('/api/auth/login', this.user).then(res => {
                toastr.success(res.data.message);
                axios.get('/api/auth/dashboard').then(res => {
                    let path = '/' + res.data;
                    this.$router.push({path: path});
                });
            }).catch(error => {
                Helper.error(error);
            });
        }
    },
    beforeRouteEnter (to, from, next) {
        axios.get('/api/auth/guest').then(res => {
            return next();
        }).catch(error => {
            var path = '/';
            axios.get('/api/auth/dashboard').then(res => {
                path += res.data;
                return next({path: path});
            });
        })
    }
}
</script>

<style lang="scss" scoped>
    .section {
        height: 100vh;
    }
</style>
