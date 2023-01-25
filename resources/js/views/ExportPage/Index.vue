<template>
    <div class="col-12 col-lg-9">
        <div class="row">

        </div>
    </div>
</template>

<script>
export default {
    name: "ExportPage",
    mounted() {
        this.$store.dispatch('setTitle', 'Export Page');
    }
}
</script>

<style scoped>

</style>
