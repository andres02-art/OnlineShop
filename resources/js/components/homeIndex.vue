<template>
    <div class="container">
        <section id="Promotions" class="container-ls overflow-hidden mx-3 my-3 gap-3 d-flex align-content-stretch flex-wrap">
            <promotions-home v-for="(e, i) in this.productsByPromotion" :key="i" :list-promos="e"></promotions-home>
        </section>
        <section id="Categories" class="">
            <category-items-row v-for="(e, i) in this.productsByCategory" :key="i" :item-row="e"></category-items-row>
        </section>
        <v-btn></v-btn>
    </div>
</template>

<script>
import promotionsHomeVue from "./home/promotionsHome.vue"
import categoryItemsRowVue from "./category/categoryItemsRow.vue"
import { promotions } from "@/namespaces/promotions"
import { categories } from "@/namespaces/categories"

export default {
    mixins: [promotions, categories],

    data(){
        return {
            productsByPromotion:Array,
            productsByCategory:Array
        }
    },

    components:{
        'promotions-home':promotionsHomeVue,
        'category-items-row':categoryItemsRowVue
    },

    methods:{
        async init(){
            let {productsByPromotion} = await this.getPromotionsContent()
            this.productsByPromotion = productsByPromotion
            let {productsByCategory} = await this.getCategoriesContent()
            this.productsByCategory = productsByCategory
        },
    },

    async created(){
        await this.init()
    }

}
</script>
