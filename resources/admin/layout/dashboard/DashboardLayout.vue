<template>
    <div class="wrapper">
        <side-bar>
            <template slot="links">
                <div v-if="user.role == 'Super'">

                    <sidebar-link to="/dashboard" :name="$t('sidebar.dashboard')" />
                    <sidebar-link to="/admins" :name="$t('sidebar.admins')" />
                    <sidebar-link to="/suppliers" :name="$t('sidebar.supplier')" />
                    <sidebar-link to="/agents" :name="$t('sidebar.agents')" />
                    <sidebar-link to="/tayar" :name="$t('sidebar.tayar')" />
                    <sidebar-link to="/leads" :name="$t('sidebar.leads')" />
                    <hr />

                    <sidebar-link to="/currencies" :name="$t('sidebar.currencies')" />
                    <sidebar-link to="/countries" :name="$t('sidebar.countries')" />
                    <sidebar-link to="/cities" :name="$t('sidebar.cities')" />
                    <sidebar-link to="/zones" :name="$t('sidebar.zones')" />
                    <sidebar-link to="/prices" :name="$t('sidebar.pricing')" />
                    <hr />

                    <sidebar-link to="/material-types" :name="$t('sidebar.materialTypes')" />
                    <sidebar-link to="/statuses" :name="$t('sidebar.deliveryStatuses')" />
                    <hr />
                    <sidebar-link to="/notify" :name="$t('sidebar.notify')" />
                    <sidebar-link to="/reports" :name="$t('sidebar.reports')" />
                    <sidebar-link to="/settings" :name="$t('sidebar.settings')" />
                    <sidebar-link to="/delivery-settings" :name="$t('sidebar.deliverySettings')" />
                    <sidebar-link to="/advertisments" :name="$t('sidebar.ads')" />
                    <sidebar-link to="/versions" :name="$t('sidebar.apk')" />


                </div>

                <div v-else-if="user.role == 'Admin'">
                    <div
                        v-for="(permission, index) in user.permissions"
                        v-bind:key="index"
                    >
                        <div v-if="permission.name == 'View Zones'">
                            <sidebar-link
                                to="/zones"
                                :name="$t('sidebar.zones')"
                            />
                        </div>

                        <div v-if="permission.name == 'View Countries'">
                            <sidebar-link
                                to="/countries"
                                :name="$t('sidebar.countries')"
                            />
                        </div>

                        <div v-if="permission.name == 'View Cities'">
                            <sidebar-link
                                to="/cities"
                                :name="$t('sidebar.cities')"
                            />
                        </div>
                        
                      
                        <div v-if="permission.name == 'Send Notify'">
                            <sidebar-link
                                to="/notify"
                                :name="$t('sidebar.notify')"
                            />
                        </div>
                        <div v-if="permission.name == 'View Reports'">
                            <sidebar-link
                                to="/reports"
                                :name="$t('sidebar.reports')"
                            />
                        </div>
                        <div v-if="permission.name == 'View Settings'">
                            <sidebar-link
                                to="/settings"
                                :name="$t('sidebar.settings')"
                            />
                        </div>
                        
                    </div>
                </div>
                <div v-else-if="user.role == 'Supplier'">
                </div>
                <div v-else-if="user.role == 'Agents'">
                </div>
                <div v-else-if="user.role == 'Tayar'">
                </div>

            </template>
        </side-bar>
        <div :data="mainPanel" class="main-panel">
            <top-navbar>Devtest</top-navbar>

            <dashboard-content
                @click.native="toggleSidebar"
            ></dashboard-content>

            <content-footer></content-footer>
        </div>
    </div>
</template>
<style lang="scss"></style>

<script>
import TopNavbar from "./TopNavbar.vue";
import ContentFooter from "./ContentFooter.vue";
import DashboardContent from "./Content.vue";
import MobileMenu from "./MobileMenu";
export default {
     props: {
      mainPanel: {
        type: String,
        default: "green"
      }
    },
    components: {
        TopNavbar,
        ContentFooter,
        DashboardContent,
        MobileMenu
    },
    methods: {
        toggleSidebar() {
            if (this.$sidebar.showSidebar) {
                this.$sidebar.displaySidebar(false);
            }
        }
    },
    computed: {
        user() {
            return this.$store.getters.user;
        }
    }
};
</script>

