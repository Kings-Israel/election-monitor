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
                    <li class="breadcrumb-item active">Answers</li>
                </ol>
            </div>
        </div>

        <div class="row">
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
                            <template v-slot:item.user="{ item }">
                                <td>
                                    {{ item.user.first_name }}
                                    {{ item.user.last_name }}
                                </td>
                            </template>
                            <template v-slot:item.date_created="{ item }">
                                <td>
                                    {{ item.date_created | formatDate }}
                                </td>
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
                toLower(item.answer).includes(toLower(term)) ||
                toLower(item.question.question).includes(toLower(term)) ||
                toLower(item.user.first_name).includes(toLower(term)) ||
                toLower(item.user.last_name).includes(toLower(term))
        );
    }

    return items;
};

export default {
    data() {
        return {
            headers: [
                {
                    text: "Answer",
                    align: "start",
                    filterable: false,
                    value: "answer",
                },
                { text: "Question", value: "question.question" },
                { text: "User", value: "user" },

                { text: "Answered On", value: "date_created" },
            ],
            answers: [],
            search: null,
            searched: [],
            filterAnswerForm: {
                sortBy: "Answer",
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
                "http://172.104.245.14/electionmonitor/api/v1/fetch-answers"
            )
            // axios.get("../api/v1/fetch-answers")
            .then((response) => {
                this.loading = false;
                for (let i = 0; i < response.data.data.length; i++) {
                    this.answers.push(response.data.data[i]);
                }
                this.searched = this.answers;
            });
    },

    methods: {
        searchOnTable() {
            this.searched = searchByFilter(this.answers, this.search);
        },
    },
    filters: {
        moment(date) {
            return helper.formatDate(date);
        },
    },
};
</script>
