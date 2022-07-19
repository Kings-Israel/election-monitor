<template>
    <div>
        <!-- Section -->
        <section
            class="vh-lg-100 mt-0 mt-lg-0 bg-soft d-flex align-items-center"
        >
            <div class="container" style="margin-top: -150px">
                <!-- <a href="" class="d-flex align-items-center justify-content-center mb-4">
                    <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                    Back to homepage
                </a> -->

                <div
                    class="row justify-content-center form-bg-image"
                    data-background-lg=""
                >
                    <div
                        class="col-12 d-flex align-items-center justify-content-center"
                    >
                        <div
                            class="bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500"
                        >
                            <div
                                class="text-center text-md-center mb-4 mt-md-0"
                            >
                                <div class="avatar avatar-lg mx-auto mb-3">
                                    <svg
                                        width="84"
                                        height="47"
                                        viewBox="0 0 64 27"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M13.3856 13.2744L13.3856 0H26.7468H26.7712V0.0243294L37.2288 10.4139V0H50.5899H50.6144V0.0243238L63.9755 13.2987H64V26.5974H50.6144V26.5731L40.1569 16.1835V26.5974H26.7712V26.5731L13.4101 13.2987H13.3856L13.3856 13.2744ZM13.3856 13.2987L13.3856 26.5974H0V13.2987L13.3856 13.2987Z"
                                            fill="black"
                                        />
                                    </svg>
                                </div>
                                <h1 class="h3" v-if="!showOTP">Welcome Back</h1>
                                <h1 class="h3" v-else>OTP Verification</h1>
                                <p class="text-gray" v-if="!showOTP">
                                    Sign in using your phone number
                                </p>
                                <p class="text-gray" v-else>
                                    Enter OTP code sent to
                                    <strong>{{ otpForm.phone }} </strong>
                                </p>
                            </div>
                            <form
                                class="mt-0"
                                role="form"
                                @submit.prevent="submit"
                                v-if="!showOTP"
                            >
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <!-- <label for="phone">Your Number</label> -->
                                    <div class="input-group">
                                        <vue-tel-input
                                            v-model="otpForm.phone"
                                            class="form-control"
                                            defaultCountry="KE"
                                            invalidMsg="Invalid phone number!"
                                            autofocus
                                            mode="international"
                                        ></vue-tel-input>
                                        <!-- <input
                                            v-model="otpForm.phone"

                                            type="number"
                                            placeholder="Phone number"
                                            class="form-control"
                                            id="phone" required> -->
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="d-grid mt-3">
                                    <button
                                        type="submit"
                                        class="btn btn-gray-800"
                                    >
                                        Get OTP
                                    </button>
                                </div>
                            </form>
                            <div class="card-body" v-else>
                                <!-- <p>Enter OTP code sent to <strong>{{ otpForm.phone }} </strong></p> -->
                                <v-otp-input
                                    v-model="otpForm.otp"
                                    :disabled="loadingOverlay"
                                    :length="4"
                                    @finish="verifyOtp"
                                ></v-otp-input>
                                <v-overlay absolute :value="loadingOverlay">
                                    <!-- <v-progress-circular
                                    indeterminate
                                    color="secondary"
                                    ></v-progress-circular>
                                     -->
                                    <div class="lds-ripple">
                                        <div></div>
                                        <div></div>
                                    </div>
                                </v-overlay>
                                <br />
                                <p class="text-center">
                                    Din't receive code yet?

                                    <br />
                                    <button
                                        type="submit"
                                        class="btn btn-gray-800"
                                        @click="resendOTP(otpForm.phone)"
                                    >
                                        Request again
                                    </button>
                                </p>
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
        </section>
        <notifications></notifications>
    </div>
</template>

<script>
import VsudInput from "../../components/VsudInput.vue";
import VsudSwitch from "../../components/VsudSwitch.vue";
import VsudButton from "../../components/VsudButton.vue";

const body = document.getElementsByTagName("body")[0];

