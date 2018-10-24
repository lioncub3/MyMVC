var app3 = new Vue({
    el: '#pages_app',

    data: {
        
    },

    methods: {
        addProdBasket: function(idproduct, name, desc, price) {
            console.log(idproduct + " " + name + " " + desc + " " + price);
        }
    }
});