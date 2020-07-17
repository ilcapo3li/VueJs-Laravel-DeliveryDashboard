<template>
    <div>
        <b-row>
            <b-col sm="3">
                <b-form-checkbox size="md" v-model="allPermissions">
                    {{ $t("select_all") }}
                </b-form-checkbox>
            </b-col>
            <b-col sm="9"></b-col>
            <b-col
                v-for="(permission, index) in permissionsList"
                :key="index"
                sm="3"
            >
                <b-form-checkbox
                    size="md"
                    :value="permission.id"
                    v-model="selectedPermissions"
                >
                    {{ isRTL ? permission.ar_name : permission.name }}
                </b-form-checkbox>
            </b-col>
        </b-row>
    </div>
</template>
<script>
import apiUrls from "../../helpers/apiUrls";
export default {
    name: "Permissions",
    props: ["admin"],
    data() {
        return {
            permissionsList: [],
            selectedPermissions: [],
            allPermissions: null
        };
    },
    mounted() {
        axios
            .get(apiUrls.permissions())
            .then(res => {
                this.permissionsList = res.data;
                if (
                    this.permissionsList.length == this.admin.permissions.length
                ) {
                    this.allPermissions = "all";
                }
            })
            .catch(error => {
                toastr.error(error.response.data.error);
                this.$router.go(-1);
            });
        this.selectedPermissions = this.admin.permissions.map(permission => {
            return permission.id;
        });
    },
    watch: {
        selectedPermissions() {
            this.$emit("update-permissions", this.selectedPermissions);
        },
        allPermissions() {
            if (this.allPermissions) {
                this.selectedPermissions = this.permissionsList.map(
                    permission => {
                        return permission.id;
                    }
                );
            } else {
                this.selectedPermissions = [];
            }
        }
    },
    computed: {
        isRTL() {
            return this.$rtl.isRTL;
        }
    }
};
</script>

<style>
.col-form-label {
    color: rgba(255, 255, 255, 0.6) !important;
}
</style>