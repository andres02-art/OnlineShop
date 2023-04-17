<template>
    <div v-if="this.profile.User" class="d-flex flex-warp flex-column">
        <div  class="col d-flex p-3 justify-content-between">
            <div class="card w-25">
                <div class="card-header">
                    <h5>Nombre</h5>
                </div>
                <div class="card-body">
                    <p>{{ this.profile.User.name }}</p>
                </div>
            </div>
            <div class="card w-25">
                <div class="card-header">
                    <h5>Segundo Nombre</h5>
                </div>
                <div class="card-body">
                    <p>{{ this.profile.User.second_name }}</p>
                </div>
            </div>
            <div class="card w-25">
                <div class="card-header">
                    <h5>Apellido</h5>
                </div>
                <div class="card-body">
                    <p>{{ this.profile.User.last_name }}</p>
                </div>
            </div>
        </div>
        <div class="col d-flex p-3 justify-content-around">
            <div class="card w-100">
                <div class="card-header">
                    <h5>Correo</h5>
                </div>
                <div class="card-body">
                    <p>{{ this.profile.User.email }}</p>
                </div>
            </div>
        </div>
        <div class="col d-flex p-3 justify-content-between">
            <div class="card w-50">
                <div class="card-header">
                    <h5>Documento</h5>
                </div>
                <div class="card-body">
                    <p>{{ this.profile.User.credentials }}</p>
                </div>
            </div>
            <div class="card w-25">
                <div class="card-header">
                    <h5>Dia de nacimiento</h5>
                </div>
                <div class="card-body">
                    <p>{{ this.profile.User.born_date }}</p>
                </div>
            </div>
        </div>
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
