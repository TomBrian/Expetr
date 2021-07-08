<template>
<nav class=" shadow-sm navbar navbar-expand-sm">
    <a class="navbar-brand" :href="location.origin"><img :src="'/images/logo.svg'" class="logo-lg sm-none" alt=""><img :src="'/images/favicon.svg'" class="logo-sm lg-none" alt=""></a>

    <div class=" right">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <router-link to="/dashboard/help"> <a class="nav-link" href="#"><img :src="'/images/help.svg'" class="icon" alt=""></a></router-link>
            </li>
            <li class="nav-item">
                <router-link to="/dashboard/chats"><a class="nav-link" href="#">
                        <div class="w"><img :src="'/images/chats.svg'" class="icon" alt=""><span v-if="unreadTextsCount != '0'" class="badge badge-info"> {{unreadTextsCount}}</span></div>
                    </a></router-link>
            </li>
            <li class="nav-item" style="margin-right:20px !important;">
                <router-link to="/dashboard/notifications"> <a class="nav-link reduce" href="#">
                        <div class="w"><img :src="'/images/notification.svg'" class="icon" alt=""><span v-if="unreadCount > 0" class="badge badge-info"> {{unreadCount}}</span></div>
                    </a></router-link>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <div class="profile">
                        <router-link to="/dashboard/profile">
                            <div class="avatar" :title="user.name">
                                <p>{{avatar}}</p>
                            </div>
                        </router-link>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>
</template>

<style scoped>
.profile {
    display: flex;
    align-items: center;
    font-family: poppins;
    font-size: 14px;

}

.avatar {
    width: 40px;
    height: 40px;
    position: relative;
    color: white;
    border-radius: 50%;
    background-color: #2C76DC;
}

.avatar p {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@media (max-width:1000px) {
    .sm-none {
        display: none !important;
    }

    .icon {
        width: 20px !important;
    }

    .logo-sm {
        width: 25px;
    }
}

@media (min-width:1000px) {
    .lg-none {
        display: none !important;
    }
}

.navbar {
    width: 100%;
    background-color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 2;
}

.nav-item {
    margin-right: 1px;
    font-weight: bolder;
}

.logo-lg {
    width: 150px;
}

.navbar-link {
    width: fit-content;

}

.nav-link .w {
    padding: 10px;
    position: relative;
    height: fit-content;
    width: fit-content;
}

.badge {
    position: absolute;
    border-radius: 50%;
    min-width: 20px;
    min-height: 20px;
    top: 0;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 10px;
}

.nav-item {
    display: flex;
    align-items: center;
}

.icon {
    width: 25px;
}
</style>

<script>
export default {
    name: 'navbar',
    data() {
        return {
            user: {},
            avatar: '',
            unreadNotifications: [],
            unreadCount:0,
            unreadTextsCount: '',
            location:{
                origin:location.origin
            }
        }
    },
    mounted() {
        fetch(location.origin + '/api/user')
            .then(res => res.json())
            .then((data) => {
                this.user = data;
                this.createAvatar()
            }).catch(err => console.log(err))
        setInterval(this.countUnreadNotifications, 20000);
         setInterval(this.countUnreadTexts, 10000);
       
    },
    methods: {
        countUnreadTexts: function () {
            axios.get(location.origin + '/api/get-unread-messages-number').then((res) => {
                this.unreadTextsCount = res.data;
            })
        },
        createAvatar: function () {
            const fullName = this.user.name;
            const nameArr = fullName.split(' ');
            const firstName = nameArr[0];
            const secondName = nameArr[1];
            const initials = firstName.charAt(0) + secondName.charAt(0);
            this.avatar = initials
            console.log('you are logged in as ' + initials);
        }

    }
}
</script>
