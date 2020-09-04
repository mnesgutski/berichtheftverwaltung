<template>
    <div>
        <!-- Header -->
        <div class="d-flex m-b-lg">
            <!-- Header -->
            <div class="box-auto pm-none">
                <h1 class="m-r-lg">Bericht</h1>
                <div class="b-b-thin"></div>
            </div>
        </div>
        <!-- Report Header -->
        <div class="d-flex">
            <div class="box-auto b-b-thin" v-if="report.position">
                <h2 class="font-md">Nummer: {{this.report.position}}</h2>
            </div>
            <div class="box-auto">
                <h2 class="font-md">
                    Vom {{new Date(this.report.begin_date).toLocaleDateString("de")}} 
                    bis zum {{new Date(this.report.end_date).toLocaleDateString("de")}}
                    | {{this.report.company}} 
                    | {{this.report.department}}

                </h2>
            </div>
        </div>
        <entry header="test" description="test2"></entry>
        <i class="fas fa-plus lbl-ico" @click="addEntry"></i>
    </div>
</template>
<script>
import axios from 'axios';
import entry from './entry.vue';
export default {
    data(){
        return{
            entries: [],
            report: {}
        }
    },
    components:{
        entry
    },
    mounted(){
        if(this.$route.params.report === undefined){
            this.$router.push({name: 'reportBooks'});
            return;
        }
        console.log(this.$route.params.report);
        this.report = this.$route.params.report;
        axios.post('/entries/get', {reportId: this.$route.params.report.id})
            .then((response) => {
                this.entries = response.data.data;
            }, (error) => {
                console.log(error);
            });
    },
    methods:{
        fetchEntries(){

        },
        addEntry(){

        }
    }
}
</script>
<style scoped>

</style>