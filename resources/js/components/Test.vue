<template>
    <div>
        Test
         
      <p>Welcome back, {{claims}}!</p>
   
    </div>
</template>

<script>
export default ({
    setup() {
        
    },
     data  () {
    return {
      claims: '',
    }
  },
  created () { 
    //   this.setup()
    const userInfo = localStorage.getItem('user')
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.claims=userData.data.email;
      console.log(userData.data.email)
    }
   },
   mounted() {
       const userInfo = localStorage.getItem('user')
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.claims=userData.data.email;
      console.log(userData.data)
    }
   },
   methods: {
       
    // async setup () {
    //   this.claims = await this.$auth.setUserData()
    // },
    // async isAuthenticated () {
    //   this.authenticated = await this.$auth.isAuthenticated()
    // },
  }
})
</script>
