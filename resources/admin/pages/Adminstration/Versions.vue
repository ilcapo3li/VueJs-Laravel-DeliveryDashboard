<template>
    <div class="row">
        <div class="col-md-3" :class="{ 'text-right': isRTL }"></div>
        <div class="col-md-6" :class="{ 'text-right': isRTL }">
            <card type="nav-tabs">
                <template slot="header">
                    <div>
                        <b-tabs>
                            <b-tab active>
                                <template v-slot:title>
                                    <b-spinner type="grow" small></b-spinner>
                                    <strong>UPload APK ;)</strong>
                                </template>

                                <form
                                    :style="{
                                        'text-align': isRTL ? 'right' : 'left'
                                    }"
                                >
                                    <br />

                                    <b-row>
                                        <b-col md="12" class="my-1">
                                            <label>{{ $t("app") }}</label>
                                            <b-form-select
                                                v-model="selectedApp"
                                                v-validate="'required'"
                                                :options="apps"
                                                name="app"
                                            ></b-form-select>
                                            <div>
                                                <span
                                                    v-show="errors.has('app')"
                                                    class="error"
                                                    >*{{
                                                        errors.first("app")
                                                    }}</span
                                                >
                                            </div>
                                        </b-col>
                                    </b-row>
                                    <br />

                                    <b-row>
                                        <b-col md="12" class="my-1">
                                            <base-input
                                                :label="$t('name')"
                                                v-model="name"
                                                @keydown.space.prevent
                                                name="name"
                                                v-validate="'required'"
                                                :placeholder="$t('name')"
                                            >
                                            </base-input>
                                            <div>
                                                <span
                                                    v-show="errors.has('name')"
                                                    class="error"
                                                    >*{{ errors.first("name") }}
                                                </span>
                                            </div>
                                        </b-col>
                                    </b-row>
                                    <br />

                                    <b-row>
                                        <b-col md="12" class="my-1">
                                            <b-form-textarea
                                                :label="$t('description')"
                                                v-model="description"
                                                v-validate="'required'"
                                                name="description"
                                                :placeholder="$t('description')"
                                                rows="5"
                                            ></b-form-textarea>

                                            <div>
                                                <span
                                                    v-show="
                                                        errors.has(
                                                            'description'
                                                        )
                                                    "
                                                    class="error"
                                                    >*{{
                                                        errors.first(
                                                            "description"
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                        </b-col>
                                    </b-row>
                                    <br />
                                    <b-row>
                                        <b-col md="12" class="my-1">
                                            <label>
                                                {{ $t("apk") }}
                                            </label>

                                            <b-form-file
                                                v-model="apk"
                                                v-validate="'required|ext:apk'"
                                                name="apk"
                                                size="lg"
                                                :state="Boolean(apk)"
                                                accept="application/vnd.android.package-archive"
                                                placeholder="Choose a file or drop it here..."
                                            ></b-form-file>
                                            <div class="mt-3">
                                                <a>Selected file:</a>
                                                {{ apk ? apk.name : "" }}
                                            </div>

                                            <div>
                                                <span
                                                    v-show="errors.has('apk')"
                                                    class="error"
                                                    >*{{
                                                        errors.first("apk")
                                                    }}</span
                                                >
                                            </div>
                                        </b-col>
                                    </b-row>
                                    <br />
                                    <div class="text-center">
                                        <b-button
                                            :disabled="uploaded"
                                            class="btn btn-success"
                                            @click="saveVersion()"
                                            >{{ $t("save") }}</b-button
                                        >
                                    </div>
                                    <br />
                                </form>
                            </b-tab>
                            <b-tab @click="getLinks()">
                                <template v-slot:title>
                                    <b-spinner type="grow" small></b-spinner>
                                    <i> LATEST APK LINKS</i>
                                </template>
                                <div class="row">
                                    <div
                                        class="col-md-1"
                                        :class="{ 'text-right': isRTL }"
                                    ></div>
                                    <div
                                        class="col-md-10"
                                        :class="{ 'text-right': isRTL }"
                                    >
                                        <br />
                                        <b-row>
                                            <b-col md="12" class="my-1">
                                                <base-input
                                                    :label="$t('RED')"
                                                    v-model="settings.red"
                                                    :value="settings.red"
                                                    name="RED"
                                                    :placeholder="$t('RED')"
                                                    disabled
                                                    download
                                                >
                                                </base-input>
                                                <div class="text-center">
                                                    <a
                                                        :href="settings.red"
                                                        download
                                                        ><u
                                                            ><i
                                                                class="tim-icons icon-link-72"
                                                            ></i
                                                            >Download
                                                            {{ $t("RED") }}
                                                            <i
                                                                class="tim-icons icon-minimal-down"
                                                            >
                                                            </i></u
                                                    ></a>
                                                </div>
                                                <br />
                                            </b-col>
                                        </b-row>
                                        <b-row>
                                            <b-col md="12" class="my-1">
                                                <base-input
                                                    :label="$t('GOLD')"
                                                    v-model="settings.gold"
                                                    :value="settings.gold"
                                                    name="GOLD"
                                                    :placeholder="$t('GOLD')"
                                                    disabled
                                                    download
                                                >
                                                </base-input>
                                                <div class="text-center">
                                                    <a
                                                        :href="settings.gold"
                                                        download
                                                        ><u
                                                            ><i
                                                                class="tim-icons icon-link-72"
                                                            ></i
                                                            >Download
                                                            {{ $t("GOLD") }}
                                                            <i
                                                                class="tim-icons icon-minimal-down"
                                                            >
                                                            </i></u
                                                    ></a>
                                                </div>
                                                <br />
                                            </b-col>
                                        </b-row>
                                        <b-row>
                                            <b-col md="12" class="my-1">
                                                <base-input
                                                    :label="$t('GOLD STORE')"
                                                    v-model="settings.store"
                                                    :value="settings.store"
                                                    name="facebook"
                                                    :placeholder="
                                                        $t('GOLD STORE')
                                                    "
                                                    disabled
                                                    download
                                                >
                                                </base-input>
                                                <div class="text-center">
                                                    <a
                                                        :href="settings.store"
                                                        download
                                                        ><u
                                                            ><i
                                                                class="tim-icons icon-link-72"
                                                            ></i>
                                                            {{
                                                                $t("GOLD STORE")
                                                            }}
                                                            <i
                                                                class="tim-icons icon-minimal-down"
                                                            >
                                                            </i></u
                                                    ></a>
                                                </div>
                                                <br />
                                            </b-col>
                                        </b-row>
                                    </div>
                                    <div
                                        class="col-md-1"
                                        :class="{ 'text-right': isRTL }"
                                    ></div>
                                </div>
                            </b-tab>
                        </b-tabs>
                    </div>
                </template>
            </card>
        </div>
        <div class="col-md-3" :class="{ 'text-right': isRTL }"></div>
    </div>
</template>

<script>
import apiUrls from "../../helpers/apiUrls";
import vue2Dropzone from "vue2-dropzone";



export default {
    name: "versions",
    mounted() {
        this.App();
        this.getLinks();
        const dict = {
            custom: {
                app: {
                    required: this.$t("validation.app")
                },
                name: {
                    required: this.$t("validation.name")
                },
                description: {
                    required: this.$t("validation.description")
                },
                apk: {
                    required: this.$t("validation.apk")
                }
            }
        };
        this.$validator.localize("en", dict);
    },
    data() {
        return {
            settings: {},
            uploaded: false,
            msg: "Welcome to Your Vue.js App",

            apps: [
                {
                    value: null,
                    text: this.$t("please_select") + " " + this.$t("app")
                }
            ],
            selectedApp: null,
            name: null,
            description: null,
            apk: null
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
        getLinks() {
            axios.get(apiUrls.getLatest()).then(response => {
                this.settings = response.data.data;
            });
        },
        saveVersion() {
            this.$validator.validateAll().then(result => {
                var loader = this.$loading.show();
                if (result) {
                    var formData = new FormData();
                    formData.append("apk", this.apk);
                    formData.append("description", this.description);
                    formData.append("name", this.name);
                    formData.append("app", this.selectedApp);
                    (this.uploaded = true),
                        axios
                            .post(
                                apiUrls.saveNewApp(this.selectedApp),

                                formData,
                                {
                                    headers: {
                                        "Content-Type": "multipart/form-data"
                                    }
                                }
                            )
                            .then(response => {
                                loader.hide()
                                toastr.success(response.data.message);
                                (this.apk = []),
                                    (this.description = ""),
                                    (this.name = ""),
                                    (this.app = []),
                                    (this.uploaded = false);
                            })
                            .catch(error => {
                                (this.uploaded = false),
                                    $.each(error.response.data.errors, function(
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

