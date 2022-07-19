import Vue from "vue";
import Vuex from "vuex";
import { createStore } from "vuex";
Vue.use(Vuex);
import createPersistedState from "vuex-persistedstate";
import * as Cookies from "js-cookie";

const store = new Vuex.Store({
    state: {
        hideConfigButton: false,
        isPinned: true,
        showConfig: false,
        isTransparent: "",
        isRTL: false,
        mcolor: "",
        isNavFixed: false,
        isAbsolute: false,
        showNavs: true,
        showSidenav: true,
        showNavbar: true,
        showFooter: true,
        showMain: true,
        auth: {
            first_name: "",
            last_name: "",
            email: "",
            avatar: "",
            phone: "",
            allocated_area: "",
            role: "",
        },
        config: {
            company_name: "",
            contact_person: "",
        },
    },
    mutations: {
        toggleConfigurator(state) {
            state.showConfig = !state.showConfig;
        },
        navbarMinimize(state) {
            const sidenav_show = document.querySelector(".g-sidenav-show");
            const sidenav = document.getElementById("sidenav-main");

            if (sidenav_show.classList.contains("g-sidenav-pinned")) {
                sidenav_show.classList.remove("g-sidenav-pinned");
                setTimeout(function () {
                    sidenav.classList.remove("bg-white");
                }, 100);
                sidenav.classList.remove("bg-transparent");
                state.isPinned = true;
            } else {
                sidenav_show.classList.add("g-sidenav-pinned");
                sidenav.classList.add("bg-white");
                sidenav.classList.remove("bg-transparent");
                state.isPinned = false;
            }
        },
        sidebarType(state, payload) {
            state.isTransparent = payload;
        },
        navbarFixed(state) {
            if (state.isNavFixed === false) {
                state.isNavFixed = true;
            } else {
                state.isNavFixed = false;
            }
        },
        setAuthUserDetail(state, auth) {
            for (let key of Object.keys(auth)) {
                state.auth[key] = auth[key];
            }
            if ("avatar" in auth)
                state.auth.avatar =
                    auth.avatar !== null ? auth.avatar : "avatar.png";
        },
        resetAuthUserDetail(state) {
            for (let key of Object.keys(state.auth)) {
                state.auth[key] = "";
            }
        },
        setConfig(state, config) {
            for (let key of Object.keys(config)) {
                state.config[key] = config[key];
            }
        },
    },
    actions: {
        toggleSidebarColor({ commit }, payload) {
            commit("sidebarType", payload);
        },
        setAuthUserDetail({ commit }, auth) {
            commit("setAuthUserDetail", auth);
        },
        resetAuthUserDetail({ commit }) {
            commit("resetAuthUserDetail");
        },
        setConfig({ commit }, data) {
            commit("setConfig", data);
        },
    },
    getters: {
        getAuthUser: (state) => (name) => {
            return state.auth[name];
        },
        getAuthUserFullName: (state) => {
            return state.auth["first_name"] + " " + state.auth["last_name"];
        },
        getAuthUserEmail: (state) => {
            return state.auth["email"];
        },
        getAuthUserPhone: (state) => {
            return state.auth["phone"];
        },
        getAuthUserAllocatedArea: (state) => {
            return state.auth["allocated_area"];
        },
        getConfig: (state) => (name) => {
            return state.config[name];
        },
        user: state => state.auth,
    },
    plugins: [createPersistedState({ storage: window.sessionStorage })],
});

export default store;
