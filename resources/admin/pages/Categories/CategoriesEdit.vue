<template>
    <card>
        <form>
            <base-input
                :label="$t('category_name')"
                v-model="categories.category_name"
                :value="categories.category_name"
                :class="isRTL ? 'text-right' : 'text-left'"
                :placeholder="$t('category_name')"
                name="category_name"
                v-validate="'required'"
            ></base-input>
            <div :style="{ 'text-align': isRTL ? 'right' : 'left' }">
                <span v-show="errors.has('category_name')" class="error"
                    >*{{ errors.first("category_name") }}</span
                >
            </div>
            <base-input
                :label="$t('category_en_name')"
                v-model="categories.category_en_name"
                :value="categories.category_en_name"
                :class="isRTL ? 'text-right' : 'text-left'"
                :placeholder="$t('category_en_name')"
                name="category_en_name"
                v-validate="'required'"
            ></base-input>
            <div :style="{ 'text-align': isRTL ? 'right' : 'left' }">
                <span v-show="errors.has('category_en_name')" class="error"
                    >*{{ errors.first("category_en_name") }}</span
                >
            </div>
            <base-input
                :label="$t('category_description')"
                v-model="categories.category_discription"
                :value="categories.category_discription"
                :class="isRTL ? 'text-right' : 'text-left'"
                :placeholder="$t('category_description')"
                name="category_description"
                v-validate="'required'"
            ></base-input>
            <div :style="{ 'text-align': isRTL ? 'right' : 'left' }">
                <span v-show="errors.has('category_description')" class="error"
                    >*{{ errors.first("category_description") }}</span
                >
            </div>
            <base-input
                :label="$t('category_rank')"
                v-model="categories.categories_rank"
                :value="categories.categories_rank"
                :class="isRTL ? 'text-right' : 'text-left'"
                :placeholder="$t('category_rank')"
                name="category_rank"
                v-validate="'required'"
            ></base-input>
            <div :style="{ 'text-align': isRTL ? 'right' : 'left' }">
                <span v-show="errors.has('category_rank')" class="error"
                    >*{{ errors.first("category_rank") }}</span
                >
            </div>
            <div :style="{ 'text-align': isRTL ? 'right' : 'left' }">
                <label>{{ $t("category_status") }}</label>
            </div>
            <b-form-select
                v-model="selectedStatus"
                :class="isRTL ? 'text-right' : 'text-left'"
                :options="status"
            ></b-form-select>

            <div :style="{ 'text-align': isRTL ? 'right' : 'left' }">
                <label>{{ $t("upload_category_logo") }}</label>
            </div>
            <vue-dropzone
                ref="myVueDropzone"
                :destroyDropzone="false"
                v-on:vdropzone-sending="sendingEvent"
                @vdropzone-success="getPhoto"
                @vdropzone-removed-file="DeletePhoto"
                id="dropzone"
                :options="dropzoneOptions"
            ></vue-dropzone>
            <b-button class="btn btn-primary" @click="updateCategories()"
                >Save</b-button
            >
        </form>
    </card>
</template>
<script>
import apiUrls from "../../helpers/apiUrls";
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
    name: "CategoriesEdit",
    components: { vueDropzone: vue2Dropzone },
    mounted() {
        const dict = {
            custom: {
                category_name: {
                    required: this.$t("validation.category_name")
                },
                category_en_name: {
                    required: this.$t("validation.category_en_name")
                },
                category_description: {
                    required: this.$t("validation.category_description")
                },
                category_rank: {
                    required: this.$t("validation.category_rank")
                }
            }
        };
        this.$validator.localize("en", dict);
        if (this.$route.params.category) {
            this.categories = this.$route.params.category;

            if (this.$route.params.category.category_photo) {
                var url =
                    window.location.origin +
                    this.$route.params.category.category_photo;
                var file = {
                    size: 123,
                    name: this.$route.params.category.category_photo,
                    type: "image/png"
                };
                this.$refs.myVueDropzone.manuallyAddFile(file, url);
                this.photo_id = this.$route.params.category.photo_id;
            }
        } else if (localStorage.getItem("categories")) {
            this.categories = JSON.parse(localStorage.getItem("categories"));
            if (JSON.parse(localStorage.getItem("categories")).category_photo) {
                var url =
                    window.location.origin +
                    JSON.parse(localStorage.getItem("categories"))
                        .category_photo;
                var file = {
                    size: 123,
                    name: JSON.parse(localStorage.getItem("categories"))
                        .category_photo,
                    type: "image/png"
                };
                this.$refs.myVueDropzone.manuallyAddFile(file, url);
                this.photo_id = JSON.parse(
                    localStorage.getItem("categories")
                ).photo_id;
            }
        } else {
            this.$router.push("/categories");
        }

        this.selectedStatus = this.categories.status;
    },
    computed: {
        isRTL() {
            return this.$rtl.isRTL;
        }
    },
    data() {
        return {
            categories: {},
            photo_id: null,
            dropzoneOptions: {
                url: window.location.origin + "/api/save/photo",
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                addRemoveLinks: true,
                maxFiles: 1,
                acceptedFiles: "image/jpeg,image/png",
                headers: {
                    Authorization:
                        "Bearer " + localStorage.getItem("access_token")
                }
            },
            status: [
                { value: null, text: "Please select status" },
                { value: "enabled", text: "enabled" },
                { value: "disabled", text: "disabled" }
            ],
            selectedStatus: null
        };
    },
    methods: {
        updateCategories() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    axios
                        .put(
                            apiUrls.updateCategories(
                                this.categories.category_id
                            ),
                            {
                                category_name: this.categories.category_name,
                                category_en_name: this.categories
                                    .category_en_name,
                                category_discription: this.categories
                                    .category_discription,
                                category_status: this.selectedStatus,
                                categories_rank: this.categories
                                    .categories_rank,
                                logo: this.photo_id
                            }
                        )
                        .then(response => {
                            this.$router.push("/categories");
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
        sendingEvent(file, xhr, formData) {
            formData.append("category", "category");
        },
        getPhoto(file, response) {
            this.photo_id = response.id;
        },
        DeletePhoto(file, error, xhr) {
            var logo = this.photo_id;

            axios
                .post(apiUrls.removePhoto(), { photo_id: logo })
                .then(response => {
                    toastr.success(response.data.message);
                });
        }
    }
};
</script>
