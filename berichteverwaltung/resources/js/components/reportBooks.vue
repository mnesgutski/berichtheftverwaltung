<template>
    <div>
        <div class="row m-b-lg">
            <div class="col-auto">
                <h1 class="m-r-lg">Berichtshefte</h1>
                <div class="b-b-thin"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-auto">
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
                if (response.error) {
                    alert(response.error_message);
                }else{
                    this.reportBooks = response.data;
                }
            }, (error) => {
                console.log(error);
            });
    },
    methods: {
        createNewReportBook(){
            this.$router.push({name: 'createReportBook'});
        }
    }
}
</script>
<style scoped>
.report-book-container{
    display: block;
    height: var(--s-lg);
    width: var(--s-lg);
    border: 1px solid var(--c-main);
}

.report-book-container:hover{
    transform: scale(1.02)
}
</style>