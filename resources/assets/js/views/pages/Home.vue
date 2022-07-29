<template>
    <div>
        <div
            class="container mt-5 mb-3"
            style="padding-top: 115px; color: #fff"
        >
            <div class="row">
                <section class="profile">
                    <header class="header">
                        <div class="details">
                            <h1 class="heading" style="color: #000">
                                {{ userDetails.first_name }}
                                {{ userDetails.last_name }}
                            </h1>
                            <div class="location" style="color: #000">
                                <svg
                                    width="18"
                                    height="18"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12 ,2Z"
                                    ></path>
                                </svg>
                                <p style="text-transform: capitalize">
                                    {{ userDetails.allocated_area }} Polling
                                    Station
                                </p>
                            </div>
                            <div class="location" style="color: #000">
                                <svg
                                    width="18"
                                    height="18"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12 ,2Z"
                                    ></path>
                                </svg>
                                <p style="text-transform: capitalize">
                                    {{ pollingDetails.ward_name }} ward,
                                    {{
                                        pollingDetails.constituency_name
                                    }}
                                    constituency,
                                    {{ pollingDetails.county_name }} county
                                </p>
                            </div>
                        </div>
                    </header>
                </section>
                <hr
                    style="
                        border: 0;
                        height: 1px;
                        background-image: linear-gradient(
                            to right,
                            rgba(0, 0, 0, 0),
                            rgba(0, 0, 0, 0.75),
                            rgba(0, 0, 0, 0)
                        );
                    "
                />
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div
                        class="card p-3 mb-2"
                        style="background-color: #040539"
                    >
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div class="icon"><v-icon>mdi-tie</v-icon></div>
                                <div class="ms-2 c-details">
                                    <h6 class="mb-0" style="color: #fff">
                                        National
                                    </h6>
                                    <span>The president</span>
                                </div>
                            </div>
                            <div class="badge">
                                <v-btn
                                    class="ma-1"
                                    color="#fff"
                                    plain
                                    @click="
                                        enterResult(
                                            'Republic of Kenya',
                                            'national'
                                        )
                                    "
                                >
                                    <v-icon>mdi-counter</v-icon> Enter Results
                                </v-btn>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4 class="heading">Republic of Kenya</h4>
                            <div class="mt-5">
                                <v-progress-linear
                                    height="12"
                                    :value="userDetails.national_prog"
                                    striped
                                    rounded
                                    color="lime"
                                >
                                    <template v-slot:default="{ value }">
                                        <strong style="color: #fff"
                                            >{{ Math.ceil(value) }}%
                                            Complete</strong
                                        >
                                    </template>
                                </v-progress-linear>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="card p-3 mb-2"
                        style="background-color: #040539"
                    >
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div class="icon"><v-icon>mdi-tie</v-icon></div>
                                <div class="ms-2 c-details">
                                    <h6 class="mb-0" style="color: #fff">
                                        County
                                    </h6>
                                    <span
                                        >County Governor, Senator, Women
                                        Rep.</span
                                    >
                                </div>
                            </div>
                            <div class="badge">
                                <v-btn
                                    class="ma-1"
                                    color="#fff"
                                    plain
                                    @click="
                                        enterResult(
                                            pollingDetails.county_name,
                                            'county'
                                        )
                                    "
                                >
                                    <v-icon>mdi-counter</v-icon> Enter Results
                                </v-btn>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4
                                class="heading"
                                style="text-transform: capitalize"
                            >
                                {{ pollingDetails.county_name }} County
                            </h4>
                            <div class="mt-5">
                                <v-progress-linear
                                    height="12"
                                    :value="userDetails.county_prog"
                                    striped
                                    rounded
                                    color="lime"
                                >
                                    <template v-slot:default="{ value }">
                                        <strong style="color: #fff"
                                            >{{ Math.ceil(value) }}%
                                            Complete</strong
                                        >
                                    </template>
                                </v-progress-linear>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="card p-3 mb-2"
                        style="background-color: #040539"
                    >
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div class="icon"><v-icon>mdi-tie</v-icon></div>
                                <div class="ms-2 c-details">
                                    <h6 class="mb-0" style="color: #fff">
                                        Constituency
                                    </h6>
                                    <span>Member of National Assembly</span>
                                </div>
                            </div>
                            <div class="badge">
                                <v-btn
                                    class="ma-1"
                                    color="#fff"
                                    plain
                                    @click="
                                        enterResult(
                                            pollingDetails.constituency_name,
                                            'constituency'
                                        )
                                    "
                                >
                                    <v-icon>mdi-counter</v-icon> Enter Results
                                </v-btn>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4
                                class="heading"
                                style="text-transform: capitalize"
                            >
                                {{
                                    pollingDetails.constituency_name
                                }}
                                Constituency
                            </h4>
                            <div class="mt-5">
                                <v-progress-linear
                                    height="12"
                                    :value="userDetails.const_prog"
                                    striped
                                    rounded
                                    color="lime"
                                >
                                    <template v-slot:default="{ value }">
                                        <strong style="color: #fff"
                                            >{{ Math.ceil(value) }}%
                                            Complete</strong
                                        >
                                    </template>
                                </v-progress-linear>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-none">
                    <div
                        class="card p-3 mb-2"
                        style="background-color: #040539"
                    >
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div class="icon"><v-icon>mdi-tie</v-icon></div>
                                <div class="ms-2 c-details">
                                    <h6 class="mb-0" style="color: #fff">
                                        Ward
                                    </h6>
                                    <span>Member of County Assembly</span>
                                </div>
                            </div>
                            <div class="badge">
                                <v-btn
                                    class="ma-1"
                                    color="#fff"
                                    plain
                                    @click="
                                        enterResult(
                                            pollingDetails.ward_name,
                                            'ward'
                                        )
                                    "
                                >
                                    <v-icon>mdi-counter</v-icon> Enter Results
                                </v-btn>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4
                                class="heading"
                                style="text-transform: capitalize"
                            >
                                {{ pollingDetails.ward_name }} Ward
                            </h4>
                            <div class="mt-5">
                                <!-- <div class="progress-bar" role="progressbar" style="width: var(--width)"  aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div> -->
                                <v-progress-linear
                                    height="12"
                                    :value="userDetails.ward_prog"
                                    striped
                                    rounded
                                    color="lime"
                                >
                                    <template v-slot:default="{ value }">
                                        <strong style="color: #fff"
                                            >{{ Math.ceil(value) }}%
                                            Complete</strong
                                        >
                                    </template>
                                </v-progress-linear>

                                <!-- <div class="mt-3"> <span class="text1">{{ userDetails.ward_prog }} Applied <span class="text2">of 70 capacity</span></span> </div> -->
                            </div>
                        </div>
                    </div>
                </div>
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
</template>

