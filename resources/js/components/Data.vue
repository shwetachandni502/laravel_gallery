<template>
    <div class="container-fluid footer-data">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">footer data</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
        <!-- <FileUploadComponent></FileUploadComponent> -->
    </div>
</template>

<script>
// import FileUploadComponent from './FileUploadComponent'
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components:{
            // FileUploadComponent
        }
    }
</script>
<style scoped>
.footer-data{
    position: static;
    bottom: 0;
}
</style>
