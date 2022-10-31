<template>
    
    <div class="container py-4" >
        <h1>Login</h1>
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
    setup() {
        
    },
     mounted() {
       
    },
    methods: {
    
        addPost() {

             this.$store
        .dispatch('login', {
          email: this.form.email,
          password: this.form.password
        })
        .then(() => {
          this.$router.push({ name: 'allnewpost' })
        })
        .catch(error => this.errors = error.response.data.errors,)

                
                    console.log(this.errors,"post all datra")
                // axios
                //     .post('http://localhost:8000/api/registore/', this.form)
                //     .then(response => (console.log(response),
                //         this.$router.push({name: 'home'})
                //     ))
                //     .catch(error => console.log(error.message))
                //     .finally(() => this.loading = false)

            },
    },
})
</script>
