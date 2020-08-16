const makeUrl = route => {
    return `https://${location.hostname}/api${route}`;
};

export default {
    login: () => {
        return makeUrl("/login");
    },
    logout() {
        return makeUrl("/logout");
    },
    checkAuth: () => {
        return makeUrl("/token/check");
    },

    ///////////////////////////OrderStatus//////////////////////////////
    status() {
        return makeUrl("/status");
    },
    allStatus() {
        return makeUrl("/all/status");
    },
    saveStatus() {
        return makeUrl("/save/status");
    },
    updateStatus(status) {
        return makeUrl(`/update/status/${status}`);
    },
    deleteStatus(status) {
        return makeUrl(`/delete/status/${status}`);
    },
    ///////////////////////////Orders//////////////////////////////
    orders() {
        return makeUrl("/orders");
    },

    saveOrder() {
        return makeUrl("/save/order");
    },
    updateOrder(order) {
        return makeUrl(`/update/order/${order}`);
    },
    deleteOrder(order) {
        return makeUrl(`/delete/order/${order}`);
    },
    /////////////////////////////////////////////////////
    collectOrder(order) {
        return makeUrl(`/collect/order/${order}`);
    },
    /////////////////////////Admin Panel/////////////////////////////
    updateOrderStatus(order) {
        return makeUrl(`/order/status/${order}`);
    },
    //////////////////////////////////////////////////////
    sendMessage() {
        return makeUrl("/send_message");
    },
    messages() {
        return makeUrl("/messages");
    },
    ///////////////////////////////Admin Panel////////////////////////////////
    blockUser(user) {
        return makeUrl(`/block/user/${user}`);
    },
    deleteUser(user) {
        return makeUrl(`/delete/user/${user}`);
    },
    updateUser(user) {
        return makeUrl(`/update/user/${user}`);
    },

    ///////////////////////////Admin API//////////////////////////

    admins() {
        return makeUrl("/admins");
    },
    saveAdmin() {
        return makeUrl("/save/admin");
    },
    updateAdmin(admin) {
        return makeUrl(`/update/admin/${admin}`);
    },

    ///////////////////////////////Admin Panel////////////////////////////////
    agents() {
        return makeUrl("/agents");
    },
    saveAgent() {
        return makeUrl("/save/agent");
    },

    ///////////////////////////////Admin Panel////////////////////////////////
    suppliers() {
        return makeUrl("/suppliers");
    },
    saveSupplier() {
        return makeUrl("/save/supplier");
    },

    ///////////////////////////////Admin Panel////////////////////////////////
    tayareen() {
        return makeUrl("/tayareen");
    },
    saveTayar() {
        return makeUrl("/save/tayar");
    },
    ///////////////////////////////power Panel////////////////////////////////
    powers() {
        return makeUrl("/powers");
    },
    savePower() {
        return makeUrl("/save/power");
    },
    updatePower(power) {
        return makeUrl(`/update/power/${power}`);
    },
    ///////////////////////////////power Panel////////////////////////////////
    superPowers() {
        return makeUrl("/superpowers");
    },
    saveSuperPower() {
        return makeUrl("/save/superpower");
    },
    updateSuperPower(superpower) {
        return makeUrl(`/update/superpower/${superpower}`);
    },

    ///////////////////////////////Admin Panel////////////////////////////////
    leads() {
        return makeUrl("/leads");
    },
    allLeads() {
        return makeUrl("/all/leads");
    },
    saveLead() {
        return makeUrl("/save/lead");
    },

    ///////////////////////////////Admin Panel////////////////////////////////

    zones() {
        return makeUrl("/zones");
    },
    allZones() {
        return makeUrl("/all/zones");
    },
    saveZone() {
        return makeUrl("/save/zone");
    },
    updateZone(zone) {
        return makeUrl(`/update/zone/${zone}`);
    },
    deleteZone(zone) {
        return makeUrl(`/delete/zone/${zone}`);
    },
    ///////////////////////////////Admin Panel////////////////////////////////

    countries() {
        return makeUrl("/countries");
    },
    allCountries() {
        return makeUrl("/all/countries");
    },
    saveCountry() {
        return makeUrl("/save/country");
    },
    updateCountry(country) {
        return makeUrl(`/update/country/${country}`);
    },
    deleteCountry(country) {
        return makeUrl(`/delete/country/${country}`);
    },
    ///////////////////////////////Admin Panel////////////////////////////////

    cities() {
        return makeUrl("/cities");
    },
    allCities() {
        return makeUrl("/all/cities");
    },
    saveCity() {
        return makeUrl("/save/city");
    },
    updateCity(city) {
        return makeUrl(`/update/city/${city}`);
    },
    deleteCity(city) {
        return makeUrl(`/delete/city/${city}`);
    },

    ///////////////////////////////Admin Panel////////////////////////////////

    materialTypes() {
        return makeUrl("/materialtypes");
    },
    allMaterialtypes() {
        return makeUrl("/all/materialtypes");
    },
    saveMaterialtype() {
        return makeUrl("/save/materialtype");
    },
    updateMaterialtype(materialtype) {
        return makeUrl(`/update/materialtype/${materialtype}`);
    },
    deleteMaterialtype(materialtype) {
        return makeUrl(`/delete/materialtype/${materialtype}`);
    },

    /////////////////////////Super Admin////////////////////////////
    permissions() {
        return makeUrl("/permissions");
    },

    removePhoto() {
        return makeUrl("/delete/photo");
    },

    saveSettings() {
        return makeUrl("/save/settings");
    },
    /////////////////////////reports/////////////////////////
    reports() {
        return makeUrl("/reports");
    },
    satueReport(report) {
        return makeUrl(`/report_statue/${report}`);
    },
    replayReport(user) {
        return makeUrl(`/report-replay/${user}`);
    },
    /////////////////////////////////////////////////////
    notify(apk) {
        return makeUrl(`/notify/${apk}`);
    },

    branches() {
        return makeUrl("/branches");
    },
    ////////////////////////////agent - Supplier - leads - tayar///////////////////////////
    myOrders() {
        return makeUrl("/my/orders");
    },

    myCollect() {
        return makeUrl("/my/collects");
    },

    leadOrders() {
        return makeUrl("/lead/Orders");
    },

    myLeads() {
        return makeUrl("/my/leads");
    },

    myLocations() {
        return makeUrl("/my/locations");
    },

    searchOrders() {
        return makeUrl("/search/orders");
    },
    /////////////////////////////////////////////////////////////////////////
    advertiments(app) {
        return makeUrl(`/ads/${app}`);
    },
    saveIDS(ads) {
        return makeUrl(`/ads/${ads}`);
    },
    getLatest() {
        return makeUrl(`/get/lastApps`);
    },
    saveNewApp(app) {
        return makeUrl(`/upload/version/${app}`);
    },
    allSettings() {
        return makeUrl("/settings");
    }
};
