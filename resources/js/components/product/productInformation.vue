<template>
    <div class="card mt-5 mb-5 ">
        <div class="text fs-5">
            <p>{{ this.product.description }}</p>
        </div>
        <hr>
        <div class="card-body fs-5">
            <p>{{ this.product.catalogo }}</p>
        </div>
        <hr>
        <div class="">
            categorias
        </div>
    </div>
</template>

<script>
export default {
    props:{
        product:{
            type:Object,
            required:true
        }
    }
}
</script>
