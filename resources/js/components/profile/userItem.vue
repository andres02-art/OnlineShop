<template>
    <div>
        <p>{{ this.profile }}</p>
    </div>
</template>

<script>
export default {
    props:{
        profile:{
            type:Object,
            required:true
        }
    },
    data(){
        return {
            userForm:null
        }
    }
}
</script>
