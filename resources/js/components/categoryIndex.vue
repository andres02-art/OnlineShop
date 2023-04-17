<template>
<div>
<div v-if="this.listCategories && this.categoryItem" class="container-fluid d-flex flex-row p-5">
<category-list class="col-3" :list="this.listCategories" @reload="this.reloadCategory"></category-list>
<div v-if="this.load" class="col-8">
<all-category :category=this.categoryItem.at()></all-category>
</div>
</div>
<div v-else> load ...</div>
</div>
</template>

<script>
import allCategory from "./category/allCategory.vue"
import categoryList from "./category/categoryList.vue"
import { categories } from "@/namespaces/categories"
export default {
extends:categories,
            props:{
authUser:{
type:null,
     required:true
         },
categoryDefault:{
type:Number,
     required:true
                }
            },
            data(){
                return{
categoryItem:null,
             listCategories:null,
             load:true,
                }
            },
            async created(){
                await this.init()
            },
components:{
               allCategory,
               categoryList
           },
methods:{
            async init(){
                this.categoryItem = await this.getAllContent(this.categoryDefault, this.offset, this.limit)
                    this.listCategories = await this.getAllCategories()
            },
            async reloadCategory(i){
                this.load = false
                    this.offset += this.limit
                    this.categoryItem = await this.getAllContent(i, this.offset, this.limit)
                    this.load = true
            },
        }
}
</script>
