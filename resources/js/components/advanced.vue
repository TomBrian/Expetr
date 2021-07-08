<template>
<div class="home">
    <ul class="nav my-4 nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <router-link class="nav-link " id="home-tab" to="/dashboard/advanced" data-toggle="tab" aria-controls="home" aria-selected="true"><i class="fa fa-user" aria-hidden="true"></i> Account</router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" id="home-tab" to="/dashboard/advanced/general" data-toggle="tab" aria-controls="home" aria-selected="true"> <i class="fa fa-users" aria-hidden="true"></i> General</router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link  flex justify-content-between" id="home-tab" to="/dashboard/advanced/membership" data-toggle="tab" aria-controls="home" aria-selected="true"><span><i class="fas fa-sign-in-alt"></i> Membership requests</span>&nbsp;<span class="badge badge-warning mx-2" v-if="requests.length > 0" id="number">{{requests.length}}</span></router-link>
        </li>
    </ul>

    <router-view name="a"></router-view>
</div>
</template>

<style scoped>
.home {
    width: 100% !important;
}
#number{
    border-radius: 50%;
}

nav {
    width: 80% !important;
    margin: auto;
}

.active {
    background: #efefef;
}
</style>

<script>
import advancedAccountVue from './widgets/advanced-account.vue'
export default {
    name: 'advanced',
    components: {
        advancedAccountVue
    },
    mounted() {
        $('.router-link-exact-active').addClass('active');
       this.countUnreadNotifications();
       this.getRequests();
    },
    data(){
        return {
            requests:[]
        }
    },
    methods:{
        getRequests:function(){
             axios.get(location.origin + '/api/get-all-join-requests').then((res) => {
                this.requests = res.data;
            }).catch((err) => {
                alert(err);
            })
        }
    }
}
</script>
