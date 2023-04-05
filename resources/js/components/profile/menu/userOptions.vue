<template>
    <nav class="d-fex col-3 flex-column flex-warp bd-sidebar">
        <div @click="this.redirect('user')" class="row"><p class="px-5 link-secondary" >Cuenta</p></div>
        <div @click="this.redirect('shops')" class="row"><p class="px-5 link-secondary" >Compras</p></div>
        <div @click="this.redirect('shops')" class="row"><p class="px-5 link-secondary" >Carrito</p></div>
        <div @click="this.redirect('categories')" class="row"><p class="px-5 link-secondary" >Favoritos</p></div>
    </nav>
</template>

<script>
export default {
    methods:{
        async redirect(site){
            switch(site){
                case 'user':
                    await this.$parent.showAccount(this.$parent.authUser, this.$parent.redirect)
                break;
                case 'shops':
                    await this.$parent.showShopsUser(this.$parent.authUser)
                break;
                case 'categories':
                    await this.$parent.showCategoriesUser(1, true)
                break;
            }
            this.$parent.autoLoadInterval=true
        }
    }
}
</script>
