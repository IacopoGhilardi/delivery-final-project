window.Vue = require('vue');
import Vue from 'vue';

const app = new Vue({
    el: '#success',
    data: {
        countDown: 20,
        seconds: 0,
        orders: [
            {
                'status': 'Cancellato'
            },
            {
                'status': 'In Preparazione'
            },
            {
                'status': 'In consegna'
            },
            {
                'status': 'Consegnato'
            },
        ]
    },
    mounted() {
        if (localStorage.getItem('orders')) {
            localStorage.clear();
          }
          this.seconds = this.countDown * 60;
          this.countDownTimer();
    },
    methods: {
        countDownTimer() { 
            if(this.seconds > 0) {
                setTimeout(() => {
                    this.seconds -= 1
                    this.countDownTimer()
                    if (this.seconds % 60 == 0) {
                        this.countDown = this.seconds / 60;
                    }
                }, 1000)
            }
        }
    }

});