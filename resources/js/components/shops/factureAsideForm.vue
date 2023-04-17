<template>
    <div>
        <!-- vista previa factura-->
        <div class="card mb-3 row" >
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Factura</h5>
                        <hr>
                        <p class="card-text">Producto</p>
                        <hr>
                        <p class="card-text">Disponibles: {{ this.product.stock }}</p>
                        <p class="card-text">Cantidad: </p>
                        <input type="number" min="1" :max="this.product.stock" @change="updateFacture" required class="form-control" v-model="this.$parent.factureForm.amount">

                        <hr>
                        <p class="card-text">Cargos</p>
                        <hr>
                        <p class="card-text">Iva en porciento: 19%</p>
                        <p class="card-text">Iva en pesos: {{ this.facture.taxes }}</p>
                        <p class="card-text">Envio: {{ this.facture.send }}</p>
                        <p class="card-text">Descuento: 0%</p>
                        <hr>
                        <p class="card-text">Totales</p>
                        <hr>
                        <p class="card-text">Subtotal: {{ this.facture.subTotal }}</p>
                        <p class="card-text">Total: {{ this.facture.total }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props:{
        product:{
            type:Object,
            required:true,
        }
    },
    data(){
        return{
            facture:{}
        }
    },
    created(){
        this.init()
    },
    methods:{
        init(){
            this.generateFacture()
            this.facture.taxes = Math.floor(this.product.precio * .19)
            this.facture.send = Math.floor(Math.random()*6+4)*1000
        },
        generateFacture(){
            if(this.facture.cantidad % 5 == 0){
                this.facture.taxes += Math.floor(this.product.precio * .19)
                this.facture.send += 6000
            }
            this.facture.subTotal = (this.product.precio * .19 + this.facture.send).toFixed(4)*1
            this.facture.cantidad += 0
            this.facture.total = (this.facture.subTotal + this.product.precio * this.facture.cantidad).toFixed(2)*1
            this.$parent.factureForm.total_purchase = this.facture.total
            this.$parent.factureForm.sub_total = this.facture.subTotal
        },
        updateFacture(ev){
            this.facture.cantidad = ev.target.value * 1
            this.generateFacture()
        },
    }
}
</script>
