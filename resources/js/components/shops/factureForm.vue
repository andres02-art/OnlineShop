<template>
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">Nombre:</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" required v-model="userForm.name">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.name" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="second_name" class="col-md-4 col-form-label text-md-end">Segundo nombre:</label>
        <div class="col-md-6">
            <input id="second_name" type="this.user.type" class="form-control" name="second_name" required v-model="userForm.second_name">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.second_name" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="last_name" class="col-md-4 col-form-label text-md-end">Apellidos: </label>
        <div class="col-md-6">
            <input id="last_name" type="text" class="form-control" name="last_name" required v-model="userForm.last_name">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.last_name" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="credentials" class="col-md-4 col-form-label text-md-end">Documento de identidad:</label>
        <div class="col-md-6">
            <input id="credentials" type="number" class="form-control" name="credentials" required v-model="userForm.credentials">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.credentials" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="born_date" class="col-md-4 col-form-label text-md-end">Fecha de nacimiento:</label>
        <div class="col-md-6">
            <input id="born_date" type="date" class="form-control" name="born_date" required v-model="userForm.born_date">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.born_date" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">Correo electronico:</label>
        <div class="col-md-6">
            <input id="email" type="address" class="form-control" name="email" required v-model="userForm.email">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.email" :key="i">{{ e }}</p>
        </div>
    </div>
    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-end">Nueva contraseña:</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required v-model="userForm.password">
        </div>
        <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
            <p v-for="(e, i) in this.formResponse.data.errors.password" :key="i">{{ e }}</p>
        </div>
        <div v-else class="bg-success"></div>
    </div>
    <div class="row mb-3">
        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirmar contraseña:</label>
        <div class="col-md-6">
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required v-model="userForm.password_confirmation">
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
                this.resetButtons()
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
