<template>
    <div id="wrapper" class="full-size">
        <div class="overlay"></div>
        <div class="center-in-window w-xl p-lg b-thin">
            <div class="fill-parent d-flex fd-column jc-center">
                <div class="b-b-thin m-b-md menu-item box d-flex jc-center"
                @click="$emit('edit', item_id)">
                    <h2 class="font-md no-select lbl-light p-md">Bearbeiten</h2>
                </div>
                <div class="b-b-thin m-b-md menu-item box d-flex jc-center"
                @click="$emit('delete', item_id)">
                    <h2 class="font-md no-select lbl-light p-md">Löschen</h2>
                </div>
                <div class="b-b-thin menu-item box d-flex jc-center"
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
        item_id: {
            type: Number
        }
    }
}
</script>
<style scoped>
.overlay{
    width: 100%;
    height: 100%;
    background-color: white;
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