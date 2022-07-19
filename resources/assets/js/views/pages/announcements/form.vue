<template>
    <form @submit.prevent="proceed">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <!-- <label for="">Full Name</label> -->
                     <v-text-field
                        v-model="announcementForm.title"
                        label="Title"
                        outlined
                        dense
                    ></v-text-field>
                    
                </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                    <v-text-field
                        v-model="announcementForm.description"
                        label="Description"
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
                announcementForm: new Form({
                    'title' : '',
                    'description' : ''
                }),
                
            };
        },

        props: ['id'],
        mounted() {
            if(this.id)
                this.getAnnouncements();
        },
        methods: {
            proceed(){
                if(this.id)
                    this.updateAnnouncement();
                else
                    this.storeAnnouncement();
            },
            storeAnnouncement(){
                 this.loading = true
                this.announcementForm.post('http://172.104.245.14/electionmonitor/api/v1/store-announcement')
                .then(response => {
                     this.loading = false
                    // toastr['success'](response.message);
                    // this.$emit('completed',response.a)
                    this.$router.push('/electionmonitor/announcements');
                })
                .catch(response => {
                     this.loading = false
                    // toastr['error'](response.message);
                })
            },
            getAnnouncements(){
                 this.loading = true
                axios.get('http://172.104.245.14/electionmonitor/api/v1/fetch-announcement/'+this.id)
                .then(response => {
                     this.loading = false
                    this.announcementForm.title = response.data.data[0].title;
                    this.announcementForm.description = response.data.data[0].description;

                        console.log(response.data.data[0].description)
                })
                .catch(response => {
                     this.loading = false
                    // toastr['error'](response.message);
                });
            },
            updateAnnouncement(){
                 this.loading = true
                this.announcementForm.patch('http://172.104.245.14/electionmonitor/api/v1/update-announcement/'+this.id)
                .then(response => {
                     this.loading = false
                    if(response.type == 'error') {
                        // toastr['error'](response.message);
                    }else {
                        this.$router.push('/electionmonitor/announcements');
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
