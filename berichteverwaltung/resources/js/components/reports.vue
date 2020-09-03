<template>
    <div>
        <div class="row m-none m-b-lg">
            <!-- Header -->
            <div class="col-auto pm-none">
                <h1 class="m-r-lg">Berichte</h1>
                <div class="b-b-thin"></div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data: function(){
        return{
            report_book_id: ''
        }
    },
    mounted(){
        axios.post('/reports/get', {reportBookId: this.$route.params.id})
            .then((response)=>{
                console.log(response);
            }, (error) => {
                console.log(error);
            });
    }
}
</script>