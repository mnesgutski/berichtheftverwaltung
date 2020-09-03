import Vue from 'vue';
import Router from 'vue-router';
import App from './app.vue';
import Login from './components/login.vue';
import ReportBooks from './components/reportBooks.vue';
import CreateReportBook from './components/CreateReportBook'

Vue.use(Router);

export default new Router({
	mode: 'history',
	routes:
	[
		{
			path: '/login',
			name: 'login',
			components: {default: Login},
			props: {},
			children: [],
		},
		{
			path: '/reportBooks',
			name: 'reportBooks',
			components: {default: ReportBooks},
			props: {},
			children: [],
		},
		{
			path: '/createReportBook',
			name: 'createReportBook',
			components: {default: CreateReportBook},
			props: {},
			children: [],
		}
		
	],

});