<template>
    <div class="mx-5 py-5">
        <div class="row">
            <div class="col-12">
                <input class="from-contole col-4" placeholder="Enter post title" type="text" v-model="search" @keyup="serchvalue" >

                <!-- <button class="btn btn-info">
                    <router-link to="/demoprofile">
                    addpost</router-link>
                </button> -->
            </div>
            <div class="card-columns"> 
                <div class="card my-3" v-for="item in records" :key="item.id">
                   <div v-if="item.img.length>1" >
                        <div :id="'data'+item.id" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item " :class="ingex===0 ? 'active' : ''" v-for="(itemimg,ingex) in item.img" :key="itemimg">
                            <img class="d-block w-100" v-bind:src="`/storage/multiuplode/${itemimg}`" alt="First slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" :href="'#data'+item.id" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" :href="'#data'+item.id" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        </div>
                    </div>
                    <div v-else v-for="(itemimg) in item.img" :key="itemimg" >
                         <img
                        v-bind:src="`/storage/multiuplode/${itemimg}`"
                        class="card-img-top"
                        alt="img"
                    />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{item.title}}</h5>
                        <p class="card-text">{{item.detail}}
                       
                        </p>
                        <p v-if="claims.id===item.userid" >
                            <router-link class="btn btn-primary"  :to ="{name:'editepost', params: {id: item.id }}">update profile</router-link>
                            <button :value="item.id" @click="delteprofile" class="btn btn-primary my-3">delete profile</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default ({
    setup() {
        
    },
    data() {
        return {
            claims:"",
            id:this.$route.params.id,
            records:'',
            search:''
            
        }
    },
    created() {
        const userInfo = localStorage.getItem('user')
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.claims=userData.data;
      
      
    }
         this.allpost();
    },
    methods: {
        serchvalue(){
            
                    axios.get(`/allpost/search/${this.search}`)
                        .then(response => {this.records = response.data
                         var coldDrinks = response.data.map(function(drink) {
                   drink.img=  JSON.parse(drink.img)
                     return drink;
                });
                this.records=coldDrinks
                        })
                        .catch(error => console.log(error))
               
        },
        delteprofile(e){
            e.preventDefault();
            
            console.log(e.target.value)
            if(confirm("are you sure?")){
                axios.delete(`/allpost/${e.target.value}`)
                .then(response => {this.records = response.data;console.log(response.data,"data") })
                .catch(error => console.log(error))
                 this.allpost()
            }
            else{
                console.log("not")
            }
            
        },
        allpost(){
            axios.get(`/allpost`)
                .then(response => {this.records = response.data;console.log(response.data,"data") 
                 var coldDrinks = response.data.map(function(drink) {
                   drink.img=  JSON.parse(drink.img)
                     return drink;
                });
                this.records=coldDrinks
                })
                .catch(error => console.log(error))
        }
    },

})
</script>

<style scoped>

@media (min-width: 48em) {
    .card-columns {
        -webkit-column-count: 1;
        -moz-column-count: 1;
        column-count: 1;
    }
}



@media (min-width: 62em) {
    .card-columns {
        -webkit-column-count: 2;
        -moz-column-count:2;
        column-count: 2;
    }
}

@media (min-width: 75em) {
    .card-columns {
        -webkit-column-count: 4;
        -moz-column-count: 4;
        column-count: 4;
    }
}
</style>
