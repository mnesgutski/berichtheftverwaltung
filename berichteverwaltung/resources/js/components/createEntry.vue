<template>
    <div id="wrapper" class="border p-lg">
        <div class="d-flex m-b-lg ">
            <!-- Header Input -->
            <div class="box prop-5 m-r-md">
                <input
                ref="inp_header"
                @keydown.enter="createEntry()"
                type="text" class="font-sm" v-model="entry_header" id="inp-entry-header">
                <h2 class="lbl-light font-sm">Kurzbeschreibung</h2>
            </div>
            <!-- Type Input -->
            <div class="box prop-3 m-r-md">
                <select @keydown.enter="createEntry()" v-model="entry_type" class="font-sm lbl-light color-2">
                    <option value="school">schulisch</option>
                    <option value="company">betrieblich</option>
                </select>
                <h2 class="lbl-light font-sm">Art</h2>
            </div>
            <!-- Duration Input -->
            <div class="box">
                <input
                class="font-sm"
                type="number"
                step="0.25"
                min="0"
                v-model="entry_duration" id="inp-entry-duration"
                @keydown.enter="createEntry()">
                <h2 class="lbl-light font-sm">Stunden</h2>
            </div>
        </div>
        <!-- Description Input -->
        <div class="d-flex m-b-md">
            <div class="box">
                <input
                @keydown.enter="createEntry()"
                type="text" class="fill-h font-sm" v-model="entry_description" id="inp-entry-description">
                <h2 class="lbl-light font-sm">Beschreibung</h2>
            </div>
        </div>
        <!-- Submit Button -->
        <div class="d-flex jc-end">
            <div class="box-auto">
                <button
                @click="cancelCreate()"
                class="btn-hov font-sm color-1 lbl-light">
                Abbrechen</button>
            </div>
            <div class="box-auto m-h-md color-1 no-select">
                |
            </div>
            <div v-if="entry !== null" class="box-auto">
                <button
                @click="$emit('delete')"
                class="btn-hov font-sm color-1 lbl-light">
                Löschen</button>
            </div>
            <div v-if="entry !== null" class="box-auto m-h-md color-1 no-select">
                |
            </div>
            <div class="box-auto">
                <button
                @click="createEntry()"
                class="btn-hov font-sm color-1 lbl-light">
                {{button_text}}</button>
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
        },
        entry:{
            type: Object
        }
    },
    data(){
        return{
            entry_header: '',
            entry_description: '',
            entry_type: 'company',
            entry_duration: '',  
            entry_id: null,
            button_text: 'Erstellen'          
        }
    },
    mounted(){
        this.$refs.inp_header.focus();
        if(this.entry !== null ){
            this.entry_header = this.entry.header;
            this.entry_description = this.entry.description;
            this.entry_type = this.entry.type;
            this.entry_duration = this.entry.duration;
            this.entry_id = this.entry.id;
            this.button_text = "Speichern";
        }
    },
    methods: {
        createEntry(){
            axios.post(this.entry == null ? 'entries/create' : 'entries/update', {
                report_id: this.report_id,
                position: 1,
                duration: this.entry_duration,
                header: this.entry_header,
                description: this.entry_description,
                type: this.entry_type,
                entry_id: this.entry_id
            }).then((response) =>{
                console.log(response.data);
                this.$emit('entryAdded');
            }, (error) => {
                console.log(error);
            });
        },
        cancelCreate(){
            this.$emit('cancel')
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
.border{border: 1px solid black}
</style>
