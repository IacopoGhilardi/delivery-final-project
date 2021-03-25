
window.Vue = require('vue');
import Vue from 'vue';

const statistic = new Vue({
  el: '#analitics',
  data: {
    amount: [],
    days: [],
    bgColor: [],
    venditaMax: '',
    imgUrlMax:''
  },
  mounted() {
    //   console.log(window.location.href.split('/'));
    var pageUrl = window.location.href.split('/');
    console.log(pageUrl[pageUrl.length - 1]);
    axios.get(`http://127.0.0.1:8000/api/statistic/${pageUrl[pageUrl.length - 1]}`)
    .then(response => {
        var sorting = response.data.sort(function compare(a, b) {
            var dateA = new Date(a.date);
            var dateB = new Date(b.date);
            return dateB - dateA;
          });
        //console.log(response.data);
        //console.log(sorting);
        for (let index = 0; index < sorting.length; index++) {
            this.amount.push(sorting[index].total_amount);
            this.days.push(sorting[index].date);
            this.bgColor.push('rgba(248, 121, 86, 0.6)')
        }
        this.charjs();
        
    });
    axios.get(`http://127.0.0.1:8000/api/dish/${pageUrl[pageUrl.length - 1]}`)
    .then(response1 => {

        this.imgUrlMax = response1.data[0].dish_img_path;
        this.venditaMax = response1.data[0].name;

        console.log(response1.data);
        
        
    });
  },
  methods: {
      charjs(){
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: this.days,
                    datasets: [{
                        label: '# Amount',
                        data: this.amount,
                        backgroundColor: this.bgColor,
                        borderColor: this.bgColor,
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