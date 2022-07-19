<template>
	<div>
        <br>
        <div class="row page-titles">
            <div class="col-md-12 col-8 align-self-center">
                <!-- <h3 class="text-themecolor m-b-0 m-t-0">Edit Aspirant</h3> -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item"><router-link to="/aspirant">Aspirant</router-link></li>
                    <li class="breadcrumb-item active">Add Aspirant</li>
                </ol>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Edit Aspirant</h4> -->
                        <aspirant-form ></aspirant-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AspirantForm from './form';
    import helper from '../../services/helper'

    export default {
        components : { AspirantForm },
        data() {
            return {
                id:this.$route.params.id
            }
        }
    }
</script>