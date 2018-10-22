var app3 = new Vue({
    el: '#pages_app',

    data: {
        showEditModalDisplay: '',
    },

    methods: {

        addPageShowModal: function () {
            this.showEditModalDisplay = 'block';
        },

        hideAddPageModal: function () {
            this.showEditModalDisplay = '';
        },
    }
});