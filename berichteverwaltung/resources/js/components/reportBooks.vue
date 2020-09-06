<template>
    <div>
        <!-- Header -->
        <div class="d-flex">
            <div class="box-auto">
                <h1 class="m-r-lg">Berichtshefte</h1>
                <div class="b-b-thin"></div>
            </div>
            <div class="box d-flex jc-end ai-center">
                <!-- Edit Button -->
                <i class="nav-i material-icons font-lg color-1"
                @click="editMode = !editMode"
                >edit</i>
                <!-- Logout Button -->
                <i onclick="window.location.href = '/logout';"
                class="nav-i material-icons font-xl color-1">
                keyboard_arrow_left</i>
            </div>
        </div>    
        <!-- Navigation Tree -->
        <div class="m-b-lg nav-tree-wrapper">
            <h2 class="no-hov no-select font-sm lbl-light">{{$user.username}}</h2>            
        </div>     
        <div class="row m-none">
            <!-- All Report Books -->
            <transition-group class="d-flex" name="list">
                <div class="col-auto pm-none m-r-lg m-b-lg" v-for="item in reportBooks" :key="item.id" @click="clickOnReportBook(item)">
                    <div :class="{'edit-item-active':editMode}" class="edit-item item-hov report-book-container d-flex fd-column f-center p-md">
                        <h2 class="no-select lbl-light font-sm lbl-center wrap">{{item.name}}</h2>
                        <div class="divider"></div>
                        <h2 class="no-select lbl-light font-sm lbl-center">
                            {{new Date(item.begin_date).toLocaleDateString('de',{dateStyle: 'medium'})}} -
                            <br>{{new Date(item.end_date).toLocaleDateString('de',{dateStyle: 'medium'})}}
                        </h2>                                                              
                    </div>
                 </div>
            </transition-group>
             <!-- Create Button -->
             <div class="col-auto pm-none m-r-lg m-b-lg" key="add_button">
                <div @click="createNewReportBook" 
                class="report-book-container item-hov">
                    <div id="btn-add-new-book" class="d-flex f-center fill-parent">
                        <i class="material-icons font-lg color-1">add</i>
                    </div>
                </div>
            </div>
        </div>
        <edit-confirm 
        v-if="showEditConfirm" 
        :item_id="editingReportBookId" 
        @cancel="cancelEdit"
        @delete="deleteReportBook"
        @edit="enterEditor"
        class="pos-abs"></edit-confirm>
    </div>
</template>
<script>
import axios from 'axios'
import editConfirm from './editConfirm.vue'
export default {
    data: function(){
        return{
            reportBooks: [],
            editMode: false,
            showEditConfirm: false,
            editingReportBookId: null
        }
    },
    components: {
        editConfirm
    },
    mounted(){
        this.fetchReportBooks();
                            console.log(this.$user);
    },
    methods: {
        fetchReportBooks(){
            axios.post('/reportBooks/get')
                .then((response) => {
                    if (response.data.error) {
                        alert(response.data.error_message);
                    }else{
                        this.reportBooks = response.data.data;
                    }
                }, (error) => {
                    console.log(error);
                });
        },
        createNewReportBook(){
            this.$router.push({name: 'createReportBook'});
        },
        enterReportBook(id){
            for(var ele in this.reportBooks){
                if(ele == id){
                    this.$tree.reportBook = this.reportBooks[ele];
                    console.log(this.$tree.reportBook)
                }
            }
            this.$router.push({name: 'reports', 
            params: {
                report_book_id: id
            }});
        },
        logout(){
            axios.get('/logout')
                .then((response)=>{
                    console.log(response);
                }, (error) =>{
                    console.log(error);
                });
        },
        clickOnReportBook(item){
            if(this.editMode){
                this.editingReportBookId = item.id;
                this.showEditConfirm = true;
            }else{
                this.enterReportBook(item.id)
            }
        },
        enterEditor(){
            var loc_book = {};
            for(var ele in this.reportBooks){
                if(ele == this.editingReportBookId){
                    loc_book = this.reportBooks[ele];
                }
            }
            console.log(loc_book);
            this.$router.push({name: 'createReportBook',
                params: {
                    edit: true,
                    report_book_id: this.editingReportBookId,
                    book: loc_book
                }
            })  
        },
        deleteReportBook(p_report_book_id){
            axios.post('/reportBooks/delete', {
                reportBookId: p_report_book_id
            }).then((response) => {
                console.log(response);
                this.showEditConfirm = false;
                this.editingReportId = null;
                this.fetchReportBooks();
            }, (error) => {
                console.log(error);
            })
        },
        cancelEdit(){
            this.showEditConfirm = false;
            this.editingReportBookId = null;
        }
    }
}
</script>
<style scoped>
.report-book-container{
    height: var(--s-lg);
    width: var(--s-lg);
    border: 1px solid var(--c-second);
}
.divider{
    height: 1px;
    width: 100%;
    background-color: var(--c-second);
    margin: var(--pm-md) 0px;
}

.wrap{word-wrap: anywhere;}
</style>