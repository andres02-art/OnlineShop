<template>
    <div @change="this.updateForm()">

        <!-- vista previa usuario-->
        <div v-if="this.buyer" class="card mb-3 row" >
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Usuario</h5>
                        <p class="card-text">Nombre: {{ this.buyer.name }}</p>
                        <p class="card-text">Correo: {{ this.buyer.email }}</p>
                        <p class="card-text">Documento: {{ this.buyer.credentials }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- vista previa producto-->
        <div class="card mb-3 row" >
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Producto</h5>
                        <p class="card-text">Nombre: {{ this.product.name }}</p>
                        <p class="card-text">Precio: {{ this.product.precio }}</p>
                        <p class="card-text">Marca: {{ this.product.mark }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- formulario escencial -->
        <div class="row mb-3">
            <label for="method" class="col-md-4 col-form-label text-md-end">Metodo de pago:</label>
            <div class="col-md-6">
                <vue-select :options="this.payMethods" v-model="this.$parent.factureForm.method"></vue-select>
            </div>
            <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
                <p v-for="(e, i) in this.formResponse.data.errors.method" :key="i">{{ e }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label for="token" class="col-md-4 col-form-label text-md-end">Token:</label>
            <div class="col-md-6">
                <input type="number" class="form-control" disabled :value="this.$parent.factureForm.token" name="token">
            </div>
            <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
                <p v-for="(e, i) in this.formResponse.data.errors.token" :key="i">{{ e }}</p>
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
        },
        product:{
            type:Object,
            required:true
        }
    },
    data(){
        return{
            payMethods:[
                'Paypal',
                'Credito',
                'Debito',
            ],
            formResponse:{},
            buyer:null,
        }
    },
    async created(){
        if(this.responseReject){
            this.formResponse={
                reject:true,
                data:{
                    errors:this.responseReject,
                }
            }
        }
        await this.init()
    },
    methods:{
        async init(){
            this.$parent.factureForm.token = Date.now()
            let { user } = await this.getProfile(this.userLogin)
            this.buyer = user
            this.$parent.factureForm.type_id = 1
            this.$parent.factureForm.product_id = this.product.id
            this.$parent.factureForm.product_id = this.product.id
            this.$parent.factureForm.owner_user_id = this.buyer.id
        },
    }
}
</script>
