<template>
    <div id="wrapper" class="full-size red">
        <div class="overlay"></div>
        <div class="center-in-window w-xl p-lg">
            <div class="fill-parent d-flex fd-column jc-center">
                <div class="b-thin m-b-md menu-item box d-flex jc-center"
                @click="$emit('edit', report_id)">
                    <h2 class="font-md no-select lbl-light p-md">Bearbeiten</h2>
                </div>
                <div class="b-thin m-b-md menu-item box d-flex jc-center"
                @click="$emit('delete', report_id)">
                    <h2 class="font-md no-select lbl-light p-md">Löschen</h2>
                </div>
                <div class="b-thin menu-item box d-flex jc-center"
                @click="$emit('cancel')">
                    <h2 class="font-md no-select lbl-light p-md">Abbrechen</h2>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'edit-confirm',
    data(){
        return{

        }
    },
    props: {
        report_id: {
            type: Number
        }
    }
}
</script>
<style scoped>
.overlay{
    width: 100%;
    height: 100%;
    background-color: black;
    opacity: .3;
}
.menu-item{
    background-color: var(--c-contrast);
    transition: background-color .1s ease;    
}
.menu-item:hover{background-color: var(--c-edit);}
.menu-item:hover h2{color: var(--c-second);}
.menu-item:active h2{color: var(--c-contrast);}
</style>