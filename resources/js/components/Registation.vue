<template>
    
    <div class="container py-5" >
        <h1>Registration</h1>
        <p style="color:red" >{{success}}</p>
        <p v-for="e in eror" :key="e" >
                {{e}} is valid
            </p>
       <!-- <form  >
           <input name="name" type="text" class="no" placeholder= "enter name" ref="name" v-model="form.name"><br><br>
        <input name="detail" type="text" ref="input" placeholder="enter value" v-model="form.detail"><br><br>
         <button type="button" @click="inputdata">click</button>
       </form> -->
       <div class="row">
       <div class="col-8">
       <form @submit.prevent="addPost" content-type="multipart/form-data">
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
            <button type="submit" class="btn btn-primary">Reagistation</button>
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
    setup() {
        
    },
     mounted() {
       
    },
    methods: {
    //      inputdata:function(e){
    //          e.preventDefault();
             
    //        this.eror=[];this.success=null
    //        for(const item in this.form){
    //            if(this.form[item]==='' && this.form[item].length===0 ){
    //                this.eror.push(item)
    //            }
    //        }
    //         if(this.eror.length==0){
    //              Vue.axios.post("http://127.0.0.1:8000/api/registore",this.form).then(res=>
    //                 {
    //                 console.log(res.data.data)
    //                 this.datas=res.data.data
    //                 console.log(this.datas.id)
    //                 this.success=null
    //                 if(this.datas.id!=null){
    //                     this.success="data is  add"
    //                 }
    //                 else{
    //                     this.success="data is not  add"

    //                 }
    //                 });
    //         }
           
    //    },
        addPost() {
                
                    console.log(this.form,"post all datra")
                // axios
                //     .post('http://localhost:8000/api/registore/', this.form)
                //     .then(response => (console.log(response),
                //         this.$router.push({name: 'loginaccount'})
                //     ))
                //     .catch(error => this.errors = error.response.data.errors)
                //     .finally(() => this.loading = false)



                     this.$store
                    .dispatch('login', {
                    email: this.form.email,
                    password: this.form.password,
                    name: this.form.name,
                    repass: this.form.repass
                    })
                    .then(() => {
                    this.$router.push({ name: 'allnewpost' })
                    })
                    .catch(error => this.errors = error.response.data.errors,)
            },
    },
})
</script>
