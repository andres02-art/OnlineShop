<template>
    <div>
        <div v-if="this.hasItems" class="mb-5">
            <div class="d-flex justify-content-between ">
                <h2>Categoria {{ this.itemRow.name }}</h2>
                <button @click="this.showAllCategory(this.itemRow.id)" class="btn btn-secondary">Ver todo</button>
            </div>
            <div :id="'RowItems'+this.itemRow.id" class="product-row container-ls bg-light d-flex align-items-stretch flex-nowrap">
                <div class="card product-card m-3" v-for="(e, i) in this.itemRow.products" :key="i">
                    <img :src="this.productsImg+(e.img??'defaultImg.jpg')" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h2 class="card-title">{{ e.name }}</h2>
                        <h5 class="card-title">{{ e.precio }} $</h5>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button :myproductid="e.id" @click="this.$parent.buyItem" class="btn btn-primary">Comprar</button>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-secondary" @click="prevPage()">
                    prev
                </button>
                <button class="btn btn-light text-primary" @click="nextPage()">
                    next
                </button>
            </div>
        </div>
        <div v-else></div>
    </div>
</template>

<script>
import { categories } from '@/namespaces/categories'
export default {
    extends:categories,
    props:{
        itemRow:{
            type:Object,
            require:true
        }
    },
    data(){
        return {
            hasItems:false,
            rowContainer:null,
            randomInterval:Number,
            rangeScroll:1085,
            intervalScrolling:true,
            reset:null,
            productsImg:'/storage/products/imgs/'
        }
    },
    created(){
        if(this.itemRow.products.at()){
            this.hasItems=true
        }
    },
    mounted(){
        this.init()
    },
    methods:{
        init(){
            if(this.hasItems){
                this.rowContainer = document.querySelector(`#RowItems${this.itemRow.id}`)
                this.randomInterval = Math.floor(Math.random()*2+1)*10000
                this.defineInterval()
            }
        },
        defineInterval(){
            setInterval(()=>{
                if(this.intervalScrolling){
                    this.autoScrolling()
                }
            }, this.randomInterval)
        },
        autoScrolling(){
            if(this.rowContainer.scrollLeft > this.rangeScroll*4){
                this.rowContainer.scrollLeft=0;
            }else{
                this.rowContainer.scrollLeft += this.rangeScroll
            }
        },
        prevPage(){
            this.resetScrollingInterval()
            this.rowContainer.scrollLeft -= this.rangeScroll
        },
        nextPage(){
            this.resetScrollingInterval()
            this.rowContainer.scrollLeft += this.rangeScroll
        },
        resetScrollingInterval(){
            this.intervalScrolling = false
            if(!this.reset){
                this.reset = setTimeout(()=>{
                    this.intervalScrolling = true
                    this.reset= null
                }, 30000)
            }
        },
    },
    detroyed(){
        clearInterval(this.intervalScrolling)
    }
}
</script>
