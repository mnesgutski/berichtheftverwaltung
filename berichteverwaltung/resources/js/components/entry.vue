<template>
    <div id="entry">
        <div class="d-flex fd-column b-thin p-md">
            <div class="d-flex">
                <div class="box-auto" v-bind:class="{'b-b-thin' : description != ''}">
                     <h2 class="font-sm">{{header}}</h2>
                </div>               
            </div>
            <div class="box" v-if="description != ''">
                <h3 class="font-sm lbl-light">{{description}}</h3>
            </div>            
        </div>
    </div>
</template>
<script>
export default {
    name: 'Entry',
    props: {
        header: {
            default: '',
            type: String 
        },
        description: {
            default: '',
            type: String
        }
    }
}
</script>
<style scoped>
#entry{
    background-color: transparent;
    transition: background-color .07s ease;
}

#entry:hover{
    background-color: var(--c-third);
}
#entry:hover h2,#entry:hover h3{color: var(--c-second)}
</style>