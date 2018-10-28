var app3 = new Vue({
    el: '#pages_app',

    data: {
        products: JSON.parse(localStorage.getItem("products")),
        string_products: localStorage.getItem("products"),
    },

    methods: {
        addProdBasket: function(idproduct, name, desc, price, category) {
            this.products.push({ idproduct: idproduct, name: name, desc: desc, price: price, category: category });

            localStorage.setItem('products', JSON.stringify(this.products));
        },
        deleteProduct: function(index) {
            this.products.splice(index, 1);
            localStorage.setItem('products', JSON.stringify(this.products));
        },
        deleteLocalStorage: function() {
            localStorage.removeItem("products");
            localStorage.clear();
        }
    }
});