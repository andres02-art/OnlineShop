<template>
    <div id="apiErrors">
        <div>
            <h1></h1>
        </div>
        <div v-for="(v, i) in this.rejectResponse.errors" :key="i">
            <h1> {{ this.titles[i] }} </h1>
            <p v-for="(v2, i2) in v" :key="i2">{{ v2 }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        rejectResponse:{
            type:Object,
            required:true
        }
    },
    data(){
        return{
            titles:[]
        }
    },
    created(){
        this.init()
    },
    methods:{
        init(){
            this.titles = Object.keys(this.rejectResponse.errors)
            console.log(this.titles)
        }
    }
}
</script>

