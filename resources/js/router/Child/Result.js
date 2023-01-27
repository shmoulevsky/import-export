import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'result',
    name: 'result',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'result.index',
            path: '',
            props: true,
            component: () => import("../../views/ResultPage/Index.vue"),
        }
    ]
}
