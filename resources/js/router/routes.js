import Admin from "../views/Admin.vue";
import dashboard from "./Child/Dashboard";
import importItem from "./Child/ImportItem";
import exportItem from "./Child/ExportItem";


export default [{
    path: '/',
    component: Admin,
    children: [
        dashboard,
        importItem,
        exportItem
    ]
}]
