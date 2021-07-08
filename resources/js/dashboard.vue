<template>
    <div class="dashboard">
    <navbar></navbar>
<div class="controls">
<sidebar></sidebar><appContent></appContent>
</div>
</div>
</template>
<style scoped>
.dashboard{
    width:100% !important;
    background-color:#F1F5F7;
    overflow: hidden;
    height: 100vh;
    font-smooth: always;
}

.controls{
    display:flex;
    width:100%;
}
</style>
<script>
import appContent from './components/appContent.vue'
import navbar from './components/navbar.vue';
import sidebar from './components/sidebar.vue';
    export default {
        name:'dashboard',
        components:{navbar,sidebar,appContent}
    }
</script>
