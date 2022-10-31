<template>
    <div>
        <h1>detailpage</h1>
        <div class="conatiner">
            <div class="row">
                    <div class="col-12 my-3" v-for="item in onedata" :key="item.id">
                        <div class="card " >
                            <img :src="item.parth" width="" class="w-100" />
                            <div class="card-body">
                                <p>{{item.name}}</p>
                                <p>{{item.email}}</p>
                                <p>{{item.phone}}</p>
                                <button class="btn btn-info" @click="back" >back</button>
                                <button class="btn btn-info" @click="redirect" >redirect</button>
                            </div>
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
    methods: {
        back(){
            this.$router.go(-1)
        },
        redirect(){
                this.$router.push({name:'Home1'})
            },
    },
    data() {
        return {
            data:"detailpage",
            id:this.$route.params.id,
            onedata:{}
        }
    },
    created() {
         axios.get(`/pages/${this.id}/edit`)
        .then(res=>{this.onedata=res.data
            console.log("all data",this.onedata)
        })
        .catch(error => console.log(error))
    },
})
</script>
