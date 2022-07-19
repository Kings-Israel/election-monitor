<template>
	<div>
        <br>
        <div class="row page-titles">
            <div class="col-md-12 col-8 align-self-center">
                <!-- <h3 class="text-themecolor m-b-0 m-t-0">User</h3> -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/electionmonitor/dashboard">Dashboard</router-link></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="py-4">              
                <md-button class="btn bg-gray-800" style="color: #FFF;border-radius: 4px" to="/electionmonitor/user/add">New user</md-button>  
            </div>
            <div class="col-lg-12 container">
                <div class="mb-4 card">
                    <div class="card-body">
                       
                       <md-field md-clearable class="md-toolbar-section-end">
                                 <v-text-field
                                 dense
                                outlined
                                placeholder="Filter..." 
                                v-model="search" 
                                @input="searchOnTable"
                                clearable
                                prepend-icon="mdi-filter-variant"
                            ></v-text-field>
                                </md-field>
                        <v-data-table
                        :headers="headers"
                        :items="searched"
                        
                        >
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                @click="editUser(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                @click="deleteUser(item)"
                            >
                                mdi-delete
                            </v-icon>
                            </template>
                        </v-data-table>
                        <!-- <h4 class="card-title">Filter User</h4> -->
                        <!-- <button class="btn btn-danger btn-sm" to="/" data-toggle="tooltip" title="Delete User"><i class="fa fa-trash"></i>Delete</button> -->
                       
                        <!-- <md-table v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header>
                            <md-table-toolbar>
                                
                              
                            </md-table-toolbar>

                            <md-table-empty-state
                                md-label="No users found"
                                :md-description="`No user found for this '${search}' query. Try a different search term or create a new user.`">
                                <md-button class="md-primary md-raised">Create New User</md-button>
                            </md-table-empty-state>

                            <md-table-row slot="md-table-row" slot-scope="{ item }">
                                <!-- <md-table-cell md-label="I" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell> --
                                <md-table-cell md-label="Name" md-sort-by="first_name">
                                    <div class="d-flex px-3 py-2">
                                  
                                    <div class="">
                                        <h6 class="mb-0 text-sm">{{item.first_name}} {{item.last_name}}</h6>
                                        <!-- <p class="text-xs  mb-0 text-muted">{{ item.phone}}</p> --
                                    </div>
                                    </div>
                                </md-table-cell>
                                <md-table-cell md-label="Phone" md-sort-by="phone">{{ item.phone }}</md-table-cell>
                                <md-table-cell md-label="Gender" md-sort-by="gender">{{ item.gender}}</md-table-cell>
                                <md-table-cell md-label="Role" md-sort-by="role"><vsud-badge color="success" variant="gradient" size="sm" v-if="item.role === 'agent' || item.role === 'Agent'" >{{item.role}}</vsud-badge> <vsud-badge color="secondary" variant="gradient" size="sm" v-if="item.role === 'admin' || item.role === 'Admin'">{{item.role}}</vsud-badge></md-table-cell>
                                <md-table-cell md-label="Allocated polling" md-sort-by="allocated_area">{{ item.allocated_area }}</md-table-cell>
                                <md-table-cell md-label="Actions" class="align-middle">
                                    <button class="btn btn-primary btn-sm" @click.prevent="editUser(item)" data-toggle="tooltip" title="Edit User"><i class="fa fa-pencil"></i>Edit</button>
                                    <button class="btn btn-danger btn-sm" @click.prevent="deleteUser(item)" data-toggle="tooltip" title="Delete User"><i class="fa fa-trash"></i>Delete</button>
                                      
                               
                                </md-table-cell>
                            </md-table-row>
                            </md-table> -->
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
                        <v-row justify="center">
                                        <v-dialog
                                        v-model="deleteDialog"
                                        persistent
                                        max-width="500"
                                        >
                                        
                                        <v-card  style="background-color: #040539; color: #fff">
                                            <v-card-title class="text-h5">
                                            Are you sure you want to delete this user?
                                            </v-card-title>
                                            <v-card-text style="color: #fff">Once this action is performed, it can not be reversed.</v-card-text>
                                            <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn
                                                color="white"
                                                text
                                                @click="deleteDialog = false"
                                            >
                                                Cancel
                                            </v-btn>
                                            <v-btn
                                                color="red lighten-1"
                                                text
                                                @click="performDelete()"
                                            >
                                                Delete
                                            </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                        </v-dialog>
                                    </v-row>
                                    

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserForm from './form'
    import helper from '../../services/helper'
    import VsudAvatar from "../../components/VsudAvatar.vue";
    import VsudBadge from "../../components/VsudBadge.vue";
      const toLower = text => {
        return text.toString().toLowerCase()
    }

    const searchByFilter = (items, term) => {
        if (term) {
        return items.filter(

            item => toLower(item.first_name).includes(toLower(term)) || toLower(item.last_name).includes(toLower(term)) ||  toLower(item.email).includes(toLower(term))
            || toLower(item.phone).includes(toLower(term)) || toLower(item.role).includes(toLower(term)) || toLower(item.allocated_area).includes(toLower(term))
            )
        }

        return items
    }


    export default {
        components : { UserForm, VsudAvatar,VsudBadge },
        data() {
            return {
                headers: [
                    {
                        text: 'First Name',
                        align: 'start',
                        filterable: false,
                        value: 'first_name',
                    },
                    {
                        text: 'Last Name',
                        align: 'start',
                        filterable: false,
                        value: 'last_name',
                    },
                    { text: 'Phone', value: 'phone' },
                    { text: 'Role', value: 'role' },
                    { text: 'Gender', value: 'gender' },
                    { text: 'Allocated polling', value: 'allocated_area' },
                    { text: 'Actions', value: 'actions' },
                    ],
                deleteDialog: false,
                deleteUserID: null,
                users: [],
                search: null,
                searched: [],
                loading: false,
                filterUserForm: {
                    sortBy : 'first_name',
                    order: 'desc',
                    phone: '',
                    status: '',
                    first_name: '',
                    last_name: '',
                    email: '',
                    pageLength: 1000,
                }
            } 
        },
        created () {
         axios.get('http://172.104.245.14/electionmonitor/api/v1/user')
                    .then(response => {
                        
                        for(let i = 0;i < response.data.length;i++) {
                            this.users.push(response.data[i])
                        }
                        this.searched = this.users
                        // console.log(this.searched)
                    });
            
        },
        mounted() {
            
        },
        methods: {
            getUsers(page) {
                this.loading =true
                if (typeof page === 'undefined') {
                    page = 1;
                }
                // let url = helper.getFilterURL(this.filterUserForm);
                axios.get('http://172.104.245.14/electionmonitor/api/v1/user')
                    .then(response => {
                        // console.log(response.data)
                        for(let i = 0;i < response.data.length;i++) {
                            this.users.push(response.data[i])
                        }
                         
                        // console.log(this.users)
                        this.loading = false
                    });
            },
            deleteUser(user) {
                this.deleteDialog = true
                this.deleteUserID = user.id
            }, 
            performDelete(){
                this.loading =true
                axios.delete('http://172.104.245.14/electionmonitor/api/v1/user/' + this.deleteUserID).then(response => {
                    // toastr['success'](response.data.message);
                    this.loading = false
                    this.deleteDialog = true
                    // console.log(response)
                    this.$router.go()
                    this.searched = this.users
                    // this.deleteDialog = false
                }).catch(error => {
                    this.deleteDialog = false
                    this.loading = false
                });
            },
            searchOnTable () {
                this.searched = searchByFilter(this.users, this.search)
            },
            editUser(item){
                this.$router.push('/electionmonitor/user/'+item.id+'/edit');
            },
        },
        filters: {
            moment(date) {
                return helper.formatDate(date);
            },
            ucword(value) {
                return helper.ucword(value);
            }
        }
    }
</script>
