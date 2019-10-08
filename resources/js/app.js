require('./bootstrap');

window.Vue = require('vue');


import AddProduct from './components/Inventory/products/AddProduct.vue';
import AddCategory from './components/Inventory/categories/AddCategory.vue';

const app = new Vue({
	el: '#app',
	components : {
		AddProduct,
		AddCategory,
	},
});
