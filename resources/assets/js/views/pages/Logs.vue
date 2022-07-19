<template>
  <div>
         <br>
        <div class="row page-titles">
            <div class="col-md-12 col-8 align-self-center">
                <!-- <h3 class="text-themecolor m-b-0 m-t-0">User</h3> -->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/electionmonitor/dashboard">Dashboard</router-link></li>
                    <li class="breadcrumb-item active">Logs</li>
                </ol>
            </div>
        </div>
         <br>
        <div class="row page-titles">
            <div class="col-md-12 col-8 align-self-center">
                
            </div>
        </div>
    <v-data-table
        :headers="headers"
        :items="logs"
        :items-per-page="5"
        class="elevation-1"
        style="max-width: 1550px"
    ></v-data-table>
  </div>
</template>
<script>
  export default {
    data () {
      return {
        headers: [
          {
            text: 'Date',
            value: 'date',
          },
          { text: 'Text', value: 'text' },
        ],
        logs: [ ],
      }
    },

    mounted() {
            axios.get('api/v1/logs')
            .then(response => {
                console.log(response.data.logs)
                this.logs = response.data.logs
            });
    }
  }
</script>