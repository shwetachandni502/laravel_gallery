<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                         
                        I'm an example component.
                    </div>
                </div>
                <table>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>detail</th>
                    </tr>
                    <tr  v-for="item in de" :key="item.id">
                        <td>{{item.id}}</td>
                        <td>{{item.name}}</td>
                        <td>{{item.detail}}</td>
                    </tr>
                   
                    </table>
                
                         <p>hi new componet</p>
            </div>
        </div>
         <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/add" class="nav-item nav-link">Add Post</router-link>
         <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            console.log(this.de)
            
        },
       props:['de']
    }
</script>
