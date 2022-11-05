<template>
  <div class="container py-5" >
    <h1>Registration</h1>
    <p style="color:red" >{{success}}</p>
    <p v-for="e in eror" :key="e" >
      {{e}} is valid
    </p>
    <div class="row">
      <div class="col-8">
        <form>
          <div class="form-group">
            <label>name</label>
            <input type="text"  class="form-control" v-model="form.name">
            <span v-if="errors.name" class="text-danger">
              <small v-text="errors.name[0]"></small>
            </span>
          </div>
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
          <div class="form-group">
            <label>re-password</label>
            <input type="text"  class="form-control"  v-model="form.repass" >
            <span v-if="errors.repass" class="text-danger">
              <small v-text="errors.repass[0]"></small>
            </span>
          </div>
          <p>
            <router-link to="/loginaccount" class="nav-item nav-link">if you have allredey accout login</router-link>
          </p>
          <button @click.prevent="addPost" class="btn btn-primary">Reagistation</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
export default ({
  data() {
    return {
      form:{
        name:'',
        email:'',
        password:'',
        repass:''
      },
      eror:[],
      errors: [],
      datas:null,
      success:null
    }
  },
  methods: {
    addPost(e) {
      e.preventDefault();
      console.log(this.form,"post all datra")
      this.$store.dispatch('register',
        {
          email: this.form.email,
          password: this.form.password,
          name: this.form.name,
          repass: this.form.repass
        })
        .then(() => {
          this.$router.push({ name: 'login' })
        })
        .catch(error => this.errors = error.response.data.errors,)
    },
  },
})
</script>
