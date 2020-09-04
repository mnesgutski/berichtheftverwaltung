<template>
    <div>
        <div class="d-flex fd-column">
            <div class="d-flex">
                <div class="box" v-bind:class="{'b-b-thin' : description != ''}">
                     <h2 class="font-md lbl-light">{{header}}</h2>
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