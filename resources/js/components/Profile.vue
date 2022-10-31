<template>
    <div class="profilepage p-5 text-center ">
        <h1>{{data}}</h1>
        <div class="row">
          <div class="col-4 py-5">
            <div class="profile-data">
              <div class="imgresize">
                <p v-if="claims1.path">
                <img :src="claims1.path" width="250px" />
                </p>
                <p v-else>
                   <img src="/storage/uploads/Profile-512.png" class="w-100" width="250px" />
                </p>
              </div>
              <h3>{{claims1.name}}</h3>
              <div class="email-data text-left">
                <div class="row">
                  <div class="col-3  ">
                    <h4 class=" p-0 pl-2">Email</h4>
                    </div>
                    <div class="col-9">
                      <p class="" >{{claims1.email}}</p>
                    </div>
                </div>
              </div>
              <div class="email-data text-left">
                <div class="row">
                  <div class="col-3  ">
                    <h4 class=" p-0 pl-2">Phone</h4>
                    </div>
                    <div class="col-9">
                      <p class="" >{{claims1.phone}}</p>
                    </div>
                </div>
              </div>
              <!-- <div class="email-data text-left">
                <h4 class="d-inline-block p-0 pr-5 pl-3">Phone</h4>
                <p class="d-inline-block" >{{claims.phone}}</p>
              </div> -->
            </div>
          </div>
          <div class="col-8">
            <div class="edite-profile ">
              <div class="">
                <button class="btn btn-success btn-sm " data-toggle="modal" data-target="#addRecords">
                  Edit Profile</button>
              </div>
              <div class="email-data text-left">
                <div class="row">
                  <div class="col-2  ">
                    <h4 class=" p-0 pl-2">dob</h4>
                    </div>
                    <div class="col-9">
                      <p class="" >{{claims1.DOB}}</p>
                    </div>
                </div>
              </div>
              <div class="email-data text-left">
                <div class="row">
                  <div class="col-2  ">
                    <h4 class=" p-0 pl-2">city</h4>
                    </div>
                    <div class="col-9">
                      <p class="" >{{claims1.city}}</p>
                    </div>
                </div>
              </div>
              <div class="email-data text-left">
                <div class="row">
                  <div class="col-2  ">
                    <h4 class=" p-0 pl-2">state</h4>
                    </div>
                    <div class="col-9">
                      <p class="" >{{claims1.state}}</p>
                    </div>
                </div>
              </div>
               <div class="email-data text-left">
                <div class="row">
                  <div class="col-2  ">
                    <h4 class=" p-0 pl-2">country</h4>
                    </div>
                    <div class="col-9">
                      <p class="" >{{claims1.country}}</p>
                    </div>
                </div>
              </div>
              <div>
          <button class="btn btn-info text-left">
            <router-link to="/Addposts">add post</router-link>
          </button>
        </div>
            </div>
          </div>
        </div>

        

      <div id="modal" class="text-left">
        <Updateprofile @recordAdded="refreshRecord"></Updateprofile>
      </div>




    </div>
</template>
<script>
import Updateprofile from './Updateprofile'
export default ({
  components:{
    Updateprofile
  },
    setup() {
        
    },
      data  () {
    return {
      claims: '',
      claims1: '',
      data:"Profile"
    }
  },
  methods: {
    refreshRecord(record) {
     
      this.claims1 = record;
    },
    getsingledata(){
      axios.get(`/getsingledata/${this.claims1.id}`)
					.then(data => {
            this.claims1=data.data.data
              console.log(data.data,"getsingledata");
					})
					.catch(error => this.errors = error.response.data.errors)
    }
  },
  created() {
    
  
    //   this.setup()
    const userprofile = localStorage.getItem('profile')
    const userInfo = localStorage.getItem('user')
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.claims1=userData.data;
      console.log(this.claims ,"login")
    }

     if (userprofile) {
      const userData = JSON.parse(userInfo)
      this.claims1=userData.data;
      console.log(this.claims,"profile")
    }
    this.getsingledata()
   },
})
</script>

<style scoped>
.imgresize{
  width: 250px;
  height: 250px;
  margin: 0 auto;
}
.imgresize img{
  border-radius: 50%;
   width: 250px;
  height: 250px;
}
.profile-data h3,.profile-data h4,.edite-profile h3,.edite-profile h4{
  font-weight: 600;
  padding: 20px;
}


</style>
