<template>
    <form @submit.prevent="proceed">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <!-- <label for="">Full Name</label> -->
                    <v-text-field
                        v-model="aspirantForm.full_name"
                        label="Full name"
                        outlined
                        dense
                    ></v-text-field>
                    <!-- <input class="form-control" type="text" value="" v-model="aspirantForm.full_name"> -->
                </div>
                <div class="form-group">
                    <!-- <label for="">Political Party</label> -->
                    <v-select
                        v-model="aspirantForm.political_party"
                        :items="political_parties2"
                        label="Political parties"
                        required
                        outlined
                        dense
                    ></v-select>
                    <!-- <select name="political_party" class="form-control" v-model="aspirantForm.political_party"> -->
                    <!-- <option v-for="parties in political_parties" :key="parties" :value="parties">{{ parties }}</option> -->
                    <!-- </select> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <v-select
                        v-model="aspirantForm.electoral_position"
                        :items="electoral_position"
                        label="Electoral position"
                        required
                        outlined
                        dense
                    ></v-select>
                    <!-- <label for="">Electoral Position</label>
                    <select name="electoral_position" class="form-control" v-model="aspirantForm.electoral_position">
                        <option v-for="positions in electoral_position" :key="positions" :value="positions">{{ positions }}</option>
                    </select> -->
                </div>
                <div
                    class="form-group"
                    v-if="aspirantForm.electoral_position === 'County Governor'"
                >
                    <!-- <label for="">Electoral County</label>
                    <select name="electoral_area" class="form-control" v-model="aspirantForm.electoral_area">
                        <option v-for="areas in county" :key="areas['county_name']" :value="areas['county_name']">{{ areas['county_name'] }}</option>
                    </select> -->
                    <v-select
                        v-model="aspirantForm.electoral_area"
                        :items="county"
                        label="Electoral county"
                        required
                        outlined
                        dense
                    ></v-select>
                </div>
                <div
                    class="form-group"
                    v-if="aspirantForm.electoral_position === 'The President'"
                >
                    <v-select
                        v-model="aspirantForm.electoral_area"
                        :items="nation"
                        label="National Government"
                        required
                        outlined
                        dense
                    ></v-select>
                </div>
                <div
                    class="form-group"
                    v-if="aspirantForm.electoral_position === 'Senator'"
                >
                    <v-select
                        v-model="aspirantForm.electoral_area"
                        :items="county"
                        label="Electoral county"
                        required
                        outlined
                        dense
                    ></v-select>
                </div>
                <div
                    class="form-group"
                    v-if="
                        aspirantForm.electoral_position ===
                        'County Woman Member of National Assembly'
                    "
                >
                    <v-select
                        v-model="aspirantForm.electoral_area"
                        :items="county"
                        label="Electoral county"
                        required
                        outlined
                        dense
                    ></v-select>
                </div>
                <div
                    class="form-group"
                    v-if="
                        aspirantForm.electoral_position ===
                        'Member of National Assembly'
                    "
                >
                    <v-select
                        v-model="aspirantForm.electoral_area"
                        :items="constituency"
                        label="Electoral constituency"
                        required
                        outlined
                        dense
                    ></v-select>
                </div>
                <div
                    class="form-group"
                    v-if="
                        aspirantForm.electoral_position ===
                        'Member of County Assembly'
                    "
                >
                    <v-select
                        v-model="aspirantForm.electoral_area"
                        :items="ward"
                        label="Electoral ward"
                        required
                        outlined
                        dense
                    ></v-select>
                </div>
            </div>
            <v-dialog v-model="loading" hide-overlay persistent width="300">
                <v-card style="background-color: #040539" dark>
                    <v-card-text>
                        Please stand by
                        <v-progress-linear
                            indeterminate
                            color="white"
                            class="mb-0"
                        ></v-progress-linear>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </div>
        <hr />
        <button
            type="submit"
            class="btn btn-primary waves-effect waves-light m-t-10"
        >
            <span v-if="id">Update</span>
            <span v-else>Save</span>
        </button>
        <button
            @click="$router.go(-1)"
            class="btn btn-danger waves-effect waves-light m-t-10"
        >
            <span>Cancel</span>
            <!-- <span v-else>Save</span> -->
        </button>
        <!-- <router-link to="/aspirant" class="btn btn-danger waves-effect waves-light m-t-10" v-show="id">Cancel</router-link> -->
    </form>
