<template>
    <div class="card">
        <div class="card-header">
            <h1>Articulos comprados</h1>
            <div class="card-body">
                <div class="card">
                    <div class="card m-2" v-for="(e, i) in this.dates" :key="i">
                        <div v-if="e[2]">
                            <div class="card-header d-flex justify-content-between">
                                <h1>carrito N°{{ this.cars[e[2]][0].factures.car_id }}</h1>
                            </div>
                            <div v-for="(e2, i2) in this.cars[e[2]]" :key="i2">
                                <div class="card m-2">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p>Precio: {{ e2.factures.total_purchase }} $</p>
                                                <div v-if="e2.factures.shop_confirm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <p>Metodo: {{ e2.factures.method }}</p>
                                                <p>Fecha: {{ e2.factures.date_shop }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div v-if="e2.factures.product">
                                                <p>Producto: {{ e2.factures.product.name }}</p>
                                                <p>Costo: {{ e2.factures.product.precio }}</p>
                                                <p>Cantidad: {{ e2.factures.amount }}</p>
                                            </div>
                                            <div v-if="e2.factures.product" class="card" style="width: 18rem;">
                                                <img class="card-img-top" :src="'/storage/products/imgs/'+(e2.factures.product.img??'defaultImg.jpg')" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h1>Factura N°{{ this.factures[e[1]].id }}</h1>
                                    <h1>{{ this.factures[e[1]].token }}</h1>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p>Precio: {{ this.factures[e[1]].factures.total_purchase }} $</p>
                                            <div v-if="this.factures[e[1]].shop_confirm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <p>Metodo: {{ this.factures[e[1]].factures.method }}</p>
                                            <p>Fecha: {{ this.factures[e[1]].date_shop }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div v-if="this.factures[e[1]].factures.product">
                                            <p>Producto: {{ this.factures[e[1]].factures.product.name }}</p>
                                            <p>Costo: {{ this.factures[e[1]].factures.product.precio }}</p>
                                            <p>Cantidad: {{ this.factures[e[1]].factures.amount }}</p>
                                        </div>
                                        <div v-if="this.factures[e[1]].factures.product" class="card" style="width: 18rem;">
                                            <img class="card-img-top" :src="'/storage/products/imgs/'+(this.factures[e[1]].factures.product.img??'defaultImg.jpg')" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { shops } from "../../namespaces/shops"
export default {
    props:{
        shopsByUser:Array,
        required:true
    },
    data(){
        return{
            cars:[],
            factures:[],
            dates:[],
        }
    },
    created(){
        this.init()
    },
    methods:{
        init(){
            let ifacture=0
            this.shopsByUser.forEach((e)=>{
                if(!e.factures.car_id){
                    this.factures.push(e)
                    this.dates.push([ e.date_shop, ifacture, e.factures.car_id ])
                    ifacture +=1
                }else if(!this.cars[e.factures.car_id]){
                    this.cars[e.factures.car_id] = [ e ]
                    this.dates.push([ e.date_shop, e.id, e.factures.car_id ])
                }else{
                    this.cars[e.factures.car_id].push(e)
                    this.dates.push([ e.date_shop, e.id, e.factures.car_id ])
                }
            })
            this.dates.forEach((e, i, a)=>{
                if(e[2]){
                    this.dates.splice(i, (this.cars[e[2]].length-1))
                }
            })
            this.dates = this.dates.reverse()
        }
    }
}
</script>
