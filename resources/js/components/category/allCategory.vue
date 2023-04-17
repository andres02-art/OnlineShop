<template>
    <section>
        <h1 class="mt-4">{{ this.category.name }}</h1>
        <div class="d-flex justify-content-around align-items-stretch flex-row flex-wrap m-3">
            <div v-for="(e, i) in this.category.products" :key="i" class="w-25 mb-3" >
                <div class="card h-100 m-3 d-flex align-items-stretch">
                    <div class="card-header">
                        <h5>{{ e.name }}</h5>
                    </div>
                    <div class="card-body">
                        <img class="img-fluid" :src="'/storage/products/imgs/'+(e.img??'defaultImg.jpg')" alt="">
                        <hr>
                        <h5>{{ e.precio }}</h5>
                        <p>{{ e.description }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-primary" @click="this.ShowProduct(e.id)">Comprar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { products } from '@/namespaces/products'
export default {
    extends:products,
    props:{
        category:{
            type:Object,
            required:true,
        }
    },
}
</script>
