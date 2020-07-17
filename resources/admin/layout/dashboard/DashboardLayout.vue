<template>
    <div class="wrapper">
        <side-bar>
            <template slot="links">
                <div v-if="user.role == 'super'">

                    <sidebar-link to="/admins" :name="$t('sidebar.admins')" />
                    <sidebar-link to="/users" :name="$t('sidebar.users')" />
                    <hr />

                    <sidebar-link
                        to="/zones"
                        :name="$t('sidebar.zones')"
                    />
                    <sidebar-link
                        to="/countries"
                        :name="$t('sidebar.countries')"
                    />
                    <sidebar-link
                        to="/cities"
                        :name="$t('sidebar.cities')"
                    />
                    <hr />

                    <sidebar-link to="/notify" :name="$t('sidebar.notify')" />
                    <sidebar-link to="/reports" :name="$t('sidebar.reports')" />
                    <sidebar-link to="/settings" :name="$t('sidebar.settings')" />
                    <sidebar-link to="/advertisments" :name="$t('sidebar.ads')" />
                    <sidebar-link to="/versions" :name="$t('sidebar.apk')" />

                    <hr />

                </div>

                <div v-else>
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

            </template>
        </side-bar>
        <div class="main-panel">
            <top-navbar>test</top-navbar>

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
<style>
hr {
    border-top: 2.2px solid rgb(245, 246, 250) !important;
    margin-top: 1rem !important;
    margin-bottom: 1rem !important;
    font-weight: bold !important;
}
</style>
