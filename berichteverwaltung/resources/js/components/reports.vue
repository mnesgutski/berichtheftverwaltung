<template>
    <div>
        <div class="row m-none m-b-lg">
            <!-- Header -->
            <div class="col-auto pm-none">
                <h1 class="m-r-lg">Berichte</h1>
                <div class="b-b-thin"></div>
            </div>
        </div>
        <div class="row m-none">
            <!-- All Reports -->
            <div class="col-auto pm-none m-r-lg m-b-lg" v-for="item in reports" :key="item.id">
                <div class="report-container d-flex fd-column f-center p-md">
                    <h2 class="lbl-light font-sm lbl-center wrap">{{item.name}}</h2>
                    <div class="divider"></div>
                    <h2 class="lbl-light font-sm lbl-center">{{item.begin_date}}/<br>{{item.end_date}}</h2>                                                              
                </div>
             </div>
             <!-- Create Button -->
             <div class="col-auto pm-none m-r-lg m-b-lg">
                <div class="report-container" @click="createReport">
                    <div id="btn-add-new-book" class="d-flex f-center fill-parent">
                        <i class="fas fa-plus lbl-ico"></i>
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
            report_book_id: '',
            reports: []
        }
    },
    mounted(){
        axios.post('/reports/get', {reportBookId: this.$route.params.id})
            .then((response)=>{
                console.log(response);
                reports = response.data.data;
            }, (error) => {
                console.log(error);
            });
    },
    methods: {
        createReport(){
            this.$router.push({name: "createReport", params: {report_book_id: this.report_book_id}});
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
</style>