<script>
import VsudSwitch from "../../components/VsudSwitch.vue";
import VsudAvatar from "../../components/VsudAvatar.vue";

import setNavPills from "../../assets/js/nav-pills.js";
import setTooltip from "../../assets/js/tooltip.js";
import helper from "../../services/helper";

export default {
    name: "profile-overview",
    data() {
        return {
            loading: false,
            userDetails: new Form({
                email: "",
                phone: "",
                role: "",
                gender: "",
                allocated_area: "",
                first_name: "",
                last_name: "",
                created_at: "",
            }),
            pollingDetails: new Form({
                county_name: "",
                ward_name: "",
                constituency_name: "",
            }),
            showMenu: false,
            loading: false,
        };
    },
    components: {
        VsudSwitch,
        VsudAvatar,
    },

    mounted() {
        this.getUserDetails();
        this.$store.state.isAbsolute = true;
        this.$store.state.isNavFixed = false;
        setNavPills();
        setTooltip();
    },
    beforeUnmount() {
        this.$store.state.isAbsolute = false;
    },
    computed: {
        progressStyles() {
            return {
                "--width": this.userDetails.county_prog + "px",
            };
        },
    },
    methods: {
        getUserDetails() {
            this.loading = true;
            axios.get('http://172.104.245.14/electionmonitor/api/v1/user/'+this.$route.params.id)
            // axios.get("/api/v1/user/" + this.$route.params.id)
                .then((response) => {
                    this.loading = false;
                    this.userDetails.first_name = response.data.first_name;
                    this.userDetails.last_name = response.data.last_name;
                    this.userDetails.email = response.data.email;
                    this.userDetails.phone = response.data.phone;
                    this.userDetails.gender = response.data.gender;
                    this.userDetails.role = response.data.role;
                    this.userDetails.county_prog = response.data.county_prog;
                    this.userDetails.const_prog = response.data.const_prog;
                    this.userDetails.ward_prog = response.data.ward_prog;
                    this.userDetails.national_prog = response.data.national_prog;
                    this.userDetails.allocated_area = response.data.allocated_area.toLowerCase();
                    this.userDetails.created_at = response.data.created_at;

                    const area = this.userDetails.allocated_area.split(
                        /\s*,\s*/
                    );

                    axios.get('http://172.104.245.14/electionmonitor/api/v1/polling-fetch/'+ decodeURI(area[0]))
                    // axios.get("/api/v1/polling-fetch/" + decodeURI(area[0]))
                        .then((response) => {
                            console.log(response.data.data[0])
                            this.pollingDetails.ward_name = response.data.data[0].ward_name.toLowerCase();
                            this.pollingDetails.county_name = response.data.data[0].county_name.toLowerCase();
                            this.pollingDetails.constituency_name = response.data.data[0].constituency_name.toLowerCase();
                        })
                        .catch((response) => {
                            // console.log(response)
                        });
                })
                .catch((response) => {
                    this.loading = false;
                    // console.log(response)
                });
        },
        enterResult(electoral_area, location) {
            this.loading = true;
            setTimeout(
                () =>
                    this.$router.push(
                        "/electionmonitor/enter-results/" +
                            electoral_area.toLowerCase() +
                            "/" +
                            location
                    ),
                2000
            );
        },
        logout() {
            helper.logout().then(() => {
                this.$store.dispatch("resetAuthUserDetail");
                this.$router.replace("/electionmonitor/login");
            });
        },
    },
};
</script>

