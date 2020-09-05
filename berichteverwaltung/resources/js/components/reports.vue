<template>
    <div>
        <!-- Header -->
        <div class="d-flex m-b-lg">
            <div class="box-auto">
                <h1 class="m-r-lg">Berichte</h1>
                <div class="b-b-thin"></div>
            </div>            
            <div class="box d-flex jc-end ai-center">
                <!-- Edit Button -->
                <i class="nav-i material-icons font-lg color-1"
                @click="editMode = !editMode"
                >edit</i>
                <!-- Nav Back Button -->
                <i class="nav-i material-icons font-xl color-1"
                @click="navBack()"
                >keyboard_arrow_left</i>
            </div>
        </div>       
        <div class="row m-none">
            <!-- All Reports -->
            <transition-group name="list">
                <div class="col-auto pm-none m-r-lg m-b-lg" v-for="item in reports" :key="item.id">
                    <div class="edit-item item-hov report-container d-flex fd-column f-center p-md" 
                    :class="{'edit-item-active':editMode}"
                    @click="clickReport(item)">
                        <h2 class="lbl-light font-sm lbl-center wrap">{{reportTypes[item.type]}}</h2>
                        <div class="divider"></div>
                        <h2 class="lbl-light font-sm lbl-center">
                            {{new Date(item.begin_date).toLocaleDateString('de',{dateStyle: 'medium'})}} -
                            <br>{{new Date(item.end_date).toLocaleDateString('de',{dateStyle: 'medium'})}}
                        </h2>                                                              
                    </div>
                 </div>
            </transition-group>
             <!-- Create Button -->
             <div v-if="!editMode" class="col-auto pm-none m-r-lg m-b-lg">
                <div class="item-hov report-container" 
                @click="createReport">
                    <div id="btn-add-new-book" class="d-flex f-center fill-parent">
                        <i class="material-icons font-lg color-1">add</i>
                    </div>
                </div>
            </div>
        </div>
        <edit-confirm 
        v-if="showEditConfirm" 
        :report_id="editingReportId" 
        @cancel="cancelEdit"
        @delete="deleteReport"
        class="pos-abs"></edit-confirm>
    </div>
</template>
<script>
import axios from 'axios';
import editConfirm from './editConfirm.vue'
export default {
    data: function(){
        return{
            editMode: false,
            editingReportId: null, 
            showEditConfirm: false,
            reports: [],
            reportTypes: { daily: "Tagesbericht", weekly: "Wochenbericht", monthly: "Monatsbericht"}
        }
    },
    components: {
        editConfirm
    },
    created(){
        if(this.$route.params.report_book_id === undefined){
            this.$router.push({name: 'reportBooks'});
        }
    },
    mounted(){
        this.fetchReports();
    },
    methods: {
        fetchReports(){
            axios.post('/reports/get', {reportBookId: this.$route.params.report_book_id})
                        .then((response)=>{
                            console.log(response);
                            this.reports = response.data.data;
                        }, (error) => {
                            console.log(error);
                        });
        },
        createReport(){
            this.$router.push({name: "createReport", 
                params: {report_book_id: this.$route.params.report_book_id}});
        },
        enterReport(report){
            this.$router.push(
                {name: 'entries', params: 
                    {
                        report: report,
                        report_book_id: this.$route.params.report_book_id
                    }});
        },
        navBack(){
            this.$router.push({name: 'reportBooks'});
        }, 
        clickReport(item){
            if(this.editMode){
                this.editingReportId = item.id;
                this.showEditConfirm = true;
            }
            else{
                this.enterReport(item);
            }            
        },
        cancelEdit(){
            this.showEditConfirm = false;
            this.editingReportId = null;
        },
        deleteReport(p_report_id){
            axios.post('/reports/delete', {
                id: p_report_id
            }).then((response) => {
                console.log(response);
                this.showEditConfirm = false;
                this.editingReportId = null;
                this.fetchReports();
            }, (error) => {
                console.log(error);
            })
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

.divider{
    height: 1px;
    width: 100%;
    background-color: var(--c-second);
    margin: var(--pm-md) 0px;
}
</style>