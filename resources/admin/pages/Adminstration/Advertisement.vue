<template>
    <div class="row">
        <!-- ///////////////////////////////////////////////////////////////////////////// -->
        <div class="col-md-2" :class="{ 'text-right': isRTL }"></div>
        <!-- ///////////////////////////////////////////////////////////////////// -->
        <div class="col-md-8" :class="{ 'text-right': isRTL }">
            <card type="nav-tabs">
                <template slot="header">
                    <h5 class="card-category text-center">
                        {{ $t("notify") }}
                        <i class="tim-icons icon-bell-55 text-info"></i>
                    </h5>
                </template>
                <div class="chart-area">
                    <form :style="{ 'text-align': isRTL ? 'right' : 'left' }">
                        <b-row>
                            <b-col md="12" class="my-1">
                                <label>{{ $t("app") }}</label>
                                <b-form-select
                                    v-model="selectedApp"
                                    :options="apps"
                                    v-validate="'required'"
                                    name="app"
                                    @change="getIDs()"
                                ></b-form-select>
                                <div>
                                    <span
                                        v-show="errors.has('app')"
                                        class="error"
                                        >*{{ errors.first("app") }}</span
                                    >
                                </div>
                            </b-col>
                        </b-row>

                        <b-row>
                            <b-col md="12" class="my-1">
                                <base-input
                                    :label="$t('bannerI')"
                                    v-model="ads.bannerI"
                                    v-validate="'required'"
                                    name="bannerI"
                                    :placeholder="$t('bannerI')"
                                ></base-input>
                                <div>
                                    <span
                                        v-show="errors.has('bannerI')"
                                        class="error"
                                        >*{{ errors.first("bannerI") }}</span
                                    >
                                </div>
                            </b-col>
                        </b-row>

                        <b-row>
                            <b-col md="12" class="my-1">
                                <base-input
                                    :label="$t('bannerII')"
                                    v-model="ads.bannerII"
                                    v-validate="'required'"
                                    name="bannerII"
                                    :placeholder="$t('bannerII')"
                                ></base-input>
                                <div>
                                    <span
                                        v-show="errors.has('bannerII')"
                                        class="error"
                                        >*{{ errors.first("bannerII") }}</span
                                    >
                                </div>
                            </b-col>
                        </b-row>

                        <b-row>
                            <b-col md="12" class="my-1">
                                <base-input
                                    :label="$t('footer')"
                                    v-model="ads.footer"
                                    v-validate="'required'"
                                    name="footer"
                                    :placeholder="$t('footer')"
                                ></base-input>
                                <div>
                                    <span
                                        v-show="errors.has('footer')"
                                        class="error"
                                        >*{{ errors.first("footer") }}</span
                                    >
                                </div>
                            </b-col>
                        </b-row>

                        <b-row>
                            <b-col md="12" class="my-1">
                                <base-input
                                    :label="$t('full_screen')"
                                    v-model="ads.full_screen"
                                    v-validate="'required'"
                                    name="full_screen"
                                    :placeholder="$t('full_screen')"
                                ></base-input>
                                <div>
                                    <span
                                        v-show="errors.has('full_screen')"
                                        class="error"
                                        >*{{
                                            errors.first("full_screen")
                                        }}</span
                                    >
                                </div>
                            </b-col>
                        </b-row>

                        <b-row>
                            <b-col md="12" class="my-1">
                                <base-input
                                    :label="$t('reward')"
                                    v-model="ads.reward"
                                    v-validate="'required'"
                                    name="reward"
                                    :placeholder="$t('reward')"
                                ></base-input>
                                <div>
                                    <span
                                        v-show="errors.has('reward')"
                                        class="error"
                                        >*{{ errors.first("reward") }}</span
                                    >
                                </div>
                            </b-col>
                        </b-row>

                        <br />
                        <br />

                        <div class="text-center">
                            <b-button
                                class="btn btn-info"
                                @click="sendNotify()"
                                >{{ $t("notify") }}</b-button
                            >
                        </div>
                    </form>
                </div>
            </card>
        </div>
        <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    </div>
</template>
<script>
import apiUrls from "../../helpers/apiUrls";
export default {
    name: "Advertisement",
    mounted() {
        this.App();
        const dict = {
            custom: {
                app: {
                    required: this.$t("validation.app")
                },
                ID: {
                    required: this.$t("validation.bannerI")
                },
                banner: {
                    required: this.$t("validation.bannerII")
                },
                footer: {
                    required: this.$t("validation.footer")
                },
                full_screen: {
                    required: this.$t("validation.full_screen")
                },
                reward: {
                    required: this.$t("validation.reward")
                }
            }
        };
        this.$validator.localize("en", dict);
    },
    data() {
        return {
            apps: [
                {
                    value: null,
                    text: this.$t("please_select") + " " + this.$t("app")
                }
            ],
            ads: {},
            selectedApp: null
        };
    },
    methods: {
        App() {
            axios.get(apiUrls.branches()).then(response => {
                response.data.forEach(app => {
                    this.apps.push({
                        value: app.id,
                        text: app.application_name
                    });
                });
            });
        },
        getIDs() {
            this.ads= {},
            axios.get(apiUrls.advertiments(this.selectedApp)).then(response => {
                this.ads = response.data != null ? response.data : {};
                this.advert = response.data.id
            });
        },
        sendNotify() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    axios
                        .put(apiUrls.saveIDS(this.advert), {
                            app: this.selectedApp,
                            bannerI: this.ads.bannerI,
                            bannerII: this.ads.bannerII,
                            footer: this.ads.footer,
                            full_screen: this.ads.full_screen,
                            reward: this.ads.reward
                        })
                        .then(response => {
                            toastr.success(response.data.message);
                        })
                        .catch(error => {
                            $.each(error.response.data.error, function(
                                key,
                                value
                            ) {
                                toastr.error(value);
                            });
                        });
                } else {
                    return;
                }
            });
        }
    },
    computed: {
        isRTL() {
            return this.$rtl.isRTL;
        }
    }
};
</script>
