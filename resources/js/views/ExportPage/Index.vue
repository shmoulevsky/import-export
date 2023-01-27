<template>
    <div class="col-12 col-lg-9">
        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <success-text :is-show="this.success.is_show" :text="this.success.text"></success-text>
                    <error-text :text="this.errors"></error-text>
                    <form>
                        <select v-model="type" class="form-select" aria-label="Default select example">
                            <option selected="selected" value="0">Выберите тип</option>
                            <option :value="key" v-for="(type, key) in types">{{type}}</option>
                        </select>
                        <button type="button" @click="send()" class="btn btn-primary mt-3">Выполнить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DataService from "../../services/DataService";
import axiosInstance from "../../services/axios";
import SuccessText from "../Components/Form/SuccessText.vue";
import ErrorText from "../Components/Form/ErrorText.vue";

export default {
    name: "ExportPage",
    components: {
        SuccessText, ErrorText
    },
    data() {
        return {
            types: [],
            type: "0",
            errors: '',
            success: {
                text : "Запрос на экспорт отправлен в очередь",
                is_show : false
            },
        };
    },
    mounted() {
        this.$store.dispatch('setTitle', 'Экспорт CSV');

        DataService.get('/export/types').then(
            (response) => {
                this.types = response.data.types ?? [];
            }
        );

    },
    methods : {
        send() {
            axiosInstance({
                method: 'post',
                url : 'export',
                data : {'type' : this.type}
            })
                .then(response => {
                    this.errors = '';
                    this.success.is_show = true;
                    setTimeout(() =>{this.success.is_show = false;}, 3000);
                })
                .catch(error => {

                    this.errors = '';

                    if(error.response.status === 500){
                        this.errors = error.response.data.message;
                    }else{
                        for(let i in error.response.data.errors){
                            this.errors +=  error.response.data.errors[i] ?? null;
                        }
                    }

                });
        }
    }
}
</script>

<style scoped>

</style>
