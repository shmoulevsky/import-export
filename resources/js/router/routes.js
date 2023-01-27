import Admin from "../views/Admin.vue";
import dashboard from "./Child/Dashboard";
import importItem from "./Child/ImportItem";
import exportItem from "./Child/ExportItem";
import result from "./Child/Result";


export default [{
    path: '/',
    component: Admin,
    children: [
        dashboard,
        importItem,
        exportItem,
        result
    ]
}]
