<template>
    <div>
        <br />
        <div class="row page-titles">
            <div class="col-md-12 col-8 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link to="/dashboard">Dashboard</router-link>
                    </li>
                    <li class="breadcrumb-item">
                        <router-link to="/user">User</router-link>
                    </li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <user-form :id="id"></user-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UserForm from "./form";

export default {
    components: { UserForm },
    data() {
        return {
            id: this.$route.params.id,
        };
    },
};
</script>
