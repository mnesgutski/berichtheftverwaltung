<template>
    <div>
        <div class="row m-none m-b-lg">
            <!-- Header -->
            <div class="col-auto pm-none">
                <h1 class="m-r-lg">Berichtshefte</h1>
                <div class="b-b-thin"></div>
            </div>
        </div>
        <div class="row m-none">
            <!-- All Report Books -->
            <div class="col-auto pm-none m-r-lg m-b-lg" v-for="item in reportBooks" :key="item.id" @click="enterReportBook(item.id)">
                <div class="report-book-container d-flex fd-column f-center p-md">
                    <h2 class="lbl-light font-sm lbl-center wrap">{{item.name}}</h2>
                    <div class="divider"></div>
                    <h2 class="lbl-light font-sm lbl-center">{{item.begin_date}} -<br>{{item.end_date}}</h2>                                                              
                </div>
             </div>
             <!-- Create Button -->
             <div class="col-auto pm-none m-r-lg m-b-lg">
                <div @click="createNewReportBook" class="report-book-container">
                    <div id="btn-add-new-book" class="d-flex f-center fill-parent">
                        <i class="fas fa-plus lbl-ico"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data: function(){
        return{
            reportBooks: []
        }
    },
    mounted(){
        axios.post('/reportBooks/get')
            .then((response) => {
                if (response.data.error) {
                    alert(response.data.error_message);
                }else{
                    this.reportBooks = response.data.data;
                }
            }, (error) => {
                console.log(error);
            });
    },
    methods: {
        createNewReportBook(){
            this.$router.push({name: 'createReportBook'});
        },
        enterReportBook(id){
            this.$router.push({name: 'reports', params: {report_book_id: id}});
        }
    }
}
</script>
<style scoped>
.report-book-container{
    height: var(--s-lg);
    width: var(--s-lg);
    border: 1px solid var(--c-second);
}

.report-book-container:hover{
    transform: scale(1.02)
}
.divider{
    height: 1px;
    width: 100%;
    background-color: var(--c-second);
    margin: var(--pm-md) 0px;
}

.wrap{word-wrap: anywhere;}
</style>