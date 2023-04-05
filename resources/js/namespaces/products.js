import {data} from './data.js';

export const products = new Object({
	extends: data,
	methods: {
		async showProductsAdmin(redirect = null, request = null) {
			this.fetchBuffers = {
				url: '/Search/Root/productsAdmin',
				method: 'fetch',
				required: false,
			};
			this.saveQueries();
			return await this.query(`/Search/Root/productsAdmin/${redirect}`, 'fetch', request, redirect);
		},
		async deleteProduct(id = null, request = null) {
			console.log('deleting');
			return await this.query(`/Search/Root/deleteProduct/${id}`, 'delete', request);
		},
		async editProduct(id = null, request = null) {
			return await this.query(`/Search/Root/editProduct/${id}`, 'post', request);
		},
		async createProduct(request = null) {
			return await this.query('/Search/Root/createProduct', 'post', request);
		},
		async ShowProduct(id = null, redirect = true, request = null) {
			return await this.query(`/Product/showProduct/${id}`, 'fetch', request, true);
		},
		async getProduct(id = null) {
			return await this.query(`/Product/getProduct/${id}`);
		},
	},
});
