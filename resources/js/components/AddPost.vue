<template>
    <div>
        <h3 class="text-center">Add Post</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addPost" content-type="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="post.name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="post.detail">
                    </div>
                    <div class="form-group">
                        <label>img</label>
                        <input type="file" class="form-control" ref="file" >
                    </div>
                    <button type="submit" class="btn btn-primary">Add Post</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                post: {
                    name:'',
                    detail:'',
                    avatar:{}
                },
                avatar:'',
                avatarName:''
            }
        },
        methods: {
            addPost() {
                
                    console.log(this.post,"post all datra")
                axios
                    .post('http://localhost:8000/api/userdata/', this.post)
                    .then(response => (console.log(response),
                        this.$router.push({name: 'home'})
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)

            },
             handleFileObject() {
                 this.post.avatar=this.$refs.file.files[0]
                
            }
        }
    }
</script>