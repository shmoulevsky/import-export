<template>
    <div v-if="isShow === true" class="alert alert-danger alert-dismissible fade show" role="alert">
        {{text}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</template>

<script>
export default {
    name: "ErrorText",
    props: ['text'],
    computed:{
        isShow(){
            return this.text.length > 0;
        }
    }
}
</script>

<style scoped>

</style>
