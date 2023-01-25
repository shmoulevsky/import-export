import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'dashboard',
    name: 'dashboard',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'dashboard.index',
            path: '',
            props: true,
            component: () => import("../../views/Dashboard/Index.vue"),
        }
    ]
}
