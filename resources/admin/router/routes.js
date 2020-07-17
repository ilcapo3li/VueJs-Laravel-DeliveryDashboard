import DashboardLayout from "@/layout/dashboard/DashboardLayout.vue";
// import Countries from "@/pages/Countries";
// 
///////////////////////////////production////////////////////////////////////////
import Settings from "@/pages/Adminstration/Settings";
import Notify from "@/pages/Adminstration/Notify";
import Notes from "@/pages/Adminstration/Notes";

///////////////////////////////production////////////////////////////////////////
import ChatTest from "@/pages/ChatTest";
import Admins from "@/pages/Admin/Admins";
import AdminEdit from "@/pages/Admin/AdminEdit";

import UserCard from "@/pages/Profile/UserCard";
import AdminAdd from "@/pages/Admin/AdminAdd";
import Users from "@/pages/Profile/Users";
import Reports from "@/pages/Report/Reports";
import ShowReport from "@/pages/Report/ShowReport";

// GeneralViews
import NotFound from "@/pages/NotFoundPage.vue";

// Admin pages
const Dashboard = () =>
    import(/* webpackChunkName: "dashboard" */ "@/pages/Dashboard.vue");
const Profile = () =>
    import(/* webpackChunkName: "common" */ "@/pages/Profile.vue");
const Notifications = () =>
    import(/* webpackChunkName: "common" */ "@/pages/Notifications.vue");
const Icons = () =>
    import(/* webpackChunkName: "common" */ "@/pages/Icons.vue");
const Maps = () => import(/* webpackChunkName: "common" */ "@/pages/Maps.vue");

const routes = [
    {
        path: "/",
        component: DashboardLayout,
        redirect: "/scores/live",
        children: [
           
            {
                path: "/countries",
                name: "countries",
                component: Countries
            },
           
           
          
           
            ////////////production begain///////////////////////
          
            {
                path: "/chat",
                name: "chat",
                component: ChatTest
            },
            {
                path: "/admins",
                name: "admins",
                component: Admins
            },
            {
                path: "/admins/edit",
                name: "admins-edit",
                component: AdminEdit
            },
           
            {
                path: "/profile",
                name: "profile",
                component: UserCard
            },
            {
                path: "/users",
                name: "users",
                component: Users
            },
            {
                path: "/admins/add",
                name: "admins-add",
                component: AdminAdd
            },

            //////////////////////////////////////
            {
                path: "/settings",
                name: "settings",
                component: Settings
            },
            {
                path: "/notify",
                name: "notify",
                component: Notify
            },
            {
                path: "/notes",
                name: "notes",
                component: Notes
            },
            {
                path: "/reports",
                name: "Report",
                component: Reports
            },
            {
                path: "/report/show",
                name: "ShowReport",
                component: ShowReport
            }
        ]
    },

    { path: "*", component: NotFound }
];

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * The specified component must be inside the Views folder
 * @param  {string} name  the filename (basename) of the view to load.
function view(name) {
   var res= require('../components/Dashboard/Views/' + name + '.vue');
   return res;
};**/

export default routes;
