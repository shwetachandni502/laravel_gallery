<template>
    <div>
        <h3 class="text-center">All Posts</h3><br/>
 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in posts" :key="post.id">
                <td>{{ post.id }}</td>
                <td>{{ post.name }}</td>
                <td>{{ post.detail }}</td>
                <td>{{ post.created_at }}</td>
                <td>{{ post.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button>
                    </div>
                </td>
            </tr>
             
            </tbody>
        </table>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                posts: []
            }
        },
        created() {
            axios
                .get('http://127.0.0.1:8000/api/userdata')
                .then(response => {
                    this.posts = response.data.data;console.log(response.data)
                });
                 
        },
        methods: {
            deletePost(id) {
                axios
                    .delete(`http://localhost:8000/api/userdata/${id}`)
                    .then(response => {
                        let i = this.posts.map(item => item.id).indexOf(id); // find index of your object
                        
                        this.posts.splice(i,1)
                    });
            }
        }
    }
</script>