<style scoped>
.card {
    border: none;
    border-radius: 10px;
}

.c-details span {
    font-weight: 300;
    font-size: 13px;
}

.icon {
    width: 50px;
    height: 50px;
    background-color: #eee;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 39px;
}

.badge span {
    background-color: #fffbec;
    width: 60px;
    height: 25px;
    padding-bottom: 3px;
    border-radius: 5px;
    display: flex;
    color: #fed85d;
    justify-content: center;
    align-items: center;
}

.progress {
    height: 10px;
    border-radius: 10px;
}

.progress div {
    background-color: red;
}

.text1 {
    font-size: 14px;
    font-weight: 600;
}

.text2 {
    color: #a5aec0;
}
.heading {
    color: #fff;
    font-size: 20px;
}

.header {
    /* min-height: 60vh; */
    /* background: #009FFF; */
    /* background: linear-gradient(to right, #ec2F4B, #009FFF); */
    color: #000;
    clip-path: ellipse(100vw 60vh at 50% 50%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.details {
    text-align: center;
}

.profile-pic {
    height: 6rem;
    width: 6rem;
    object-fit: center;
    border-radius: 50%;
    border: 2px solid #040539;
}

.location p {
    display: inline-block;
}

.location svg {
    vertical-align: middle;
}

.stats {
    display: flex;
}

.stats .col-4 {
    width: 10rem;
    text-align: center;
}

.heading {
    font-weight: 400;
    font-size: 1.3rem;
    margin: 1rem 0;
}
</style>
