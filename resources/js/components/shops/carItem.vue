<template>
    <div>
        <div v-if="this.carActive">
            <form @submit.prevent="this.buyCarShop">
                <h1>Carrito: </h1>
                <div class="card m-2" v-for="(e, i) in this.carShop" :key="i">
                    <div class="card-header d-flex justify-content-between">
                        <h5>{{ e.item.name }}</h5><h5>N°{{ e.id }}</h5>
                    </div>
                    <div class="crad-body d-flex justify-content-center">
                        <div class="m-3 w-75">
                            <div class="row g-0">
                                <div class="d-flex flex-row gap-5">
                                    <p class="text fs-5">Precio:  </p><p>{{ e.item.precio }} $</p>
                                </div>
                                <div class="d-flex flex-row gap-5">
                                    <p class="text fs-5">Descripcion:  </p><p>{{ e.item.description }}</p>
                                </div>
                                <div class="d-flex flex-row gap-5">
                                    <p class="text fs-5">Disponibles:  </p><p>{{ e.item.stock }}</p>
                                </div>
                                <div class="d-flex flex-row gap-5">
                                    <p class="text fs-5">Marca:  </p><p>{{ e.item.mark }}</p>
                                </div>
                                <div class="col-md-4">
                                    <img v-if="e.item.img" :src="'/storage/products/imgs/'+e.item.img" class="img-fluid">
                                    <img v-else :src="'/storage/products/imgs/defaultImg.jpg'" class="img-fluid">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="d-flex flex-row justify-content-around">
                                            <p>Cargos del producto</p>
                                        </div>
                                        <hr>
                                        <div class="d-flex flex-row justify-content-around">
                                            <p>Iva(19%):  {{ e.iva }} $</p>
                                            <p>Envio:  {{ e.send }} $</p>
                                        </div>
                                        <hr>
                                        <div class="d-flex flex-row justify-content-around">
                                            <p>SubTotal:  {{ e.subTotal }} $</p>
                                            <p>Total:  {{ e.total }} $</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button @click="this.dropItem(i)" class="btn btn-danger"> Eliminar </button>
                                        <div class="d-flex align-items-center flex-row gap-2 ">
                                            <p>Cantidad: </p><input :iterator="i" disabled class="form-control" type="number" :name="'amount'+e.id" min="0" max="e.item.stock" :value="e.times">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button @click="this.changeAmount(1, i)" type="button" class="btn btn-light">+</button>
                                                <button @click="this.changeAmount(-1, i)" type="button" class="btn btn-light">-</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-around">
                    <p>Cargos totales del carrito</p>
                </div>
                <hr>
                <div class="d-flex flex-row justify-content-around">
                    <p>Iva(19%) del carrito:  {{ this.carCost.iva.toFixed(2) }} $</p>
                    <p>Envio del carrito:  {{ this.carCost.send.toFixed(2) }} $</p>
                </div>
                <hr>
                <div class="d-flex flex-row justify-content-around">
                    <p>SubTotal del carrito:  {{ this.carCost.subTotal.toFixed(2) }} $</p>
                    <p>Total del carrito:  {{ this.carCost.total.toFixed(2) }} $</p>
                </div>
                <hr>
                <button class="btn btn-primary" activity="buyCar">Comprar carrito</button>
            </form>
        </div>
        <div v-else>
            <p class="fs-5">No hay carrito activo</p>
        </div>
    </div>
</template>
<script>
import { shops } from '@/namespaces/shops'
import { profile } from '@/namespaces/profile'
export default {
    mixins:[shops, profile],
    props:{
        carShop:{
            type:Array ,
            required:true
        }
    },
    data(){
        return{
            carActive:false,
            carCost:{},
        }
    },
    methods:{
        init(){
            if(this.carShop.at()){
                this.carActive=true
                this.calculateCar()
            }
        },
        saveCarShop(){
            window.localStorage.setItem('Car', JSON.stringify(this.carShop))
        },
        calculateCar(){
            this.carShop.forEach((e)=>{
                e.send = 5000
                e.iva = (e.item.precio * 0.19).toFixed(4)*1
                e.subTotal = (e.iva*1 + e.send).toFixed(4)*1
                e.total = (e.item.precio * e.times + e.subTotal).toFixed(4)*1
            })
            this.carCost.send = 5000*this.carShop.length
            this.carCost.total=0
            this.carCost.subTotal=0
            this.carCost.iva=0
            this.carShop.forEach((e)=>{
                this.carCost.iva += e.iva
                this.carCost.subTotal += e.subTotal
                this.carCost.total += e.total
            })
            this.saveCarShop()
        },
        changeAmount(amount, i){
            this.carShop[i].times += amount
            if(this.carShop[i].times === 0){
                this.carShop[i].times += 1
                return false
            }else if(this.carShop[i].times > this.carShop[i].item.stock){
                this.carShop[i].times += -1
                return false
            }
            this.calculateCar()
        },
        dropItem(i){
            this.carShop.splice(i, 1)
            this.calculateCar()
        },
        makeForm(){
            let formCar = new FormData()
            formCar.append('owner_user_id', this.$parent.$parent.authUser)
            formCar.append('total_purchase', this.carCost.total)
            formCar.append('sub_total', this.carCost.subTotal)
            formCar.append('method', this.method)
            formCar.append('token', this.token)
            this.carShop.forEach((e, i)=>{
                formCar.append(`${e.id}`, i)
                formCar.append(`amount${e.id}`, e.times)
                formCar.append(`total_purchase${e.id}`, e.total)
                formCar.append(`sub_total${e.id}`, e.subTotal)
            })
            return formCar
        },
        async buyCarShop(ev){
            if(ev.submitter.attributes.activity.value === 'buyCar'){
                let resolve = await this.buyRequestCar(this.makeForm())
                window.localStorage.removeItem('Car')
                await this.showAccount(this.$parent.$parent.authUser, true)
            }
        }
    },
    created(){
        this.init()
    },
}
</script>
