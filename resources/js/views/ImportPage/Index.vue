<template>
    <div class="col-12 col-lg-9">
        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <success-text :is-show="this.success.is_show" :text="this.success.text"></success-text>
                    <error-text :text="this.errors"></error-text>
                    <form>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Выберите файл (csv)</label>
                            <input @input="uploadFile()" class="form-control" type="file" id="formFile">
                            <span>{{filePath}}</span>
                        </div>
                        <div id="progress" class="progress mb-3">
                            <div
                                id="progress-bar"
                                class="progress-bar progress-bar-info"
                                role="progressbar"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            ></div>
                        </div>
                        <div>
                        <select v-model="type" class="form-select" aria-label="Default select example">
                            <option selected="selected" value="0">Выберите тип</option>
                            <option :value="key" v-for="(type, key) in types">{{type}}</option>
                        </select>
                        </div>
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
    name: "ImportPage",
    components: {
        SuccessText, ErrorText
    },
    data() {
        return {
            types: [],
            type: "0",
            filePath : '',
            errors: '',
            success: {
                text : "Запрос на импорт отправлен в очередь",
                is_show : false
            },
        };
    },
    mounted() {
        this.$store.dispatch('setTitle', 'Импорт CSV');

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
                url : 'import',
                data : {'type' : this.type, 'path' : this.filePath}
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
        },
        uploadFile: async function () {

            this.errors = '';

            let formData = new FormData();
            let file = document.querySelector('#formFile');
            formData.append("file", file.files[0]);


            let progressBarElement = document.getElementById("progress-bar");
            progressBarElement.innerHTML = "0%";
            progressBarElement.setAttribute("aria-valuenow", 0);
            progressBarElement.style.width = "0%";

            const onUploadProgress = (event) => {
                const percentage = Math.round((100 * event.loaded) / event.total);
                progressBarElement.innerHTML = percentage + "%";
                progressBarElement.setAttribute("aria-valuenow", percentage);
                progressBarElement.style.width = percentage + "%";

            };

            try {
                const response = await axios.post('api/upload-file', formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                    onUploadProgress,
                });

                this.filePath = response.data.path;

            } catch (error) {
                let message = ' :' + error.response.data.message || '';
                this.errors = 'Ошибка загрузки файла' + message;
            }


        }
    }
}
</script>

<style scoped>

</style>
