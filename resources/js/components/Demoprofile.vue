<template>
    <div>
        <h1>Add Post</h1>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card border-primary mb-3">
                    <div class="card-header">Addpost</div>
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
                    <div class="form-group">
                        <label for="title">upload Post</label>
                       <input type="file" 
					   name="file" 
					   id="file" ref="file"
					   class="form-control" 
                       v-on:change="onChange" 
                       multiple
					   >
                       
                          
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
            record:{
                file:[]
            },
            file:[],
            errors:[],
            filess:[],
            attachments:[]
        }
    },
    created() {
    const userInfo = localStorage.getItem('user')
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.claims=userData.data;
      
      console.log(this.claims ,"login")
    }
    },
    methods: {
             onChange(e) {
                //  this.file=this.$refs.file.files
                if (e.target.files && e.target.files) {
                 this.file=e.target.files
                }
                // for(let i=0; i<file.length; i++){
                //  formData.append('file[]', file[i])
                // }
                console.log(this.file.length,"this.file");
            },
        postuplod(){
             const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let data = new FormData();
				// data.append('file', JSON.stringify(this.file));
                 for(let i=0; i<this.file.length; i++){
                 data.append('file[]', this.file[i])
                }
				// data.append('file', JSON.stringify(this.file));
				data.append('name', this.record.name);
				data.append('title', this.record.title);
				data.append('detail', this.record.detail);
				data.append('userid', this.claims.id);
                console.log(this.record,"all from data")
                axios.post('/demoprofiless',data)
					.then(data => {
                        console.log(data);
                         this.$router.push({ path: `/Mypost` });
					})
					.catch(error => this.errors = error.response.data.errors)
        }
    },
})
</script>
