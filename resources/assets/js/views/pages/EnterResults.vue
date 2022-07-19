<template>
<div class="container-fluid">
    <br>
    <div class="py-4">              
       <md-button class="btn bg-gray-800" style="color: #FFF;border-radius: 4px" @click="$router.go(-1)">Back</md-button>  
    </div>

  <div class="card mb-4 mt-4">
    <div class="card-header pb-0">
      <h6 style="text-transform: capitalize">{{$route.params.electoral_area}} {{$route.params.location}}</h6>
      <!-- <p class="text-xs text-secondary mb-0">County</p><br> -->
      <v-subheader style="color: red" v-if="prograssCalc() <= 45"> {{ prograssCalc () }}% Complete </v-subheader>
      <!-- <v-subheader style="color: yellow" v-else-if="prograssCalc() = 65 "> {{ prograssCalc () }}% Complete </v-subheader> -->
      <v-subheader style="color: green" v-else-if="prograssCalc() >= 46"> {{ prograssCalc () }}% Complete </v-subheader>
    </div>
    <div class="card-body px-3 pt-3 pb-2">

                <!-- Tab Nav -->
                        <div class="nav-wrapper position-relative mb-2" v-if="$route.params.location === 'county'">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 d-flex align-items-center justify-content-center" id="tabs-icons-text-2-tab" @click="filterAspirants('All')"  aria-controls="tabs-icons-text-2" aria-selected="false" style="background-color: #040539; color: #fff">
                                        <!-- <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg> -->
                                        County Governor
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 d-flex align-items-center justify-content-center" id="tabs-icons-text-2-tab" @click="filterAspirants('County Governor')"  aria-controls="tabs-icons-text-2" aria-selected="false" style="background-color: #040539; color: #fff">
                                        <!-- <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg> -->
                                        County Governor
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 d-flex align-items-center justify-content-center" id="tabs-icons-text-3-tab" @click="filterAspirants('Senator')"  aria-controls="tabs-icons-text-3" aria-selected="false" style="background-color: #040539; color: #fff">
                                        <!-- <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg> -->
                                        Senator
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 d-flex align-items-center justify-content-center" id="tabs-icons-text-3-tab" @click="filterAspirants('County Woman Member of National Assembly')"  aria-controls="tabs-icons-text-3" aria-selected="false" style="background-color: #040539; color: #fff">
                                        <!-- <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg> -->
                                        Women Rep.
                                    </a>
                                </li>
                            </ul>
                        </div>
                       
                         <v-data-table
                            :headers="headers"
                            :items="aspirants"
                            class="elevation-1"
                            itemsPerPage = 5
                          >
                            <template v-slot:item.actions="{ item }" >
                              <form @submit.prevent = "feedResult(item.uuid, item.id)" :id="item.uuid"  v-if="!uuids.includes(item.uuid)">
                              <div class="row">
                                <div class="col-6">
                                        <input
                                          class="form-control"
                                          type="number"
                                          step="1"
                                          min="1"
                                          :key="item.id"
                                          :id="item.id"
                                          :name="item.id"
                                          required
                                          v-model="resultsDetails.results[item.id]"
                                        />
                                </div>
                                <div class="col-6">

                                  <md-button class="btn bg-gray-800" style="color: #FFF;border-radius: 4px" type="submit"> <v-icon color="#fff"> mdi-database-plus</v-icon> Enter</md-button>
                                   
                                </div>
                              </div>
                            </form>

                            <template v-else>
                                  <p v-for="vote in voted" :key="vote.aspirant_uuid">
                                    <span v-if="item.uuid === vote.aspirant_uuid"><code>{{ Number (vote.votes).toLocaleString() }}</code></span> 
                                  </p>
                            </template>
                            </template>
  
                          </v-data-table>
         
          <v-dialog
              v-model="loading"
              hide-overlay
              persistent
              width="300"
              >
              <v-card
                  style="background-color: #040539"
                  dark
              >
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

  </div>
  </div>
</template>

<script>

