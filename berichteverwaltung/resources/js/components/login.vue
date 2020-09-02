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
                    <input type="text" name="username" id="inp-username">
                    <h4 class="lbl-thin m-b-lg">Username</h4>
                    <input type="password" name="password" id="inp-password">
                    <h4 class="lbl-thin">Passwort</h4>
                </div>
            </div>
            <div class="row">
                <button type="submit">Login</button>
            </div>
        </div>
        
        
    </div>
	
</template>
<style scoped>
*{color: rgb(3, 199, 3);}

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
    outline: none;
}


.force-center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}

</style>
