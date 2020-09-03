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
                <div class="report-book-container">
                    <div id="btn-add-new-book" class="d-flex jc-center fill-parent">
                        <i class="fa-plus lbl-ico"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.report-book-container{
    display: block;
    height: var(--s-lg);
    width: var(--s-lg);
    border: 1px solid var(--c-main);
}
.b-b-thin{border-bottom: 1px solid var(--c-main);}

.lbl-ico{font-size: 30px; color: var(--c-second)}
</style>