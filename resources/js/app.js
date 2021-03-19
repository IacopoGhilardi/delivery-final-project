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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import axios from 'axios';
import Vue from 'vue';

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
        allRestaurants: []
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
        finalPrice: 0
    },
    mounted() {
        //prendo i dati dal local storage e lo salvo nei miei data
        if (localStorage.getItem('orders') && localStorage.getItem('finalPrice')) {
            try {
              this.orders = JSON.parse(localStorage.getItem('orders'));
              this.finalPrice = JSON.parse(localStorage.getItem('finalPrice'));
            } catch(e) {
              localStorage.removeItem('orders');
              localStorage.removeItem('finalPrice');
            }
          }
    },
    methods: {
        stamp(x) {
            console.log(x);
        },
        addOrder(name, basePrice) {
            // ensure they actually typed something
            if (!name && !price) {
              return;
            }
            //salvo il nuovo ordine
            const newOrder = {name, basePrice, count: 1};
            //controllo se esiste e in tal caso sommo solo il prezzo
            if (!this.groupOrders(newOrder)) {
                this.orders.push(newOrder);
                this.finalPrice += parseFloat(newOrder.basePrice);
            }
            this.saveOrders();
        },
        removeOrder(name) {
        this.orders.forEach((element, index) => {
            if (element.name == name && element.count == 1) {
                this.orders.splice(index, 1);
                this.finalPrice += parseFloat(element.basePrice);
            } else if (element.name == name) {
                element.count--;
                this.finalPrice -= parseFloat(element.basePrice);
            }
        });
        this.saveOrders();
        },
        saveOrders() {
        const parsed = JSON.stringify(this.orders);
        const parsedPrice = JSON.stringify(this.finalPrice);
        localStorage.setItem('orders', parsed);
        localStorage.setItem('finalPrice', parsedPrice);
        },
        //raggruppo ordini con lo stesso ordine
        groupOrders(newOrder) {
            let exist = false;
            this.orders.forEach(element => {
                if (newOrder.name == element.name && !exist) {
                    element.count++;
                    this.finalPrice += parseFloat(newOrder.basePrice);
                    exist = true;
                }
            });
            return exist;
        },
    }
});

