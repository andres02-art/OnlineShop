import {data, FETCH_RESPONSE_STATUS} from './data.js';

export const categories = new Object({
	extends: data,
	methods: {
		async getCategoriesContent() {
			return await this.query('/Categories/CategoriesContent');
		},
		async deleteCategory(id = null, request = null) {
			console.log('deleting');
			return await this.query(`/Categories/Root/deleteCategory/${id}`, 'delete', request);
		},
		async editCategory(id = null, request = null) {
			return await this.query(`/Categories/Root/editCategory/${id}`, 'post', request);
		},
		async createCategory(request = null) {
			return await this.query('/Categories/Root/createCategory', 'post', request);
		},
		async getAllCategories() {
			return await this.query('/Categories/allCategories');
		},
		async showCategoriesUser(id = null, redirect = null, request = null) {
			this.fetchBuffers = {
				url: '/Categories/User/view',
				method: 'fetch',
				required: `${id}/${false}`,
			};
			this.saveQueries();
			return await this.query(`/Categories/User/view/${id}/${redirect}`, 'fetch', request, redirect);
		},
		async showCategoriesAdmin(redirect = null, request = null) {
			this.fetchBuffers = {
				url: '/Categories/Root/categoriesAdmin',
				method: 'fetch',
				required: false,
			};
			this.saveQueries();
			return await this.query(`/Categories/Root/categoriesAdmin/${redirect}`, 'fetch', request, redirect);
		},
	},
});
