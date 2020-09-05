<template>
    <div class="fill-parent">
        <div class="container-fluid pm-none p-h-lg fill-parent">    
            <div class="d-flex fd-column fill-v">
                <div class="box">
                    <!-- Page Router -->
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
        }
    }
}
</script>
