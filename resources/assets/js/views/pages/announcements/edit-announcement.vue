<template>
	<div>
        <br>
        <div class="row page-titles">
            <div class="col-md-12 col-8 align-self-center">
                <!-- <h3 class="text-themecolor m-b-0 m-t-0">Edit Aspirant</h3> -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/electionmonitor/dashboard">Home</router-link></li>
                    <li class="breadcrumb-item"><router-link to="/electionmonitor/announcements">Announcements</router-link></li>
                    <li class="breadcrumb-item active">Edit Aspirant</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Edit Aspirant</h4> -->
                        <announcement-form :id="id"></announcement-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AnnouncementForm from './form';
    import helper from '../../../services/helper'

    export default {
        components : { AnnouncementForm },
        data() {
            return {
                id:this.$route.params.id
            }
        }
    }
</script>