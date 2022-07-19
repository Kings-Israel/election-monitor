<template>
    <form @submit.prevent="proceed">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <!-- <label for="">Full Name</label> -->
                     <v-text-field
                        v-model="questionForm.question"
                        label="Question"
                        outlined
                        dense
                    ></v-text-field>
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                       <v-select
                       v-model="questionForm.survey_id"
                        :items="surveys"
                        label="Survey"
                        outlined
                        dense
                        ></v-select>
                </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                       <v-select
                       v-model="questionForm.type"
                        :items="question_types"
                        label="Question Type"
                        outlined
                        dense
                        ></v-select>
                </div>
            </div>
            <div class="col-md-6" v-if="questionForm.type === 'radio_opt'">
               <div class="form-group">
                    <v-text-field
                        v-model="questionForm.frm_option"
                        label="Radio 1"
                        outlined
                        dense
                    ></v-text-field>
                </div>
            </div>

            <div class="col-md-6" v-if="questionForm.type === 'checkbox_opt'">
               <div class="form-group">
                    <v-text-field
                        v-model="questionForm.frm_option"
                        label="checkbox 1"
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
        </div>
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
                question_types: ['radio_opt', 'checkbox_opt', 'textfield_s'],
                surveys: [],
                questionForm: new Form({
                    'question' : '',
                    'type' : '',
                    'survey_id' : '',
                    'frm_option' : []
                }),
                
            };
        },

        props: ['id'],
        created () {
            axios.get('http://172.104.245.14/electionmonitor/api/v1/fetch-surveys/')
                .then(response => {
                     this.loading = false
                    for(let i=0;i<response.data.data.length;i++){
                        this.surveys.push(response.data.data[i].id)
                    }

                        // console.log(response.data.data)
                })
                .catch(response => {
                     this.loading = false
                    // toastr['error'](response.message);
                });
        },
        mounted() {
            if(this.id)
                this.getQuestion();
        },
        methods: {
            proceed(){
                if(this.id)
                    this.updateQuestion();
                else
                    this.storeQuestion();
            },
            storeQuestion(){
                 this.loading = true
                this.questionForm.post('http://172.104.245.14/electionmonitor/api/v1/store-question')
                .then(response => {
                     this.loading = false
                    // toastr['success'](response.message);
                    // this.$emit('completed',response.a)
                    this.$router.push('/electionmonitor/questions');
                })
                .catch(response => {
                     this.loading = false
                    // toastr['error'](response.message);
                })
            },
            getQuestion(){
                this.loading = true
                axios.get('http://172.104.245.14/electionmonitor/api/v1/fetch-question/'+this.id)
                .then(response => {
                     this.loading = false
                    this.questionForm.question = response.data.data[0].question;
                    this.questionForm.survey_id = response.data.data[0].survey_id;

                    this.questionForm.type = response.data.data[0].type;
                    this.questionForm.frm_option = response.data.data[0].frm_option;

                        console.log(response)
                })
                .catch(response => {
                     this.loading = false
                    // toastr['error'](response.message);
                });
            },
            updateQuestion(){
                 this.loading = true
                this.questionForm.patch('http://172.104.245.14/electionmonitor/api/v1/update-question/'+this.id)
                .then(response => {
                     this.loading = false
                    if(response.type == 'error') {
                        // toastr['error'](response.message);
                    }else {
                        this.$router.push('/electionmonitor/questions');
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
