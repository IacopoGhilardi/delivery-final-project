
window.Vue = require('vue');
import Vue from 'vue';

const statistic = new Vue({
  el: '#analitics',
  data: {
    amount: [],
    days: [],
    venditaMax: '',
  },
  mounted() {
    //   console.log(window.location.href.split('/'));
    var pageUrl = window.location.href.split('/');
    console.log(pageUrl[pageUrl.length - 1]);
    axios.get(`http://127.0.0.1:8000/api/statistic/${pageUrl[pageUrl.length - 1]}`)
    .then(response => {
        console.log(response.data);
        for (let index = 0; index < response.data.length; index++) {
            this.amount.push(response.data[index].total_amount);
            this.days.push(response.data[index].date);
            
        }
        this.charjs();
        
    });
    axios.get(`http://127.0.0.1:8000/api/dish/${pageUrl[pageUrl.length - 1]}`)
    .then(response1 => {
        console.log(response1.data);
        this.venditaMax = response1.data[0].name;

        console.log(response1.data[1]);
        
        
    });
  },
  methods: {
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