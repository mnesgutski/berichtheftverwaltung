<template>
    <div>
        <!-- Header -->
        <div class="d-flex m-b-lg">
            <div class="box-auto">
                <h1 class="m-r-lg">Berichte</h1>
                <div class="b-b-thin"></div>
            </div>
            <div class="box d-flex jc-end ai-center">
                <i class="nav-i material-icons font-xl color-1"
                @click="navBack()"
                >keyboard_arrow_left</i>
            </div>
        </div>       
        <div class="row m-none">
            <!-- All Reports -->
            <div class="col-auto pm-none m-r-lg m-b-lg" v-for="item in reports" :key="item.id">
                <div class="report-container d-flex fd-column f-center p-md" @click="enterReport(item)">
                    <h2 class="lbl-light font-sm lbl-center wrap">{{reportTypes[item.type]}}</h2>
                    <div class="divider"></div>
                    <h2 class="lbl-light font-sm lbl-center">{{item.begin_date}} -<br>{{item.end_date}}</h2>                                                              
                </div>
             </div>
             <!-- Create Button -->
             <div class="col-auto pm-none m-r-lg m-b-lg">
                <div class="report-container" @click="createReport">
                    <div id="btn-add-new-book" class="d-flex f-center fill-parent">
                        <i class="material-icons font-lg color-1">add</i>
                    </div>
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
            reports: [],
            reportTypes: { daily: "Tagesbericht", weekly: "Wochenbericht", monthly: "Monatsbericht"}
        }
    },
    created(){
        if(this.$route.params.report_book_id === undefined){
            this.$router.push({name: 'reportBooks'});
        }
    },
    mounted(){
        console.log(this.$route.params.report_book_id);
        axios.post('/reports/get', {reportBookId: this.$route.params.report_book_id})
            .then((response)=>{
                console.log(response);
                this.reports = response.data.data;
            }, (error) => {
                console.log(error);
            });
    },
    methods: {
        createReport(){
            this.$router.push({name: "createReport", params: {report_book_id: this.$route.params.report_book_id}});
        },
        enterReport(report){
            this.$router.push({name: 'entries', params: {report: report}});
        },
        navBack(){
            this.$router.push({name: 'reportBooks'});
        }
    }
}
</script>
<style scoped>
.report-container{
    height: var(--s-lg);
    width: var(--s-lg);
    border: 1px solid var(--c-second);
}

.report-container:hover{
    transform: scale(1.02)
}
.divider{
    height: 1px;
    width: 100%;
    background-color: var(--c-second);
    margin: var(--pm-md) 0px;
}
</style>