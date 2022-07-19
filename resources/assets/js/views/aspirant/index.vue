<template>
	<div>
        <br>
        <div class="row page-titles">
            <div class="col-md-12 col-8 align-self-center">
                <!-- <h3 class="text-themecolor m-b-0 m-t-0">User</h3> -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/electionmonitor/dashboard">Dashboard</router-link></li>
                    <li class="breadcrumb-item active">Aspirants</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="py-4">
                <md-button class="btn bg-gray-800" style="color: #FFF;border-radius: 4px" to="/electionmonitor/aspirant/add">New aspirant</md-button>
            </div>
            <div class="col-lg-12">
                <div class="mb-4 card">
                    <div class="card-body">
                      <!-- Tab Nav -->
                        <div class="nav-wrapper position-relative mb-2">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active d-flex align-items-center justify-content-center" id="tabs-icons-text-1-tab" @click="tabs('The president')"  aria-controls="tabs-icons-text-1" aria-selected="true" style="background-color:#040539; color: #fff">
                                        <!-- <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"></path></svg> -->
                                        The President
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 d-flex align-items-center justify-content-center" id="tabs-icons-text-2-tab" @click="tabs('County governor')"  aria-controls="tabs-icons-text-2" aria-selected="false" style="background-color:#040539; color: #fff">
                                        <!-- <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg> -->
                                        County Governor
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 d-flex align-items-center justify-content-center" id="tabs-icons-text-3-tab" @click="tabs('Senator')"  aria-controls="tabs-icons-text-3" aria-selected="false" style="background-color:#040539; color: #fff">
                                        <!-- <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg> -->
                                        Senator
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 d-flex align-items-center justify-content-center" id="tabs-icons-text-3-tab" @click="tabs('County Woman Member of National Assembly')"  aria-controls="tabs-icons-text-3" aria-selected="false" style="background-color:#040539; color: #fff">
                                        <!-- <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg> -->
                                        Women Rep.
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 d-flex align-items-center justify-content-center" id="tabs-icons-text-3-tab" @click="tabs('Member of county assembly')"  aria-controls="tabs-icons-text-3" aria-selected="false" style="background-color:#040539; color: #fff">
                                        <!-- <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg> -->
                                        MCA
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End of Tab Nav -->

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
                        <template v-slot:item.results="{ item }">
                            <td>{{ Number(item.results).toLocaleString() }}</td>
                            </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                @click="editAspirant(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                @click="deleteAspirant(item)"
                            >
                                mdi-delete
                            </v-icon>
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
                         <v-row justify="center">
                                        <v-dialog
                                        v-model="deleteDialog"
                                        persistent
                                        max-width="550"
                                        >

                                        <v-card  style="background-color: #040539; color: #fff">
                                            <v-card-title class="text-h5">
                                            Are you sure you want to delete this aspirant?
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
    import AspirantForm from './form'
    import helper from '../../services/helper'
    import VsudAvatar from "../../components/VsudAvatar.vue";
    import VsudBadge from "../../components/VsudBadge.vue";
    const toLower = text => {
        return text.toString().toLowerCase()
    }

    const searchByFilter = (items, term) => {
        if (term) {
        return items.filter(

            item => toLower(item.full_name).includes(toLower(term)) || toLower(item.electoral_area).includes(toLower(term)) ||  toLower(item.electoral_position).includes(toLower(term))
            || toLower(item.political_party).includes(toLower(term))
            // || toLower(item.role).includes(toLower(term))
            )
        }

        return items
        }

    export default {
        components : { AspirantForm, VsudAvatar, VsudBadge},
        data() {
            return {
                headers: [
                    {
                        text: 'Full Name',
                        align: 'start',
                        filterable: false,
                        value: 'full_name',
                    },
                    { text: 'Political party', value: 'political_party' },
                    { text: 'Electoral_position', value: 'electoral_position' },
                    { text: 'Electoral area', value: 'electoral_area' },
                    { text: 'Results', value: 'results' },
                    { text: 'Actions', value: 'actions' },
                    ],
                deleteDialog: false,
                deleteAspirantID: null,
                aspirants: [],
                search: null,
                searched: [],
                filterAspirantForm: {
                    sortBy : 'electoral_position',
                    order: 'desc',
                    electoral_area: '',
                    electoral_position: '',
                    full_name: '',
                    pageLength: 25
                }
            }
        },

        created() {
            this.loading =true
            axios.get('http://172.104.245.14/electionmonitor/api/v1/aspirant')
            // axios.get('../api/v1/aspirant')
                    .then(response => {
                        this.loading =false
                        for(let i = 0;i < response.data.length;i++) {
                            this.aspirants.push(response.data[i])
                        }
                        this.searched = this.aspirants
                        // console.log(this.searched)
                    });
        },

        methods: {
            tabs (position) {
                // console.log(position)
                this.search = position
                this.searched = searchByFilter(this.aspirants, this.search)
            },

            deleteAspirant(aspirant) {
                this.deleteDialog = true
                this.deleteAspirantID = aspirant.id
            },

            performDelete (){
                this.loading =true
                axios.delete('http://172.104.245.14/electionmonitor/api/v1/aspirant/'+this.deleteAspirantID).then(response => {
                     // toastr['success'](response.data.message);
                    this.loading = false
                    this.deleteDialog = true
                    // console.log(response)
                    this.$router.go()
                    this.searched = this.aspirants
                }).catch(error => {
                    // toastr['error'](error.response.data.message);
                    this.loading = false
                });
            },
            searchOnTable () {
                this.searched = searchByFilter(this.aspirants, this.search)
            },
            editAspirant(aspirant){
                this.$router.push('/electionmonitor/aspirant/'+aspirant.uuid+'/edit');
            },

        },
        filters: {
          moment(date) {
            return helper.formatDate(date);
          }
        }
    }
</script>
