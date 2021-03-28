
window.Vue = require('vue');
import { merge } from 'jquery';
import Vue from 'vue';

const statistic = new Vue({
  el: '#analitics',
  data: {
    amount: [],
    days: [],
    bgColor: [],
    venditaMax: '',
    imgUrlMax:'',
    dishMaxSell: '',
    months:[],
    years:[],
   
  },
  mounted() {
    //   console.log(window.location.href.split('/'));
    var pageUrl = window.location.href.split('/');
    //console.log(pageUrl[pageUrl.length - 1]);
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
            this.bgColor.push('rgba(154, 220, 216, 0.8)')
   
        }
        this.charjs();
        for (let index = 0; index < this.days.length; index++) {
            if (!this.years.includes(this.days[index].split('-')[0]) ) {
                this.years.push(this.days[index].split('-')[0]) ;
                //console.log(this.days[index].split('-')[0]);
            }           
        
        }
        for (let index = 0; index < this.days.length; index++) {
            if (!this.months.includes(this.days[index].split('-')[1]) ) {
                this.months.push(this.days[index].split('-')[1]);
                //console.log(this.days[index].split('-')[1]);
            }           
            
        }
        this.months.sort(function compare(a, b) {
          
            return a - b;
          });
        //console.log(this.months);
        
    });
    
    axios.get(`http://127.0.0.1:8000/api/dish/${pageUrl[pageUrl.length - 1]}`)
    .then(response1 => {

        this.imgUrlMax = response1.data[0].dish_img_path;
        this.venditaMax = response1.data[0].name;
        this.dishMaxSell = response1.data[1].maxsell;     

        //console.log(this.venditaMax);        
        
    });
  },
  methods: {
        onChangeYears(event) {
            let year = event.target.value;
            const self = this;
            var pageUrl = window.location.href.split('/');
            
            if (year == "All") {
                this.days = [];
                self.amount = [];
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
                            this.bgColor.push('rgba(154, 220, 216, 0.8)')
                            
                        }
                        this.charjs();
                    })
            };

            axios.get(`http://127.0.0.1:8000/api/statistic/${pageUrl[pageUrl.length - 1]}/${year}`)
            .then(response => {
                //console.log(response)
                self.days = [];
                self.amount = [];
                for (let index = 0; index < response.data.length; index++) {
                    if (response.data[index] != null ) {
                        self.days.push(response.data[index].date)
                        self.amount.push(response.data[index].total_amount)
                    }
                    
                }
                
                this.charjs();
            
                
            });
         //console.log(event.target.value)
         //this.$forceupdate()
        },
        onChangeMonth(event) {
           
            let month = event.target.value;
            //console.log(month)
            const self = this;
            var pageUrl = window.location.href.split('/');

            if (month == "All") {
                this.days = [];
                self.amount = [];
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
                            this.bgColor.push('rgba(154, 220, 216, 0.8)')
                            
                        }
                        this.charjs();
                    })
            };

            axios.get(`http://127.0.0.1:8000/api/statistic/${pageUrl[pageUrl.length - 1]}/month-filter/${month}`)
            .then(response => {
                //console.log(response)
                self.days = [];
                self.amount = [];
                for (let index = 0; index < response.data.length; index++) {
                    if (response.data[index] != null ) {
                        self.days.push(response.data[index].date)
                        self.amount.push(response.data[index].total_amount)
                    }
                    
                }
                
                this.charjs();
            
                
            });
           },   
      charjs(){
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: this.days,
                    datasets: [{
                        label: 'Totale',
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
      },
      annoPiuRedditizio(obj) {
        // amount:[ 
            // { 
            //     date
            //     amount
            // }
        // ]
        
        // var merge = []
        this.amount.forEach(element => {
            anno = element.date.split('-')[0];
            contenuto = false
            merge.foreach(mergeElement => {
                if (anno == mergeElement.date.split('-')[0]) {
                    mergeElement.amount += element.amount
                    contenuto = true
                }
            })
            if (!contenuto) {
                merge.push(element)
            }
        });
      }
  }

})  