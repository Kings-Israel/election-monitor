<template>
    <div id="main-wrapper"  >


        <v-app>
          <v-navigation-drawer width="300px" color="#040539" app  v-if="$route.name !== 'agentHome'">
            <!-- <nav  style="width: 350px" class="sidebar d-lg-block text-white collapse" data-simplebar v-if="$route.name !== 'agentHome'"> -->
            <div class="sidebar-inner px-4 pt-3" style="width: 100%; color: #fff">
              <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item"  style="">
                  <!-- < href="/dashboard" class="nav-link d-flex align-items-center"> -->
                    <!-- <span class="sidebar-icon">
                      <svg width="54" height="17" viewBox="0 0 64 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3856 13.2744L13.3856 0H26.7468H26.7712V0.0243294L37.2288 10.4139V0H50.5899H50.6144V0.0243238L63.9755 13.2987H64V26.5974H50.6144V26.5731L40.1569 16.1835V26.5974H26.7712V26.5731L13.4101 13.2987H13.3856L13.3856 13.2744ZM13.3856 13.2987L13.3856 26.5974H0V13.2987L13.3856 13.2987Z" fill="white"/>
                      </svg>
                    </span> -->
                    <span class="mt-1 ms-1 ">Election Monitor </span>

                  <!-- </> -->
                </li>
                <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
                <li class="nav-item">
                  <router-link to="/electionmonitor/dashboard" class="nav-link">
                    <!-- <span class="sidebar-icon">
                      <svg class="icon icon-xs me-2"  style="color: #fff" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    </span>  -->
                    <span class="sidebar-text">Dashboard</span>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/electionmonitor/user" class="nav-link d-flex justify-content-between">
                    <span>
                      <!-- <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2"  style="color: #fff" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                      </span> -->
                      <span class="sidebar-text">Users</span>
                    </span>
                  </router-link>
                </li>
                <li class="nav-item" >
                  <router-link to="/electionmonitor/aspirant" class="nav-link">
                    <!-- <span class="sidebar-icon">
                      <svg class="icon icon-xs me-2"  style="color: #fff" fill="#fff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                    </span> -->
                    <span class="sidebar-text">Aspirants</span>
                  </router-link>
                </li>
                <li class="nav-item ">
                  <router-link to="/electionmonitor/county" class="nav-link">
                    <!-- <span class="sidebar-icon">
                      <svg class="icon icon-xs me-2"  style="color: #fff" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                    </span> -->
                    <span class="sidebar-text">Counties</span>
                  </router-link>
                </li>
                <li class="nav-item ">
                  <router-link to="/electionmonitor/constituency" class="nav-link">
                    <!-- <span class="sidebar-icon">
                      <svg class="icon icon-xs me-2"  style="color: #fff" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                    </span> -->
                    <span class="sidebar-text">Constituencies</span>
                  </router-link>
                </li>
                <li class="nav-item ">
                  <router-link to="/electionmonitor/ward" class="nav-link">
                    <!-- <span class="sidebar-icon">
                      <svg class="icon icon-xs me-2"  style="color: #fff" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                    </span> -->
                    <span class="sidebar-text">Wards</span>
                  </router-link>
                </li>
                <li class="nav-item ">
                  <router-link to="/electionmonitor/announcements" class="nav-link">
                    <span class="sidebar-icon">
                      <!-- <v-icon>mdi-logout</v-icon> -->
                      <!-- <svg class="icon icon-xs me-2"  style="color: #fff" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg> -->
                    </span>
                    <span class="sidebar-text">Announcements</span>
                  </router-link>
                </li>
                <li class="nav-item ">
                  <router-link to="/electionmonitor/surveys" class="nav-link">
                    <span class="sidebar-icon">
                      <!-- <v-icon>mdi-logout</v-icon> -->
                      <!-- <svg class="icon icon-xs me-2"  style="color: #fff" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg> -->
                    </span>
                    <span class="sidebar-text">Surveys</span>
                  </router-link>
                </li>
                <li class="nav-item ">
                  <router-link to="/electionmonitor/questions" class="nav-link">
                    <span class="sidebar-icon">
                      <!-- <v-icon>mdi-logout</v-icon> -->
                      <!-- <svg class="icon icon-xs me-2"  style="color: #fff" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg> -->
                    </span>
                    <span class="sidebar-text">Questions</span>
                  </router-link>
                </li>
                <li class="nav-item ">
                  <router-link to="/electionmonitor/answers" class="nav-link">
                    <span class="sidebar-icon">
                      <!-- <v-icon>mdi-logout</v-icon> -->
                      <!-- <svg class="icon icon-xs me-2"  style="color: #fff" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg> -->
                    </span>
                    <span class="sidebar-text">Answers</span>
                  </router-link>
                </li>
                <li class="nav-item ">
                  <router-link to="/electionmonitor/logs" class="nav-link">
                    <span class="sidebar-icon">
                      <!-- <v-icon>mdi-logout</v-icon> -->
                      <!-- <svg class="icon icon-xs me-2"  style="color: #fff" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg> -->
                    </span>
                    <span class="sidebar-text">Logs</span>
                  </router-link>
                </li>
              </ul>
            </div>
          <!-- </nav> -->
          </v-navigation-drawer>
          <v-app-bar app dense style="background-color: #040539">
           <svg width="54" height="17" viewBox="0 0 64 27" fill="none" xmlns="http://www.w3.org/2000/svg" v-if="$route.name === 'agentHome'">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3856 13.2744L13.3856 0H26.7468H26.7712V0.0243294L37.2288 10.4139V0H50.5899H50.6144V0.0243238L63.9755 13.2987H64V26.5974H50.6144V26.5731L40.1569 16.1835V26.5974H26.7712V26.5731L13.4101 13.2987H13.3856L13.3856 13.2744ZM13.3856 13.2987L13.3856 26.5974H0V13.2987L13.3856 13.2987Z" fill="white"/>
            </svg>
            <v-toolbar-title v-if="$route.name === 'agentHome'" style="color: #fff; padding-left: 5px">Election Monitor</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-toolbar-items>

                <v-btn @click="logout()" color="red lighten-1" plain dense> <v-icon>mdi-logout</v-icon>Logout</v-btn>
              </v-toolbar-items>
          </v-app-bar>

          <!-- Sizes your content based upon application components -->
          <v-main>

            <!-- Provides the application the proper gutter -->
            <div class="container-fluid">

              <!-- If using vue-router -->
              <router-view></router-view>

            </div>
          </v-main>

        </v-app>


    </div>
