<template>
    <nav class="d-fex col-3 flex-column flex-warp bd-sidebar">
        <div @click="this.redirect('usersAdmin')" class="row"><p class="px-5 link-secondary" >Usuarios</p></div>
        <div @click="this.redirect('productsAdmin')" class="row"><p class="px-5 link-secondary" >Productos</p></div>
        <div @click="this.redirect('promotions')" class="row"><p class="px-5 link-secondary" >Promotions</p></div>
        <div @click="this.redirect('categoriesAdmin')" class="row"><p class="px-5 link-secondary" >Categorias</p></div>
        <div @click="this.redirect('shopsAdmin')" class="row"><p class="px-5 link-secondary" >Facturas</p></div>
    </nav>
</template>
<script>
import { products } from '@/namespaces/products';
import { promotions } from '@/namespaces/promotions'

export default {
    mixins:[products, promotions],
    methods:{
        async redirect(site){
            switch(site){
                case 'shopsAdmin':
                    await this.$parent.showShopsAdmin(this.$parent.redirect)
                break;
                case 'categoriesAdmin':
                    await this.$parent.showCategoriesAdmin(this.$parent.redirect);break;
                case 'usersAdmin':
                    await this.$parent.showUsersAdmin(this.$parent.redirect);break;
                case 'productsAdmin':
                    await this.showProductsAdmin(this.$parent.redirect)
                break;
                case 'promotions':
                    await this.showPromotionsAdmin(this.$parent.redirect)
                break;
            }
        }
    }
}
</script>
