<template>
    <div>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card bg-gradient-dark border-0 shadow pt-4">
                    <div
                        class="card-header d-sm-flex flex-row align-items-center flex-0"
                        style="color: #fff"
                    >
                        <div class="d-block mb-3 mb-sm-0">
                            <div class="fs-5 fw-normal mb-2">
                                Total votes cast
                            </div>
                            <h2 class="fs-3 fw-extrabold" style="color: #fff">
                                {{ stats.results.toLocaleString() }}
                                <!-- <number
                            class="bold transition"
                            ref="results"
                            to="1000"
                            duration="5"
                            easing="Power4.easeOut"/> -->
                            </h2>
                            <div class="small mt-2" style="color: #fff">
                                <span class="fw-normal me-2">Last Hour</span>
                                <span
                                    class="fas fa-angle-up text-success"
                                ></span>
                                <span class="text-success fw-bold">10.57%</span>
                            </div>
                        </div>
                        <!-- <div class="d-flex ms-auto">
                    <a href="#" class="btn btn-secondary text-dark btn-sm me-2">Month</a>
                    <a href="#" class="btn btn-dark btn-sm me-3">Week</a>
                </div> -->
                    </div>
                    <div class="card-body p-2">
                        <!-- <div class="ct-chart-sales-value ct-double-octave ct-series-g"></div> -->
                        <active-users-chart />
                    </div>
                </div>
            </div>
        </div>

        <div class="py-4 container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6">
                            <div class="card l-bg-cherry">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large">
                                        <i
                                            class="ni ni-circle-08"
                                            style="font-size: 100px"
                                        ></i>
                                    </div>
                                    <div class="mb-4">
                                        <h5
                                            class="card-title mb-0"
                                            style="color: #fff"
                                        >
                                            Users
                                        </h5>
                                    </div>
                                    <div
                                        class="row align-items-center mb-2 d-flex"
                                    >
                                        <div class="col-8">
                                            <h2
                                                class="d-flex align-items-center mb-0"
                                                style="color: #fff"
                                            >
                                                {{
                                                    stats.users.value.toLocaleString()
                                                }}
                                            </h2>
                                        </div>
                                        <!-- <div class="col-4 text-right">
                                    <span><i class="ni ni-circle-08" style="font-size: 35px"></i></span>
                                </div> -->
                                    </div>
                                    <!-- <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card l-bg-blue-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large">
                                        <i
                                            class="ni ni-paper-diploma"
                                            style="font-size: 100px"
                                        ></i>
                                    </div>
                                    <div class="mb-4">
                                        <h5
                                            class="card-title mb-0"
                                            style="color: #fff"
                                        >
                                            Aspirants
                                        </h5>
                                    </div>
                                    <div
                                        class="row align-items-center mb-2 d-flex"
                                    >
                                        <div class="col-8">
                                            <h2
                                                class="d-flex align-items-center mb-0"
                                                style="color: #fff"
                                            >
                                                {{
                                                    stats.aspirants.value.toLocaleString()
                                                }}
                                            </h2>
                                        </div>
                                        <!-- <div class="col-4 text-right">
                                    <span><i class="ni ni-cart" style="font-size: 35px"></i></span>
                                </div> -->
                                    </div>
                                    <!-- <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card l-bg-green-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large">
                                        <i
                                            class="ni ni-square-pin"
                                            style="font-size: 100px"
                                        ></i>
                                    </div>
                                    <div class="mb-4">
                                        <h5
                                            class="card-title mb-0"
                                            style="color: #fff"
                                        >
                                            Pollings
                                        </h5>
                                    </div>
                                    <div
                                        class="row align-items-center mb-2 d-flex"
                                    >
                                        <div class="col-8">
                                            <h2
                                                class="d-flex align-items-center mb-0"
                                                style="color: #fff"
                                            >
                                                {{
                                                    stats.pollings.value.toLocaleString()
                                                }}
                                            </h2>
                                        </div>
                                        <!-- <div class="col-4 text-right">
                                    <span><i class="ni ni-cart" style="font-size: 35px"></i></span>
                                </div> -->
                                    </div>
                                    <!-- <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card l-bg-orange-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large">
                                        <i
                                            class="ni ni-badge"
                                            style="font-size: 100px"
                                        ></i>
                                    </div>
                                    <div class="mb-4">
                                        <h5
                                            class="card-title mb-0"
                                            style="color: #fff"
                                        >
                                            Total votes
                                        </h5>
                                    </div>
                                    <div
                                        class="row align-items-center mb-2 d-flex"
                                    >
                                        <div class="col-8">
                                            <h2
                                                class="d-flex align-items-center mb-0"
                                                style="color: #fff"
                                            >
                                                {{
                                                    stats.results.toLocaleString()
                                                }}
                                            </h2>
                                        </div>
                                        <!-- <div class="col-4 text-right">
                                    <span><i class="ni ni-cart" style="font-size: 35px"></i></span>
                                </div> -->
                                    </div>
                                    <!-- <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// import Card from "../../examples/Cards/Card.vue";
