<template>
    <div>
        <div v-if="this.account.Usersshops || this.car.at()">
            <car-item :car-shop="this.car"></car-item>
            <hr>
            <div v-if="this.account.Usersshops">
                <shop-list :shops-by-user="this.account.Usersshops.shops"></shop-list>
            </div>
        </div>
        <user-item v-else :profile="this.account"></user-item>
    </div>
</template>

<script>
import { FETCH_RESPONSE_DATA, FETCH_RESPONSE_STATUS, FETCH_RESPONSE_HEADERS } from '@/namespaces/data'
import { profile } from '@/namespaces/profile'
import userItemVue from './userItem.vue'
import carItemVue from '../shops/carItem.vue'
import shopListVue from '../shops/shopList.vue'

export default {
    extends:profile,
    data(){
        return{
            car:[],
            account:{},
            data:null,
            head:null,
            autoLoad:null,
            accountActive:false
        }
    },
    async created(){
        await this.init()
    },
    components:{
        'user-item':userItemVue,
        'car-item':carItemVue,
        'shop-list':shopListVue,
    },
    methods:{
        async init(){
            if(window.localStorage.getItem('Car')){
                this.car = JSON.parse(window.localStorage.getItem('Car'))
            }
            this.autoLoad = setInterval(()=>{
                if(FETCH_RESPONSE_STATUS){
                    this.data = FETCH_RESPONSE_DATA
                    this.head = FETCH_RESPONSE_HEADERS
                    if(FETCH_RESPONSE_HEADERS.profiledatatable === "1"){
                        this.$emit('loadadmin')
                    }
                }else{
                    this.closeAccount()
                }
                if(FETCH_RESPONSE_STATUS && this.accountActive){
                    this.data = null
                    this.head = null
                }
                if(this.data && this.head){
                    this.initAccount(this.data, this.head)
                    this.data=null
                    this.head=null
                }
            }, 500)
        },
        async initAccount(){
            if(!this.head.form){
                this.ownerFetch = false
                await this.showAccount(this.$parent.authUser).then(async ()=>{
                    await this.initAccount()
                })
            }
            this.account = this.data
            this.accountActive=true
        },
        closeAccount(){
            this.accountActive=false
        },
        assignData(x){
            this.dataResponse = x
        }

    }
}
</script>
