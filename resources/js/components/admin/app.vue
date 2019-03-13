<template>
    <div>
        <Header></Header>
        <Sidebar :toggle_sidebar="toggle_sidebar" @toggled="toggle"></Sidebar>
        <div class="main-content mobile-padding pb-5 scrollbar" :class="toggle_sidebar ? 'hide_sidebar' : ''">
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
                toggle_sidebar: false
            }
        },
        created () {
            if(localStorage.toggle_sidebar) {
                this.toggle_sidebar = JSON.parse(localStorage.getItem('toggle_sidebar'));
            }
        },
        methods: {
            toggle (value) {
                this.toggle_sidebar = value;
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

<style lang="scss">
    .scrollbar {
        overflow-y: auto;
        max-height: 94vh;
        margin-top: 4rem;
    }
@media screen and (min-width: 769px) {
    .hide_sidebar {
        animation-name: margin_change;
        animation-fill-mode: forwards;
        animation-delay: .2s;
        animation-duration: .2s;
    }
    @keyframes margin_change {
        from {margin-left: 250px}
        to {margin-left: 4.5rem}
    }
}
@media screen and (max-width: 768px) {
    .mobile-padding {
        padding-top: 5.5em !important;
    }
    .hide_sidebar {
        margin-left: 0!important;
    }
}
</style>