export default {
    name: "signin",
    components: {
        VsudInput,
        VsudSwitch,
        VsudButton,
    },
    data() {
        return {
            otpForm: new Form({
                otp: "",
                phone: "",
            }),
            bindProps: {
                mode: "international",
                defaultCountry: "KE",
                disabledFetchingCountry: true,
                disabled: false,
                disabledFormatting: false,
                placeholder: "Enter a phone number",
                required: true,
                enabledCountryCode: true,
                enabledFlags: true,
                preferredCountries: ["KE"],
                onlyCountries: [],
                ignoredCountries: [],
                autocomplete: "on",
                name: "telephone",
                maxLen: 25,
                wrapperClasses: "",
                inputClasses: "",
                dropdownOptions: {
                    disabledDialCode: false,
                },
                inputOptions: {
                    showDialCode: true,
                },
            },
            alert: false,
            alertMessage: "",
            showOTP: false,
            loading: false,
            loadingOverlay: false,
            signinForm: new Form({
                email: "",
                password: "password",
            }),
            verify_phone: "",
        };
    },
    beforeMount() {
        this.$store.state.hideConfigButton = true;
        this.$store.state.showNavbar = false;
        this.$store.state.showSidenav = false;
        this.$store.state.showFooter = false;
        body.classList.remove("bg-gray-100");
    },
    beforeUnmount() {
        this.$store.state.hideConfigButton = false;
        this.$store.state.showNavbar = true;
        this.$store.state.showSidenav = true;
        this.$store.state.showFooter = true;
        body.classList.add("bg-gray-100");
    },
    methods: {
        submit(e) {
            this.loading = true;
            this.otpForm
                // .post("/electionmonitor/api/v1/auth/check/if/user/exists")
                .post("../api/v1/auth/check/if/user/exists")
                .then((response) => {
                    this.alert = true;
                    // console.log(this.alertMessage = response.message)
                    this.signinForm.email = response.data[0].email;
                    // this.otpForm.phone = response.data.phone
                    this.verify_phone = this.otpForm.phone =
                        response.data[0].phone;

                    // this.signinForm.phone = response.data[0].phone
                    setTimeout(() => {
                        this.loading = false;
                        this.alert = false;
                        this.showOTP = true;
                        console.log(response.otp);
                    }, 3500);
                })
                .catch((error) => {
                    setTimeout(() => {
                        this.loading = false;
                        notify({
                            text: "User does not exist!",
                            theme: "red",
                            position: "top-right",
                        });
                        // console.log(this.alertMessage = error)
                    }, 1500);
                });
        },
        verifyOtp() {
            this.loadingOverlay = true;
            // this.otpForm.phone = this.signinForm.phone
            this.otpForm.phone = this.verify_phone;
            this.otpForm
                // .post("/electionmonitor/api/v1/auth/two-factor-auth")
                .post("../api/v1/auth/two-factor-auth")
                .then((response) => {
                    // console.log(response)
                    if (response.message === "Success") {
                        setTimeout(() => {
                            this.signin();
                            this.loadingOverlay = false;
                        }, 3500);
                    } else {
                        setTimeout(() => {
                            notify({
                                text: "Error encountered!",
                                theme: "red",
                                position: "top-right",
                            });
                            this.loadingOverlay = false;
                            this.otpForm.otp = "";
                            this.otpForm.phone = this.verify_phone;
                        }, 1500);
                    }
                })
                .catch((response) => {
                    setTimeout(() => {
                        notify({
                            text: "Error encountered!",
                            theme: "red",
                            position: "top-right",
                        });
                        this.loadingOverlay = false;
                        this.otpForm.otp = "";
                        this.otpForm.phone = this.verify_phone;
                    }, 1500);

                    // console.log(response)
                });
        },
        resendOTP(number) {
            this.loadingOverlay = true;
            axios
                .post("../api/v1/auth/two-factor-auth/resend/" + number)
                .then((response) => {
                    setTimeout(() => {
                        // this.signin()
                        // console.log(response.data.message)
                        notify({
                            text: response.data.message,
                            theme: "green",
                            position: "top-right",
                        });
                        this.loadingOverlay = false;
                    }, 3500);
                })
                .catch((response) => {
                    this.loadingOverlay = false;
                    notify({
                        text: "Error encountered!",
                        theme: "red",
                        position: "top-right",
                    });
                    // console.log(response)
                });
        },
        signin() {
            this.signinForm
                // .post("/electionmonitor/api/v1/auth/login")
                .post("../api/v1/auth/login")
                .then((response) => {
                    // console.log(response.data[0].role)
                    this.loading = true;
                    if (
                        response.message === "Success" &&
                        response.data[0].role === "Admin"
                    ) {
                        setTimeout(() => {
                            localStorage.setItem("auth_token", response.token);
                            axios.defaults.headers.common["Authorization"] =
                                "Bearer " + localStorage.getItem("auth_token");

                            this.$store.dispatch('setAuthUserDetail', response.data[0]);

                            this.$router.push("/electionmonitor/dashboard");
                            this.showOTP = false;
                            this.loading = false;
                        }, 3500);
                    } else if (
                        response.message === "Success" &&
                        response.data[0].role === "Agent"
                    ) {
                        setTimeout(() => {
                            localStorage.setItem("auth_token", response.token);
                            axios.defaults.headers.common["Authorization"] =
                                "Bearer " + localStorage.getItem("auth_token");

                            this.$store.dispatch('setAuthUserDetail', response.data[0]);

                            this.$router.push(
                                "/electionmonitor/home/" +
                                    response.data[0].id +
                                    "/agent"
                            );
                            this.showOTP = false;
                            this.loading = false;
                        }, 3500);
                    }
                })
                .catch((response) => {
                    setTimeout(() => {
                        this.loadingOverlay = false;
                        this.showOTP = false;
                    }, 3500);
                    // console.log(response)
                });
        },
    },
};
</script>

<style scoped>
body {
    background-color: #040539;
}

/*
  Enter and leave animations can use different
  durations and timing functions.
*/
.slide-fade-enter-active {
    transition: all 0.8s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
.lds-ripple {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}
.lds-ripple div {
    position: absolute;
    border: 4px solid #fff;
    opacity: 1;
    border-radius: 50%;
    animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
    animation-delay: -0.5s;
}
@keyframes lds-ripple {
    0% {
        top: 36px;
        left: 36px;
        width: 0;
        height: 0;
        opacity: 1;
    }
    100% {
        top: 0px;
        left: 0px;
        width: 72px;
        height: 72px;
        opacity: 0;
    }
}
</style>
