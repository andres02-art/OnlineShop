<template>
    <div class="card mt-5 mb-5">
        <div class="text fs-4">
            <p>{{ this.product.description }}</p>
        </div>
        <div class="card-body">
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
