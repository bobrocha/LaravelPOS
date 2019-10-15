require('./bootstrap');

window.Vue = require('vue');

//console.log(action_url);
import AddItem from './components/Inventory/items/AddItem.vue';
import AddCategory from './components/Inventory/categories/AddCategory.vue';

const app = new Vue({
	el: '#app',
	components : {
		AddItem,
		AddCategory,
	},
});
