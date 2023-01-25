import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'export',
    name: 'exportItem',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'export',
            path: '',
            props: true,
            component: () => import("../../views/ExportPage/Index.vue"),
        }
    ]
}
