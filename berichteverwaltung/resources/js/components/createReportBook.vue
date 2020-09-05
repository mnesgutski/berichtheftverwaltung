<template>
    <div class="fill-parent">
        <div class="d-flex fd-column fill-v">
            <div class="box-auto">
                <!-- Header -->
                <div class="d-flex m-b-lg">
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
            </div>
            <div class="box">
                <div class="row fd-column fill-v">
                    <!-- Create Form -->
                    <div class="col container d-flex jc-center fd-column form-container">  
                        <!-- Apprenticeship Input -->
                        <div class="row m-b-xl">
                            <div class="col">
                                <input type="text" v-model="apprenticeship_name" id="inp-username">
                                <h2 class="lbl-light font-sm">Ausbildungsberuf</h2>
                            </div>
                        </div> 
                        <!-- Date Inputs -->
                        <div class="row m-b-xl">
                            <div class="col">
                                <input type="date" v-model="begin_date" id="inp-username">
                                <h2 class="lbl-light font-sm">Beginn</h2>
                            </div>
                            <div class="col">
                                <input type="date" v-model="end_date" id="inp-username">
                                <h2 class="lbl-light font-sm">Ende</h2>
                            </div>                    
                        </div> 
                        <!-- Submit Button -->
                        <div class="row m-b-xl">
                            <div class="col d-flex jc-end">
                                <button @click="createReportBook" class="font-md lbl-light btn-hov">{{button_text}}</button>
                            </div>
                        </div>
                        <!-- <div class="offset-xl"></div> -->
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data(){
        return{
            apprenticeship_name: '',
            begin_date: '',
            end_date: '',
            edit: false,
            report_book_id: '', //Kritisch: hier könnte jemand Hefte Bearbeiten, die Ihm nicht gehören.
            header: 'Berichtsheft erstellen',
            button_text: 'Erstellen'
        }
    },
    created(){
        if(this.$route.params.edit !== undefined){
            this.edit = this.$route.params.edit;
        }
        if(this.edit){
            this.begin_date = this.$route.params.book.begin_date;
            this.end_date = this.$route.params.book.end_date;
            this.apprenticeship_name = this.$route.params.book.name;
            this.report_book_id = this.$route.params.book.id;
            this.header = 'Berichtsheft bearbeiten',
            this.button_text = 'Speichern'
        }
    },
    methods: {
        cancelCreate: function(){
            this.$router.push({name: 'reportBooks'})
        },
        enterReportBook(id){
            this.$router.push({name: 'reports', params: {report_book_id: id}});
        },
        createReportBook: function(){
            axios.post(this.edit ? '/reportBooks/update' : '/reportBooks/create', {
                apprenticeship_name: this.apprenticeship_name,
                begin_date: this.begin_date,
                end_date: this.end_date,
                reportBookId: this.report_book_id
            }).then((response) => {
                if(response.data.error){
                    alert(response.data.error_message);
                }else{
                    console.log(response.data.data);
                    this.enterReportBook(response.data.data.id);
                }
            }, (error) => {
                    console.log(error);
            });
        },
        enterReportBook(id){
            this.$router.push({name: 'reports', params: {report_book_id: id}});
        }
    }
}
</script>
<style scoped>
.offset-xl{
    height: 200px;
    width: 0px;
}
input[type="text"]{
    width: 100%;
    font-size: 30px;
    font-family: roboto-light;
    border: none;
    border-radius: 0;
    border-bottom: 1px solid var(--c-second);
    outline: none;
    color: var(--c-second);
}

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