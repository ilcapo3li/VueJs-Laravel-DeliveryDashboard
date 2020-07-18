<template>
    <card>
        <div>
            <b-row :style="{ 'text-align': isRTL ? 'right' : 'left' }">
                <b-col md="6" class="my-1">
                    <div v-if="user.role == 'super'">
                        <b-button
                            class="btn btn-primary"
                            size="sm"
                            @click="addCategoris()"
                            >{{ $t("add") }}</b-button
                        >
                    </div>
                    <div
                        v-for="(permission, index) in user.permissions"
                        v-bind:key="index"
                    >
                        <div v-if="permission.name == 'Add Categories'">
                            <b-button
                                class="btn btn-primary"
                                size="sm"
                                @click="addCategoris()"
                                >{{ $t("add") }}</b-button
                            >
                        </div>
                    </div>
                </b-col>
                <b-col md="4" class="my-1">
                    <base-input
                        v-model="filter"
                        type="search"
                        id="filterInput"
                        placeholder="Type to Search"
                    >
                    </base-input>
                </b-col>
                <b-col md="2" class="my-1">
                    <b-button
                        class="btn btn-warning"
                        size="sm"
                        :disabled="!filter"
                        @click="filter = ''"
                        >{{ $t("clear") }}</b-button
                    >
                </b-col>
            </b-row>
            <b-row>
                <b-col md="12" class="my-1">
                    <b-table
                        id="categories"
                        show-empty
                        stacked="md"
                        :class="isRTL ? 'text-right' : 'text-left'"
                        :sort-direction="sortDirection"
                        head-variant="light"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :items="categories"
                        :fields="fields"
                        :filter="filter"
                        :filterIncludedFields="filterOn"
                        @filtered="onFiltered"
                    >
                        <template v-slot:cell(photo)="data">
                            <div class="img-row">
                                <b-img-lazy
                                    :src="
                                        data.item.category_photo
                                            ? data.item.category_photo
                                            : '/default/default.png'
                                    "
                                    alt="Source image"
                                />
                            </div>
                        </template>

                        <template v-slot:cell(actions)="row">
                            <div v-if="user.role == 'super'">
                                <b-button
                                    size="sm"
                                    class="mr-1 btn btn-success"
                                    @click="editCategories(row.item)"
                                    >{{ $t("edit") }}</b-button
                                >
                                <b-button
                                    size="sm"
                                    class="mr-1 btn btn-danger"
                                    @click="deleteCategories(row.item)"
                                    >{{ $t("delete") }}</b-button
                                >
                            </div>
                            <div
                                v-for="(permission, index) in user.permissions"
                                v-bind:key="index"
                            >
                                <div
                                    v-if="permission.name == 'Edit Categories'"
                                >
                                    <b-button
                                        size="sm"
                                        class="mr-1 btn btn-success"
                                        @click="editCategories(row.item)"
                                        >{{ $t("edit") }}</b-button
                                    >
                                </div>
                            </div>
                            <div
                                v-for="(permission, index) in user.permissions"
                                v-bind:key="index"
                            >
                                <div
                                    v-if="
                                        permission.name == 'Remove Categories'
                                    "
                                >
                                    <b-button
                                        size="sm"
                                        class="mr-1 btn btn-danger"
                                        @click="deleteCategories(row.item)"
                                        >{{ $t("delete") }}</b-button
                                    >
                                </div>
                            </div>
                        </template>
                    </b-table>
                </b-col>
            </b-row>
            <b-row>
                <b-col md="6" class="my-1">
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="total"
                        :per-page="perPage"
                        aria-controls="categories"
                    >
                    </b-pagination>
                </b-col>
            </b-row>
        </div>
    </card>
</template>
<script>
import apiUrls from "../../helpers/apiUrls";

export default {
    name: "categories",
    mounted() {
        this.getCategores();
    },
    methods: {
        getCategores() {
            axios
                .get(apiUrls.categories(), {
                    params: { page: this.currentPage }
                })
                .then(response => {
                    this.categories = response.data.data;
                    this.perPage = response.data.meta.per_page;
                    this.total = response.data.meta.total;
                });
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        },
        editCategories(category) {
            localStorage.setItem("categories", JSON.stringify(category));
            this.$router.push({
                name: "edit-categories",
                params: { category }
            });
        },
        deleteCategories(row) {
            swal({
                title: this.$t("Are_you_sure"),
                text: this.$t("once_record_deleted_cannot_restord"),
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(willDelete => {
                if (willDelete) {
                    axios
                        .delete(apiUrls.deleteCategories(), {
                            params: { category_id: row.category_id }
                        })
                        .then(response => {
                            const index = this.categories.indexOf(row);
                            this.categories.splice(index, 1);
                            swal(this.$t("record_deleted"), {
                                icon: "success"
                            });
                        })
                        .catch(error => {
                            toastr.error(error.response.data.error);
                        });
                } else {
                    swal(this.$t("record_not_deleted"));
                }
            });
        },
        addCategoris() {
            this.$router.push({ name: "add-categories" });
        }
    },
    data() {
        return {
            sortDirection: "asc",
            sortBy: null,
            sortDesc: false,
            categories: [],
            currentPage: 1,
            perPage: null,
            total: null,
            fields: [
                {
                    label: "#",
                    key: "category_id",
                    sortable: true
                },
                {
                    label: this.$t("category_name"),
                    key: "category_name",
                    sortable: true
                },
                {
                    label: this.$t("category_en_name"),
                    key: "category_en_name",
                    sortable: true
                },
                {
                    label: this.$t("image"),
                    key: "photo",
                    sortable: true
                },
                {
                    label: this.$t("actions"),
                    key: "actions",
                    sortable: false
                }
            ],
            totalRows: 1,
            currentPage: 1,
            filterOn: null,
            filter: null
        };
    },
    watch: {
        currentPage() {
            this.getCategores();
        }
    },
    computed: {
        user() {
            return this.$store.getters.user;
        },
        sortOptions() {
            // Create an options list from our fields
            return this.fields
                .filter(f => f.sortable)
                .map(f => {
                    return { text: f.label, value: f.key };
                });
        },
        isRTL() {
            return this.$rtl.isRTL;
        }
    }
};
</script>
