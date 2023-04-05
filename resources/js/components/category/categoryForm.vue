<template>
    <div>
        <div v-if="this.deleteForm">
            <p>¿Estas seguro de eliminar el usuario N°{{ this.formConfig.item }}</p>
        </div>
        <div v-else>
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Nombre de la categoria:</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required v-model="this.$parent.formContent.name">
                </div>
                <div v-if="this.formResponse.reject" class="col-mb3 d-flex justify-content-center text-danger">
                    <p v-for="(e, i) in this.formResponse.data.errors.name" :key="i">{{ e }}</p>
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
            roles:false,
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
    async mounted(){
        await this.init()
    },
    methods:{
        async init(){
            this.buttons = document.querySelector('#buttons')
            if(this.userHasLogin){
                this.getProfile(this.userLogin)
            }else if(this.formConfig){
                if(this.formConfig.action === 'deleteItem') this.deleteForm = true;
                this.rolesForForm = await this.getAllRoles()
                this.roles = true
            }
        },
    }
}
</script>
