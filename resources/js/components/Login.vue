<template>
  <div class="container py-4" >
    <h1>Login</h1>
    <p style="color:red" >{{success}}</p>
    <p v-for="e in eror" :key="e" >
      {{e}} is valid
    </p>
    <div class="row">
      <div class="col-8">
        <form @submit.prevent="addPost" content-type="multipart/form-data">
          <div class="form-group">
              <label>email</label>
              <input type="text" class="form-control" v-model="form.email">
                <span v-if="errors.email" class="text-danger">
              <small v-text="errors.email[0]"></small>
            </span>
          </div>
            <div class="form-group">
                <label>password</label>
                <input type="text"   class="form-control"  v-model="form.password" >
                  <span v-if="errors.password" class="text-danger">
                <small v-text="errors.password[0]"></small>
              </span>
            </div>
            <span v-if="errors.dataerorr" class="text-danger">
          <small v-text="errors.dataerorr"></small>
        </span>
            <p>
              <router-link to="/new" class="nav-item nav-link">create new accout new account</router-link>
            </p>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default ({
  data() {
    return {
      form:{
        email:'',
        password:'',
      },
      eror:[],
      errors:"",
      datas:null,
      success:null
    }
  },
  methods: {
    addPost() {
      this.$store.dispatch('login',
        {
          email: this.form.email,
          password: this.form.password
        })
        .then(() => {
          this.$router.push({ name: 'allnewpost' })
        })
        .catch(error => this.errors = error.response.data.errors,)
    },
  },
})
</script>
