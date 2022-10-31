<template>
    <div>
        <h1>update Post</h1>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card border-primary mb-3">
                    <div class="card-header">Update post</div>
                    <div class="card-body ">
                        <div class="form-group">
                            <input type="hidden" v-model="claims.id" />
                            <label for="name">Name</label>
                            <input type="text" 
                                name="name" 
                                id="name" 
                                class="form-control" 
                                v-model="record.name"
                                >
                            <span v-if="errors.name" class="text-danger">
                                <small v-text="errors.name[0]"></small>
                            </span>
                      </div>
                    <div class="form-group">
                        <label for="name">Detail</label>
                        <input type="text" 
                            name="detail" 
                            id="detail" 
                            class="form-control" 
                            v-model="record.detail"
                            >
                        <span v-if="errors.detail" class="text-danger">
                            <small v-text="errors.detail[0]"></small>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="title">Tilte</label>
                        <input type="text" 
                            name="title" 
                            id="title" 
                            class="form-control" 
                            v-model="record.title"
                            >
                        <span v-if="errors.title" class="text-danger">
                            <small v-text="errors.title[0]"></small>
                        </span>
                    </div>
                    <div class="form-group ">
                        <label for="title">upload Post</label>
                       <input type="file" 
					   name="file" 
					   id="file" multiple
					   class="form-control" 
                       v-on:change="onChange"
					   >
                       <p  v-for="itemss in record.img" :key="itemss"   class="d-inline-block censel-img">
                           <img  class="m-2" v-bind:src="`/storage/multiuplode/${itemss}`" width="100"/>
                        
                           <input type="checkbox" :value="itemss"  id="test1" v-model="checkboxvalue"/>
                           <!-- <span class="close-buttona"  >
                               
                           </span> -->
                       </p>
                        <span v-if="errors.file" class="text-danger">
                            <small v-text="errors.file[0]"></small>
                        </span>
                    </div>
                    <!-- <span v-if="errors.dataerorr" class="text-danger">
					<small v-text="errors.dataerorr"></small>
				</span> -->
                    <button class="btn btn-info" @click="postuplod" >upload post</button>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        
            
    </div>
</template>

<script>
export default ({
    setup() {
        
    },
    data() {
        return {
            claims:'',
            record:{},
            file:[],
            id:this.$route.params.id,
            errors:[],
            checkboxvalue:[]
        }
    },
    mounted(){
    const userInfo = localStorage.getItem('user')
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.claims=userData.data;
      
      console.log(this.claims ,"login")
    }
    axios.get(`/allpost/${this.id}/edit`)
    .then(response => {this.record = response.data.data[0];
     
     
var coldDrinks = response.data.data.map(function(drink) {
                   drink.img=  JSON.parse(drink.img)
                     return drink;
                });
                this.records=coldDrinks
                console.log(this.records,"dataaa")
    })
     .catch(error => console.log(error))

    },
    methods: {
             onChange(e) {
                  if (e.target.files) {
                this.file = e.target.files;
                // var reader = new FileReader();
                //  reader.onload = (er) => {
                
                //     this.record.parth = er.target.result;
                // }
                // reader.readAsDataURL(e.target.files[0]);
                 console.log( this.file)
                  }
            },
        postuplod(){
             const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                console.log(this.checkboxvalue)
                let data = new FormData();
				data.append('checkboxvalue', this.checkboxvalue);
				// data.append('file', this.record.file);
                for(let i=0; i<this.file.length; i++){
                 data.append('file[]', this.file[i])
                }

				data.append('name', this.record.name);
				data.append('title', this.record.title);
				data.append('detail', this.record.detail);
				data.append('userid', this.claims.id);
                axios.post(`/editpostdata/${this.id}`,data)
					.then(data => {
                        console.log(data);
                         this.$router.push({ path: `/Mypost` });
						// this.$emit('recordAdded', data);
						// this.record = {};
						// $('#addRecord').modal('hide');
					})
					.catch(error => this.errors = error.response.data.errors)
        }
    },
})
</script>
<style  scoped>
.censel-img{
    color: red;
    position:relative;
}
.censel-img input{
    /* position: absolute ; */
    top: 4px;
    right: -5px;
    width: 32px;
    /* transform: rotate(
54deg
); */
}
                          
.close-buttona{
    position: absolute;
    top:0px;
    right: 33px;
    width: 26px;z-index: 1;display: block;
    height: 26px;
    border-radius: 50%;
    background: brown;

}


</style>
