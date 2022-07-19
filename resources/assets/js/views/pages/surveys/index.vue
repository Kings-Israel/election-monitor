<template>
    <div>
        <br />
        <div class="row page-titles">
            <div class="col-md-12 col-8 align-self-center">
                <!-- <h3 class="text-themecolor m-b-0 m-t-0">User</h3> -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link to="/electionmonitor/dashboard"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="breadcrumb-item active">Surveys</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="py-4">
                <md-button
                    class="btn bg-gray-800"
                    style="color: #fff; border-radius: 4px"
                    to="/electionmonitor/add-survey"
                    >New Survey</md-button
                >
            </div>
            <div class="col-lg-12">
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
                        <v-data-table :headers="headers" :items="searched">
                            <!-- <template v-slot:item.results="{ item }">
                            <td>{{ Number(item.results).toLocaleString() }}</td>
                            </template> -->
                            <template v-slot:item.actions="{ item }">
                                <v-icon
                                    small
                                    class="mr-2"
                                    @click="editSurvey(item)"
                                >
                                    mdi-pencil
                                </v-icon>
                                <v-icon small @click="deleteSurvey(item)">
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
                            <v-card style="background-color: #040539" dark>
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
                                <v-card
                                    style="
                                        background-color: #040539;
                                        color: #fff;
                                    "
                                >
                                    <v-card-title class="text-h5">
                                        Are you sure you want to delete this
                                        survey?
                                    </v-card-title>
                                    <v-card-text style="color: #fff"
                                        >Once this action is performed, it can
                                        not be reversed.</v-card-text
                                    >
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
// import AspirantForm from './form'
// import helper from '../../services/helper'
// import VsudAvatar from "../../components/VsudAvatar.vue";
// import VsudBadge from "../../components/VsudBadge.vue";
const toLower = (text) => {
    return text.toString().toLowerCase();
};

const searchByFilter = (items, term) => {
    if (term) {
        return items.filter(
            (item) =>
                toLower(item.title).includes(toLower(term)) ||
                toLower(item.description).includes(toLower(term))
        );
    }

    return items;
};

export default {
    // components : { AspirantForm, VsudAvatar, VsudBadge},
    data() {
        return {
            headers: [
                {
                    text: "Title",
                    align: "start",
                    filterable: false,
                    value: "title",
                    width: "20%",
                },
                { text: "Description", value: "description", width: "50%" },
                { text: "Start Date", value: "start_date" },
                { text: "End Date", value: "end_date" },
                { text: "Actions", value: "actions" },
            ],
            deleteDialog: false,
            deleteSurveyID: null,
            surveys: [],
            search: null,
            searched: [],
            filterSurveyForm: {
                sortBy: "title",
                order: "desc",
                description: "",
                pageLength: 25,
            },
        };
    },

    created() {
        this.loading = true;
        axios.get('http://172.104.245.14/electionmonitor/api/v1/fetch-surveys')
        // axios.get("../api/v1/fetch-surveys")
            .then((response) => {
            this.loading = false;
            for (let i = 0; i < response.data.data.length; i++) {
                this.surveys.push(response.data.data[i]);
            }
            this.searched = this.surveys;
            // console.log(response.data.data)
        });
    },

    methods: {
        getSurveys(page) {
            this.loading = true;
            if (typeof page === "undefined") {
                page = 1;
            }
            // let url = helper.getFilterURL(this.filterAspirantForm);
            axios.get('http://172.104.245.14/electionmonitor/api/v1/surveys')
            // axios.get("../api/v1/surveys")
                .then((response) => {
                console.log(response.data);
                for (let i = 0; i < response.data.data.length; i++) {
                    this.surveys.push(response.data.data[i]);
                }
                this.searched = this.surveys;
                this.loading = false;
            });
        },

        deleteSurvey(survey) {
            this.deleteDialog = true;
            this.deleteSurveyID = survey.id;
        },

        performDelete() {
            this.loading = true;
            axios.delete('http://172.104.245.14/electionmonitor/api/v1/delete-survey/'+this.deleteSurveyID)
            // axios.delete("../api/v1/delete-survey/" + this.deleteSurveyID)
                .then((response) => {
                    // toastr['success'](response.data.message);
                    this.loading = false;
                    this.deleteDialog = true;
                    // console.log(response)
                    this.$router.go();
                    this.searched = this.survey;
                })
                .catch((error) => {
                    // toastr['error'](error.response.data.message);
                    this.loading = false;
                });
        },
        searchOnTable() {
            this.searched = searchByFilter(this.surveys, this.search);
        },
        editSurvey(survey) {
            this.$router.push(
                "/electionmonitor/edit-survey/" + survey.id + "/edit"
            );
        },
    },
    filters: {
        moment(date) {
            return helper.formatDate(date);
        },
    },
};
</script>
