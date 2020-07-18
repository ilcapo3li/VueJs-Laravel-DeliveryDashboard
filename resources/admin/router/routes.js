import DashboardLayout from "@/layout/dashboard/DashboardLayout.vue";
 
///////////////////////////////production Admin////////////////////////////////////////
import Settings from "@/pages/Adminstration/Settings";
import Notify from "@/pages/Adminstration/Notify";
import Notes from "@/pages/Adminstration/Notes";

///////////////////////////////production Leads////////////////////////////////////////
import Leads from "@/pages/Leads/Leads";
import LeadAdd from "@/pages/Leads/LeadAdd";
import LeadEdit from "@/pages/Leads/LeadEdit";

///////////////////////////////production Suppliers////////////////////////////////////////
import Suppliers from "@/pages/Suppliers/Suppliers";
import SupplierAdd from "@/pages/Suppliers/SupplierAdd";
import SupplierEdit from "@/pages/Suppliers/SupplierEdit";

///////////////////////////////production Agents////////////////////////////////////////
import Agents from "@/pages/Agents/Agents";
import AgentAdd from "@/pages/Agents/AgentAdd";
import AgentEdit from "@/pages/Agents/AgentEdit";

///////////////////////////////production Admin////////////////////////////////////////
import Admins from "@/pages/Admin/Admins";
import AdminAdd from "@/pages/Admin/AdminAdd";
import AdminEdit from "@/pages/Admin/AdminEdit";


///////////////////////////////production Currencies////////////////////////////////////////
import Currencies from "@/pages/Currencies/Currencies";
import CurrencyAdd from "@/pages/Currencies/CurrencyAdd";
import CurrencyEdit from "@/pages/Currencies/CurrencyEdit";

///////////////////////////////production Prices////////////////////////////////////////
import Pricing from "@/pages/Pricing/Prices";
import PricingAdd from "@/pages/Pricing/PricingAdd";
import PricingEdit from "@/pages/Pricing/PricingEdit";

///////////////////////////////production DeliverySettings////////////////////////////////////////
import DeliverySettings from "@/pages/DeliverySettings/DeliverySettings";


///////////////////////////////production Statuses////////////////////////////////////////
import Statuses from "@/pages/Statuses/Statuses";
import StatusAdd from "@/pages/Statuses/StatusAdd";
import StatusEdit from "@/pages/Statuses/StatusEdit";

///////////////////////////////production Orders////////////////////////////////////////
import Orders from "@/pages/Orders/Orders";
import OrderAdd from "@/pages/Orders/OrderAdd";
import OrderEdit from "@/pages/Orders/OrderEdit";

///////////////////////////////production Countries////////////////////////////////////////
import Countries from "@/pages/Countries/Countries";
import CountryAdd from "@/pages/Countries/CountryAdd";
import CountryEdit from "@/pages/Countries/CountryEdit";

///////////////////////////////production Cities////////////////////////////////////////
import Cities from "@/pages/Cities/Cities";
import CityAdd from "@/pages/Cities/CityAdd";
import CityEdit from "@/pages/Cities/CityEdit";

///////////////////////////////production Zones////////////////////////////////////////
import Zones from "@/pages/Zones/Zones";
import ZoneAdd from "@/pages/Zones/ZoneAdd";
import ZoneEdit from "@/pages/Zones/ZoneEdit";



import ChatTest from "@/pages/ChatTest";
import UserCard from "@/pages/Profile/UserCard";
import Users from "@/pages/Profile/Users";
import Reports from "@/pages/Report/Reports";
import ShowReport from "@/pages/Report/ShowReport";

// GeneralViews
import Login from "@/pages/Login.vue";
import NotFound from "@/pages/NotFoundPage.vue"

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
        redirect: "/profile",
        children: [

            ////////////production begain///////////////////////
            {
                path: "/dashboard",
                name: "Dashboard",
                component: Dashboard
            },
            {
                path: "/chat",
                name: "chat",
                component: ChatTest
            },
            {
                path: "/profile",
                name: "profile",
                component: UserCard
            },
            {
                path: "/delivery-settings",
                name: "delivery-settings",
                component: DeliverySettings
            },
            {
                path: "/delivery-settings",
                name: "delivery-settings",
                component: DeliverySettings
            },
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
                path: "/advertisments",
                name: "ads",
                component: Ads
            },
            {
                path: "/allversions",
                name: "allversions",
                component: AllVersions
            },
            {
                path: "/versions",
                name: "versions",
                component: Versions
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
            },
            
            ////////////////////////////////////////////////////
            {
                path: "/admins",
                name: "admins",
                component: Admins
            },
            {
                path: "/admins/add",
                name: "admins-add",
                component: AdminAdd
            },
            {
                path: "/admins/edit",
                name: "admins-edit",
                component: AdminEdit
            },
            //////////////////////////////////////////////////////
            {
                path: "/suppliers",
                name: "suppliers",
                component: Suppliers
            },
            {
                path: "/supplier/add",
                name: "supplier-add",
                component: SupplierAdd
            },
            {
                path: "/supplier/edit",
                name: "supplier-edit",
                component: SupplierEdit
            },
            //////////////////////////////////////////////////////
            {
                path: "/agents",
                name: "agents",
                component: Agents
            },
            {
                path: "/agents/add",
                name: "agent-add",
                component: AgentAdd
            },
            {
                path: "/suppliers/edit",
                name: "agent-edit",
                component: AgentEdit
            },
            //////////////////////////////////////////////////////
            {
                path: "/tayar",
                name: "tayar",
                component: Tayar
            },
            {
                path: "/tayar/add",
                name: "tayar-add",
                component: TayarAdd
            },
            {
                path: "/tayar/edit",
                name: "tayar-edit",
                component: TayarEdit
            },
            //////////////////////////////////////////////////////
            {
                path: "/leads",
                name: "leads",
                component: Leads
            },
            {
                path: "/lead/add",
                name: "lead-add",
                component: LeadAdd
            },
            {
                path: "/lead/edit",
                name: "lead-edit",
                component: LeadEdit
            },

            //////////////////////////////////////////////////////
            {
                path: "/orders",
                name: "orders",
                component: Orders
            },
            {
                path: "/order/add",
                name: "order-add",
                component: OrderAdd
            },
            {
                path: "/order/edit",
                name: "order-edit",
                component: OrderEdit
            },

            //////////////////////////////////////////////////////
            {
                path: "/statuses",
                name: "statuses",
                component: Statuses
            },
            {
                path: "/status/add",
                name: "status-add",
                component: StatusAdd
            },
            {
                path: "/status/edit",
                name: "status-edit",
                component: StatusEdit
            },

            //////////////////////////////////////////////////////
            {
                path: "/currencies",
                name: "currencies",
                component: Currencies
            },
            {
                path: "/currency/add",
                name: "currency-add",
                component: CurrencyAdd
            },
            {
                path: "/currency/edit",
                name: "currency-edit",
                component: CurrencyEdit
            },
             //////////////////////////////////////////////////////
            {
                path: "/locations",
                name: "locations",
                component: Locations
            }
            
           
           
           
           
        ],

    },
     {
        path: "/admin/delivery/login",
        name: "login",
        component: Login
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
