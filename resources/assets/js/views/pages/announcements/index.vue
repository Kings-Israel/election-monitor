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
                    <li class="breadcrumb-item active">Announcements</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="py-4">
                <md-button
                    class="btn bg-gray-800"
                    style="color: #fff; border-radius: 4px"
                    to="/electionmonitor/add-announcement"
                    >New Announcement</md-button
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
                                    @click="editAnnouncement(item)"
                                >
                                    mdi-pencil
                                </v-icon>
                                <v-icon small @click="deleteAnnouncement(item)">
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
                                        announcement?
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
                },
                { text: "Description", value: "description" },
                { text: "Actions", value: "actions" },
            ],
            deleteDialog: false,
            deleteAnnouncementID: null,
            announcements: [],
            search: null,
            searched: [],
            filterAnnouncementForm: {
                sortBy: "title",
                order: "desc",
                description: "",
                pageLength: 25,
            },
        };
    },

    created() {
        this.loading = true;
        axios.get('http://172.104.245.14/electionmonitor/api/v1/fetch-announcements')
        // axios.get("../api/v1/fetch-announcements")
            .then((response) => {
            this.loading = false;
            for (let i = 0; i < response.data.data.length; i++) {
                this.announcements.push(response.data.data[i]);
            }
            this.searched = this.announcements;
        });
    },

    methods: {
        getAnnouncements(page) {
            this.loading = true;
            if (typeof page === "undefined") {
                page = 1;
            }
            // let url = helper.getFilterURL(this.filterAspirantForm);
            axios
                .get(
                    "http://172.104.245.14/electionmonitor/api/v1/announcements"
                )
                .then((response) => {
                    for (let i = 0; i < response.data.data.length; i++) {
                        this.announcements.push(response.data.data[i]);
                    }
                    this.searched = this.announcements;
                    this.loading = false;
                });
        },

        deleteAnnouncement(announcement) {
            this.deleteDialog = true;
            this.deleteAnnouncementID = announcement.id;
        },

        performDelete() {
            this.loading = true;
            axios
                .delete(
                    "http://172.104.245.14/electionmonitor/api/v1/delete-announcement/" +
                        this.deleteAnnouncementID
                )
                .then((response) => {
                    // toastr['success'](response.data.message);
                    this.loading = false;
                    this.deleteDialog = true;
                    // console.log(response)
                    this.$router.go();
                    this.searched = this.announcements;
                })
                .catch((error) => {
                    // toastr['error'](error.response.data.message);
                    this.loading = false;
                });
        },
        searchOnTable() {
            this.searched = searchByFilter(this.announcements, this.search);
        },
        editAnnouncement(announcement) {
            this.$router.push(
                "/electionmonitor/edit-announcement/" +
                    announcement.id +
                    "/edit"
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