import VsudBadge from "../../components/VsudBadge.vue";
    export default {
      components : { VsudBadge },
        data() {
        return {
        position: '',
        loading: false,
        uuids: [],
        voted: [],
        resultsDetails: new Form({
          index: '',
          uuid: '',
        //   id: '',
          results: {},
      }),
       headers: [
        {
          text: 'Aspirant name',
          align: 'left',
          sortable: false,
          value: 'full_name',
        },
        { text: 'Political party', value: 'political_party' },
        { text: 'Electoral position', value: 'electoral_position' },
        { text: 'Electoral area', value: 'electoral_area' },
        { text: 'Actions', value: 'actions' },
      ],
            aspirants: [],
            progress: null
        }
        },
        methods : {
          filterAspirants (electoral_position) {
                 axios.get('http://172.104.245.14/electionmonitor/api/v1/enter-results/'+this.$route.params.electoral_area)
              .then(response => {
                  this.aspirants = response.data.data
                  this.aspirants = this.aspirants.filter(function (el)
                  {
                    return el.electoral_position === electoral_position                        
                  });
              })
              .catch(response => {
                // console.log(response)
              });

              this.aspirants = this.aspirants.filter(function (el)
                  {
                    return el.electoral_position === electoral_position                        
                  });

                  // console.log(this.aspirants)
            },
            prograssCalc () {
              var _ = require('underscore');
              var aspirant_uuids = []
               for(var i=0;i<this.aspirants.length;i++) {
                 
                      aspirant_uuids.push(this.aspirants[i].uuid) 
                }
                // console.log());
                var intersected = []
                intersected = _.intersection(aspirant_uuids, this.uuids)
                var count_aspirants = this.aspirants.length
                var count_aspirants_voted = intersected.length
                var progress = (count_aspirants_voted / count_aspirants) * 100

                return Math.round(progress, 1) 
            },
            feedResult (uuid,index,id) {
                this.resultsDetails.uuid = uuid
                this.resultsDetails.index = index
                // this.resultsDetails.id = id
                this.loading = true
                
                // var self = this
                this.resultsDetails.post('http://172.104.245.14/electionmonitor/api/v1/enter-results')
                .then(response => {
                    setTimeout(() => 
                        this.loading =false,
                        this.resultsDetails.results = {},
                        this.resultsDetails.uuid = ''
                    , 2000);
                    axios.get('http://172.104.245.14/electionmonitor/api/v1/vote-status')
                    .then(response => {
                        this.voted = response.data
                        for(var i=0;i<response.data.length;i++) {
                            this.uuids.push(response.data[i].aspirant_uuid)
                            // this.voted.push(response.data[i])
                        }

                      var _ = require('underscore');
                       var aspirant_uuids = []
                      for(var i=0;i<this.aspirants.length;i++) {
                        
                              aspirant_uuids.push(this.aspirants[i].uuid) 
                        }
                        // console.log());
                        var intersected = []
                        intersected = _.intersection(aspirant_uuids, this.uuids)
                        var count_aspirants = this.aspirants.length
                        var count_aspirants_voted = intersected.length
                        this.progress = (count_aspirants_voted / count_aspirants) * 100

                        // return Math.round(progress, 1) 
                    // console.log(this.progress)

                    if (this.$route.params.location === "county") {
                      axios.post('http://172.104.245.14/electionmonitor/api/v1/county_progress', {prog: Math.round(this.progress, 1) })
                      .then(response => {
                          // console.log(response)
              
                      })
                    } else if (this.$route.params.location === "national"){
                      axios.post('http://172.104.245.14/electionmonitor/api/v1/national_progress', {prog: Math.round(this.progress, 1) })
                      .then(response => {
                          // console.log(response)
              
                      })
                    } else if (this.$route.params.location === "constituency"){
                      axios.post('http://172.104.245.14/electionmonitor/api/v1/constituency_progress', {prog: Math.round(this.progress, 1) })
                      .then(response => {
                          // console.log(response)
              
                      })
                    } else if (this.$route.params.location === "ward"){
                      axios.post('http://172.104.245.14/electionmonitor/api/v1/ward_progress', {prog: Math.round(this.progress, 1) })
                      .then(response => {
                          // console.log(response)
                      })
                    }

                     
                    })
                    .catch(response => {
                      this.loading = false
                        // console.log(response)
                    });
                    
                })
                .catch(response => {
                    // console.log(response)
                });

            }
        },
        mounted() {
            // console.log(this.$route.params.electoral_area)
            axios.get('http://172.104.245.14/electionmonitor/api/v1/enter-results/'+this.$route.params.electoral_area)
              .then(response => {
                  this.aspirants = response.data.data
                  console.log(response)
              })
              .catch(response => {
                // console.log(response)
              });

            axios.get('http://172.104.245.14/electionmonitor/api/v1/vote-status')
              .then(response => {
                //   console.log(this.uuids = response.data[0].aspirant_uuid)
                 this.voted = response.data
                  for(var i=0;i<response.data.length;i++) {
                      this.uuids.push(response.data[i].aspirant_uuid)
                    //   this.voted.push(response.data)
                  }
              })
              .catch(response => {
                // console.log(response)
              });

        },
        computed: {
         
        },
        destroyed(){
        }
    }
</script>