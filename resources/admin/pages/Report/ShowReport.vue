<template>
  <div class="row" :class="{'text-right': isRTL}">
    <!-- <card> -->
    <b-col md="7" class="my-1">
      <card>
        <h5 slot="header" class="title">
          {{$t('user_value')}}
          <i class="tim-icons icon-heart-2"></i>
        </h5>
        <hr />
        <div class="row">
          <div class="col-md-6 pr-md-1">
            <label>{{$t('name')}}</label>
            <base-input v-model="reports.name" placeholder="name" disabled></base-input>
          </div>
          <div class="col-md-6 pl-md-1">
            <label>{{$t('type')}}</label>
            <base-input v-model="reports.type" placeholder="type" disabled></base-input>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-md-12">
            <base-input>
              <label>{{$t('message')}}</label>
              <textarea
                rows="4"
                cols="80"
                class="form-control"
                placeholder="Here can be Report Message"
                v-model="reports.message"
                disabled
              ></textarea>
            </base-input>
          </div>
        </div>
        <hr />
        <form>
          <div class="row">
            <div class="col-md-6">
              <base-input>
                <label>{{$t('report')}}</label>
                <textarea
                  rows="2"
                  cols="80"
                  class="form-control"
                  placeholder="Here can be your replay"
                  v-model="replay"
                  name="replay"
                  v-validate="'required'"
                ></textarea>
              </base-input>
              <div>
                <span v-show="errors.has('replay')" class="error">*{{ errors.first('replay') }}</span>
              </div>
            </div>
            <div class="col-md-6">
              <label>{{$t('status')}}</label>
              <b-form-select
                v-model="selectedStatue"
                :options="status"
                v-validate="'required'"
                name="status"
              ></b-form-select>
              <div>
                <span v-show="errors.has('status')" class="error">*{{ errors.first('status') }}</span>
              </div>
            </div>
          </div>
        </form>
        <base-button @click="sendNotify()" slot="footer" type="info" fill>
          {{$t('replay')}}
          <i class="tim-icons icon-heart-2"></i>
        </base-button>
      </card>
    </b-col>
    <b-col md="5" class="my-1">
      <card type="user">
        <p class="card-text"></p>
        <div class="author">
          <div class="block block-one"></div>
          <div class="block block-two"></div>
          <div class="block block-three"></div>
          <div class="block block-four"></div>
          <a href="#">
            <img class="avatar" :src="photo ? photo.path :'/img/anime3.png'" />
            <h5 class="title">{{user ? user.name : "" }}</h5>
          </a>
          <p class="description">{{user ? user.email : ""}}</p>
        </div>
        <div slot="footer" class="button-container">
          <base-button icon round class="btn-facebook">
            <i class="fab fa-facebook"></i>
          </base-button>
          <base-button icon round class="btn-twitter">
            <i class="fab fa-twitter"></i>
          </base-button>
          <base-button icon round class="btn-google">
            <i class="fab fa-google-plus"></i>
          </base-button>
        </div>
      </card>
    </b-col>
  </div>
</template>

<script>
import apiUrls from "../../helpers/apiUrls";
export default {
  name: "ShowReport",
  data() {
    return {
      reports: {},
      user: {},
      photo: {},
      replay: null,
      selectedStatue: null,
      status: [
        {
          value: null,
          text: this.$t("please_select") + " " + this.$t("statue")
        },
        { value: "open", text: "open" },
        { value: "solved", text: "solved" },
        { value: "closed", text: "closed" }
      ]
    };
  },

  mounted() {
    if (this.$route.params.reports) {
      this.reports = this.$route.params.reports;
      this.user = this.reports.user;
      this.photo = this.reports.user.photo;
    } else if (localStorage.getItem("reports")) {
      this.reports = JSON.parse(localStorage.getItem("reports"));
      this.user = this.reports.user;
      this.photo = this.reports.user.photo;
    } else {
      this.$router.push("/reports");
    }
    const dict = {
      custom: {
        statue: {
          required: this.$t("validation.statue")
        },
        replay: {
          required: this.$t("validation.replay")
        }
      }
    };
    this.$validator.localize("en", dict);
  },
  methods: {
    sendNotify() {
      this.$validator.validateAll().then(result => {
        if (result) {
          axios
            .post(apiUrls.notify(), {
              title: "الدعم الفني",
              message: this.replay,
              reporter: this.user_id,
              groupType: "unique"
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