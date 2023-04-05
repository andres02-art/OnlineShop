
<template>
    <div class="p-3 card">
        <div class="card-head d-flex justify-content-between">
            <h1 id="profileAdminTableTitle"></h1>
            <button class="btn btn-primary" id="createItem">Crear</button>
        </div>
        <div class="card-body">

            <table class="table m-3 p-2" id="profileAdminTable">
                <thead id="profileAdminTableHead">
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</template>

<script>
import {FETCH_RESPONSE_DATA, FETCH_RESPONSE_STATUS, FETCH_RESPONSE_HEADERS} from '@/namespaces/data'
import { profile } from '@/namespaces/profile'

export default {
    extends:profile,
    mounted(){
        this.init
    },
    data(){
        return{
            data:null,
            head:null,
            autoLoad:null,
            responseLoad:null,
            datatable:false,
            button:null,
            title:null,
            table:null,
            form:null,
            ownerFetch:null
        }
    },
    mounted(){
        this.init()
    },
    methods:{
        init(){
            this.addClickerEvents()
            this.title = document.querySelector('#profileAdminTableTitle')
            this.table = document.querySelector('#profileAdminTableHead')
            this.autoLoad = setInterval(()=>{
                if(FETCH_RESPONSE_STATUS){
                    this.data = FETCH_RESPONSE_DATA
                    this.head = FETCH_RESPONSE_HEADERS
                }else{
                    this.dropDatatable()
                }
                if(FETCH_RESPONSE_STATUS && this.datatable){
                    this.data = null
                    this.head = null
                }
                if(this.data && this.head){
                    this.createDatatable(this.data, this.head)
                    this.data=null
                    this.head=null
                }
            }, 500)
        },
        addClickerEvents(){
            document.addEventListener('click', ev=>{
                switch(ev.target.id){
                    case 'editItem':  this.$parent.openFormModal(ev, this.form);break;
                    case 'deleteItem': this.$parent.openFormModal(ev, this.form);break;
                    case 'getItem': this.$parent.openFormModal(ev, this.form);break;
                    case 'createItem': this.$parent.openFormModal(ev, this.form);break;
                }
            })
        },
        setTable(){
            this.title.innerHTML= this.data.title
            this.form = this.head.form
        },
        async createDatatable(){
            if(!this.head.form){
                this.ownerFetch = false
                await this.showUsersAdmin(false).then(async ()=>{
                    await this.createDatatable()
                })
            }
            this.datatable=true
            this.setTable()
            $('#profileAdminTable').on( 'error.dt', this.dropDatatable()).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : this.data.url,
                    method : 'get'
                },
                columns: this.data.columns
            })
            $('#example')
            .DataTable();
        },
        dropDatatable(){
            if($.fn.DataTable.isDataTable('#profileAdminTable')){
                $('#profileAdminTable').dataTable().fnClearTable()
                $('#profileAdminTable').dataTable().fnDestroy()
                this.datatable=false
                this.table.innerHTML = null
            }else{
                document.querySelector('#profileAdminTable').innerHTML=null
            }
        }
    }
}
</script>
