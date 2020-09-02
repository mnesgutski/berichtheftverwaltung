<template>
    <div class="force-center">
        <div class="row fd-column comp-w-md">
            <div class="row">
                <div class="col-auto d-flex jc-center">
                    <h1 class="lbl-thin m-b-lg">Reporter 3000</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" v-model="username" name="username" id="inp-username">
                    <h4 class="lbl-thin m-b-lg">Username</h4>
                    <input type="password" v-model="password" name="password" id="inp-password">
                    <h4 class="lbl-thin m-b-lg">Passwort</h4>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex jc-end">
                    <button @click="loginCall" type="submit">Login</button>
                </div>
                
            </div>
        </div>
        
        
    </div>
	
</template>
<script>
import axios from 'axios';
export default {
    data: function(){
        return{
            username: '',
            password: ''
        }
    },
    methods:{
        loginCall(){
            axios.post('/login', {
                    username: this.username,
                    passwort: this.password
                })
                .then((response) => {
                    console.log(response);
                }, (error) => {
                    console.log(error);
                });
        }
    }
}
</script>
<style scoped>
*{color: var(--c-main);}

.comp-w-sm{width: 200px;}
.comp-w-md{width: 400px;}

.m-b-sm{margin-bottom: 5px;}
.m-b-md{margin-bottom: 10px;}
.m-b-lg{margin-bottom: 20px;}
.m-b-xl{margin-bottom: 40px;}

input[type="text"], input[type="password"]{
    width: 100%;
    font-size: 35px;
    font-family: roboto-thin;
    border: none;
    border-radius: 0;
    border-bottom: 1px solid black;
    outline: none;
}

button{
    background-color: transparent;
    font-size: 35px;
    font-family: roboto-thin;
    border: none;
    outline: none;
    transition: border .1s ease;
    
}
button:hover{
    border: none;
    border-radius: 0;
    border-bottom: 1px solid var(--c-main);
}

.force-center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}

</style>
