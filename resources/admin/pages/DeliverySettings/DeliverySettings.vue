<template>
    <card>
        <form :style="{ 'text-align': isRTL ? 'right' : 'left' }">
            <b-row>
                <b-col md="6" class="my-1">
                    <base-input
                        :label="$t('gmail')"
                        v-model="settings.gmail"
                        :value="settings.gmail"
                        v-validate="'required|email'"
                        name="gmail"
                        :placeholder="$t('gmail')"
                    >
                    </base-input>
                    <div>
                        <span v-show="errors.has('gmail')" class="error"
                            >*{{ errors.first("gmail") }}
                        </span>
                    </div>
                </b-col>
                <b-col md="6" class="my-1">
                    <base-input
                        :label="$t('facebook')"
                        v-model="settings.facebook"
                        :value="settings.facebook"
                        v-validate="'required|url'"
                        name="facebook"
                        :placeholder="$t('facebook')"
                    >
                    </base-input>
                    <div>
                        <span v-show="errors.has('facebook')" class="error"
                            >*{{ errors.first("facebook") }}
                        </span>
                    </div>
                </b-col>
            </b-row>
            <b-row>
                <b-col md="6" class="my-1">
                    <base-input
                        :label="$t('whats_up')"
                        v-model="settings.whats_up"
                        :value="settings.whats_up"
                        v-validate="'required'"
                        name="whats_up"
                        :placeholder="$t('whats_up')"
                    >
                    </base-input>
                    <div>
                        <span v-show="errors.has('whats_up')" class="error"
                            >*{{ errors.first("whats_up") }}
                        </span>
                    </div>
                </b-col>
                <b-col md="6" class="my-1">
                    <base-input
                        :label="$t('web_page')"
                        v-model="settings.web_page"
                        :value="settings.web_page"
                        v-validate="'required|url'"
                        name="web_page"
                        :placeholder="$t('web_page')"
                    >
                    </base-input>
                    <div>
                        <span v-show="errors.has('web_page')" class="error"
                            >*{{ errors.first("web_page") }}
                        </span>
                    </div>
                </b-col>
            </b-row>

            <b-row>
                <b-col md="6" class="my-1">
                    <base-input
                        :label="$t('fb_group')"
                        v-model="settings.fb_group"
                        :value="settings.fb_group"
                        v-validate="'required|url'"
                        name="fb_group"
                        :placeholder="$t('fb_group')"
                    >
                    </base-input>
                    <div>
                        <span v-show="errors.has('fb_group')" class="error"
                            >*{{ errors.first("fb_group") }}
                        </span>
                    </div>
                </b-col>

                <b-col md="6" class="my-1">
                    <base-input
                        :label="$t('youtube_channel')"
                        v-model="settings.youtube_channel"
                        :value="settings.youtube_channel"
                        v-validate="'required|url'"
                        name="youtube_channel"
                        :placeholder="$t('youtube_channel')"
                    >
                    </base-input>
                    <div>
                        <span
                            v-show="errors.has('youtube_channel')"
                            class="error"
                            >*{{ errors.first("youtube_channel") }}
                        </span>
                    </div>
                </b-col>
            </b-row>

            <b-row>
                <b-col md="6" class="my-1">
                    <base-input
                        :label="$t('twitter')"
                        v-model="settings.twitter"
                        :value="settings.twitter"
                        v-validate="'required|url'"
                        name="twitter"
                        :placeholder="$t('twitter')"
                    >
                    </base-input>
                    <div>
                        <span v-show="errors.has('twitter')" class="error"
                            >*{{ errors.first("twitter") }}
                        </span>
                    </div>
                </b-col>
                <b-col md="6" class="my-1">
                    <base-input
                        :label="$t('instagram')"
                        v-model="settings.instagram"
                        :value="settings.instagram"
                        v-validate="'required|url'"
                        name="instagram"
                        :placeholder="$t('instagram')"
                    >
                    </base-input>
                    <div>
                        <span v-show="errors.has('instagram')" class="error"
                            >*{{ errors.first("instagram") }}
                        </span>
                    </div>
                </b-col>
            </b-row>

            <b-button class="btn btn-primary" @click="saveSettings()">{{
                $t("save")
            }}</b-button>
        </form>
    </card>
</template>
<script>
import apiUrls from "../../helpers/apiUrls";

export default {
    name: "Settings",
    mounted() {
        this.getSettings();
        const dict = {
            custom: {
                gmail: {
                    required: this.$t("validation.gmail")
                },
                facebook: {
                    required: this.$t("validation.facebook")
                },
                whats_up: {
                    required: this.$t("validation.whats_up")
                },
                web_page: {
                    required: this.$t("validation.web_page")
                },
                fb_group: {
                    required: this.$t("validation.fb_group")
                },
                youtube_channel: {
                    required: this.$t("validation.youtube_channel")
                },
                twitter: {
                    required: this.$t("validation.twitter")
                },
                instagram: {
                    required: this.$t("validation.instagram")
                }
            }
        };
        this.$validator.localize("en", dict);
    },
    data() {
        return {
            settings: {}
        };
    },
    methods: {
        saveSettings() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    axios
                        .put(apiUrls.saveSettings(), {
                            gmail: this.settings.gmail,
                            facebook: this.settings.facebook,
                            whats_up: this.settings.whats_up,
                            web_page: this.settings.web_page,
                            fb_group: this.settings.fb_group,
                            youtube_channel: this.settings.youtube_channel,
                            twitter: this.settings.twitter,
                            instagram: this.settings.instagram
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
        },
        getSettings() {
            axios
                .get(apiUrls.allSettings(), {
                    params: { page: this.currentPage }
                })
                .then(response => {
                    console.log(response.data.data);
                    this.settings = response.data.data != null ? response.data.data :{};
                });
        }
    },
    computed: {
        isRTL() {
            return this.$rtl.isRTL;
        }
    },
    watch: {
        currentPage() {
            this.getSettings();
        }
    }
};
</script>
