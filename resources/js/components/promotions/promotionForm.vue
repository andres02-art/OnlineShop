<template>
    <div>
        <div v-if="this.deleteForm">
            <p>¿Estas seguro de eliminar la promocion N°{{ this.formConfig.item }}</p>
        </div>
        <div v-else>
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Nombre:</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required v-model="this.$parent.formContent.name">
                </div>
                <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
                    <p v-for="(e, i) in this.formResponse.data.errors.name" :key="i">{{ e }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="sale" class="col-md-4 col-form-label text-md-end">Descuento general:</label>
                <div class="col-md-6">
                    <input id="sale" type="number" class="form-control" name="sale" required v-model="this.$parent.formContent.sale">
                </div>
                <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
                    <p v-for="(e, i) in this.formResponse.data.errors.sale" :key="i">{{ e }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="season" class="col-md-4 col-form-label text-md-end">Numero de temporada: </label>
                <div class="col-md-6">
                    <input id="season" type="number" class="form-control" name="season" required v-model="this.$parent.formContent.season">
                </div>
                <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
                    <p v-for="(e, i) in this.formResponse.data.errors.season" :key="i">{{ e }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="active" class="col-md-4 col-form-label text-md-end">¿Activa?</label>
                <div class="col-md-6">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="active" id="btnradio1" autocomplete="off" checked v-model="this.$parent.formContent.active">
                        <label class="btn btn-outline-primary" for="btnradio1">Si</label>
                        <input type="radio" class="btn-check" name="active" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnradio2">No</label>
                    </div>
                </div>
                <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
                    <p v-for="(e, i) in this.formResponse.data.errors.active" :key="i">{{ e }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="date_begin" class="col-md-4 col-form-label text-md-end">Fecha inicial:</label>
                <div class="col-md-6">
                    <input id="date_begin" type="date" class="form-control" name="date_begin" required v-model="this.$parent.formContent.date_begin">
                </div>
                <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
                    <p v-for="(e, i) in this.formResponse.data.errors.date_begin" :key="i">{{ e }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label for="date_end" class="col-md-4 col-form-label text-md-end">Fecha final:</label>
                <div class="col-md-6">
                    <input id="date_end" type="date" class="form-control" name="date_end" required v-model="this.$parent.formContent.date_end">
                </div>
                <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
                    <p v-for="(e, i) in this.formResponse.data.errors.date_end" :key="i">{{ e }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { profile } from '@/namespaces/profile'

export default {
    extends:profile,
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
            deleteForm:false,
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
    mounted(){
        this.init()
    },
    methods:{
        init(){
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
