<template>
    <div  v-for="(e, i) in this.listPromos.products" :key="i">
        <v-card class="p-3 sm">
            <v-img :src="e.img" cover></v-img>
            <v-card-title> {{ e.name }} </v-card-title>
            <v-card-text> {{ e.description }} </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    props:{
        listPromos:{
            type:Array,
            required:true
        },
    },
    created(){
        this.init()
        console.log(this.listPromos)
    },
    methods:{
        init(){
            this.loadPromos()
        },
        loadPromos(){

        }
    }
}
</script>
