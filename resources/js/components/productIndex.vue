<template>
    <div class="container-ls d-grid overflow-hidden">
        <form @submit.prevent="sendBuy">
            <div class="row">
                <div class="container col-8">
                    <div>
                        <facture-form v-if="this.buy" :userHasLogin="true" :userLogin="this.authUser" :product="this.productItem"></facture-form>
                        <product-item v-else  :product="this.productItem"></product-item>
                        <button v-if="this.buy" activity="buyProduct" class="btn btn-primary" >Comprar</button>
                    </div>
                    <div>
                        <product-information :product="this.productItem"></product-information>
                    </div>
                </div>
                <div class="container col-3">
                    <facture-aside-form v-if="this.buy"  :product="this.productItem"></facture-aside-form>
                    <product-list v-else :product="this.productItem"></product-list>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { products } from '@/namespaces/products'
import { shops } from '@/namespaces/shops'
import productItemVue from './product/productItem.vue'
import productListVue from './product/productList.vue'
import productInformationVue from './product/productInformation.vue'
import factureFormVue from './shops/factureForm.vue'
import factureAsideFormVue from './shops/factureAsideForm.vue'

export default {
    mixins:[products, shops],
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
            factureForm:{},
            buy:false,
            formDataFacture:null,
        }
    },
    components:{
        'product-item':productItemVue,
        'product-list':productListVue,
        'product-information':productInformationVue,
        'facture-form':factureFormVue,
        'facture-aside-form':factureAsideFormVue,
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
        },
        mount(){

        },
        openBuyForm(){
            if(this.authUser){
                this.buy = !this.buy
            }else{
                this.alertError(401)
            }
        },
        createFormData(){
            let newFormDataFacture = new FormData()
            for(const [k, v] of Object.entries(this.factureForm)){
                newFormDataFacture.append(`${k}`, v)
            }
            return newFormDataFacture
        },
        sendBuy(ev){
            switch(ev.submitter.attributes.activity.value){
                case 'addToCar':
                    if(!this.authUser){
                    return this.alertError(401)
                }else{
                    return this.alertInfo('El producto se ha añadido al carro, revisa el carrito en tu cuenta para comprarlo');
                }
                case 'buyProduct':
                    this.formDataFacture = this.createFormData()
                this.buyRequestItem(this.formDataFacture)
                ;break;
            }
        }
    }
}
</script>
