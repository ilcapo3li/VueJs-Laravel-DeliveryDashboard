<template>
    <card>
        <form :style="{ 'text-align': isRTL ? 'right' : 'left' }">
            <b-row>
                <b-col md="6" class="my-1">
                    <label>{{ $t("sport") }}</label>
                    <b-form-select
                        @change="getTournaments"
                        v-model="selectedSport"
                        id="sports"
                        :options="sports"
                        v-validate="'required'"
                        name="sport"
                    ></b-form-select>
                    <div>
                        <span v-show="errors.has('sport')" class="error"
                            >*{{ errors.first("sport") }}
                        </span>
                    </div>
                </b-col>

                <b-col md="6" class="my-1">
                    <label>{{ $t("touranment") }}</label>
                    <b-form-select
                        v-model="selectedTournament"
                        v-validate="'required'"
                        name="touranment"
                        :options="tournaments"
                    ></b-form-select>
                    <div>
                        <span v-show="errors.has('touranment')" class="error"
                            >*{{ errors.first("touranment") }}
                        </span>
                    </div>
                </b-col>
            </b-row>
            <br />
            <b-row>
                <b-col md="12" class="my-1">
                    <label>{{ $t("match_info") }}</label>
                    <b-form-textarea
                        :label="$t('match_info')"
                        v-model="touranments_matches.info"
                        :value="touranments_matches.info"
                        :placeholder="$t('info') + ' .  .  .  .  .  .  .  '"
                        rows="5"
                        max-rows="12"
                    ></b-form-textarea>
                </b-col>
            </b-row>

            <br />
            <b-row>
                <b-col md="4" class="my-1">
                    <label>{{ $t("home_team") }}</label>
                    <b-form-select
                        v-model="selectedHomeTeam"
                        :options="teams"
                        v-validate="'required'"
                        name="home_team"
                        id="home_team"
                    ></b-form-select>
                    <div>
                        <span v-show="errors.has('home_team')" class="error"
                            >*{{ errors.first("home_team") }}
                        </span>
                    </div>
                </b-col>
                <b-col md="2" class="my-1" v-show="isNinja">
                    <label>{{ $t("home_team_score") }}</label>
                    <b-input
                        id="homeScore"
                        v-model="touranments_matches.home_team_score"
                        :value="touranments_matches.home_team_score"
                        :placeholder="$t('home_team_score')"
                    >
                    </b-input>
                </b-col>

                <b-col md="4" class="my-1 form-group" v-show="isNinja">
                    <label>{{ $t("away_team") }}</label>
                    <b-form-select
                    id="away_team"

                        v-model="selectedAwayTeam"
                        :options="teams"
                        v-validate=" selectedSport != 4 ? 'required' : '' "
                        name="away_team"
                    ></b-form-select>
                    <div>
                        <span v-show="errors.has('away_team')" class="error"
                            >*{{ errors.first("away_team") }}
                        </span>
                    </div>
                </b-col>
                <b-col md="2" class="my-1" v-show="isNinja">
                    <label>{{ $t("away_team_score") }}</label>
                    <b-input
                        id="awayScore"
                        v-model="touranments_matches.away_team_score"
                        :value="touranments_matches.away_team_score"
                        :placeholder="$t('away_team_score')"
                    >
                    </b-input>
                </b-col>
            </b-row>

            <b-row>
                <b-col md="6" class="my-1 flatpickr">
                    <div class="form-group">
                        <label>{{ $t("match_date") }}</label>
                        <div class="input-group">
                            <flat-pickr
                                v-model="match_date"
                                name="match_date"
                                v-validate="'required'"
                                :value="match_date"
                                :label="$t('match_date')"
                                :config="config1"
                            ></flat-pickr>
                        </div>
                    </div>
                    <div>
                        <span v-show="errors.has('match_date')" class="error"
                            >*{{ errors.first("match_date") }}
                        </span>
                    </div>
                </b-col>
                <b-col md="6" class="my-1">
                    <div class="form-group">
                        <label>{{ $t("match_time") }}</label>
                        <div class="input-group">
                            <flat-pickr
                                v-model="match_time"
                                name="match_time"
                                v-validate="'required'"
                                :value="match_time"
                                :label="$t('match_time')"
                                :config="config2"
                            ></flat-pickr>
                        </div>
                    </div>
                    <div>
                        <span v-show="errors.has('match_time')" class="error"
                            >*{{ errors.first("match_time") }}
                        </span>
                    </div>
                </b-col>

                <!-- <b-col md="2" class="my-1">
                    <label>{{ $t("match_live") }}</label>

                    <base-checkbox class="mb-3" v-model="selected">
                        {{ $t("live") }}
                    </base-checkbox>
                </b-col> -->
            </b-row>

            <br />
            <hr />
            <b-row>
                <b-col md="4" class="my-1">
                    <label>{{ $t("channel") }}</label>
                    <b-form-select
                        v-model="selectedChannel"
                       
                        name="channel"
                        :options="channels"
                    ></b-form-select>
                    <div>
                        <span v-show="errors.has('channel')" class="error"
                            >*{{ errors.first("channel") }}
                        </span>
                    </div>
                </b-col>
                <b-col md="4" class="my-1">
                    <label>{{ $t("commentator") }}</label>
                    <b-form-select
                        v-model="selectedCommentator"
                      
                        name="commentator"
                        :options="commentators"
                    ></b-form-select>

                    <div>
                        <span v-show="errors.has('commentator')" class="error"
                            >*{{ errors.first("commentator") }}
                        </span>
                    </div>
                </b-col>
                 <b-col md="4" class="my-1">
                    <label>{{ $t("match_statue") }}</label>
                    <b-form-select
                        v-model="selectedStatue"
                        :options="status"
                    ></b-form-select>
                </b-col>
            </b-row>
            
            
            <br />
            <b-button
                class="btn btn-primary"
                @click="saveTouranmentMatches()"
                >{{ $t("save") }}</b-button
            >
        </form>
    </card>
