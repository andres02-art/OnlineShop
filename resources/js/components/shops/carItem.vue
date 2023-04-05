<template>
    <div>
        <div v-if="this.carActive">

        </div>
        <div v-else>
            <p class="fs-5">No hay carrito activo</p>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        carShop:{
            type:Array ,
            required:true
        }
    },
    data(){
        return{
            carActive:false
        }
    },
    methods:{
        init(){
            if(this.carShop){
                this.carActive=true
                this.fetchShops()
            }
        },
        fetchShops(){
            console.log(this.carShop)
        }
    },
    created(){
        this.init()
    },
}
</script>
