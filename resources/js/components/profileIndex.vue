<template>
    <div>
        <div class="container-ls p-2 d-flex overflow-hidden">
            <div class="p-2 flex-xl-fill" v-if="this.dataResponse">
                <profile-home-user v-if="this.user"/>
                <profile-home-admin v-else/>
            </div>
            <div class="p-2" v-else>
                load ...
            </div>
            <div class="p-2 ms-auto bd-aside-right">
                <profile-menu :auth-user="this.authUser"></profile-menu>
            </div>
        </div>
        <section>
            <div class="modal fade" id="profileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="profileModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form @submit.prevent="sendForm" enctype="multipart/form-data">
                            <div v-if="this.modal" class="modal-body">
                                <profile-form v-if="this.form.type=='users' " :form-config="this.form"></profile-form>
                                <category-form v-if="this.form.type=='categories'" :form-config="this.form"></category-form>
                                <product-form v-if="this.form.type=='products'" :form-config="this.form"></product-form>
                                <facture-form v-if="this.form.type=='factures'" :form-config="this.form"></facture-form>
                                <promotion-form v-if="this.form.type=='promotions'" :form-config="this.form"></promotion-form>
                            </div>
                            <div id="buttons" class="modal-footer"></div>
                        </form>
                    </div>
                </div>
            </div>
            <api-errors class="visually-hidden" v-if="this.formResponse.reject" :reject-response="this.formResponse.data"></api-errors>
        </section>
    </div>
</template>

<script>
import { profile } from "@/namespaces/profile"
import { categories } from "@/namespaces/categories"
import { shops } from "@/namespaces/shops"
import { products } from "@/namespaces/products"
import { promotions } from "@/namespaces/promotions"
import profileMenuVue from "./profile/profileMenu.vue"
import profileHomeAdminVue from "./profile/profileHomeAdmin.vue"
import profileHomeUserVue from "./profile/profileHomeUser.vue"
import profileFormVue from "./profile/profileForm.vue"
import promotionFormVue from "./promotions/promotionForm.vue"
import productFormVue from "./product/productForm.vue"
import categoryFormVue from "./category/categoryForm.vue"
import factureFormVue from "./shops/factureForm.vue"
import apiErrorsVue from "./handle/apiErrors.vue"


