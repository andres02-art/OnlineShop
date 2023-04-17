import {data} from './data.js';

export const promotions = new Object({
	extends: data,
	data() {
		return {
			activePromotionID: Number,
		};
	},
	methods: {
		async getPromotionsContent() {
			await this.activePromotion();
			return await this.query(`/Promotions/PromotionContent/${this.activePromotionID}`);
		},
		async getAllPromotions() {
			return await this.query('/Promotions/allPromotions');
		},
		async showPromotionsAdmin(redirect = null, request = null) {
			this.fetchBuffers = {
				url: '/Promotions/Root/promotionsAdmin',
				method: 'fetch',
				required: false,
			};
			this.saveQueries();
			return await this.query(`/Promotions/Root/promotionsAdmin/${redirect}`, 'fetch', request, redirect);
		},
		async deletePromotion(id = null, request = null) {
			return await this.query(`/Promotions/Root/deletePromotion/${id}`, 'delete', request);
		},
		async editPromotion(id = null, request = null) {
			return await this.query(`/Promotions/Root/editPromotion/${id}`, 'post', request);
		},
		async createPromotion(request = null) {
			return await this.query('/Promotions/Root/createPromotion', 'post', request);
		},
		async activePromotion() {
			const {promotions} = await this.getAllPromotions();
			for (const element of promotions) {
				if (element.active === '1') {
					this.activePromotionID = element.id;
				}
			}
		},
	},
});
