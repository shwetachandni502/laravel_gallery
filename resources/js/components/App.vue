<template>
    <div >
        <!-- <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <span class="text-secondary">Laravel Vue CRUD oOprations</span>
        </div>
 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/data" class="nav-item nav-link">Home</router-link>
                    <router-link to="/add" class="nav-item nav-link">Add Post</router-link>
                    <button @click="redirect" > redirect</button>
                    <button @click="backe" > backe</button>
                    <button @click="forverd" > forverd</button>
                </div>
            </div>
        </nav>
        <br/> -->

       
        <div class="row" >
            <!-- <div class="col-2 pl-0">
                <div class="left-menu pt-4 px-4">
                    <h2><router-link to="/all">Menu</router-link></h2>
                    <p><router-link to="/about">about</router-link></p>
                    <p><router-link to="/help">help</router-link></p>
                </div>
            </div> -->
            <div class="col-10 scroll-data">
                 <!-- <Header></Header> -->
                 <!-- <router-view></router-view> -->
                 <!-- <Data></Data> -->
            </div>
        </div>



    <HelloWorld msg=""/>
     

    







        
    </div>
</template>
 
<script>
import FileUploadComponent from './FileUploadComponent.vue'
import HelloWorld from './HelloWorld.vue'
// import Header from './Header.vue';
// import Data from './Data.vue';
    export default {
        methods: {
            backe(){
                this.$router.go(-1)
            },
            redirect(){
                this.$router.push({name:'home'})
            },
            forverd(){
                this.$router.go(1)
            },
        },
        components:{
            FileUploadComponent,
            HelloWorld
            // Header,
            // Data
        }
    }
</script>

<style scoped>
.left-menu{
    background: #3490dc !important;
    height: 100vh;position: fixed; width: 200px;
}
.left-menu h2 a,.left-menu p a{
    color: black;
    font-weight: 500;
    text-decoration: none;
   
}
/* .scroll-data{
    height: ;
} */
</style>