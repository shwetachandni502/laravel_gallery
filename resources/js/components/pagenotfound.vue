<template>
    <div class="conatiner">
        <div class="page-not text-center">
            <h1>404</h1>
            <h2>page top found</h2>
            <button class="btn btn-info">
                <router-link to="/">Backe to home</router-link>
            </button>
        </div>
    </div>
</template>
<script>
export default ({
  name:"pagenotfound",
  data(){
      return{
          data:"page not found"
      }
  }
})
</script>
<style scoped>
.page-not h1{
    font-size: 45px;
}
.page-not h2{
    font-size: 30px;
}
</style>
