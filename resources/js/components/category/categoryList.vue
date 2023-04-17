<template>
    <div>
        <div class="row m-3 position-fixed d-flex justify-content-center">
            <div class="col">
                <div class="list-group m-3" id="list-tab" role="tablist">
                    <a v-for="(e, i) in this.list.categories" :key="i" class="list-group-item list-group-item-action" :id="'list-'+e.name" data-toggle="list" @click="this.swapCategory(e.id)" role="tab" >{{ e.name }}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        list:{
            type:Object,
            required:true
        }
    },
    created(){
        this.init()
    },
    data(){
        return {
            categoriesNull:[],
        }
    },
    methods:{
        init(){
            this.list.categories.forEach((e, i)=>{
                if(!e.products.at()){
                    this.categoriesNull.push(i)
                }
            })
            this.categoriesNull.forEach((e, i)=>{
                this.list.categories.splice(e-i, 1)
            })
        },
        swapCategory(i){
            this.$emit('reload', i)
        }
    }
}
</script>
