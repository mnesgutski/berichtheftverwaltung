<template>
    <div>
        <!-- Header -->
        <div class="d-flex">
            <div class="box-auto">
                <h1 class="m-r-lg">FAQ</h1>
                <div class="b-b-thin"></div>
            </div>
            <div class="box d-flex jc-end ai-center">
                <!-- Logout Button -->
                <i @click="$router.push({name: 'reportBooks'})"
                class="nav-i material-icons font-xl color-1">
                keyboard_arrow_left</i>
            </div>
        </div>    
    </div>
</template>