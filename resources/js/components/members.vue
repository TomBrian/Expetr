<template>
<div class="home">
<div class="jumbotron jumbotron-fluid flex  align-items-center px-5 text-center" v-if="AllUsers.length < 1" style="margin:auto;"> 
    <div class="container flex  align-items-center">
        <div>
       <h5>You have no members in your organisation.</h5>
       <small class="text-muted">Share the organisation code with those you want to add to the organisation.Your organisation code will be required while we register them</small>
    </div>
    </div>
</div>
    <div class="member-card shadow-sm" v-for="user in AllUsers" :key="user.id">
        <div class="left">
            <div class="avatar mx-1">
                <p class="my-1">{{user.avatar}}</p>
            </div>
        </div>
        <div class="details">
            <div class="user-name">
                {{user.name}}
            </div>
            <div class="position">
                <div class="badge my-1 badge-secondary">{{user.position}}</div>
            </div>
            <div class="email text-muted">
                <small>{{user.email}}</small>
            </div>
            <div class="chat my-1">
                
                <small class="text-muted">Joined {{user.created_at | moment("from", "now")}}</small>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'members',
    data() {
        return {
            AllUsers: []
        }
    },
    mounted() {
        axios.get(location.origin + '/api/all-users').then((res) => {
            this.AllUsers = res.data
            //console.log(this.AllUsers)
            this.createAvatar()
           // this.sanitizeDate()
        }).catch((err) => {
            console.log(err)
        })
        this.countUnreadNotifications()
    },
    methods: {
        // sanitizeDate: function () {
        //     this.AllUsers.forEach(
        //         user => {
        //             const date = user.created_at;
        //             const dateArray = date.split('T');
        //             user.created_at = dateArray[0];
        //         }
        //     )
        // },
        createAvatar: function () {
            this.AllUsers.forEach(user => {
                const fullName = user.name;
                const nameArr = fullName.split(' ');
                const firstName = nameArr[0];
                const secondName = nameArr[1];
                const initials = firstName.charAt(0) + secondName.charAt(0);
                user.avatar = initials
            });
        }
    }
}
</script>

<style scoped>
.member-card {
    background-color: white;
    height: 150px;
    padding: 10px;
    width: 290px;
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

.home {
    flex-direction: row !important;
    flex-wrap: wrap;
    background-color: transparent !important;
    justify-content: space-between;
    width: 99% !important;
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

.chat {
    width: 80%;
    display: flex;
    margin: auto;
    justify-content: space-between;
    margin-top: 20px !important;
}

.chat .icon {
    width: 20px !important;
}
</style>