</template>

<script>
import datepicker from "vuejs-datepicker";
import RangeSlider from "vue-range-slider";
import "vue-range-slider/dist/vue-range-slider.css";
import helper from "../../services/helper";

export default {
    data() {
        return {
            loading: false,
            aspirantForm: new Form({
                full_name: "",
                political_party: "",
                electoral_position: "",
                electoral_area: "",
            }),
            political_parties: [
                "Orange Democratic Movement",
                "Federal Party Of Kenya",
                "Economic Freedom Party",
                "Shirikisho Party Of Kenya",
                "United Democratic Party",
                "Thirdway Alliance Kenya",
                "The National Vision Party",
                "Social Democratic Party Of Kenya",
                "Safina",
                "Progressive Party Of Kenya",
                "Peoples Empowerment Party",
                "Peoples Democratic Party",
                "Party Of National Unity",
                "Party Of Independent Candidates Of Kenya",
                "Party Of Democratic Unity",
                "Party For Development And Reform ",
                "New Democrats",
                "National Rainbow Coalition - Kenya",
                "Nationa Rainbow Coalition",
                "Muungano Party",
                "Mazingira Greens Party Of Kenya",
                "Maendeleo Democratic Party",
                "Maendeleo Chap Chap Party",
                "Kenya Patriots Party",
                "Kenya African National Union",
                "Jubilee",
                "Green Congress Of Kenya",
                "Frontier Alliance Party",
                "Forum For Restoration Of Democracy - Kenya",
                "Farmers Party",
                "Empowerment And Liberation Party",
                "Devolution Party Of Kenya",
                "Democratic Congress",
                "Citizens Convention Party",
                "Chama Mwangaza Daima",
                "Chama Cha Uzalendo",
                "Amani National Congress",
                "Agano Party",
            ],
            political_parties2: [
                'Azimio la Umoja One Kenya Coalition Party',
                'United Democratic Alliance',
                'Independent',
                'Jubilee Party',
                'Federal Party Of Kenya',
                'Amani National Congress',
                'Wiper Democratic Movement of Kenya',
                'Maendeleo Chap Chap Party',
                'Maendeleo Chap Chap Party',
                'Agano Party',
                'Roots Party of Kenya',
                'Grand Dream Development Party',
                'Forum For Restoration Of Democracy-Kenya',
                'Orange Democratic Movement',
                'Kenya Social Congress',
                'National Rainbow Coalition',
                'Usawa Kwa Wote Party',
                'Tujibebe Wakenya Party',
                'Kenya African Democratic Union- Asili',
                'Pamoja African Alliance',
                'Democratic Action Party- Kenya',
                'United Democratic Movement',
                'Vibrant Democratic Party',
                'Kenya African National Union',
                'United Party Of Independent Alliance',
                'United Green Movement',
                'Umoja Summit Party',
                'National Rainbow Coalition-Kenya',
                'The New Democrats',
                'The National Vision Party',
                'Safina',
                'Party Of Democratic Unity',
                'Justice And Freedom Party',
                'United Democratic Party',
                'Communist Party Of Kenya',
                'National Agenda Party Of Kenya',
                'Party Of National Unity',
                'Peoples Empowerment Party',
                'The Service Party',
                'United Progressive Alliance',
                'Democratic Congress',
                'National Ordinary Peoples Empowerment Union',
                'Kenya Reform Party',
                'Devolution Empowerment Party',
                'Chama Cha Kazi',
                'Democratic Party Of Kenya',
                'Maendeleo Democratic Party',
                'Empowerment And Liberation Party',
                'Chama Cha Uzalendo',
                'Peoples Trust Party',
                'Muungano Party',
                'Green Thinking Action Party',
                'Ukweli Party',
                'Mabadiliko Party Of Kenya',
                'Farmers Party',
                'Republican Liberty Party',
                'Alternative Leadership Party Of Kenya',
                'Mazingira Greens Party Of Kenya',
                'Peoples Party Of Kenya',
                'Thirdway Alliance Kenya',
                'Kenya Union Party',
                'The Labour Party Of Kenya',
                'Movement For Democracy And Growth',
                'Entrust Pioneer Party',
                'Chama Cha Mashinani',
                'Ubuntu Peoples Forum',
                'Green Congress Of Kenya',
                'National Reconstruction Alliance',
                'Forum For Republican Democracy',
                'Progressive Party Of Kenya',
                'National Liberal Party',
                'Liberal Democratic Party',
                'Kenya National Congress',
                'Political Party Name',
                'Amani  National Congress',
                'United  DemocraticAlliance',
                'Kenya African Democratic Union-Asili',
                'Party For Peace And Development',
            ],
            electoral_position: [
                "The President",
                "County Governor",
                "Senator",
                "Member of National Assembly",
                "Member of County Assembly",
                "County Woman Member of National Assembly",
            ],
            county: [],
            nation: ["Republic of Kenya"],
            constituency: [],
            ward: [],
        };
    },
    components: { datepicker, RangeSlider },
    props: ["id"],
    mounted() {
        if (this.id) this.getAspirants();
        this.getLocations();
    },
    methods: {
        proceed() {
            if (this.id) this.updateAspirant();
            else this.storeAspirant();
        },
        storeAspirant() {
            this.loading = true;
            this.aspirantForm
                .post("http://172.104.245.14/electionmonitor/api/v1/aspirant")
                .then((response) => {
                    this.loading = false;
                    // toastr['success'](response.message);
                    this.$emit("completed", response.aspirant);
                    this.$router.push("/electionmonitor/aspirant");
                })
                .catch((response) => {
                    this.loading = false;
                    // toastr['error'](response.message);
                });
        },
        getAspirants() {
            this.loading = true;
            axios
                .get(
                    "http://172.104.245.14/electionmonitor/api/v1/aspirant/" +
                        this.id
                )
                .then((response) => {
                    this.loading = false;
                    this.aspirantForm.full_name = response.data.full_name;
                    this.aspirantForm.political_party =
                        response.data.political_party;
                    this.aspirantForm.electoral_position =
                        response.data.electoral_position;
                    this.aspirantForm.electoral_area =
                        response.data.electoral_area;
                })
                .catch((response) => {
                    this.loading = false;
                    // toastr['error'](response.message);
                });
        },
        updateAspirant() {
            this.loading = true;
            this.aspirantForm
                .patch(
                    "http://172.104.245.14/electionmonitor/api/v1/aspirant/" +
                        this.id
                )
                .then((response) => {
                    this.loading = false;
                    if (response.type == "error") {
                        // toastr['error'](response.message);
                    } else {
                        this.$router.push("/electionmonitor/aspirant");
                    }
                })
                .catch((response) => {
                    // toastr['error'](response.message);
                });
        },
        getLocations() {
            this.loading = true;
            axios
                .get("http://172.104.245.14/electionmonitor/api/v1/county")
                .then((response) => {
                    this.loading = false;
                    // console.log(this.county=response.data)
                    for (let i = 0; i < response.data.length; i++) {
                        this.county.push(response.data[i].county_name);
                    }
                })
                .catch((response) => {
                    this.loading = false;
                    // toastr['error'](response.message);
                });

            axios
                .get(
                    "http://172.104.245.14/electionmonitor/api/v1/constituency"
                )
                .then((response) => {
                    this.loading = false;
                    for (let i = 0; i < response.data.length; i++) {
                        this.constituency.push(
                            response.data[i].constituency_name
                        );
                    }
                })
                .catch((response) => {
                    this.loading = false;
                    // toastr['error'](response.message);
                });

            axios
                .get("http://172.104.245.14/electionmonitor/api/v1/ward")
                .then((response) => {
                    this.loading = false;
                    for (let i = 0; i < response.data.length; i++) {
                        this.ward.push(response.data[i].ward_name);
                    }
                })
                .catch((response) => {
                    this.loading = false;
                    // toastr['error'](response.message);
                });
        },
    },
};
</script>
<style>
.slider {
    width: 100%;
}
</style>
