<template>
    <div>
        <transition name="fade" mode="out-in">
            <div key="id_entry" v-if="!edit" id="entry" @click="edit = true">
                <div class="d-flex fd-column b-thin p-md">
                    <div class="d-flex">
                        <div class="box-auto" 
                        v-bind:class="{'b-b-thin' : ((description != '')&&(description != null))}">
                             <h2 class="no-select font-sm">{{header}}</h2>
                        </div> 
                        <div class="box d-flex jc-end" v-if="entry.duration !== null">
                            <h2 class="no-select font-sm lbl-light">{{entry.duration}} Std.</h2>
                        </div>              
                    </div>
                    <div class="box" v-if="((description != '')&&(description != null))">
                        <h3 class="no-select font-sm lbl-light">{{description}}</h3>
                    </div>            
                </div>
            </div>
            <create-entry key="id_create_entry"
            v-else 
            :report_id="report_id"
            :entry="entry"
            @entryAdded="edit = false; $emit('updated')"
            @cancel="edit = false"
            @delete="deleteEntry()"></create-entry>
        </transition>
    </div>
</template>
<script>
import axios from 'axios'
import createEntry from './createEntry';
export default {
    name: 'Entry',
    components:{
        createEntry
    },
    data(){
        return{
            edit: false
        }
    },
    props: {
        header: {
            default: '',
            type: String 
        },
        description: {
            default: '',
            type: String
        },
        report_id:{
            type: Number
        },
        entry:{
            type: Object
        }
    },
    methods: {
        deleteEntry(){
            axios.post('/entries/delete', {entry_id: this.entry.id})
            .then((response) =>{
                console.log(response);
                this.$emit('updated');
            }, (error) => {console.log(error)})
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

.fade-enter-active, .fade-leave-active {
  transition: opacity .3s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>