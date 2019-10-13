require('./bootstrap');

window.Vue = require('vue');

//console.log(action_url);
import AddProduct from './components/Inventory/products/AddProduct.vue';
import AddCategory from './components/Inventory/categories/AddCategory.vue';

const app = new Vue({
	el: '#app',
	components : {
		AddProduct,
		AddCategory,
	},
});
