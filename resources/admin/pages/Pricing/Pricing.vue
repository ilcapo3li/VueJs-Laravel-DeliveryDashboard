<template>
    <card>
        <div>
            <b-row :style="{ 'text-align': isRTL ? 'right' : 'left' }">
                <b-col md="6" class="my-1">
                    <div v-if="user.role == 'super'">
                        <b-button
                            class="btn btn-primary"
                            size="sm"
                            @click="addTouranmentMatches()"
                            >{{ $t("add") }}</b-button
                        >
                    </div>
                    <div
                        v-for="(permission, index) in user.permissions"
                        v-bind:key="index"
                    >
                        <div
                            v-if="permission.name == 'Add Tournaments Matches'"
                        >
                            <b-button
                                class="btn btn-primary"
                                size="sm"
                                @click="addTouranmentMatches()"
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
            <div v-for="(sports, key) in touranments_matches" v-bind:key="key">
                <div
                    class="card-header typography-line "
                    :style="{ 'text-align': isRTL ? 'right' : 'left' }"
                >
                    <h3><i class="tim-icons icon-atom"> </i> {{ $t(key) }}</h3>
                    <hr />
                </div>
                <b-row>
                    <b-col md="12" class="my-1">
                        <b-table
                            id="touranments_matches"
                            show-empty
                            stacked="md"
                            :class="isRTL ? 'text-right' : 'text-left'"
                            :sort-direction="sortDirection"
                            :sort-by.sync="sortBy"
                            :sort-desc.sync="sortDesc"
                            :items="sports"
                            :fields="fields"
                            head-variant="light"
                            :filter="filter"
                            :filterIncludedFields="filterOn"
                            @filtered="onFiltered"
                        >
                            <template v-slot:photo="data">
                                <div class="img-row">
                                    <b-img-lazy
                                        :src="
                                            data.item.photo
                                                ? data.item.photo
                                                : 'default/default.png'
                                        "
                                        alt="home image"
                                    />
                                </div>
                            </template>

                            <template v-slot:photo="data">
                                <div class="img-row">
                                    <b-img-lazy
                                        :src="
                                            data.item.photo
                                                ? data.item.photo
                                                : 'default/default.png'
                                        "
                                        alt="away image"
                                    />
                                </div>
                            </template>

                            <template v-slot:cell(actions)="row">
                                <div v-if="user.role == 'super'">
                                    <b-button
                                        size="sm"
                                        class="mr-1 btn btn-success"
                                        @click="editTouranmentMatches(row.item)"
                                        >{{ $t("edit") }}</b-button
                                    >
                                    <b-button
                                        size="sm"
                                        class="mr-1 btn btn-danger"
                                        @click="
                                            deleteTouranmentMatches(row.item)
                                        "
                                        >{{ $t("delete") }}</b-button
                                    >
                                </div>
                                <div
                                    v-for="(permission,
                                    index) in user.permissions"
                                    v-bind:key="index"
                                >
                                    <div
                                        v-if="
                                            permission.name ==
                                                'Edit Tournaments Matches'
                                        "
                                    >
                                        <b-button
                                            size="sm"
                                            class="mr-1 btn btn-success"
                                            @click="
                                                editTouranmentMatches(row.item)
                                            "
                                            >{{ $t("edit") }}</b-button
                                        >
                                    </div>
                                    <div
                                        v-if="
                                            permission.name ==
                                                'Remove Tournaments Matches'
                                        "
                                    >
                                        <b-button
                                            size="sm"
                                            class="mr-1 btn btn-danger"
                                            @click="
                                                deleteTouranmentMatches(
                                                    row.item
                                                )
                                            "
                                            >{{ $t("delete") }}</b-button
                                        >
                                    </div>
                                </div>
                            </template>
                        </b-table>
                    </b-col>
                </b-row>
            </div>
            <b-row>
                <b-col md="6" class="my-1">
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="total"
                        :per-page="perPage"
                        aria-controls="touranments_matches"
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
    name: "TouranmentMatches",
    mounted() {
        this.getTouranmentMatches();
    },
    methods: {
        getTouranmentMatches() {
            axios
                .get(apiUrls.touranmentMatches(), {
                    params: { page: this.currentPage, query: this.filter }
                })
                .then(response => {
                    this.touranments_matches = response.data.data;
                    this.perPage = response.data.meta.per_page;
                    this.total = response.data.meta.total;
                });
        },
        editTouranmentMatches(row) {
            localStorage.setItem("touranments_matches", JSON.stringify(row));
            this.$router.push({
                name: "edit-touranments_matches",
                params: { row }
            });
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        },
        deleteTouranmentMatches(row) {
            swal({
                title: this.$t("Are_you_sure"),
                text: this.$t("once_record_deleted_cannot_restord"),
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(willDelete => {
                if (willDelete) {
                    axios
                        .delete(apiUrls.deleteTouranmentMatches(row.id), {
                            params: { touranments_match_id: row.id }
                        })
                        .then(response => {
                            const index = this.touranments_matches.indexOf(row);
                            this.touranments_matches.splice(index, 1);
                            swal(this.$t("record_deleted"), {
                                icon: "success"
                            });
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
                    swal(this.$t("Your_imaginary_record_is_safe!"));
                }
            });
        },

        addTouranmentMatches() {
            this.$router.push({ name: "add-touranments_matches" });
        }
    },
    data() {
        return {
            sortDirection: "asc",
            sortBy: null,
            sortDesc: false,
            touranments_matches: [],
            currentPage: 1,
            perPage: null,
            total: null,

            fields: [
                {
                    key: "id",

                    label: "#",

                    sortable: true
                },
                {
                    key: "home_team",

                    label: this.$t("home_team"),

                    sortable: true
                },
                {
                    key: "away_team",
                    label: this.$t("away_team"),

                    sortable: true
                },
                {
                    key: "date",
                    label: this.$t("date"),

                    sortable: true
                },
                {
                    key: "time",
                    label: this.$t("time"),

                    sortable: true
                },
                {
                    key: "commentator_name",
                    label: this.$t("commentator"),
                    sortable: true
                },
                {
                    key: "channel",

                    label: this.$t("channel"),
                    sortable: true
                },
                {
                    key: "created_by.name",
                    label: this.$t("admin"),
                    sortable: true
                },
                {
                    key: "actions",
                    label: this.$t("actions"),
                    sortable: false
                }
            ],
            totalRows: 1,
            currentPage: 1,
            filterOn: null,
            filter: null
        };
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
    },
    watch: {
        currentPage() {
            this.getTouranmentMatches();
        },
        filter() {
            this.getTouranmentMatches();
        }
    }
};
</script>
<style>
.form-control[disabled],
.form-control[readonly],
fieldset[disabled] .form-control {
    color: antiquewhite !important;
}
</style>
