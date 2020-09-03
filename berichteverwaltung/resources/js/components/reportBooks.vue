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
                <div @click="create_new_report_book" class="report-book-container">
                    <div id="btn-add-new-book" class="d-flex f-center fill-parent">
                        <i class="fas fa-plus lbl-ico"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: function(){
        return{

        }
    },
    methods: {
        create_new_report_book(){
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

.lbl-ico{
    font-size: 50px; 
    color: var(--c-main);
    height: 1em;
}

#btn-add-new-book:hover{transform: scale(1.05)}

.report-book-container:hover{
    box-shadow: 0px 0px 1px black;
}
</style>