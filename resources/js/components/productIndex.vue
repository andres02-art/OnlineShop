<template>
    <div class="container-ls d-grid overflow-hidden">
        <div class="row">
            <div class="container col-8">
                <div>
                    <product-item  :product="this.productItem"></product-item>
                </div>
                <div>
                    <product-information :product="this.productItem"></product-information>
                </div>
            </div>
            <div class="container col-3">
                <product-list :product="this.productItem"></product-list>
            </div>
        </div>
    </div>
</template>

<script>
import { products } from '@/namespaces/products'
import productItemVue from './product/productItem.vue'
import productListVue from './product/productList.vue'
import productInformationVue from './product/productInformation.vue'

export default {
    extends:products,
    props:{
        productItemId:{
            type:Number,
            required:true
        },
        authUser:{
            type:null,
            required:true
        }
    },
    data(){
        return {
            productItem:{},
        }
    },
    components:{
        'product-item':productItemVue,
        'product-list':productListVue,
        'product-information':productInformationVue,
    },
    async created(){
        await this.init()
    },
    mounted(){
        this.mount()
    },
    methods:{
        async init(){
            this.productItem = await this.getProduct(this.productItemId)
            console.log(this.productItem)
        },
        mount(){

        }
    }
}
</script>
