require('./bootstrap');

window.Vue = require('vue');

import Categories from './components/Inventory/categories/Categories.vue';

const app = new Vue({
	el: '#app',
	components : {
		Categories,
	},
});
