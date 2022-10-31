<template>
   <div>
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
        </div>
 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/all" class="nav-item nav-link">Home</router-link>
                    <router-link to="/about" class="nav-item nav-link">about</router-link>
                    <router-link to="/help" class="nav-item nav-link">help</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <Letmenu></Letmenu>
    </div>
</template>
 
<script>
import Letmenu from './Letmenu'
    export default {
        components:{
            Letmenu
        }

    }
</script>