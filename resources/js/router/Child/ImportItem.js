import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'import',
    name: 'importItem',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'import',
            path: '',
            props: true,
            component: () => import("../../views/ImportPage/Index.vue"),
        }
    ]
}
