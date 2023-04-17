<template>
    <div>
        <div v-if="this.hasItems">
            <div :id=this.promotion+this.listPromos.id class="carousel slide promotion-carousel mb-5"  data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active h-100">
                        <div class="card d-block bg-dark bg-gradient text-white">
                            <img src="/storage/products/imgs/primavera.jpg" class="promotion-carousel card-img rounded-1 w-100 d-block">
                            <div class="card-img-overlay d-flex align-items-end">
                                <div>
                                    <h5 class="card-title fs-2 fw-bold">{{ this.listPromos.name }}</h5>
                                    <p class="card-text fs-5">{{ this.listPromos.sale??'50%' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item h-100" v-for="(e, i) in this.listPromos.products" :key="i">
                        <div class="card d-block bg-dark bg-gradient text-white ">
                            <img v-if="e.img"  :src="'/storage/products/imgs/'+e.img" class="promotion-carousel card-img rounded-1 w-100 d-block">
                            <img v-else  src="/storage/products/imgs/primavera.jpg" class="promotion-carousel card-img rounded-1 w-100 d-block">
                            <div :myproductid="this.listPromos.products[i].id" @click="this.$parent.buyItem" class="card-img-overlay d-flex align-items-end">
                                <div>
                                    <h5 class="card-title fs-2 fw-bold">{{ e.name }}</h5>
                                    <p class="card-text fs-5">{{ e.precio }} $</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" :data-bs-target=this.id+this.promotion+this.listPromos.id data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" :data-bs-target=this.id+this.promotion+this.listPromos.id data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div v-else></div>
    </div>
</template>

<script>
import promotionFormVue from "../promotions/promotionForm.vue"
export default {
    props:{
        listPromos:{
            type:Object,
            required:true,
            carousel:null
        },
    },
    data(){
        return{
            hasItems:false,
            promotion:'CarouselPromotions',
            id:'#'
        }
    },
    mounted(){
        this.init()
    },
    created(){
        if(this.listPromos.products.at()){
            this.hasItems=true
        }
    },
    methods:{
        init(){
            if(this.hasItems){
                this.carousel=document.querySelector(`#${this.promotion}${this.listPromos.id}`)
                this.createCarousel()
            }
        },
        createCarousel(){
            let promotionCarousel = new window.bootstrap.Carousel(this.carousel, {
                keyboard:false,
                interval:30000
            })
        },
    }
}
</script>
