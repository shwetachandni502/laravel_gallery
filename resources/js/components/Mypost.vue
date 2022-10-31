<template>
    <div class="mx-5 py-5">
        <div class="row">
            <div class="col-12"></div>
            <div class="card-columns"  >
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
                    </div>
                </div>
            </div>
            <div v-if="records.length===0" class="alert alert-secondary w-100" >
                <b>you are not add any post please add post</b>
                <button class="btn btn-info ml-5">
                    <router-link to="/demoprofile">
                    addpost</router-link>
                </button>
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
            
            records:'',
            allimge:'',
            coldDrinks:'',
            de:10
        }
    },
    created() {

        const userInfo = localStorage.getItem('user')
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.claims=userData.data;
      
      
    }
         axios.get(`/pa/${this.claims.id}`)
                .then(response => {this.records = response.data;console.log(this.records,"data") 
                    // console.log( JSON.parse(response.data[0]['img']))
                    var coldDrinks = response.data.map(function(drink) {
                   drink.img=  JSON.parse(drink.img)
                     return drink;
                });
                this.records=coldDrinks
                                console.log(this.records,"datass")

                })
                .catch(error => console.log(error))

                
              
    },

})
</script>

<style scoped>
@media (min-width: 576px){
.card-columns {
   
    column-count: 4;
}}
</style>
