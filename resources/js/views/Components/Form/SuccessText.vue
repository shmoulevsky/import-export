<template>
    <div v-if="isShow === true" class="alert alert-success alert-dismissible fade show" role="alert">
        {{text}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</template>

<script>
export default {
    name: "SuccessText",
    props: ['text', 'isShow'],
}
</script>

<style scoped>

</style>
