<template>
    <div id="app">
        <side-bar></side-bar>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
                <div class="flex-row d-flex">
                    <div class="flex-column">

                    </div>
                    <div class="flex-column d-flex end">

                    </div>
                </div>
            </header>
            <page-title></page-title>

            <div class="page-content">
                <section class="row">
                    <router-view :key="$route.fullPath"/>
                </section>
            </div>
            <page-footer/>
        </div>
    </div>
</template>
<script>
import SideBar from "./Components/SideBar"
import PageTitle from "./Components/PageTitle"
import PageFooter from "./Components/PageFooter"

export default {
    components: {SideBar, PageTitle, PageFooter},
    data(){
        return {
        }
    },
    created() {

    },
    mounted () {

    },
    methods : {

    }
}
</script>
<style scoped>
    .page-content{
        min-height: 500px;
    }
</style>
