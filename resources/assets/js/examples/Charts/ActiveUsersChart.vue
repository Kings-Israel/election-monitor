<template>
<div>
  <div class="py-3 mb-3 border-radius-lg pe-1" >
    <div class="chart">
      <canvas id="chart-bars" class="chart-canvas" height="300"></canvas>
    </div>
  </div>
  </div>
</template>
<script>
import Chart from "chart.js/auto";

export default {
  name: "active-users-chart",
  // mixins: [mixins.reactiveData],
  mounted() {
    axios.get('api/v1/fetch-results')
      .then(response => {
        // JSON responses are automatically parsed.
        // console.log(response.data)
          const responseData = []
            for(var i=0;i<response.data.results.length;i++) {
            
              responseData.push(response.data.results[i])
            }

            let summedResults = responseData.reduce((a, c) => {
                
                let filtered = a.filter(el => 
                  el.agent_id === c.agent_id);
                if(filtered.length > 0){
                 a[a.indexOf(filtered[0])].votes = (parseInt(a[a.indexOf(filtered[0])].votes) + parseInt(c.votes));
                }else{
                  a.push(c);
                  // a = a+c
                }
                return a;
              }, []);

              console.log(JSON.stringify(summedResults));
              summedResults = summedResults.splice(0, 20)

            // console.log(responseData)
    var ctx = document.getElementById("chart-bars").getContext("2d");
    new Chart(ctx, {
      type: "bar",
      data: {
        labels: summedResults.map(item => item.agent_id),
        datasets: [
          {
            label: "Votes",
            tension: 0.4,
            borderWidth: 2,
            borderRadius: 2,
            borderSkipped: true,
            backgroundColor: "#fff",
            data: summedResults.map(item => item.votes),
            maxBarThickness: 6,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
        },
        interaction: {
          intersect: false,
          mode: "index",
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Open Sans",
                style: "normal",
                lineHeight: 2,
              },
              color: "#fff",
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false,
            },
          },
        },
      },
    });
      })
   
  },
};
</script>
