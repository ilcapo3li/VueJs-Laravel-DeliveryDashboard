import DashboardLayout from "@/layout/dashboard/DashboardLayout";

 
///////////////////////////////production Admin////////////////////////////////////////
import Settings from "@/pages/Adminstration/Settings";
import Notify from "@/pages/Adminstration/Notify";
import Versions from "@/pages/Adminstration/Versions";
import AllVersions from "@/pages/Adminstration/AllVersions";
import Ads from "@/pages/Adminstration/Advertisement";

///////////////////////////////production Leads////////////////////////////////////////
import Leads from "@/pages/Leads/Leads";
import LeadAdd from "@/pages/Leads/LeadAdd";
import LeadEdit from "@/pages/Leads/LeadEdit";

///////////////////////////////production Agents////////////////////////////////////////
import Agents from "@/pages/Agents/Agents";
import AgentAdd from "@/pages/Agents/AgentAdd";
import AgentEdit from "@/pages/Agents/AgentEdit";

///////////////////////////////production Admin////////////////////////////////////////
import Admins from "@/pages/Admin/Admins";
import AdminAdd from "@/pages/Admin/AdminAdd";
import AdminEdit from "@/pages/Admin/AdminEdit";

///////////////////////////////production Admin////////////////////////////////////////
import Tayar from "@/pages/Tayar/Tayar";
import TayarAdd from "@/pages/Tayar/TayarAdd";
import TayarEdit from "@/pages/Tayar/TayarEdit";


///////////////////////////////production Currencies////////////////////////////////////////
import Currencies from "@/pages/Currencies/Currencies";
import CurrencyAdd from "@/pages/Currencies/CurrencyAdd";
import CurrencyEdit from "@/pages/Currencies/CurrencyEdit";

///////////////////////////////production Prices////////////////////////////////////////
import Prices from "@/pages/Pricing/Prices";
import PricingAdd from "@/pages/Pricing/PricingAdd";
import PricingEdit from "@/pages/Pricing/PricingEdit";

///////////////////////////////production DeliverySettings////////////////////////////////////////
import DeliverySettings from "@/pages/DeliverySettings/DeliverySettings";


///////////////////////////////Production Status////////////////////////////////////////
import Status from "@/pages/OrderStatus/Status";
import StatusAdd from "@/pages/OrderStatus/StatusAdd";
import StatusEdit from "@/pages/OrderStatus/StatusEdit";

///////////////////////////////production MaterialTypes////////////////////////////////////////
import MaterialTypes from "@/pages/MaterialTypes/MaterialTypes";
import MaterialTypeAdd from "@/pages/MaterialTypes/MaterialTypeAdd";
import MaterialTypeEdit from "@/pages/MaterialTypes/MaterialTypeEdit";

///////////////////////////////production items////////////////////////////////////////
import items from "@/pages/Items/Items";
import itemAdd from "@/pages/Items/ItemAdd";
import itemEdit from "@/pages/Items/ItemEdit";

///////////////////////////////production Orders////////////////////////////////////////
import Orders from "@/pages/Orders/Orders";
import OrderAdd from "@/pages/Orders/OrderAdd";
import OrderEdit from "@/pages/Orders/OrderEdit";

///////////////////////////////production Locations////////////////////////////////////////
import Locations from "@/pages/Locations/Locations";
import LocationAdd from "@/pages/Locations/LocationAdd";
import LocationEdit from "@/pages/Locations/LocationEdit";

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
import AdminLogin from "@/pages/Login/AdminLogin";
import HomeLogin from "@/pages/Login/HomeLogin";
import CompanyLogin from "@/pages/Login/CompanyLogin";
import AgentLogin from "@/pages/Login/AgentLogin";
import TayarLogin from "@/pages/Login/TayarLogin";
import LeadLogin from "@/pages/Login/LeadLogin";
import TestLogin from "@/pages/Login/TestLogin";
import NotFound from "@/pages/NotFoundPage";

import Test from "@/pages/Test";
// Admin pages
const Dashboard = () =>
    import(/* webpackChunkName: "dashboard" */ "@/pages/Dashboard");
const Profile = () =>
    import(/* webpackChunkName: "common" */ "@/pages/Profile");
const Notifications = () =>
    import(/* webpackChunkName: "common" */ "@/pages/Notifications");
const Icons = () =>
    import(/* webpackChunkName: "common" */ "@/pages/Icons");
const Maps = () => import(/* webpackChunkName: "common" */ "@/pages/Maps");

const routes = [
    {
        path: "/",
        component: DashboardLayout,
        redirect: "/dashboard",
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
                path: "/status",
                name: "status",
                component: Status
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
                path: "/material-types",
                name: "material-types",
                component: MaterialTypes
            },
            {
                path: "/material-types/add",
                name: "material-types-add",
                component: MaterialTypeAdd
            },
            {
                path: "/material-types/edit",
                name: "material-types-edit",
                component: MaterialTypeEdit
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
                path: "/countries",
                name: "countries",
                component: Countries
            },
            {
                path: "/country/add",
                name: "country-add",
                component: CountryAdd
            },
            {
                path: "/country/edit",
                name: "country-edit",
                component: CountryEdit
            },
             //////////////////////////////////////////////////////
            {
                path: "/cities",
                name: "cities",
                component: Cities
            },
            {
                path: "/city/add",
                name: "city-add",
                component: CityAdd
            },
            {
                path: "/city/edit",
                name: "city-edit",
                component: CityEdit
            },
             //////////////////////////////////////////////////////
            {
                path: "/zones",
                name: "zones",
                component: Zones
            },
            {
                path: "/zone/add",
                name: "zone-add",
                component: ZoneAdd
            },
            {
                path: "/zone/edit",
                name: "zone-edit",
                component: ZoneEdit
            },
              //////////////////////////////////////////////////////
            {
                path: "/prices",
                name: "prices",
                component: Prices
            },
            {
                path: "/Price/add",
                name: "price-add",
                component: PricingAdd
            },
            {
                path: "/Price/edit",
                name: "Price-edit",
                component: PricingEdit
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
        path: "/admin/bicomatics/login",
        name: "admin-login",
        component: AdminLogin
    },
    {
        path: "/test/login",
        name: "test-login",
        component: TestLogin
    },
    {
        path: "/company/login",
        name: "company-login",
        component: CompanyLogin
    },
    {
        path: "/lead/login",
        name: "lead-login",
        component: LeadLogin
    },
    {
        path: "/agent/login",
        name: "agent-login",
        component: AgentLogin
    },
    {
        path: "/tayar/login",
        name: "tayar-login",
        component: TayarLogin
    },
    {
        path: "/home/login",
        name: "home-login",
        component: HomeLogin
    },
    {
        path: "/test/package",
        name: "test-package",
        component: Test
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
