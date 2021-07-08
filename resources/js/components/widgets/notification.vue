<template>
<div class="alert alert-info shadow-sm">
    {{message}}
    <button type="button" class="close" v-on:click="makeEvent()" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
</template>

<style scoped>
.alert {
    transition: 0.3s;
    width: 60%;
    margin: auto;
    margin-top: 20px !important;
}
</style>

<script>
export default {
    name: "notification",
    props: {
        message: ''
    },
    methods: {
        makeEvent: function () {
            this.$emit('deleteMe');
        }
    }
}
</script>