export default {
    mixins:[profile, categories, shops, products, promotions],
    props:{
        authUser:{
            type:null,
            required:true,
        },
    },
    components:{
        'profile-menu':profileMenuVue,
        'profile-home-admin':profileHomeAdminVue,
        'profile-home-user':profileHomeUserVue,
        'profile-form':profileFormVue,
        'promotion-form':promotionFormVue,
        'category-form':categoryFormVue,
        'product-form':productFormVue,
        'facture-form':factureFormVue,
        'api-errors':apiErrorsVue
    },
    data(){
        return{
            dataResponse:null,
            headResponse:null,
            modal:null,
            containerModal:null,
            buttons:null,
            form:{
                type:'',
                action:'',
                item:0,
            },
            formContent:{},
            formFiles:[],
            formResponse:{},
            htmlErrors:null
        }
    },
    async created(){
        await this.init()
    },
    async mounted(){
        await this.mount()
    },
    methods:{
        async init(){
            await this.setRoleConfig()
        },
        async mount(){
            this.containerModal = document.querySelector('#profileModal')
            this.buttons = document.querySelector('#buttons')
        },
        openFormModal(ev, form){
            if(this.formResponse.reject){
                this.htmlErrors = $('#apiErrors')[0]
                if(this.htmlErrors){
                    window.swal.fire({
                        html: this.htmlErrors.innerHTML
                    })
                }
            }
            this.modal = new window.bootstrap.Modal(this.containerModal, { keyboard:false })
            this.form.type = form
            this.form.action = ev.target.id
            if(ev.target.parentElement.attributes.rowitem){
                this.form.item = ev.target.parentElement.attributes.rowitem.value*1
            }else{
                this.form.item = 0
            }
            this.getButtons()
            this.containerModal.addEventListener('hidden.bs.modal', ()=>{
                this.destroyFromModal()
            })
            this.modal.show()
        },
        destroyFromModal(){
            this.modal=null
        },
        getButtons(){
            if(!this.form){
                return false
            }
            this.buttons.innerHTML = null
            switch(this.form.action){
                case 'editItem':
                    this.createButton(this.form.action, 'Editar', 'warning');break;
                case 'deleteItem':
                    this.createButton(this.form.action, 'Eliminar', 'danger');break;
                case 'createItem':
                    this.createButton(this.form.action, 'Crear', 'primary');break;
            }
            this.createButton('closeItem', 'Cerrar', 'secondary')
        },
        createButton(action, name, color){
            let configButton={
                class:`btn btn-${color} bg-gradient`,
            'data-bs-dismiss':'modal',
            value:name,
            id:`${action}Button`,
            type:'submit'
            }
            let newButton = document.createElement('button')
            newButton.innerHTML = name
            for(const [k, v] of Object.entries(configButton)){
                if(!(k === 'type' && action === 'closeItem')){
                    newButton.setAttribute(k, v)
                }
            }
            this.buttons.append(newButton)
        },
        createFormData(){
            const formProflieAdmin = new FormData()
            formProflieAdmin.append('name', 215135)
            for(const[k, v] of Object.entries(this.formContent) ){
                formProflieAdmin.append(`${k}`, `${v}`)
            }
            this.formFiles.forEach((e, i)=>{
                formProflieAdmin.append(`${e.name}`, e.file, e.title)
            })
            return formProflieAdmin
        },
        addFile(ev){
            this.formFiles.push({
                'name': ev.target.attributes.name.value,
                'file': ev.target.files[0],
                'title': ev.target.files.name
            })
        },
        async sendForm(){
            this.createFormData()
            switch(this.form.type){
                case 'categories':
                    await this.sendCategoryForm()
                break;
                case 'users':
                    await this.sendUserForm()
                break;
                case 'products':
                    await this.sendProductForm()
                break;
                case 'promotions':
                    await this.sendPromotionForm()
                break;
                case 'factures':
                    await this.sendFactureForm()
                break;
            }
        },
        async sendCategoryForm(){
            switch(this.form.action){
                case 'createItem':
                    this.formResponse = await this.createCategory(this.createFormData())
                break;
                case 'editItem':
                    this.formResponse = await this.editCategory(this.form.item, this.createFormData())
                break;
                case 'deleteItem':
                    this.formResponse = await this.deleteCategory(this.form.item, this.createFormData())
                break;
            }
        },
        async sendProductForm(){
            switch(this.form.action){
                case 'createItem':
                    this.formResponse = await this.createProduct(this.createFormData())
                break;
                case 'editItem':
                    this.formResponse = await this.editProduct(this.form.item, this.createFormData())
                break;
                case 'deleteItem':
                    this.formResponse = await this.deleteProduct(this.form.item, this.createFormData())
                break;
            }
        },
        async sendFactureForm(){
            switch(this.form.action){
                case 'createItem':
                    this.formResponse = await this.createFacture(this.createFormData())
                break;
                case 'editItem':
                    this.formResponse = await this.editFacture(this.form.item, this.createFormData())
                break;
                case 'deleteItem':
                    this.formResponse = await this.deleteFacture(this.form.item, this.createFormData())
                break;
            }
        },
        async sendUserForm(){
            switch(this.form.action){
                case 'createItem':
                    this.formResponse = await this.createProfile(this.createFormData())
                break;
                case 'editItem':
                    this.formResponse = await this.editProfile(this.form.item, this.createFormData())
                break;
                case 'deleteItem':
                    this.formResponse = await this.deleteProfile(this.form.item, this.createFormData());
                break;

            }
        },
        async sendPromotionForm(){
            switch(this.form.action){
                case 'createItem':
                    this.formResponse = await this.createPromotion(this.createFormData())
                break;
                case 'editItem':
                    this.formResponse = await this.editPromotion(this.form.item, this.createFormData())
                break;
                case 'deleteItem':
                    this.formResponse = await this.deletePromotion(this.form.item, this.createFormData())
                break;
            }
        },
    }
}
</script>
