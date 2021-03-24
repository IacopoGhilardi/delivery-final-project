
window.Vue = require('vue');
import Vue from 'vue';

const statistic = new Vue({
  el: '#analitics',
  data: {
    amount: [],
    days: [],
    restaurantId: ""
  },
  mounted() {
    axios.post(`http://127.0.0.1:8000/api/statistic/${this.restaurantId}`)
    .then(response => {
        for (let index = 0; index < response.data.length; index++) {
            this.amount.push(response.data[index].total_amount);
            this.days.push(response.data[index].date);
            
        }
        //console.log(response.data);
        //console.log(this.amount);
        //console.log(this.days);
        this.charjs();
        
    })
  },
  methods: {
    //   stamp(id) {
    //         axios.post(`http://127.0.0.1:8000/api/statistic/${id}`)
    //         .then(response => {
    //             for (let index = 0; index < response.data.length; index++) {
    //                 this.amount.push(response.data[index].total_amount);
    //                 this.days.push(response.data[index].date);
                    
    //             }
    //             console.log(response.data);
    //             //console.log(this.amount);
    //             //console.log(this.days);
    //             this.charjs();
                
    //         })
    //   },
      charjs(){
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.days,
                    datasets: [{
                        label: '# Amount',
                        data: this.amount,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
      }
  }


})  