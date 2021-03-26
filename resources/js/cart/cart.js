window.Vue = require('vue');
import Vue from 'vue';


const cart = new Vue({
    el: '#cart',
    data: {
        orders: [],
    },
    mounted() {
        //prendo i dati dal local storage e lo salvo nei miei data
        if (localStorage.getItem('orders')) {
            try {
              this.orders = JSON.parse(localStorage.getItem('orders'));
            } catch(e) {
              localStorage.removeItem('orders');
            }
          }
    },
    methods: {
        addOrder(name, basePrice, restaurantId, dishId) {
            // ensure they actually typed something
            if (!name && !price) {
              return;
            }
            //salvo il nuovo ordine
            const newOrder = {name, basePrice, count: 1, restaurantId, dishId};
            //controllo se esiste e in tal caso sommo solo il prezzo
            if (!this.groupOrders(newOrder)) {
                this.orders.push(newOrder);
            }
            this.saveOrders();
        },
        removeOrder(name) {
        this.orders.forEach((element, index) => {
            if (element.name == name && element.count == 1) {
                this.orders.splice(index, 1);
            } else if (element.name == name) {
                element.count--;
            }
        });
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
                if (newOrder.name == element.name && !exist && newOrder.restaurantId == element.restaurantId) {
                    element.count++;
                    exist = true;
                }
            });
            return exist;
        },
        findMyOrders(restaurantId) {
           const filteredOrders =  this.orders.filter(element => {
                return element.restaurantId == restaurantId;
            })
            let finalPrice = 0;
            filteredOrders.forEach(element => {
                finalPrice += (parseFloat(element.basePrice) * element.count);
            });
            finalPrice = (Math.round(finalPrice * 100) / 100).toFixed(2);
            return {filteredOrders, "finalPrice" : [finalPrice]};
        },
    }
});

