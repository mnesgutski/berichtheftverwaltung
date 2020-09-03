<template>
    <div class="fill-parent">
        <div class="row fd-column fill-parent">
            <!-- Head Bar -->
            <div class="col-auto row">
                <!-- Title -->
                <div class="col-auto">
                    <h1 class="m-r-lg">Berichtsheft erstellen</h1>
                    <div class="b-b-thin"></div>
                </div>
                <!-- Cancel Button -->
                <div class="col d-flex ai-center jc-end">
                    <i class="fas fa-times lbl-ico"></i>
                </div>
            </div>
            <!-- Create Form -->
            <div class="col container d-flex jc-center fd-column form-container">  
                <!-- Apprenticeship Input -->
                <div class="row m-b-xl">
                    <div class="col">
                        <input type="text" v-model="apprenticeship_name" id="inp-username">
                        <h2 class="lbl-light font-sm">Ausbildungsberuf</h2>
                    </div>
                </div> 
                <!-- Date Inputs -->
                <div class="row m-b-xl">
                    <div class="col">
                        <input type="date" v-model="start_date" id="inp-username">
                        <h2 class="lbl-light font-sm">Beginn</h2>
                    </div>
                    <div class="col">
                        <input type="date" v-model="start_date" id="inp-username">
                        <h2 class="lbl-light font-sm">Ende</h2>
                    </div>                    
                </div> 
                <!-- Submit Button -->
                <div class="row m-b-xl">
                    <div class="col d-flex jc-end">
                        <button class="font-md lbl-light btn-hov">Erstellen</button>
                    </div>
                </div>
                <!-- <div class="offset-xl"></div> -->
            </div>
        </div>
        
    </div>
</template>
<script>
export default {
    data(){
        return{

        }
    },
    methods: {
        cancelCreate: function(){
            
        }
    }
}
</script>
<style scoped>
.offset-xl{
    height: 200px;
    width: 0px;
}
input[type="text"]{
    width: 100%;
    font-size: 30px;
    font-family: roboto-light;
    border: none;
    border-radius: 0;
    border-bottom: 1px solid var(--c-second);
    outline: none;
    color: var(--c-second);
}

input[type="date"]{
    width: 100%;
    font-size: 30px;
    font-family: roboto-light;
    border: none;
    border-radius: 0;
    border-bottom: 1px solid var(--c-second);
    outline: none;
    color: var(--c-second);
}

.form-container{width: var(--s-xx)}
</style>