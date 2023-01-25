<template>
    <div class="col-12 col-lg-9">
        <div class="row">

        </div>
    </div>
</template>

<script>
export default {
    name: "Dashboard",
    mounted() {
        this.$store.dispatch('setTitle', 'Dashboard');
    }
}
</script>

<style scoped>

</style>
