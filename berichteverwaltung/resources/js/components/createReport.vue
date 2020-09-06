<template>
    <div class="fill-parent d-flex fd-column">
        <!-- Header -->
        <div class="box-auto d-flex m-b-lg">
            <div class="box-auto">
                <h1 class="m-r-lg">{{header}}</h1>
                <div class="b-b-thin"></div>
            </div>
            <div class="box d-flex jc-end ai-center">
                <i class="nav-i material-icons font-xl color-1"
                @click="cancelCreate"
                >close</i>
            </div>
        </div> 
        <div class=" box row fd-column fill-parent">
            <!-- Create Form -->
            <div class="col container d-flex jc-center fd-column form-container">  
                <!-- Apprenticeship Input -->
                <div class="row m-b-xl">
                    <div class="col">
                        <input type="text" v-model="report_position" id="inp-rep-position">
                        <h2 class="lbl-light font-sm">Nummer</h2>
                    </div>
                    <div class="col">
                        <select id="inp-rep-position" v-model="report_type">
                            <option value="daily">Tagesbericht</option>
                            <option value="weekly">Wochenbericht</option>
                            <option value="monthly">Monatsbericht</option>
                        </select>
                        <h2 class="lbl-light font-sm">Art</h2>
                    </div>
                    <div class="col">
                        <input step="0,5" min="0" type="number" v-model="report_hours" id="inp-rep-hours">
                        <h2 class="lbl-light font-sm">Zielstunden</h2>
                    </div>
                </div> 
                <!-- Date Inputs -->
                <div class="row m-b-xl">
                    <div class="col">
                        <input type="date" v-model="report_begin_date" id="inp-rep-begin-date">
                        <h2 class="lbl-light font-sm">Beginn</h2>
                    </div>
                    <div class="col">
                        <input type="date" v-model="report_end_date" id="inp-rep-end-date">
                        <h2 class="lbl-light font-sm">Ende</h2>
                    </div>                    
                </div>
                <!-- Department Input -->
                <div class="row m-b-xl">
                    <div class="col">
                        <input type="text" v-model="report_department" id="inp-rep-department">
                        <h2 class="lbl-light font-sm">Abteilung</h2>
                    </div>               
                </div> 
                <!-- Company Input -->
                <div class="row m-b-xl">
                    <div class="col">
                        <input @keydown.enter="createReport" type="text" v-model="report_company" id="inp-rep-company">
                        <h2 class="lbl-light font-sm">Unternehmen</h2>
                    </div>               
                </div> 
                <!-- Submit Button -->
                <div class="row m-b-xl">
                    <div class="col d-flex jc-end">
                        <button @click="createReport()" class="font-md lbl-light btn-hov">{{button_text}}</button>
                    </div>
                </div>
                <!-- <div class="offset-xl"></div> -->
            </div>
        </div>
        
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data(){
        return{
            report_position: '',
            report_begin_date: '',
            report_end_date: '',
            report_type: 'weekly',
            report_hours: 0,
            report_company: '',
            report_department: '',
            edit: false,
            report_id: '', //Kritisch: hier könnte jemand Berichte Bearbeiten, die Ihm nicht gehören.
            header: 'Bericht erstellen',
            button_text: 'Erstellen'
        }
    },
    created(){
        if (this.$route.params.report_book_id === undefined) {
            this.$router.push({name: 'reportBooks'});
        }
        if(this.$route.params.edit !== undefined){
            this.edit = this.$route.params.edit;
        }
        if(this.edit){
            this.report_position = this.$route.params.report.position;
            this.report_begin_date = this.$route.params.report.begin_date;
            this.report_end_date = this.$route.params.report.end_date;
            this.report_type = this.$route.params.report.type;
            this.report_hours = this.$route.params.report.hours_targeted;
            this.report_company = this.$route.params.report.company;
            this.report_department = this.$route.params.report.department;
            this.report_id = this.$route.params.report.id;
            this.header = 'Bericht bearbeiten',
            this.button_text = 'Speichern'
        }
    },
    methods: {
        cancelCreate: function(){
            this.$router.push({name: 'reports', params: {report_book_id: this.$route.params.report_book_id}})
        },
        createReport: function(){
            console.log(this.report_position);
            axios.post(this.edit ? '/reports/update' : '/reports/create', {
                type: this.report_type,
                report_book_id: this.$route.params.report_book_id,
                position: this.report_position,
                begin_date: this.report_begin_date,
                end_date: this.report_end_date,
                hours_targeted: this.report_hours,
                department: this.report_department,
                company: this.report_company,
                id: this.report_id,
            }).then((response) => {
                if(response.data.error){
                    alert(response.data.error_message);
                }else{
                    console.log(response.data.data);
                    this.enterReport(response.data.data);
                }
            }, (error) => {
                    console.log(error);
            });
        },
        enterReport(report){
            this.$router.push(
                {name: 'entries', params: 
                    {
                        report: report,
                        report_book_id: this.$route.params.report_book_id
                    }});
        }
    }
}
</script>
<style scoped>
.offset-xl{
    height: 200px;
    width: 0px;
}
input[type="text"],input[type="number"], select{
    width: 100%;
    font-size: 30px;
    font-family: roboto-light;
    border: none;
    border-radius: 0;
    border-bottom: 1px solid var(--c-second);
    outline: none;
    color: var(--c-second);
}
select{-moz-appearance:none;}
select:focus{background-color: var(--c-edit)}
option{font-family: roboto-light; font-size: var(--f-md);}
input[type="date"]{
    width: 100%;
    font-size: 30px;
    font-family: roboto-light;
    border: none;
    border-radius: 0;
    border-bottom: 1px solid var(--c-second);
    outline: none;
    color: var(--c-second);
}

.form-container{width: var(--s-xx)}
</style>