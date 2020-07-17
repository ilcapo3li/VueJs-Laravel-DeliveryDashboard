<template>
  <card>
    <div>
      <b-row :style="{'text-align':isRTL?'right':'left'}">
        <b-col md="6" class="my-1"></b-col>
        <b-col md="4" class="my-1">
          <base-input v-model="filter" type="search" id="filterInput" placeholder="Type to Search"></base-input>
        </b-col>
        <b-col md="2" class="my-1">
          <b-button
            class="btn btn-warning"
            size="sm"
            :disabled="!filter"
            @click="filter = ''"
          >{{$t('clear')}}</b-button>
        </b-col>
      </b-row>
      <b-row>
        <b-col md="12" class="my-1">
          <b-table
            id="reports"
            show-empty
            stacked="md"
            :sort-direction="sortDirection"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            :items="reports"
            :fields="fields"
            :class="isRTL?'text-right':'text-left'"
            :filter="filter"
            head-variant="light"
            :filterIncludedFields="filterOn"
            @filtered="onFiltered"
          >
            <template v-slot:cell(actions)="row">
              <div v-if="user.role =='super'">
                <b-button
                  size="sm"
                  class="mr-1 btn btn-success"
                  @click="showReport(row.item)"
                >{{$t('edit')}}</b-button>
              </div>
              <div v-for="(permission,index) in user.permissions" v-bind:key="index">
                <div v-if="permission.name=='Edit Server Generators'">
                  <b-button
                    size="sm"
                    class="mr-1 btn btn-success"
                    @click="showReport(row.item)"
                  >{{$t('edit')}}</b-button>
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
            aria-controls="reports"
          ></b-pagination>
        </b-col>
      </b-row>
    </div>
  </card>
</template>
<script>
import apiUrls from "../../helpers/apiUrls";
export default {
  name: "Reports",
  mounted() {
    this.getReports();
  },
  methods: {
    getReports() {
      axios
        .get(apiUrls.reports(), { params: { page: this.currentPage } })
        .then(response => {
          this.reports = response.data.data.data;
          this.perPage = response.data.data.per_page;
          this.total = response.data.data.total;
        });
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    showReport(row) {
      localStorage.setItem("reports", JSON.stringify(row));
      this.$router.push({ name: "ShowReport", params: { row } });
    }
  },
  data() {
    return {
      sortDirection: "asc",
      sortBy: null,
      sortDesc: false,
      reports: [],
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
          key: "user.name",
          label: this.$t("user"),
          sortable: true
        },
        {
          key: "message",
          label: this.$t("message"),
          sortable: true
        },
        {
          key: "status",
          label: this.$t("status"),
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
      this.getReports();
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

<style>
.form-control[disabled],
.form-control[readonly],
fieldset[disabled] .form-control {
  color: antiquewhite !important;
}
</style>