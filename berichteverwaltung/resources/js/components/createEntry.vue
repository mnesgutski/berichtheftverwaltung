<template>
    <div id="wrapper" class="">        
        <div class="d-flex m-b-lg">
            <!-- Header Input -->
            <div class="box prop-5 m-r-md">
                <input type="text" class="font-md" v-model="entry_header" id="inp-entry-header">
                <h2 class="lbl-light font-sm">Kurzbeschreibung</h2>
            </div>
            <!-- Type Input -->
            <div class="box prop-3 m-r-md">
                <select v-model="entry_type" class="font-md lbl-light color-2">
                    <option value="school">schulisch</option>
                    <option value="company">betrieblich</option>
                </select>
                <h2 class="lbl-light font-sm">Art</h2>
            </div>
            <!-- Duration Input -->
            <div class="box m-r-md">
                <input 
                class="font-md" 
                type="number" 
                step="0.25"
                min="0"
                v-model="entry_duration" id="inp-entry-duration">
                <h2 class="lbl-light font-sm">Stunden</h2>
            </div>
        </div>     
        <!-- Description Input -->
        <div class="d-flex m-b-md">
            <div class="box m-r-md">
                <input 
                @keydown.enter="createEntry()"
                type="text" class="fill-h font-sm" v-model="entry_description" id="inp-entry-description">
                <h2 class="lbl-light font-sm">Beschreibung</h2>
            </div>
        </div> 
        <!-- Submit Button -->
        <div class="d-flex jc-end m-b-md m-r-md">
            <div class="box-auto">
                <button 
                @click="createEntry()"
                class="btn-hov font-md color-1 lbl-light">
                Erstellen</button>
            </div>            
        </div> 
    </div>
</template>
<script>
import axios from 'axios'
export default {
    name: 'create-entry',
    props: {
        report_id: {
            default: 0, 
            type: Number
        }
    },
    data(){
        return{
            entry_header: '',
            entry_description: '',
            entry_type: 'company',
            entry_duration: '',            
        }
    },
    methods: {
        createEntry(){
            axios.post('entries/create', {
                report_id: this.report_id,
                position: 1,
                duration: this.entry_duration,
                header: this.entry_header,
                description: this.entry_description,
                type: this.entry_type
            }).then((response) =>{
                console.log(response.data);
                this.$emit('entryAdded');
            }, (error) => {
                console.log(error);
            });
        }
    }
}
</script>
<style scoped>
input[type="text"], input[type="number"], select{
    font-family: roboto-light;
    border: none;
    border-radius: 0;
    border-bottom: 1px solid var(--c-second);
    outline: none;
    color: var(--c-second);
    width: 100%;
    height: 1em;
}

select:focus{
    background-color: var(--c-second);
    color: var(--c-main);
}

input[type="date"]{
    font-family: roboto-light;
    border: none;
    border-radius: 0;
    border-bottom: 1px solid var(--c-second);
    outline: none;
    color: var(--c-second);
    width: 100%;
}
</style>