</template>
<script>
import apiUrls from "../../helpers/apiUrls";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
export default {
    name: "TouranmentMatchesAdd",
    mounted() {
        
        const dict = {
            custom: {
                home_team: {
                    required: this.$t("validation.home_team")
                },
                away_team: {
                    required: this.$t("validation.away_team")
                },
                touranment: {
                    required: this.$t("validation.touranment")
                },
                sport: {
                    required: this.$t("validation.sport")
                },
                match_time: {
                    required: this.$t("validation.match_time")
                },
                match_date: {
                    required: this.$t("validation.home_team")
                },
                // channel: {
                //     required: this.$t("validation.channel")
                // },
                // commentator: {
                //     required: this.$t("validation.commentator")
                // }
            }
        };
        this.$validator.localize("en", dict);

        axios.get(apiUrls.allCommentators()).then(response => {
            response.data.forEach(commentator => {
                this.commentators.push({
                    value: commentator.id,
                    text: commentator.name
                });
            });
        }),
            axios.get(apiUrls.touranmentType()).then(response => {
                response.data.data.forEach(sport => {
                    this.sports.push({ value: sport.id, text: sport.ar_name });
                });
            }),
            
            axios.get(apiUrls.allChannels()).then(response => {
                response.data.forEach(channel => {
                    this.channels.push({
                        value: channel.id,
                        text: channel.ar_name
                    });
                });
            });
    },
    components: { flatPickr },
    data() {
        return {
            config1: {
                wrap: true, // set wrap to true only when using 'input-group'
                altInput: true,
                dateFormat: "Y-m-d"
            },
            config2: {
                wrap: true, // set wrap to true only when using 'input-group'
                enableTime: true,
                dateFormat: "H:i",
                noCalendar: true,

                altInput: true,
                time_24hr: true
            },
            touranments_matches: {},
            match_date: new Date().toISOString().slice(0,10),
            match_time: new Date().toLocaleTimeString("en-US", { hour12: false }),

            channels: [
                {
                    value: null,
                    text: this.$t("please_select") + " " + this.$t("channel")
                }
            ],
            selectedChannel: null,

            sports: [
                {
                    value: null,
                    type: null,
                    text: this.$t("please_select") + " " + this.$t("sport")
                }
            ],
            selectedSport: null,

            tournaments: [
                {
                    value: null,
                    text: this.$t("please_select") + " " + this.$t("tournament")
                }
            ],
            selectedTournament: null,

            commentators: [
                {
                    value: null,
                    text:
                        this.$t("please_select") + " " + this.$t("commentator")
                }
            ],
            selectedCommentator: null,
            teams: [
                {
                    value: null,
                    text: this.$t("please_select") + " " + this.$t("team")
                }
            ],
            selectedHomeTeam: null,
            selectedAwayTeam: null,

            status: [
                {
                    value: null,
                    text:
                        this.$t("please_select") + " " + this.$t("match_statue")
                },
                { value: "postponed", text: this.$t("postponed") },
                { value: "finished", text: this.$t("finished") },
                { value: "cancelled", text: this.$t("cancelled") }
            ],
            selectedStatue: null,

            selected: {
                unlive: false,
                live: true
            },
            isNinja: true
        };
    },
    methods: {
        saveTouranmentMatches() {
            if (this.selectedHomeTeam == this.selectedAwayTeam) {
                toastr.error("You Can't Choose Same Team");
            }
            else{
            this.$validator.validateAll().then(result => {
                if (result) {
                    axios
                        .post(apiUrls.saveTouranmentMatches(), {
                            hometeam: this.selectedHomeTeam,
                            hometeam_score: this.touranments_matches
                                .home_team_score,
                            awayteam: this.selectedAwayTeam,
                            awayteam_score: this.touranments_matches
                                .away_team_score,
                            info: this.touranments_matches.info,
                            match_time: this.match_time,
                            match_date: this.match_date,
                            // match_live:  ? 1 : 0,
                            match_status: this.selectedStatue,
                            toranment_id: this.selectedTournament,
                            sport_id: this.selectedSport,
                            commentator_id: this.selectedCommentator,
                            country_id: this.selectedCountry,
                            channel_id: this.selectedChannel
                        })
                        .then(response => {
                            this.$router.push("/touranments_matches");
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

        getTournaments() {

            if (this.selectedSport == 4)
            {
              this.isNinja=false;
             
            }else{
              this.isNinja=true;
             
            }
            this.tournaments=[{
                
                    value: null,
                    text: this.$t("please_select") + " " + this.$t("tournament")
                
            }],
            this.teams=  [{
                    value: null,
                    text: this.$t("please_select") + " " + this.$t("team")
                 }],
                 this.selectedTournament = null,
                 this.selectedHomeTeam = null,
                 this.selectedAwayTeam = null,
                axios
                    .post(apiUrls.tournamentsTeams(), {
                        sport: this.selectedSport
                    })
                    .then(response => {
                        response.data.data.tournaments.forEach(touranment => {
                            this.tournaments.push({
                                value: touranment.id,
                                text: touranment.ar_name
                            });
                        }),
                            response.data.data.teams.forEach(team => {
                                this.teams.push({
                                    value: team.id,
                                    text: team.ar_name
                                });
                            });
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
