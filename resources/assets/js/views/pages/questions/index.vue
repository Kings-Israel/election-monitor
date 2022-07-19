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
                    <li class="breadcrumb-item active">Questions</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="py-4">
                <md-button
                    class="btn bg-gray-800"
                    style="color: #fff; border-radius: 4px"
                    to="/electionmonitor/add-question"
                    >New Question</md-button
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
                            <template v-slot:item.date_created="{ item }">
                                {{ item.date_created | formatDate }}
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <!-- <router-link :to="`/electionmonitor/question/${item.id}/answers`">
                                    <v-icon
                                        small
                                        class="mr-2"
                                    >
                                        mdi-eye
                                    </v-icon>
                                </router-link> -->
                                <v-icon
                                    small
                                    class="mr-2"
                                    @click="editQuestion(item)"
                                >
                                    mdi-pencil
                                </v-icon>
                                <v-icon small @click="deleteQuestion(item)">
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
                                        question?
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
const toLower = (text) => {
    return text.toString().toLowerCase();
};

const searchByFilter = (items, term) => {
    if (term) {
        return items.filter(
            (item) =>
                toLower(item.question).includes(toLower(term)) ||
                toLower(item.type).includes(toLower(term))
        );
    }

    return items;
};

export default {
    data() {
        return {
            headers: [
                {
                    text: "Question",
                    align: "start",
                    filterable: false,
                    value: "question",
                },
                { text: "Survey", value: "survey.title" },
                { text: "Type", value: "type" },

                { text: "Options", value: "frm_option", width: "30%" },
                { text: "Date Created", value: "date_created" },
                { text: "Actions", value: "actions" },
            ],
            deleteDialog: false,
            deleteQuestionID: null,
            questions: [],
            search: null,
            searched: [],
            filterQuestionForm: {
                sortBy: "Question",
                order: "desc",
                description: "",
                pageLength: 25,
            },
        };
    },

    created() {
        this.loading = true;
        axios
            .get(
                "http://172.104.245.14/electionmonitor/api/v1/fetch-survey-questions"
            )
            // axios.get("../api/v1/fetch-survey-questions")
            .then((response) => {
                console.log(response.data.data);
                this.loading = false;
                for (let i = 0; i < response.data.data.length; i++) {
                    this.questions.push(response.data.data[i]);
                }
                this.searched = this.questions;
            });
    },

    methods: {
        formatOptions(options) {
            if (options.length) {
                // const formattedOptions = []
                // console.log(JSON.parse(options))
                Object.keys(JSON.parse(options)).some((key) => {
                    this.formattedOptions[key] = JSON.parse(options)[key];
                });
                // console.log(formattedOptions)
                return formattedOptions;
            }
        },

        deleteQuestion(question) {
            this.deleteDialog = true;
            this.deleteQuestionID = question.id;
        },

        performDelete() {
            this.loading = true;
            axios
                .delete(
                    "http://172.104.245.14/electionmonitor/api/v1/delete-question/" +
                        this.deleteQuestionID
                )
                // axios.delete("../api/v1/delete-question/" + this.deleteQuestionID)
                .then((response) => {
                    this.loading = false;
                    this.deleteDialog = true;
                    this.$router.go();
                    this.searched = this.question;
                })
                .catch((error) => {
                    this.loading = false;
                });
        },
        searchOnTable() {
            this.searched = searchByFilter(this.questions, this.search);
        },
        editQuestion(question) {
            this.$router.push(
                "/electionmonitor/edit-question/" + question.id + "/edit"
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
