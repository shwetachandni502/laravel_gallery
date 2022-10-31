<template>
    <div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 my-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h2 class="profiles">
                            Profile detail
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="profile-data">
                            <div class="imgresize">
                                <p v-if="claims1.path">
                                <img :src="claims1.path" width="250px" />
                                </p>
                                <p v-else>
                                <img src="/storage/uploads/Profile-512.png" class="w-100" width="250px" />
                                </p>
                            </div>
                            <h3 class="text-center">{{claims1.name}}</h3>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="email-data text-left">
                                        <div class="row">
                                        <div class="col-3  ">
                                            <h4 class=" p-0 pl-2">Email</h4>
                                            </div>
                                            <div class="col-9">
                                             <p class="mb-0" v-if="claims1.email" > {{claims1.email}} </p>
                                            <p class="mb-0" v-else>-</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="email-data text-left">
                                        <div class="row">
                                        <div class="col-3  ">
                                            <h4 class=" p-0 pl-2">Phone</h4>
                                            </div>
                                            <div class="col-9">
                                             <p class="mb-0" v-if="claims1.phone" > {{claims1.phone}} </p>
                                            <p class="mb-0" v-else>-</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="email-data text-left">
                                        <div class="row">
                                        <div class="col-3  ">
                                            <h4 class=" p-0 pl-2">DOB</h4>
                                            </div>
                                            <div class="col-9">
                                            
                                            <p class="mb-0" v-if="claims1.DOB" > {{claims1.DOB}} </p>
                                            <p class="mb-0" v-else>-</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-12 col-md-6">
                                    <div class="email-data text-left">
                                        <div class="row">
                                        <div class=" col-3  ">
                                            <h4 class=" p-0 ">city</h4>
                                            </div>
                                            <div class="col-9">
                                            <p class="mb-0" v-if="claims1.city" > {{claims1.city}} </p>
                                            <p class="mb-0" v-else>-</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="email-data text-left">
                                        <div class="row">
                                        <div class="col-3  ">
                                            <h4 class=" p-0 ">state</h4>
                                            </div>
                                            <div class="col-9">
                                            <p class="mb-0" v-if="claims1.state" > {{claims1.state}} </p>
                                            <p class="mb-0" v-else>-</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="email-data text-left">
                                        <div class="row">
                                        <div class="col-3">
                                            <h4 class=" p-0 ">country</h4>
                                            </div>
                                             <div class="col-9">
                                            <p class="mb-0" v-if="claims1.country" > {{claims1.country}} </p>
                                            <p class="mb-0" v-else>-</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12"> <button class="btn btn-info buttons" >
                                <router-link to="/editeprofile">Edite Profile</router-link>
                            </button></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</template>

<script>
export default ({
  components:{
   
  },
      data  () {
    return {
      claims: '',
      claims1: '',
      data:"Profile"
    }
  },
  methods: {
    // refreshRecord(record) {
     
    //   this.claims1 = record;
    // },
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
    // const userprofile = localStorage.getItem('profile')
    const userInfo = localStorage.getItem('user')
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.claims1=userData.data;
      console.log(this.claims ,"login")
    }

    //  if (userprofile) {
    //   const userData = JSON.parse(userInfo)
    //   this.claims1=userData.data;
    //   console.log(this.claims,"profile")
    // }
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
.profiles{
    font-weight: 600;
    color: white;
}
.buttons {
    width: 140px;
    margin: 0 auto;
}


</style>
