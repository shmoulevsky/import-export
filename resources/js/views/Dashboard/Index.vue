<template>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <table-admin
                :items="items.data"
                :headers="headers"
                @updateItems="getItems"
            >
            </table-admin>
            <vue-pagination
                :pagination="items.meta ?? {}"
                @paginate="getItems"
                :offset="per_page"
            >
            </vue-pagination>
        </div>
    </div>
</template>

<script>
import DataService from "../../services/DataService";
import TableAdmin from "../Components/Table/TableAdmin";
import VuePagination from "../Components/Table/Pagination";


export default {
    data() {
        return {
            title: {},
            items: {},
            offset: null,
            headers: {},
            per_page: null,
            sort: null,
            dir: null,
            add: '',
            edit: '',
            current_page: 1,
        };
    },
    components: {
        TableAdmin,
        VuePagination,
    },
    computed : {
    },
    methods: {
        getItems(page, sort, dir) {

            if (sort) this.sort = sort;
            if (dir) this.dir = dir;

            DataService.getList(this.per_page, page, this.sort, this.dir, '').then(
                (response) => {
                    //this.setDefault();
                    this.items = response.data ?? [];

                    const url = new URL(window.location.href);
                    url.searchParams.delete('page');
                    if(page > 1){
                        url.searchParams.set('page', page);
                    }

                    window.history.replaceState(null, null, url); // or pushState

                }
            );
        },
        setDefault() {

            let url = 'users';
            let table = 'users';
            this.title = 'Список пользователей';
            this.headers = [
                {
                    title: "ID",
                    code: "id" ,
                    dir: "desc",
                    is_sort: true,
                },
                {
                    title: "User Name",
                    code: "user_name",
                    dir: "asc",
                    is_sort: true,
                },
                {
                    title: "Фамилия",
                    code: "last_name",
                    dir: "asc",
                    is_sort: true,
                },
                {
                    title: "Имя",
                    code: "first_name",
                    dir: "asc",
                    is_sort: true,
                },
                {
                    title: "Отчество",
                    code: "patronymic",
                    dir: "asc",
                    is_sort: true,
                },
                {
                    title: "E-mail",
                    code: "email",
                    dir: "asc",
                    is_sort: true,
                },
                {
                    title: "Пароль",
                    code: "password",
                    dir: "asc",
                    is_sort: true,
                },
            ];
            this.offset = [];
            this.per_page = 10;
            this.$store.dispatch('setTitle', this.title);
            DataService.url = url;
            this.getItems();


        },
    },
    mounted() {

        DataService.url = this.$route.params.entity;
        this.setDefault();

    },
};
</script>
