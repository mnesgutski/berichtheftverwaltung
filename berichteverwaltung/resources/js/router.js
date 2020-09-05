import Vue from 'vue';
import Router from 'vue-router';
import App from './app.vue';
import Login from './components/login.vue';
import ReportBooks from './components/reportBooks.vue';
import CreateReportBook from './components/createReportBook.vue';
import Reports from './components/reports.vue';
import CreateReport from './components/createReport.vue';
import Entries from './components/entries.vue';

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
			meta: {header_name: 'Berichtshefte'}
		},
		{
			path: '/createReportBook',
			name: 'createReportBook',
			components: {default: CreateReportBook},
			props: {},
			children: [],
			meta: {header_name: 'Berichtsheft erstellen'}
		},
		{
			path: '/reports',
			name: 'reports',
			components: {default: Reports},
			props: {},
			children: [],
			meta: {header_name: 'Berichte'}
		},
		{
			path: '/createReport',
			name: 'createReport',
			components: {default: CreateReport},
			props: {},
			children: [],
			meta: {header_name: 'Bericht erstellen'}
		},
		{
			path: '/entries',
			name: 'entries',
			components: {default: Entries},
			props: {},
			children: [],
			meta: {header_name: 'Einträge'}
		}

	],

});
