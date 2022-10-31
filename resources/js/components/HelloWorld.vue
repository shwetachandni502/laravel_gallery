<template>
<div class="text-left">
  <div class="container-fluid">
    <div class="conatainer">
      <div class="row">
        <div class="col-12">
          <nav class="navbar navbar-expand-lg navbar-light bg-light  naigation">
                <div class="collapse navbar-collapse naigation">
                    <div class="navbar-nav">
                        <router-link to="/allnewpost" class="nav-item nav-link">Home</router-link>
                        <router-link to="/help" class="nav-item nav-link">help</router-link>
                        <!-- <router-link to="/demoprofile" class="nav-item nav-link">demoprofile</router-link> -->
                        <router-link to="/allnewpost" class="nav-item nav-link">Allpost</router-link>
                        <router-link to="/demoprofile" v-if="isLogged"  class="nav-item nav-link">Addposts</router-link>
                        <router-link to="/Mypost" v-if="isLogged"  class="nav-item nav-link">Mypost</router-link>
                        <router-link to="/profile1" v-if="isLogged" class="nav-item nav-link">Profile</router-link>
                       
                    </div>
                </div>
                 <button class="btn btn-info p-0 "  v-if="!isLogged">
                    <!-- <router-link to="/new" class="nav-item nav-link">registation</router-link> -->
                    <router-link to="/new">registation</router-link>
                  </button>
                   

                   <button class=" btn btn-info" @click="logout()" v-if="isLogged">
                      Logout 
                    </button>
            </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="conatainer">
      
        <router-view></router-view>
      
    </div>
  </div>
</div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'HelloWorld',
  props: {
   
  },
  data(){

    return{
      claims:""
    }
  },
  computed: {
    ...mapGetters([
      'isLogged'
    ])
  },
    created () { 
    //   this.setup()
    // const userInfo = localStorage.getItem('user')
    // if (userInfo) {
    //   const userData = JSON.parse(userInfo)
    //   this.claims=userData.data.email;
    //   console.log(this.claims)
    // }
   },
   methods: {
    logout () {
      this.$store.dispatch('logout')
    }
  }


}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a{
  color: black;
}
.naigation button {
  width: 100px;color:black  !important;height: 35px;
}
</style>
