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
    },
    methods: {
        restaurants() {
            axios.post(`http://127.0.0.1:8000/api/restaurants/${this.type}`)
                .then(response => {
                    this.firstSearch = false;
                    this.filteredRestaurants = response.data;
                    console.log(this.filteredRestaurants);
                    this.type = '';
                })
                .catch((error) => {
                    this.type = '';
                    this.firstSearch = false;
                      // when you throw error this will also fetch error.
                       throw error;
                  });
        },
        filterOnType(tipo) {
            axios.post(`http://127.0.0.1:8000/api/restaurants/${tipo}`)
                .then(response => {
                    this.filteredRestaurants = response.data;
                    // this.scrollToEnd();
                })
                .catch((error) => {
                    this.type = '';
                    this.firstSearch = false;
                      // when you throw error this will also fetch error.
                       throw error;
                  });
        },
        // scrollToEnd: function() {    	
        //     var container = this.$el.querySelector(".main_container");
        //     container.scrollTop = container.scrollHeight;
        //   },
    }
});