</template>


<script>


    // import Icon from "../components/Icon.vue";
    // import SidenavCollapse from "./Sidenav/SidenavCollapse.vue";
    // import SidenavCard from "./Sidenav/SidenavCard.vue";
    import helper from '../services/helper'
    export default {
        computed: {
            getAvatar(){
                return '/images/users/'+this.getAuthUser('avatar');
            }
        },
        methods : {
            logout(){
                helper.logout().then(() => {
                    this.$store.dispatch('resetAuthUserDetail');
                    this.$router.replace('/electionmonitor/login');
                })
            },
            getAuthUserFullName(){
                return this.$store.getters.getAuthUserFullName;
            },
            getAuthUser(name){
                return this.$store.getters.getAuthUser(name);
            },
            notification(){

            },
            getAuthUser(name){
                return this.$store.getters.getAuthUser(name);
            }
        },
        components: {

        },
        mounted() {
            if(!this.getAuthUser('email')){
                helper.authUser().then(response => {
                    this.$store.dispatch('setAuthUserDetail',{
                        first_name: response.first_name,
                        last_name: response.last_name,
                        email: response.user.email,
                        avatar:response.avatar,
                        phone: response.phone,
                        allocated_area: response.allocated_Area
                    });
                });
            }
        }
    }
</script>
<style scoped>

.nav {
    white-space: nowrap;
}

.nav-item {
    margin-bottom: 0.2rem;
}

.nav-item.active > .nav-link {
    color: #F2F4F6;
    background-color: #374151;
}

.nav-item .nav-link {
    color: #ffffff;
    cursor: pointer;
}

.nav-item .nav-link:hover {
    color: #F2F4F6;
    background-color: #374151;
}

.nav-link + .multi-level {
    margin-top: 0.2rem;
}

.nav-link {
    font-size: 1rem;
    vertical-align: middle;
    padding: 0.55rem 0.75rem;
    border-radius: 0.5rem;
}

.nav-link .sidebar-icon {
    margin-right: 0.5rem;
    color: #9CA3AF;
}

.nav-link .link-arrow {
    font-size: 0.875rem;
}

.nav-link[data-bs-toggle=collapse][aria-expanded=true] .link-arrow {
    transform: rotate(90deg);
    transition: all 0.2s ease;
}

.nav-link.active {
    color: #F2F4F6;
}

.multi-level .nav-link {
    padding-left: 53px;
}

.sidebar-text,
.link-arrow,
.badge,
.notification-count {
    opacity: 1;
}

.sidebar-text-contracted {
    display: none;
}

.contracted {
    max-width: 95px;
}

.contracted .sidebar-text,
.contracted .link-arrow,
.contracted .badge {
    opacity: 0;
}

.contracted .notification-count {
    opacity: 1;
    position: absolute;
    top: 0;
    left: 40px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    font-size: 0.7rem;
    padding: 0.2rem;
}

.contracted .nav-item {
    position: relative;
}

.contracted .nav-item.active > .nav-link {
    background-color: #363c54;
    width: 44px;
}

.contracted .nav-item .nav-link:hover {
    background-color: #1F2937;
}

.contracted .sidebar-text-contracted {
    display: inline;
}

.contracted .multi-level .nav-link {
    padding-left: 17px;
}

.contracted .nav-item {
    white-space: nowrap;
}

.contracted .sidebar-icon {
    text-align: center;
}

@media (min-width: 768px) {
    .contracted + .content {
        margin-left: 95px;
    }
}

.sidebar-inner {
    position: relative;
    overflow: hidden;
}

.sidebar-heading {
    font-size: 0.75rem;
    text-transform: uppercase;
}

.user-card {
    border-bottom: 0.0625rem solid #2e3650;
}

@media (max-width: 575.98px) {
    .sidebar {
        width: 100%;
    }
}

.content {
    overflow: hidden;
    padding: 0 1rem 0 1rem;
    transition: all 0.3s;
}

@media (prefers-reduced-motion: reduce) {
    .content {
        transition: none;
    }
}

@media (min-width: 992px) {
    .content {
        margin-left: 260px;
    }
}

.sidebar-toggle {
    font-size: 1.3rem;
}

.sidebar-toggle:hover, .sidebar-toggle:focus {
    outline: none;
    box-shadow: none;
    background: #D1D5DB;
}

</style>
