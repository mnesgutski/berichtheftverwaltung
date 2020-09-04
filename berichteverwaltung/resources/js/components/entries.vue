<template>
    <div>
        <!-- Header -->
        <div class="d-flex red">
            <!-- Header -->
            <div class="box-auto pm-none">
                <h1 class="m-r-lg">Bericht</h1>
                <div class="b-b-thin"></div>
            </div>
        </div>
        <!-- Report Header -->
        <div class="d-flex b-b-thin">
            <div class="box-auto" v-if="$route.params.report.position">
                <h2>Nummer: {{this.$route.params.report.position}}</h2>
            </div>
            <div class="box-auto">
                Vom {{this.$route.params.report.begin_date}} bis zum {{this.$routes.params.report.end_date}}
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data(){
        return{
            entries: []
        }
    },
    mounted(){
        if(this.$route.params.report !==undefined){
            this.$router.push({name: 'reportBooks'});
            return;
        }
        axios.post('/entries/get', {reportId: this.$route.params.report.id})
            .then((response) => {
                this.entries = response.data.data;
            }, (error) => {
                console.log(error);
            });
    }
}
</script>
<style scoped>

</style>