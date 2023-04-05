<template>

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">Nombre:</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" required v-model="this.$parent.formContent.name">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.name" :key="i">{{ e }}</p>
        </div>
    </div>

    <div class="row mb-3" v-if="this.category">
        <label for="role" class="col-md-4 col-form-label text-md-end">Categoria:</label>
        <div class="col-md-6">
            <vue-select class="vue" :options="this.categoryForForm" label="name" :reduce="category => category.id" v-model="this.$parent.formContent.category_id" ></vue-select>
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.role" :key="i">{{ e }}</p>
        </div>
    </div>

    <div class="row mb-3" v-if="this.promotion">
        <label for="role" class="col-md-4 col-form-label text-md-end">Promocion:</label>
        <div class="col-md-6">
            <vue-select class="vue" :options="this.promotionForForm" label="name" :reduce="promotion => promotion.id" v-model="this.$parent.formContent.promotion_id" ></vue-select>
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.role" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="img" class="col-md-4 col-form-label text-md-end">Imagen:</label>
        <div class="col-md-6">
            <input id="img" type="file" accept="image/*" class="form-control" name="img" required @change="this.$parent.addFile">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.name" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="precio" class="col-md-4 col-form-label text-md-end">Precio: </label>
        <div class="col-md-6">
            <input id="precio" type="number" class="form-control" name="precio" required v-model="this.$parent.formContent.precio">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.precio" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="mark" class="col-md-4 col-form-label text-md-end">Marca: </label>
        <div class="col-md-6">
            <input id="mark" type="text" class="form-control" name="mark" required v-model="this.$parent.formContent.mark">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.mark" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="company" class="col-md-4 col-form-label text-md-end">Empresa: </label>
        <div class="col-md-6">
            <input id="company" type="text" class="form-control" name="company" required v-model="this.$parent.formContent.company">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.company" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="catalogo" class="col-md-4 col-form-label text-md-end">Catalogo completo: </label>
        <div class="col-md-6">
            <textarea id="catalogo" type="text" class="form-control" name="catalogo" required v-model="this.$parent.formContent.catalogo"></textarea>
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.catalogo" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="description" class="col-md-4 col-form-label text-md-end">Descripcion general: </label>
        <div class="col-md-6">
            <textarea id="description" type="text" class="form-control" name="description" required v-model="this.$parent.formContent.description"></textarea>
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.description" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="prom" class="col-md-4 col-form-label text-md-end">¿Activa?</label>
        <div class="col-md-6">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="prom" id="btnradio1" autocomplete="off" checked v-model="this.$parent.formContent.prom">
                <label class="btn btn-outline-primary" for="btnradio1">No</label>
                <input type="radio" class="btn-check" name="prom" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio2">Si</label>
            </div>
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.prom" :key="i">{{ e }}</p>
        </div>
    </div>
</template>
<script>
import { profile } from '@/namespaces/profile'
import { categories } from '@/namespaces/categories'
import { promotions } from '@/namespaces/promotions'

export default {
    mixins:[profile, categories, promotions],
    props:{
        userHasLogin:{
            type:Boolean,
            required:false
        },
        userLogin:{
            type:Number,
            required:false
        },
        formConfig:{
            type:Object,
            required:false
        },
        responseReject:{
            type:Object,
            required:false
        }
    },
    data(){
        return{
            userForm:{},
            formResponse:{},
            buttons:null,
            promotion:null,
            category:null,
            promotionForForm:null,
            categoryForForm:null,
            fromContent:null
        }
    },
    created(){
        if(this.responseReject){
            this.formResponse={
                reject:true,
                data:{
                    errors:this.responseReject,
                }
            }
        }
    },
    async mounted(){
        await this.init()
    },
    async created(){
        let { categories }= await this.getAllCategories()
        this.categoryForForm=categories
        this.category = true
        let { promotions }= await this.getAllPromotions()
        this.promotionForForm=promotions
        this.promotion = true
    },
    methods:{
        async init(){
            this.buttons = document.querySelector('#buttons')
            if(this.userHasLogin){
                this.getProfile(this.userLogin)
            }else if(this.formConfig){
                if(this.formConfig.action === 'deleteItem') this.deleteForm = true;
            }
        },
        async sendForm(){
            this.formResponse = await this.registerProfile(this.userForm)
        },
        resetButtons(){
            this.buttons.innerHTML = null
        }
    }
}
</script>
