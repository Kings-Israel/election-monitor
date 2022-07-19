 <template>
	<div>
        <br>
        <div class="row page-titles">
            <div class="col-md-12 col-8 align-self-center">
                <!-- <h3 class="text-themecolor m-b-0 m-t-0">User</h3> -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/electionmonitor/dashboard">Dashboard</router-link></li>
                    <li class="breadcrumb-item active">Wards</li>
                </ol>
            </div>
        </div>

        <div class="row">
            
            <div class="col-lg-12">
                <div class="mb-4 card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Filter User</h4> -->
                        
                        <md-table v-model="searched" md-sort="ward_name" md-sort-order="asc" md-card md-fixed-header>
                            <md-table-toolbar>
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
                              
     
                            </md-table-toolbar>

                            <md-table-empty-state
                                md-label="No wards found"
                                :md-description="`No ward found for this '${search}' query. Try a different search term.`">
                                <!-- <md-button class="md-primary md-raised">Create New User</md-button> -->
                            </md-table-empty-state>

                            <md-table-row slot="md-table-row" slot-scope="{ item }">
                                <!-- <md-table-cell md-label="I" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell> -->
                                <md-table-cell md-label="Ward name" md-sort-by="ward_name">
                                    {{ item.ward_name }}
                                </md-table-cell>
                                <!-- <md-table-cell md-label="Electoral position" md-sort-by="electoral_position">{{ item.electoral_position }}</md-table-cell> -->
                                <md-table-cell md-label="County" md-sort-by="county_name">{{ item.county_name }}</md-table-cell>
                                <md-table-cell md-label="Constituency" md-sort-by="constituency_name">{{ item.constituency_name }}</md-table-cell>
                               <md-table-cell md-label="Registered voters" md-sort-by="registered">{{ item.registered }}</md-table-cell>
                               <md-table-cell md-label="Population" md-sort-by="population">{{ item.population }}</md-table-cell>   
                                
                            </md-table-row>
                            </md-table>
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
        </div>
    </div>
</template>

<script>
    import 'vue-material/dist/vue-material.min.css'
    import 'vue-material/dist/theme/default.css'
    // import AspirantForm from './form'
    import helper from '../../services/helper'
    import VsudAvatar from "../../components/VsudAvatar.vue";
    import VsudBadge from "../../components/VsudBadge.vue";
    const toLower = text => {
        return text.toString().toLowerCase()
    }

    const searchByFilter = (items, term) => {
        if (term) {
        return items.filter(

            item => toLower(item.ward_name).includes(toLower(term)) || toLower(item.county_name).includes(toLower(term)) ||  toLower(item.constituency_name).includes(toLower(term))
            // || toLower(item.political_party).includes(toLower(term)) 
            // || toLower(item.role).includes(toLower(term))
            )
        }

        return items
        }

    export default {
        components : {  VsudAvatar, VsudBadge},
        data() {
            return {
                wards: [],
                search: null,
                searched: [],
            }
        },

        created() {
            this.loading =true
            axios.get('http://172.104.245.14/electionmonitor/api/v1/ward')
                    .then(response => {
                        this.loading =false
                        for(let i = 0;i < response.data.length;i++) {
                            this.wards.push(response.data[i])
                        }
                        this.searched = this.wards
                        // console.log(this.searched)
                    });
        },

        methods: {
            getWards(page) {
                this.loading =true
                if (typeof page === 'undefined') {
                    page = 1;
                }
                // let url = helper.getFilterURL(this.filterAspirantForm);
                axios.get('http://172.104.245.14/electionmonitor/api/v1/ward')
                    .then(response => {
                        
                        for(let i = 0;i < response.data.length;i++) {
                            this.wards.push(response.data[i])
                        }
                        this.searched = this.wards
                        // console.log(this.searched)
                         this.loading = false
                    });
            },
            searchOnTable () {
                this.searched = searchByFilter(this.wards, this.search)
            },
        },
        filters: {
        }
    }
</script>
