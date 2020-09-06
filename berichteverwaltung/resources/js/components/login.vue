<template>
    <div class="force-center">
        <div class="row fd-column comp-w-md">
            <div class="row">
                <div class="col-auto d-flex jc-center">
                    <h1 class="lbl-thin m-b-xl">Reports.</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" ref="inp_username" v-model="username" name="username" id="inp-username">
                    <h4 class="m-b-lg">Benutzername</h4>
                    <input type="password" @keydown.enter="loginCall" v-model="password" name="password" id="inp-password">
                    <h4 class="m-b-lg">Passwort</h4>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex jc-end">
                    <button class="btn-hov" @click="loginCall">Login</button>
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
    mounted(){
        this.$refs.inp_username.focus();
    },
    methods:{
        loginCall(){
            axios.post('/login', {
                    username: this.username,
                    passwort: this.password
                })
                .then((response) => {
                    console.log(response.data);                                 
                    this.$user.username = response.data.data.username;       
                    this.$router.push({name: 'reportBooks'})
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
    font-size: 25px;
    font-family: roboto-light;
    border: none;
    border-radius: 0;
    border-bottom: 1px solid var(--c-second);
    outline: none;
    color: var(--c-second);
}

button{
    background-color: transparent;
    padding: 5px;
    font-size: 30px;
    font-family: roboto-light;
    border: none;
    outline: none;
}
.force-center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}

</style>
