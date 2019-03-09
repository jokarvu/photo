<template>
    <div>
        <Header></Header>
        <Sidebar :toggle_sidebar="toggle_sidebar"></Sidebar>
        <div class="main-content pt-2" :style="toggle_sidebar ? 'margin-left: 0' : ''">
            <div class="header py-6">
                <!-- Toggle sidebar -->
                <label class="custom-toggle float-right mr-5 mt-3">
                    <input type="checkbox" v-model="toggle_sidebar">
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>
            </div>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import Header from './partial/header'
    import Sidebar from './partial/sidebar'
    export default {
        data () {
            return {
                toggle_sidebar: 0
            }
        },
        created () {
            if(localStorage.toggle_sidebar) {
                this.toggle_sidebar = JSON.parse(localStorage.getItem('toggle_sidebar'));
            }
        },
        watch: {
            toggle_sidebar: function (newval, oldval) {
                localStorage.setItem('toggle_sidebar', JSON.stringify(newval));
            }
        },
        components: {Header, Sidebar}
    }
</script>