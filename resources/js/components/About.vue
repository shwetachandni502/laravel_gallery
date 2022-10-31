<template>
    <div>
        <h1>about page</h1>
        <div class="conatiner">
            <div class="row all-card">
                    <div class="col-4 my-3" v-for="item in data" :key="item.id">
                        <router-link :to ="{name:'alldata', params: {id: item.id }}">
                        <div class="card " >
                            <img :src="item.parth" width="" class="w-100" />
                            <div class="card-body">
                                <p>{{item.name}}</p>
                            </div>
                        </div>
                        </router-link>
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
            data:{}
        }
    },
    created(){
        this.axios.get(`api/page`)
        .then(res=>{this.data=res.data
            console.log("all data",this.data)
        })
        .catch(error => console.log(error))
        
    },
})
</script>

<style scoped>
.all-card a{
        color: #1d68a7;
    text-decoration: none;

}
</style>