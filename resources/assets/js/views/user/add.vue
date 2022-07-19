<template>
	<div>
        <br>
        <div class="row page-titles">
            <div class="col-md-12 col-8 align-self-center">
                <!-- <h3 class="text-themecolor m-b-0 m-t-0">Add User</h3> -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/dashboard">Dashboard</router-link></li>
                    <li class="breadcrumb-item"><router-link to="/user">User</router-link></li>
                    <li class="breadcrumb-item active">Add User</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Add User</h4> -->
                        <user-form ></user-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserForm from './form';
    // import helper from '../../services/helper'

    export default {
        components : { UserForm },
        data() {
            return {
                id:this.$route.params.id
            }
        }
    }
</script>