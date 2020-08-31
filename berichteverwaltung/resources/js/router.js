import Vue from 'vue';
import Router from 'vue-router';
import App from './app.vue';
import Login from './components/login.vue';

Vue.use(Router);

export default new Router({
	mode: 'history',
	routes:
	[
		{
			path: '/',
			name: 'home',
			components: {default : App},
			props: {},
			children:[]
		},
		{
				path: '/login',
			name: 'login',
			components: {default: Login},
			props: {},
			children: [],
		}
	] 

);