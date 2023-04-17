<template>
    <div  class="mt-5">
        <div @click="this.$parent.ShowProduct(e.id)" v-for="(e, i) in this.list" class="card mb-3" style="max-width: 540px;" :key="i">
            <div class="row g-0">
                <div class="col-md-4">
                    <img v-if="e.img" :src="'/storage/products/imgs/'+e.img" class="img-fluid rounded-start" alt="...">
                    <img v-else src="/storage/products/imgs/defaultImg.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ e.name }}</h5>
                        <p class="card-text">{{ e.precio }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
props:{
product:{
type:Object,
         required:true
        }
      },
          data(){
              return {
list:Object,
              }
          },
          async created(){
              await this.init()
          },
methods:{
            async init(){
                this.list = await this.$parent.getProducts()
            },
            swapItem(i){
                console.log(i)
            }
        },
}
</script>
