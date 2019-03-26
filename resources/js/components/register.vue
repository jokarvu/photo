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
                                    <small>Register an account</small>
                                </div>
                                <form @submit.prevent="register">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Name" type="text" v-model="user.name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" type="email" v-model="user.email" autocomplete="false">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" type="password" v-model="user.password">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Password Confirmation" type="password" v-model="user.password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <select class="form-control" name="role" id="role" v-model="user.role_id">
                                                <option value="0" disabled>Select account type</option>
                                                <option v-for="item in roles" :key="item.id" :value="item.id">{{ item.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4">Create account</button>
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
                                <router-link to="/login" class="text-light">
                                    <small>Already have an account?</small>
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
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                role_id: 0,
            },
            roles: []
        }
    },
    created () {
        axios.get('/api/auth/register').then(res => {
            this.roles = res.data;
        }).catch(error => {
            toastr.error("Something went wrong");
            this.$router.push('/login');
        })
    },
    methods: {
        register () {
            axios.post('/api/auth/register', this.user).then(res => {
                toastr.success(res.data.message);
                this.$router.push({path: '/login'});
            }).catch(error => {
                Helper.error(error);
            })
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
