<template>
    <div>
    <table class="styled-table">
        <tr>
            <td
                v-for="(head, index) in headers"
                :class="head.is_sort ? 'active' : ''"
                class="heading"
                :data-code="head.code"
                :data-dir="head.dir"
                :data-index="index"
                @click="sortColumn"
                :key="head.title">{{head.title}}
                <i
                    class="bi"
                    :class="head.dir === 'asc' ? 'bi-arrow-up-short' : 'bi-arrow-down-short'"
                ></i>
            </td>
        </tr>
        <tr v-for="item in items" :key="item.id">
            <td v-for="(header, index) in headers" :key="index">
                <template v-if="header.type === 'img'">
                    <img alt="" style="max-height: 90px;" :src="item[header.code]"/>
                </template>
                <template v-else-if="header.type === 'url'">
                    <a :href="item[header.url]">{{item[header.code]}}</a>
                </template>
                <template v-else-if="header.type === 'badge'">
                    <span class="badge" :class="item[header.code].class">{{item[header.code].title}}</span>
                </template>
                <template v-else>
                    {{item[header.code]}}
                </template>

            </td>

        </tr>
    </table>
    </div>
</template>
<script>


export default({
    name: 'Table',
    data() {
       return {

       }
    },
    methods: {
        filterFields: function(obj = []) {

             Object.keys(obj).filter(item => this.columns.includes(item) === false).forEach(key => delete obj[key]);
             return obj;

        },
        sortColumn: function (event) {
            let sort = event.target.dataset.code;
            let dir = event.target.dataset.dir;
            let index = event.target.dataset.index;
            let page = 1;

            for(let key in this.headers){
                this.headers[key].is_sort = false;
            }

            if(dir === 'desc'){
                dir = 'asc';
            }else {
                dir = 'desc';
            }

            event.target.dataset.dir = dir;
            this.headers[index].dir = dir;

            this.headers[index].is_sort = true;
            this.$emit('updateItems', page, sort, dir);
        }
    },
    props : ['headers','items','columns','route_create_name','route_edit_name'],
    mounted(){

    }
})
</script>
<style scoped>
    .styled-table{
        width: 100%;
        border-collapse: collapse;
    }

    .styled-table td{
       padding: 5px 10px;
       border-bottom: 1px solid #ccc;
    }

    td.heading{
        font-weight: bold;
        background-color: #2d499d;
        border-color: #2d499d;
        color: #fff;
        padding: 15px 10px;
    }

    .heading.active{
        background-color: #4c6ac7;
    }

</style>
