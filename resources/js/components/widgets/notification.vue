<template>
<div :class="'alert alert-info shadow-sm '+ randomClass">
    {{message}}
    <button type="button" class="close" v-on:click="makeEvent(randomClass)">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
</template>

<style scoped>
.alert {
    transition: 0.5s;
    width: 60%;
    margin: auto;
    margin-top: 20px !important;
}
.close{
    position: absolute;
    right: 1px !important;
    top: 50% !important;
    transform: translateY(-50%);
    color: maroon;
    display: flex;
    justify-content: center;
    align-items: center;

}
@media (max-width:800px){
    .alert{
        width:90% !important;
    }
}
</style>

<script>
export default {
    name: "notification",
    data(){
        return{
            randomClass:Math.floor(Math.random()*10000)
        }
    },
    props: {
        message: '',
        identification:''
    },
    methods: {
        makeEvent: function (clss) {
            $(`.${clss}`).css('opacity', '0.4');
            this.$emit('deleteMe');
        }
    }
}
</script>
