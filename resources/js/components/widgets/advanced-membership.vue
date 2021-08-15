<template>
<div class="home">
    <div class="loader shadow-sm">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
     <div class="rights jumbotron flex align-items-center justify-content-center shadow-sm text-center" style="height:100%;" v-if="user.position != 'admin' && user.length != 0">
        <h5>You need admin rights to view the membership requests</h5>
        <p v-if="admins.length > 0" class="text-muted">
            Contact either of the following members for permission
        </p>
        <ul v-if="admins.length > 0">
            <li v-for="admin in admins" :key="admin.id"><b>{{admin.name}}</b></li>
        </ul>
    </div>
      <div class="rights jumbotron flex align-items-center justify-content-center shadow-sm text-center" style="height:100%;" v-if="user.position == 'admin' && requests.length == 0 ">
        <h5>You have no join requests</h5>
    </div>
    <div class="flex" v-if="user.position == 'admin' && requests.length > 0">
        <div :class="'member-card shadow-sm '+request.id" v-for="request in requests" :key="request.id">
            <div class="left">
                <div class="avatar mx-1">
                    <p class="my-1">{{request.name.split(' ')[0].charAt(0)}}{{request.name.split(' ')[1].charAt(0)}}</p>
                </div>
            </div>
            <div class="details">
                <div class="user-name">
                    {{request.name}}
                </div>
                <div class="position">
                    <small class="text-secondary">{{request.created_at | moment("from","now")}}</small>
                </div>
                <div class="email text-muted">
                    <small>{{request.email}}</small>
                </div>
                <div class="flex justify-content-between" style="width:100%;">
                    <button class="btn btn-sm my-3 btn-primary" v-on:click="acceptRequest(request.id)">
                        Accept request
                    </button>
                    <button class="btn btn-sm my-3 btn-danger" v-on:click="deleteRequest(request.id)">
                        Delete request
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped>
.home {
    width: 100%;
    background: #F1F5F7 !important;
}

.member-card {
    background-color: white;
    height: 150px;
    padding: 10px;
    width: 350px;
    margin: 30px;
    display: flex;
    align-items: center;
    border-radius: 16px;
}

.member-card .left {
    height: 100%;
    width: fit-content;
    display: flex;
    align-items: center;
}

.member-card .left .avatar {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background-color: #2C76DC;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
}

.details {
    flex: 1;
}

.details .user-name {
    font-weight: bold;
    width: 90%;
    margin: auto;
    font-size: 18px;
    color: rgb(63, 63, 63);
    text-align: center;
}

.position {
    width: 90%;
    margin: auto;
    display: flex;
    justify-content: center;
}

.email {
    width: 100%;
    display: flex;
    justify-content: center;
    opacity: 0.7;
}
.jumbotron{
    flex-direction:column;
}
</style>

<script>
export default {
    name: 'membership',
    mounted() {
       
        this.getRequests();
          this.getUser()
        this.getAllUsers()
    },
    data() {
        return {
            requests: [],
             user:[],
            allUsers: [],
            admins: [],
            Users:[]
        }
    },
    methods: {
        getRequests: function () {
            axios.get(location.origin + '/api/get-all-join-requests').then((res) => {
                this.requests = res.data;
                 $('.loader').hide();
            }).catch((err) => {
                alert(err);
            })
        },   
        getAllUsers: function () {
            fetch(location.origin+'/api/all-users')
                .then((res) => res.json())
                .then((data) => {
                    this.allUsers = data;
                    for (let i = 0; i < this.allUsers.length; i++) {
                        const element = this.allUsers[i];
                        if (element.position == 'admin') {
                            this.admins.push(element)
                        }
                    }
                    this.getOrg()
                })
                .catch((err) => {
                    console.log(err);
                });

        },
        acceptRequest: function (id) {
            $(`.${id}`).css({
                'opacity':0.5,
                'pointer-events':'none'
            })
            axios.post(location.origin + `/api/accept-join/${id}`).then(() => {
                location.reload();
            }).catch((err) => {
                alert(err);
            });
        },
        deleteRequest: function (id) {
            axios.post(location.origin + `/api/delete-join/${id}`).then(() => {
                location.reload();
            }).catch((err) => {
                alert(err);
            });
        }
    }
}
</script>
