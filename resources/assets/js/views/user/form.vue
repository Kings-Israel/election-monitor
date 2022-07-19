<template>
    <form id="userform" @submit.prevent="proceed">
        <div class="row">
            <div class="col-md-12">
                <v-row>
                    <v-col
                    cols="12"
                    sm="6"
                    >
                    <v-text-field
                        v-model="userForm.first_name"
                        label="First Name"
                        outlined
                        dense
                        required
                    ></v-text-field>
                    </v-col>

                    <v-col
                    cols="12"
                    sm="6"
                    >
                    <v-text-field
                        v-model="userForm.last_name"
                        label="Last Name"
                        outlined
                        dense
                        required
                    ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col
                    cols="12"
                    sm="6"
                    >
                
                     <vue-tel-input 
                                            v-model="userForm.phone" 
                                            class="form-control" 
                                            defaultCountry="KE"
                                            invalidMsg="Invalid phone number!"
                                            autofocus
                                            mode="international"
                                            required
                                            style="margin-top: -5.5px;padding: 6.5px"
                                         ></vue-tel-input>
                    </v-col>
                    <v-col
                    cols="12"
                    sm="6"
                    >
                    <v-select
                    v-model="userForm.gender"
                    :items="genders"
                    label="Gender"
                    required
                    outlined
                    dense
                    ></v-select>
                    </v-col>
                </v-row>

                <v-row>
                    

                    <v-col
                    cols="12"
                    sm="6"
                    >
                   <v-select
                    v-model="userForm.role"
                    :items="roles"
                    label="Role"
                    required
                    outlined
                    dense
                    
                    ></v-select>
                    </v-col>
                       <v-col
                    cols="12"
                    sm="6"
                    >
                      <v-autocomplete v-if="userForm.role !== 'Admin' && userForm.role !== '' "
                        v-model="userForm.allocated_area"
                        clearable
                        :items="pollings"
                        :search-input.sync="search"
                        flat
                        label="What is your polling station?"
                        outlined
                        dense
                        ></v-autocomplete>
                    </v-col>
                </v-row>
                <v-row >
                 
                </v-row>
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
        <hr>
        <button type="submit" class="btn btn-primary waves-effect waves-light m-t-10">
            <span v-if="id">Update</span>
            <span v-else>Save</span>
        </button>
        <button @click="$router.go(-1)" class="btn btn-danger waves-effect waves-light m-t-10">
            <span>Cancel</span>
        </button>
        <notifications></notifications>
    </form>
    
</template>


<script>
     export default {
        data() {
            return {
                userForm: new Form({
                    password: 'password',
                    password_confirmation: 'password',
                    // email: '',
                    phone: '',
                    role:'',
                    gender: '',
                    allocated_area: '',
                    first_name: '',
                    last_name: ''
                }),
                roles: ['Admin','Agent'],
                genders: ['Male','Female'],
                loading: false,
                pollings: [],
                items: [],
                search: null,
                select: null,
                loading_search: false,
            }
        },
        props: ['id'],
        mounted() {
            if(this.id)
                this.getUsers();
                this.getPollings();
        },
        watch: {
            search (val) {
                val && val !== this.userForm.allocated_area && this.querySelections(val)
            },
            },
        methods: {
            querySelections (v) {
                this.loading_search = true
                // Simulated ajax query
                setTimeout(() => {
                this.pollings = this.pollings.filter(e => {
                    return (e || '').toLowerCase().indexOf((v || '').toLowerCase()) > -1
                })
                this.loading_search = false
                }, 500)
            },
        
            proceed(){
                if(this.id)
                    this.updateUser();
                else
                    this.submit();
            },
            submit(e){
                this.loading = true
                // console.log(this.userForm.allocated_area.polling_name)
                this.userForm.allocated_area = this.userForm.allocated_area.polling_name
                axios.post('http://172.104.245.14/electionmonitor/api/v1/auth/register', this.userForm).then(response =>  {
                   notify({
                            text: 'Registration was successful',
                            theme: 'green',
                            position: 'top-right'
                        });
                     
                          
                        this.$router.push('/electionmonitor/user') 
                    
                    this.loading = false
                }).catch(error => {
                     notify({
                            text: 'Error in registraion',
                            theme: 'red',
                            position: 'top-right'
                        });
                    this.loading = false
                });
            },
            getUsers(){
                this.loading = true
                axios.get('http://172.104.245.14/electionmonitor/api/v1/user/'+this.id)
                .then(response => {
                    this.loading = false
                    this.userForm.first_name = response.data.first_name;
                    this.userForm.last_name = response.data.last_name;
                    this.userForm.email = response.data.email;
                    this.userForm.phone = response.data.phone;
                    this.userForm.gender = response.data.gender.charAt(0).toUpperCase() + response.data.gender.slice(1);
                    this.userForm.role = response.data.role.charAt(0).toUpperCase() + response.data.role.slice(1);
                    this.userForm.allocated_area = response.data.allocated_area;
                    // console.log(response)
                })
                .catch(response => {
                    this.loading = false
                });
            },
            updateUser(){
                this.loading = true
                this.userForm.allocated_area = this.userForm.allocated_area
                this.userForm.put('http://172.104.245.14/electionmonitor/api/v1/user/'+this.id)
                .then(response => {
                    this.loading = false
                    if(response.type == 'error')
                        notify({
                            text: 'Error in user update',
                            theme: 'red',
                            position: 'top-right'
                        });
                        
                    else {
                        this.$router.push('/electionmonitor/user');
                        this.loading = false
                    }
                })
                .catch(response => {
                    notify({
                            text: 'Error in user update',
                            theme: 'red',
                            position: 'top-right'
                        });
                    this.loading = false
                });
            },
            getPollings (){
                this.loading = true
                axios.get('http://172.104.245.14/electionmonitor/api/v1/polling')
                .then(response => {
                    this.loading = false
                    for(let i=10;i<response.data.length;i++){
                        this.pollings.push(response.data[i].polling_name+','+response.data[i].county_name)
                    }
                    // console.log(this.pollings)
                })
                .catch(response => {
                    // toastr['error'](response.message);
                    this.loading = false
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
