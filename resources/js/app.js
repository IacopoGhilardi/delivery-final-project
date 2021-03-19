/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import axios from 'axios';
import Vue from 'vue';

import Slide from './components/Slider.vue';
const slide = new Vue({
    render: h => h(Slide),  
  }).$mount('#slide')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        firstSearch: true,
        type: '',
        filteredRestaurants: [],
        allRestaurants: [],
        
    },
    mounted() {
        axios.post(`http://127.0.0.1:8000/api/allRestaurants`)
                .then(response => {
                    this.allRestaurants = response.data;
                })
      
    },
    methods: {
        restaurants() {
            axios.post(`http://127.0.0.1:8000/api/restaurants/${this.type}`)
                .then(response => {
                    this.firstSearch = false;
                    this.filteredRestaurants = response.data;
                    this.type = '';
                    var el = this.$el.getElementsByClassName("restaurant")[0];
                    //console.log(el);
                   el.scrollIntoView(); 
                })
                .catch((error) => {
                    this.type = '';
                    this.firstSearch = false;
                    this.filteredRestaurants = [];
                      // when you throw error this will also fetch error.
                       throw error;
                  });
        },
        filterOnType(tipo) {
            axios.post(`http://127.0.0.1:8000/api/restaurants/${tipo}`)
                .then(response => {
                    this.filteredRestaurants = response.data;
                })
                .catch((error) => {
                    this.type = '';
                    this.firstSearch = false;
                      // when you throw error this will also fetch error.
                       throw error;
                  });
        }
    }
});


const cart = new Vue({
    el: '#root',
    data: {
        orders: [],
    },
    mounted() {
        if (localStorage.getItem('orders')) {
            try {
              this.orders = JSON.parse(localStorage.getItem('orders'));
            } catch(e) {
              localStorage.removeItem('orders');
            }
          }
    },
    methods: {
        stamp(x) {
            console.log(x);
        },
        addOrder(name, price) {
            // ensure they actually typed something
            if (!name && !price) {
              return;
            }
            //salvo il nuovo ordine
            const newOrder = {name, price, count: 1};
            if (this.orders.length == 0) {
                this.orders.push(newOrder);
            }
            //controllo se esiste e in tal caso sommo solo il prezzo
            else if (!this.groupOrders(newOrder)) {
                this.orders.push(newOrder);
            }
            this.saveOrders();
        },
        removeOrder(x) {
        this.orders.splice(x, 1);
        this.saveOrders();
        },
        saveOrders() {
        const parsed = JSON.stringify(this.orders);
        localStorage.setItem('orders', parsed);
        },
        //raggruppo ordini con lo stesso ordine
        groupOrders(newOrder) {
            let exist = false;
            this.orders.forEach(element => {
                if (newOrder.name == element.name && !exist) {
                    element.price = parseFloat(element.price);
                    element.price += parseFloat(newOrder.price);
                    element.price = Math.round(element.price * 100) / 100;
                    element.count++;
                    exist = true;
                }
            });
            return exist;
        }
    }
});

