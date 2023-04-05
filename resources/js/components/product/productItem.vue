<template>
    <div class="card mt-5 mb-5">
        <div v-if="this.product.img" class="w-100 bg-light d-flex justify-content-center">
            <img class="img-fluid" :src="'/storage/products/imgs/'+this.product.img">
        </div>
        <div v-else class="w-100 bg-light d-flex justify-content-center">
            <img src="/storage/products/imgs/defaultImg.jpg">
        </div>
        <div class="card-body">
            <h1>{{ this.product.name }}</h1>
            <div class="d-flex flex-row justify-content-between">
                <div>
                    <h5>{{ this.product.precio }} $</h5>
                </div>
                <div class="d-flex gap-3">
                    <button @click="buy" class="btn btn-primary bg-gradient">Comprar</button>
                    <button @click="addBuy" class="btn btn-secondary bg-gradient">Agregar al carrito</button>
                </div>
            </div>
        </div>
        <section>
            <buy-item :item="this.product" :authUser="this.$parent.authUser"></buy-item>
        </section>
    </div>
</template>
<script>
import { shops } from '@/namespaces/shops'
import { profile } from '@/namespaces/profile'
import buyItemVue from '@/components/shops/buyItem.vue'

export default {
    mixins:[shops, profile],
    props:{
        product:{
            type:Object,
            required:true,
        }
    },
    components:{
        'buy-item':buyItemVue
    },
    data(){
        return{
            buyRequest:{},
            sessionCar:[],
            response: null,
        }
    },
    created(){
        this.init()
    },
    methods:{
        init(){
            if(window.localStorage.getItem('Car')){
                this.sessionCar = JSON.parse(window.localStorage.getItem('Car'))
            }
        },
        async buy(){
            this.response = await this.buyItem(this.buyRequest)
        },
        addBuy(ev){
            if(!this.sessionCar.at()){
                this.sessionCar.push({ id:this.product.id, item: this.product, times:1 })
                window.localStorage.setItem('Car', JSON.stringify(this.sessionCar))
            }
            this.sessionCar.forEach((e, i, a)=>{
                if(e.id === this.product.id){
                    e.times++;
                    window.localStorage.setItem('Car', JSON.stringify(this.sessionCar))
                }else if(!(a.find((e2)=>e2.id===this.product.id))){
                    this.sessionCar.push({ id:this.product.id, item: this.product, times:1 })
                    window.localStorage.setItem('Car', JSON.stringify(this.sessionCar))
                }
            })
        }
    }
}
</script>
