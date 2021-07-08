<template>
<div class="wrapper home shadow-sm">
    <div class="loader shadow-sm">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="header" v-if="unreadNotifications.length > 0">
        <span class="title">Unread</span>
    </div>
    <notification v-for="notification in unreadNotifications" :key="notification.id" @deleteMe="deleteNotification(notification.id)" :message="notification.data.message"></notification>
    <div class="header my-6" v-if="readNotifications.length > 0">
        <span class="title">Seen</span>
    </div>
    <notification v-for="notification in readNotifications" @deleteMe="deleteNotification(notification.id)" :key="notification.id" :message="notification.data.message"></notification>
</div>
</template>

<style scoped>
.wrapper {
    position: relative;
    width: fit-content !important;
    padding: 10px;
    background-color: white;
    min-width: 70%;
    height: 100%;
    margin: auto;
}

.header {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: roboto;
    font-size: 18px;
    font-weight: bold;
    padding: 15px;
    border-bottom: solid 0.5px rgba(128, 128, 128, 0.247);
    font-family: poppins;
}
</style>

<script>
import notification from './widgets/notification.vue'
export default {
    name: 'notifications',
    components: {
        notification
    },
    data() {
        return {
            unreadNotifications: [],
            readNotifications: [],
            targetId: ''
        }
    },
    mounted() {
        this.getNotifications()
        this.countUnreadNotifications()

    },
    methods: {
        deleteNotification: function (id) {
            axios.get(`${location.origin}/api/delete-notification/${id}`).then(() => {
                this.getNotifications()
                this.countUnreadNotifications()
            }).catch((err) => {
                console.log(err)
            })
        }
    }
}
</script>
