<template>
    <user-options ></user-options>
    <hr v-if="this.admin">
    <admin-options  v-if="this.admin"></admin-options>
</template>

<script>
import { profile } from '@/namespaces/profile'
import { shops } from '@/namespaces/shops'
import { categories } from '@/namespaces/categories'
import { FETCH_RESPONSE_DATA } from '@/namespaces/data'
import { FETCH_RESPONSE_STATUS } from '@/namespaces/data'
import { FETCH_RESPONSE_HEADERS } from '@/namespaces/data'
import adminOptionsVue from './menu/adminOptions.vue'
import userOptionsVue from './menu/userOptions.vue'

export default {
    mixins:[profile, shops, categories],
    props:{
        authUser:{
            type:null,
            required:true
        }
    },
    components:{
        'admin-options':adminOptionsVue,
        'user-options':userOptionsVue,
    },
    data(){
        return {
            redirect:true,
            canvas:null,
            autoLoad:null,
        }
    },
    async mounted(){
        await this.init()
    },
    methods:{
        async init(){
            this.canvas=document.querySelector('#profileSideBar')
            await this.setRoleConfig()
            this.setLocationConfig()
            this.autoOpen()
            this.autoFetchStorage()
            this.autoLoad = setInterval(()=>{
                if(FETCH_RESPONSE_STATUS){
                    this.$parent.dataResponse = FETCH_RESPONSE_DATA
                    this.$parent.headResponse = FETCH_RESPONSE_HEADERS
                }
            })
        },
        async autoFetchStorage(){
            this.retriveQueries()
            if(this.fetchBuffers){
                await this.query(`${this.fetchBuffers.url}/${this.fetchBuffers.required}`, 'fetch', null, false )
            }
            this.deleteQueries()
        },
        autoOpen(){
            if(!this.redirect){
                let canvas = new window.bootstrap.Offcanvas(this.canvas)
                canvas.show()
            }
        },
        setLocationConfig(){
            if(window.location.pathname.match(/^\/Profile.*/)){
this.redirect = false
            }
        },

    }
}
</script>