import ActiveUsersChart from "../../examples/Charts/ActiveUsersChart.vue";
import GradientLineChart from "../../examples/Charts/GradientLineChart.vue";
// import OrdersCard from "../components/OrdersCard.vue";
// import ProjectsCard from "../components/ProjectsCard.vue";
// import US from "../../assets/img/icons/flags/US.png";
// import DE from "../../assets/img/icons/flags/DE.png";
// import GB from "../../assets/img/icons/flags/GB.png";
// import BR from "../../assets/img/icons/flags/BR.png";

export default {
    name: "dashboard-default",
    data() {
        return {
            stats: {
                results: "",
                iconBackground: "bg-gradient-success",
                aspirants: {
                    title: "Total Aspirants",
                    value: "",
                    percentage: "+55%",
                    iconClass: "ni ni-money-coins",
                },
                users: {
                    title: "Total Votes Cast",
                    value: "",
                    percentage: "+3%",
                    iconClass: "ni ni-world",
                },
                agents: {
                    title: "Total Agents",
                    value: "",
                    percentage: "-2%",
                    iconClass: "ni ni-paper-diploma",
                    percentageColor: "text-danger",
                },
                pollings: {
                    title: "Total Pollings",
                    value: "",
                    percentage: "+5%",
                    iconClass: "ni ni-cart",
                },
            },
        };
    },
    components: {
        ActiveUsersChart,
        GradientLineChart,
    },

    mounted() {
        axios.get("/electionmonitor/api/v1/user-dashboard").then((response) => {
        // axios.get("../api/v1/user-dashboard").then((response) => {
            this.stats.users.value = response.data.users_count;
            this.stats.aspirants.value = response.data.aspirants_count;
            this.stats.results = response.data.total_results;
            this.stats.pollings.value = response.data.pollings;
        });
    },
};
</script>

<style scoped>
.card {
    background-color: #fff;
    border-radius: 10px;
    border: none;
    position: relative;
    margin-bottom: 30px;
    box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1),
        0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1),
        0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12),
        0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
}
.l-bg-cherry {
    background: linear-gradient(to right, #493240, #f09) !important;
    color: #fff;
}

.l-bg-blue-dark {
    background: linear-gradient(to right, #373b44, #4286f4) !important;
    color: #fff;
}

.l-bg-green-dark {
    background: linear-gradient(to right, #0a504a, #38ef7d) !important;
    color: #fff;
}

.l-bg-orange-dark {
    background: linear-gradient(to right, #a86008, #ffba56) !important;
    color: #fff;
}

.card .card-statistic-3 .card-icon-large .fas,
.card .card-statistic-3 .card-icon-large .far,
.card .card-statistic-3 .card-icon-large .fab,
.card .card-statistic-3 .card-icon-large .fal {
    font-size: 110px;
}

.card .card-statistic-3 .card-icon {
    text-align: center;
    line-height: 50px;
    margin-left: 15px;
    color: #000;
    position: absolute;
    right: -5px;
    top: 20px;
    opacity: 0.1;
}

.l-bg-cyan {
    background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
    color: #fff;
}

.l-bg-green {
    background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
    color: #fff;
}

.l-bg-orange {
    background: linear-gradient(to right, #f9900e, #ffba56) !important;
    color: #fff;
}

.l-bg-cyan {
    background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
    color: #fff;
}
</style>
