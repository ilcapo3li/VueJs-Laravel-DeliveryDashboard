const makeUrl = route => {
    return `http://${location.hostname}/api${route}`;
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
    allCountries: () => {
        return makeUrl("/allCountries");
    }, 

    ///////////////////////////OrderStatus//////////////////////////////
    OrderStatus() {
        return makeUrl("/status");
    },
    allOrderStatus() {
        return makeUrl("/allStatus");
    },
    saveStatue() {
        return makeUrl("/save/Statue");
    },
    updateStatue(statue_id) { 
        return makeUrl(`/update/statue/${statue_id}`);
    },
    deleteStatue(statue_id) {
        return makeUrl(`/delete/statue/${statue_id}`);
    }, 
    ///////////////////////////Orders//////////////////////////////
    orders() {
        return makeUrl("/orders");
    },
    allOrders() {
        return makeUrl("/allOrders");
    },
    saveOrder() {
        return makeUrl("/save/order");
    },
    updateOrder(order_id) {
        return makeUrl(`/update/order/${order_id}`);
    },
    deleteOrder(order_id) {
        return makeUrl(`/delete/order/${order_id}`);
    }, 
    /////////////////////////////////////////////////////
    collectOrder(order_id) {
        return makeUrl(`/collect/order/${order_id}`);
    },
    /////////////////////////Admin Panel/////////////////////////////
     updateOrderStatus(order_id) {
        return makeUrl(`/order/status/${order_id}`);
    },
    //////////////////////////////////////////////////////
    sendMessage() {
        return makeUrl("/send_message");
    },
    messages() {
        return makeUrl("/messages");
    },
    ///////////////////////////Admin API//////////////////////////
    admins() {
        return makeUrl("/admins");
    },
    agents() {
        return makeUrl("/agents");
    },
    suppliers() {
        return makeUrl("/suppliers");
    },
    tayareen() {
        return makeUrl("/tayareen");
    },
    leads() {
        return makeUrl("/leads");
    },

    ///////////////////////////////Admin Panel////////////////////////////////
    blockUser(user_id) {
        return makeUrl(`/block/users/${user_id}`);
    },

    saveUser() {
        return makeUrl("/save/admin");
    },
    updateUser(user_id) {
        return makeUrl(`/update/admin/${user_id}`);
    },
    deleteUser(user_id) {
        return makeUrl(`/delete/admin/${user_id}`);
    },

    zones() {
        return makeUrl("/zones");
    },
    saveZone() {
        return makeUrl("/save/zone");
    },
    updateZone(zone_id) {
        return makeUrl(`/update/zone/${zone_id}`);
    },
    deleteZone(zone_id) {
        return makeUrl(`/delete/zone/${zone_id}`);
    },

    prices() {
        return makeUrl("/zones");
    },
    savePrice() {
        return makeUrl("/save/price");
    },
    updatePrice(price_id) {
        return makeUrl(`/update/price/${price_id}`);
    },
    deletePrice(price_id) {
        return makeUrl(`/delete/price/${price_id}`);
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
    },
};
