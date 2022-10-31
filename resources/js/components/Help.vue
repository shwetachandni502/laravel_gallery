<template>
    <div>
        <h1>{{data}}</h1>
        <me></me>
    </div>
</template>
<script>
import me from './me.vue'

export default ({
    setup() {
        
    },
    components:{

        me
    },
    data() {
        return {
            data:"help paged"
        }
    },
})
</script>
