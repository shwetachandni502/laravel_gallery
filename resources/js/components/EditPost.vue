<template>
    <div>
        <h3 class="text-center">Edit Post</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updatePost">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="post.name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="post.detail">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Post</button>
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
                    name:null,
                    detail:null,
                },
                
            }
        },
        created() {
            axios
                .get(`http://localhost:8000/api/userdata/${this.$route.params.id}`)
                .then((response) => {
                    this.post.name = response.data.data.name;
                    this.post.detail = response.data.data.title;
                });
        },
        methods: {
            updatePost() {
                axios
                    .put(`http://localhost:8000/api/userdata/${this.$route.params.id}`, this.post)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>