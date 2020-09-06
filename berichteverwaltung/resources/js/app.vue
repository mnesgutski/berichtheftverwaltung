<template>
    <div class="fill-parent">
        <div class="container-fluid pm-none p-h-lg fill-parent">    
            <div class="d-flex fd-column fill-v">
                <div class="box">
                    <transition appear name="fade" mode="out-in">
                        <!-- Page Router -->
                        <router-view></router-view>
                    </transition>
                </div>
            </div>
        </div>
        <i @click="$router.push({name:'faq'})" class="faq-icon material-icons font-lg color-1">sort_by_alpha</i>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data(){
        return{
        }
    },
    created(){
        axios.get('/username').then((response) => {
            console.log(response);
            this.$user.username = response.data.username;
        }, (error) => {
            console.log(error);
        });
    }
}
</script>
<style scoped>
.faq-icon{
    position: absolute;
    bottom: var(--pm-md);
    right: var(--pm-md);

}
.fade-enter-active, .fade-leave-active {
  transition: opacity .1s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
<style>
.list-item {
  display: inline-block;
  margin-right: 10px;
}
.list-enter-active, .list-leave-active {
  transition: all .3s;
}
.list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
  opacity: 0;
  transform: translateY(30px);
}
.item-hov{
    background-color: transparent;
    transition: background-color .1s ease;
}

.item-hov:hover{
    background-color: var(--c-third);
}
.item-hov:hover i, 
.item-hov:hover h2, 
.item-hov:hover h3{color: var(--c-second)}

i.material-icons{
    color: var(--c-main);
    transition: color .1s ease;
}
i.material-icons:hover{color: var(--c-second)}

.edit-item{transition: background-color .1s ease;}

.edit-item h1,
.edit-item h2,
.edit-item h3,
.edit-item i{transition: color .1s ease;}

.edit-item-active{background-color: var(--c-edit);}

.edit-item-active h1,
.edit-item-active h2,
.edit-item-active h3,
.edit-item-active i{color: var(--c-contrast);}

.nav-tree-wrapper h2{
    color: var(--c-main);
    transition: color .1s ease;
    }

.nav-tree-wrapper h2:hover{
    color: var(--c-second)
}
.nav-tree-wrapper .no-hov:hover{
    color: var(--c-main)
}
.nav-tree-wrapper i:hover{
    color: var(--c-main)
}
</style>