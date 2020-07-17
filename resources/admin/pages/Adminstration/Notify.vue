<template>
  <div class="row">
    <!-- ///////////////////////////////////////////////////////////////////////////// -->
    <div class="col-md-2" :class="{'text-right': isRTL}"></div>
    <!-- ///////////////////////////////////////////////////////////////////// -->
    <div class="col-md-8" :class="{'text-right': isRTL}">
      <card type="nav-tabs">
        <template slot="header">
          <h5 class="card-category text-center">
            {{$t('notify')}}
            <i class="tim-icons icon-bell-55 text-info"></i>
          </h5>
        </template>
        <div class="chart-area">
          <form :style="{'text-align':isRTL?'right':'left'}">
            <b-row>
              <b-col md="12" class="my-1">
                <label>{{$t('app')}}</label>
                <b-form-select
                  v-model="selectedApp"
                  :options="apps"
                  v-validate="'required'"
                  name="app"
                ></b-form-select>
                <div>
                  <span v-show="errors.has('app')" class="error">*{{ errors.first('app') }}</span>
                </div>
              </b-col>
            </b-row>

            <b-row>
              <b-col md="12" class="my-1">
                <base-input
                  :label="$t('title')"
                  v-model="title"
                  v-validate="'required'"
                  name="title"
                  :placeholder="$t('title')"
                ></base-input>
                <div>
                  <span v-show="errors.has('title')" class="error">*{{ errors.first('title') }}</span>
                </div>
              </b-col>
            </b-row>

            <b-row>
              <b-col md="12" class="my-1">
                <b-form-textarea
                  :label="$t('message')"
                  v-model="message"
                  :value="message"
                  name="message"
                  v-validate="'required'"
                  :placeholder="$t('message')"
                  rows="5"
                ></b-form-textarea>

                <div>
                  <span v-show="errors.has('message')" class="error">*{{ errors.first('message') }}</span>
                </div>
              </b-col>
            </b-row>
            <br />
            <br />
            <br />

            <b-row>
              <b-col md="12" class="my-1">
                <label>{{$t('type')}}</label>
                <b-form-select
                  v-model="selectedType"
                  :options="types"
                  v-validate="'required'"
                  v-on:change="detect()"
                  name="type"
                ></b-form-select>
                <div>
                  <span v-show="errors.has('type')" class="error">*{{ errors.first('type') }}</span>
                </div>
              </b-col>
            </b-row>

            <b-row>
              <b-col md="12" class="my-1">
                <base-input
                  :label="$t('url')"
                  v-model="url"
                  v-validate=" selectedType == 'update' ? 'required|url' : ''  "
                  name="url"
                  v-show="updateShow"
                  :placeholder="$t('url')"
                ></base-input>
                <div>
                  <span v-show="errors.has('url')" class="error">*{{ errors.first('url') }}</span>
                </div>
              </b-col>
            </b-row>
            <br />
            <b-row>
              <b-col md="12" class="my-1" v-show="matchShow">
                <label>{{$t('sport')}}</label>
                <b-form-select
                  v-model="selectedSport"
                  :options="sports"
                  v-validate=" selectedType == 'match' ? 'required' : ''  "
                  name="sport"
                ></b-form-select>
                <div>
                  <span v-show="errors.has('sport')" class="error">*{{ errors.first('sport') }}</span>
                </div>
              </b-col>
            </b-row>
            <b-row>
              <b-col md="12" class="my-1">
                <base-input
                  :label="$t('match')"
                  v-model="match"
                  v-show="matchShow"
                  type="number"
                  default="0"
                  v-validate=" selectedType == 'match' ? 'required' : ''  "
                  name="match"
                  :placeholder="$t('match')"
                ></base-input>
                <div>
                  <span v-show="errors.has('match')" class="error">*{{ errors.first('match') }}</span>
                </div>
              </b-col>
            </b-row>

            <div class="text-center">
              <b-button class="btn btn-info" @click="sendNotify()">{{$t('notify')}}</b-button>
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
  name: "Notify",
  mounted() {
    this.App()
    const dict = {
      custom: {
        title: {
          required: this.$t("validation.title")
        },
        app: {
          required: this.$t("validation.app")
        },
        message: {
          required: this.$t("validation.message")
        },
        sport: {
          required: this.$t("validation.sport")
        },
        match: {
          required: this.$t("validation.match")
        },
        url: {
          required: this.$t("validation.url")
        },
        type: {
          required: this.$t("validation.type")
        }
      }
    };
    this.$validator.localize("en", dict);
  },
  data() {
    return {
      sports: [
        {
          value: null,
          text: this.$t("please_select") + " " + this.$t("sport")
        },
        { value: "football", text: "Football" },
        { value: "tennis", text: "Tennis" },
        { value: "basketball", text: "Basketball" },
        { value: "wrestling", text: "WWE" },
        { value: "football_manual", text: "Football Manual" },
      ],
      types: [
        { value: null, text: this.$t("please_select") + " " + this.$t("type") },
        { value: "update", text: "Update" },
        { value: "match", text: "Match" },
        { value: "normal", text: "Normal" }
      ],
      apps: [
        { value: null, text: this.$t("please_select") + " " + this.$t("app") },
        
      ],
      title: null,
      message: null,
      selectedSport: null,
      selectedType: null,
      selectedApp: null,
      match: null,
      updateShow: false,
      matchShow: false,
      url: null
    };
  },
  methods: {
    detect() {
      if (this.selectedType == "match") {
        this.updateShow = false;
        this.matchShow = true;
        this.url = null;
      } else if (this.selectedType == "update") {
        this.updateShow = true;
        this.matchShow = false;
        this.selectedSport = null;
        this.match = null;
      } else {
        this.updateShow = false;
        this.matchShow = false;
        this.selectedSport = null;
        this.url = null;
        this.match = null;
      }
    },
    App() {
     axios.get(apiUrls.branches()).then(response => {
      response.data.forEach(app => {
        this.apps.push({ value: app.id, text: app.application_name });
      });
    });
    },
    sendNotify() {
      this.$validator.validateAll().then(result => {
        if (result) {
          axios
            .post(apiUrls.notify(this.selectedApp), {
              title: this.title,
              message: this.message,
              notify_type: this.selectedType,
              match_type: this.selectedSport,
              match_id: this.match,
              url_update: this.url,
              app: this.selectedApp,
            })
            .then(response => {
              toastr.success(response.data.message);
            })
            .catch(error => {
              $.each(error.response.data.error, function(key, value) {
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