<template>
    <div>
        <div>
            <car-item :car-shop="this.car"></car-item>
        </div>
        <user-item :profile="this.lastAccount"></user-item>
    </div>
</template>

<script>
import { FETCH_RESPONSE_DATA, FETCH_RESPONSE_STATUS, FETCH_RESPONSE_HEADERS } from '@/namespaces/data'
import { profile } from '@/namespaces/profile'
import userItemVue from './userItem.vue'
import carItemVue from '../shops/carItem.vue'

export default {
    extends:profile,
    data(){
        return{
            lastAccount:{},
            data:null,
            head:null,
            autoLoad:null,
            account:false
        }
    },
    async created(){
        await this.init()
    },
    components:{
        'user-item':userItemVue,
        'car-item':carItemVue,
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
                }else{
                    this.closeAccount()
                }
                if(FETCH_RESPONSE_STATUS && this.account){
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
        async initAccount(data, head){
            if(!this.head.form){
                this.ownerFetch = false
                await this.showAccount(this.$parent.authUser).then(async ()=>{
                    await this.initAccount()
                })
            }
            this.lastAccount=data
            this.account=true
        },
        closeAccount(){
            this.account=false
        },
        assignData(x){
            this.dataResponse = x
        }

    }
}
</script>
