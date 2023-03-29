import {data} from './data';

export const promotions = new Object({
    extends: data,
    data(){
        return{
            activePromotionID : Number
        }
    },
    methods: {
        async getPromotionsContent() {
            await this.activePromotion()
            return await this.fetch(`/Promotions/PromotionContent/${this.activePromotionID}`);
        },
        async getAllPromotions(){
            return await this.fetch('/Promotions/allPromotions');
        },
        async activePromotion(){
            let { promotions } = await this.getAllPromotions()
            promotions.forEach(element => {
                if (element.active) {
                    this.activePromotionID = element.id
                }
            });
        }
    },
});
