import {data} from './data.js';

export const shops = new Object({
	extends: data,
	data() {
		return {
			car: null,
		};
	},
	methods: {
		async showShopsAdmin(redirect = null, request = null) {
			this.fetchBuffers = {
				url: '/Shops/Confirm/Root/shopsAdmin',
				method: 'fetch',
				required: false,
			};
			this.saveQueries();
			return await this.query(`/Shops/Confirm/Root/shopsAdmin/${redirect}`, 'fetch', request, redirect);
		},
		async showShopsUser(id = null) {
			return await this.query(`/Bought/list/${id}`);
		},

	},
});
