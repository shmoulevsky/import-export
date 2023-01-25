<template>
    <div class="page-heading">
        <h3>{{pageTitle}}</h3>
    </div>
</template>

<script>


export default {
    name: "PageTitle",
    computed : {
        pageTitle() { return this.$store.state.page.title }
    }

}
</script>

<style scoped>

</style>
