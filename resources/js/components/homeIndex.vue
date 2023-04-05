<template>
    <div class="container">
        <section id="Promotions" class="container-ls overflow-hidden mt-5 mb-5">
            <promotions-home v-for="(e, i) in this.promotionContent" :key="i" :list-promos="e"></promotions-home>
        </section>
        <section id="Categories" class="mt-2 mb-1">
            <category-items-row v-for="(e, i) in this.categoriesContent" :key="i" :item-row="e"></category-items-row>
        </section>
    </div>
</template>

<script>
import promotionsHomeVue from "./home/promotionsHome.vue"
import categoryItemsRowVue from "./category/categoryItemsRow.vue"
import { promotions } from "@/namespaces/promotions"
import { categories } from "@/namespaces/categories"
import { products } from "@/namespaces/products"

export default {
    mixins: [promotions, categories, products],

    data(){
        return {
            promotionContent:Array,
            categoriesContent:Array
        }
    },

    components:{
        'promotions-home':promotionsHomeVue,
        'category-items-row':categoryItemsRowVue
    },

    methods:{
        async init(){
            let {productsByPromotion} = await this.getPromotionsContent()
            this.promotionContent = productsByPromotion
            let {productsByCategories} = await this.getCategoriesContent()
            this.categoriesContent = productsByCategories
        },
        async buyItem(ev){
            await this.ShowProduct(ev.target.attributes.myproductid.value*1)
        },
    },

    async created(){
        await this.init()
    }

}
</script>
