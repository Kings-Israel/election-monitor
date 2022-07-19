<template>
    <form @submit.prevent="proceed">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <!-- <label for="">Full Name</label> -->
                     <v-text-field
                        v-model="surveyForm.title"
                        label="Title"
                        outlined
                        dense
                    ></v-text-field>
                    
                </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                    <v-text-field
                        v-model="surveyForm.description"
                        label="Description"
                        outlined
                        dense
                    ></v-text-field>
                </div>
                
            </div>

            <div class="col-md-6">
               <div class="form-group">
                    <v-text-field
                        v-model="surveyForm.start_date"
                        label="Start Date"
                        outlined
                        dense
                    ></v-text-field>
                </div>
                
            </div>

            <div class="col-md-6">
               <div class="form-group">
                    <v-text-field
                        v-model="surveyForm.end_date"
                        label="End Date"
                        outlined
                        dense
                    ></v-text-field>
                </div>
                
            </div>


            </div>
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
      
        <hr>
        <button type="submit" class="btn btn-primary waves-effect waves-light m-t-10">
            <span v-if="id">Update</span>
            <span v-else>Save</span>
        </button>
        <button @click="$router.go(-1)" class="btn btn-danger waves-effect waves-light m-t-10">
            <span>Cancel</span>
            <!-- <span v-else>Save</span> -->
        </button>
        <!-- <router-link to="/aspirant" class="btn btn-danger waves-effect waves-light m-t-10" v-show="id">Cancel</router-link> -->
    </form>
</template>


<script>
    import datepicker from 'vuejs-datepicker'
    import RangeSlider from 'vue-range-slider'
    import 'vue-range-slider/dist/vue-range-slider.css'
    import helper from '../../../services/helper'

    export default {
        data() {
            return {
                loading: false,
                surveyForm: new Form({
                    'title' : '',
                    'description' : '',
                    'start_date' : '',
                    'end_date' : ''
                }),
                
            };
        },

        props: ['id'],
        mounted() {
            if(this.id)
                this.getSurveys();
        },
        methods: {
            proceed(){
                if(this.id)
                    this.updateSurvey();
                else
                    this.storeSurvey();
            },
            storeSurvey(){
                 this.loading = true
                this.surveyForm.post('http://172.104.245.14/electionmonitor/api/v1/store-survey')
                .then(response => {
                     this.loading = false
                    // toastr['success'](response.message);
                    // this.$emit('completed',response.a)
                    this.$router.push('/electionmonitor/surveys');
                })
                .catch(response => {
                     this.loading = false
                    // toastr['error'](response.message);
                })
            },
            getSurveys(){
                 this.loading = true
                axios.get('http://172.104.245.14/electionmonitor/api/v1/fetch-survey/'+this.id)
                .then(response => {
                     this.loading = false
                    this.surveyForm.title = response.data.data[0].title;
                    this.surveyForm.description = response.data.data[0].description;
                    this.surveyForm.start_date = response.data.data[0].start_date;
                    this.surveyForm.end_date = response.data.data[0].end_date;
                        // console.log(response)
                })
                .catch(response => {
                     this.loading = false
                    // toastr['error'](response.message);
                });
            },
            updateSurvey(){
                 this.loading = true
                this.surveyForm.patch('http://172.104.245.14/electionmonitor/api/v1/update-survey/'+this.id)
                .then(response => {
                     this.loading = false
                    if(response.type == 'error') {
                        // toastr['error'](response.message);
                    }else {
                        this.$router.push('/electionmonitor/surveys');
                    }
                })
                .catch(response => {
                    // toastr['error'](response.message);
                });
            }
        }
    }
</script>
<style>
    .slider{
        width: 100%;
    }
</style>
