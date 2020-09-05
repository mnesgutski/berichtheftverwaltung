<template>
<!-- @Todo: Michel : Wenn End und Begin date gleich, Anders rendern -->
    <div class="fill-parent">
        <!-- Header -->
        <div class="d-flex m-b-lg">
            <div class="box-auto">
                <h1 class="m-r-lg">Bericht</h1>
                <div class="b-b-thin"></div>
            </div>
            <div class="box d-flex jc-end ai-center">
                <i class="nav-i material-icons font-xl color-1"
                @click="navBack()"
                >keyboard_arrow_left</i>
            </div>
        </div>       
        <div class="d-flex jc-center fill-v">
            <div class="w-xx blue">
                <!-- Report Header -->
                <div class="d-flex b-b-thin m-b-lg">
                    <div class="box-auto b-b-thin" v-if="report.position">
                        <h2 class="font-md lbl-light">Nummer: {{this.report.position}}</h2>
                    </div>
                    <div class="box-auto">
                        <h2 class="font-md lbl-light">
                            Vom {{new Date(this.report.begin_date).toLocaleDateString("de")}} 
                            bis zum {{new Date(this.report.end_date).toLocaleDateString("de")}}
                            | {{this.report.company}} 
                            | {{this.report.department}}
        
                        </h2>
                    </div>
                </div>
                <!-- Actual Entries -->
                <div v-for="item in entries" :key="item.id">
                    <entry class="m-b-md" :header="item.header" :description="item.description"></entry>
                </div>
                <!-- Add Entry Form -->
                <create-entry @entryAdded="fetchEntries()" class="w-xx" :report_id="this.report.id"></create-entry>
                <i class="material-icons" @click="addEntry">face</i>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import entry from './entry.vue';
import createEntry from './createEntry.vue';
export default {
    data(){
        return{
            entries: [],
            report: {},
            mountReady: true
        }
    },
    components:{
        entry,
        createEntry
    },
    mounted(){
        if(this.$route.params.report === undefined){
            this.$router.push({name: 'reportBooks'});
            return;
        }
        console.log(this.$route.params.report);
        this.report = this.$route.params.report;
        this.fetchEntries();
    },
    methods:{
        fetchEntries(){
            axios.post('/entries/get', {reportId: this.$route.params.report.id})
                .then((response) => {
                    this.entries = response.data.data;
                }, (error) => {
                    console.log(error);
                });
        },
        addEntry(){

        },
        navBack(){
            this.$router.push({name: 'reports', params: {report_book_id: this.$route.params.report_book_id}})
        }
    }
}
</script>
<style scoped>

</style>