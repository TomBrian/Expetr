<template>
<div class="home mx-1">

    <!-- Modal -->
    <div class="modal fade conversations-modal" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="container">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#private" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-user" aria-hidden="true"></i> Private chat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#group" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-users" aria-hidden="true"></i> Group chat</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="private" role="tabpanel" aria-labelledby="home-tab">
                                    <!-- private chat -->
                                    <div class="alert alert-success">Conversation opened !</div>
                                    <div class="profiles-wrapper">
                                        <div class="profile-card p-3 flex" v-for="user in allUsers" :key="user.id" v-on:click="makeConversation(user.id)">
                                            <div class="a-wrapper">
                                                <div class="avatar mx-4 font-weight-bold">
                                                    <p class="my-3">
                                                        {{user.name.split(' ')[0].charAt(0)}}{{user.name.split(' ')[1].charAt(0)}}</p>
                                                </div>
                                            </div>
                                            <div class="d-wrapper">
                                                <div>{{user.name}}</div>
                                                <div>
                                                    <small class="text-muted">
                                                        {{user.email}}
                                                    </small>
                                                </div>
                                            </div>
                                            <div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="group" role="tabpanel" aria-labelledby="profile-tab">
                                    <!-- group chat -->
                                    <form autocomplete="off" @submit.prevent="createGroupConversation" style="height:100%;">
                                        <input type="text" class="form-control my-3" v-model="groupForm.name" placeholder="add group name" required />
                                        <div class="alert alert-danger">
                                            Not enough participants to make group
                                        </div>
                                        <div class="text-success"></div>
                                        <div class="profiles-wrapper">
                                            <div class="profile-card p-3 flex" style="justify-content:space-between;" v-for="user in allUsers" :key="user.id">
                                                <div class="a-wrapper">
                                                    <div class="avatar mx-4 font-weight-bold">
                                                        <p class="my-3">
                                                            {{user.name.split(' ')[0].charAt(0)}}{{user.name.split(' ')[1].charAt(0)}}</p>
                                                    </div>
                                                </div>
                                                <div class="d-wrapper">
                                                    <div>{{user.name}}</div>
                                                    <div>
                                                        <small class="text-muted">
                                                            {{user.email}}
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="mx-3">
                                                    <input type="checkbox" v-on:change="AddParticipantConversation(user.id)" style="background-color:blue; color:white; border-radius:50% !important;" :name="user.name" :value="user.id" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer flex">
                                            <button class="btn btn-primary" type="submit">
                                                create group
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="conversations">
        <div class="header sticky-top my-4">
            <div class="flex">
                <h4>Chats</h4>
                <div data-toggle="modal" data-target="#modelId">
                    <img :src="'/images/new.svg'" alt="new" class="icon">
                </div>
            </div>
            <div class="search my-2 flex">
                <input type="search" placeholder="search for conversation..." v-model="searchQuery" v-on:change="searchConv" class="form-control"><button class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
<<<<<<< HEAD
 <div class="jumbotron text-center" v-if="searchResults.length == 0" id="noResults">
            <h5>No conversation matches your query</h5>
</div>
        <div class="jumbotron text-center" v-if="conversations.length == 0 ">
            <h5>You have no conversations</h5>
        </div>
        
=======
        <div class="jumbotron text-center" v-if="searchResults.length == 0" id="noResults">
            <h5>No conversation matches your query</h5>
        </div>
        <div class="jumbotron text-center" v-if="conversations.length == 0 ">
            <h5>You have no conversations</h5>
        </div>

>>>>>>> b76127416238573a71100617fa38f108f7a02456
        <div v-if="openConversation != null">
            <div :class="openConversation.conversationId == convo.conversationId?'open profile-card p-3 flex':'profile-card p-3 flex'" v-on:click="changeOpenConv(convo.conversationId)" v-for="(convo,i) in conversations" :key="i">
                <div class="a-wrapper">
                    <div class="avatar font-weight-bold" v-if="convo.type == 'personal' ">
                        <p class="my-3">{{convo.participants[0].name.split(' ')[0].charAt(0) + convo.participants[0].name.split(' ')[1].charAt(0)}}</p>
                    </div>
                    <div class="avatar font-weight-bold" v-if="convo.type == 'group' ">
                        <p class="my-3">GR</p>
                    </div>
                </div>
                <div class="d-wrapper" v-if="convo.type == 'group' ">
                    <div>{{convo.data.name}}</div>
                    <div>
                        <small class="text-muted">
                            group
                        </small>
                    </div>
                </div>
                <div class="d-wrapper" v-if="convo.type == 'personal' ">
                    <div>{{convo.participants[0].name}}</div>
                    <div>
                        <small class="text-muted">
                            {{convo.participants[0].email}}
                        </small>
                    </div>
                </div>
                <div>
                    <span class="badge badge-primary" v-if="convo.unread > 0">{{convo.unread}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="inbox" v-if="conversations.length > 0 && openConversation != null">
        <div class="loader shadow-sm">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="inbox-header shadow-sm p-3 sticky-top">
            <div class="profile-details" v-if="openConversation.type == 'personal' ">
                <div class="flex">
                    <div>
                        <div class="avatar">{{openConversation.participants[0].name.split(' ')[0].charAt(0) + openConversation.participants[0].name.split(' ')[1].charAt(0)}}</div>
                    </div>
                    <div class="mx-3">
                        <div class="username">{{openConversation.participants[0].name}}</div>
                        <div class="badge badge-secondary">{{openConversation.participants[0].position}}</div>
                    </div>
                </div>
            </div>
            <div class="profile-details" v-if="openConversation.type == 'group' ">
                <div class="flex">
                    <div class="mx-3">
                        <div class="username">
                            <h5>{{openConversation.data.name}}</h5>
                        </div>
                        <div class="text-muted">
                            <small>created by {{openConversation.data.admin}}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-danger" title="delete conversation" v-on:click="deleteConversation(openConversation.conversationId)">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </div>
        </div>
        <div class="inbox-content my-1 px-1">

            <div id="innerH" style="height:fit-content;">
                <div class="text-muted text-center" v-if="openConversation.type == 'group' ">
                    <p>participants:</p>
                    <p><u v-for="participant in openConversation.participants" :key="participant.id"><small>{{participant.name}},</small></u></p>
                </div>
                <div :class="message.sender.id == me.id?'message-to-wrapper my-2':'message-from-wrapper my-2'" v-for="message in messages" :key="message.id">

                    <div :class="message.sender.id == me.id?'message-to':'message-from'">
                        <p>{{message.body}}</p>
                        <div class="date"><small>{{message.created_at | moment("from", "now")}}</small></div>
                    </div>
                    <div v-if="message.sender.id != me.id && openConversation.type == 'group'"><small class="text-muted font-weight-lighter" style="position:absolute; top:0; left:10px;">{{message.sender.name}}</small></div>
                </div>
            </div>
        </div>
        <form @submit.prevent="sendMessage(openConversation.conversationId)" class="inbox-footer px-4 py-4" autocomplete="off">
            <div class="form flex">
                <div></div>
                <div>
                    <div class="dropdown">
                        <div class="emojis" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img :src="'/images/emojis.svg'" alt="new" class="icon">
                        </div>
                        <div class="dropdown-menu picker" aria-labelledby="triggerId">
                            <form>
                                <VEmojiPicker @select="selectEmoji" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="footer-form">
                    <input type="text" placeholder="message..." v-model="message" class="form-control px-2" id="inboxChat" required />
                </div>
                <div>
                    <button class="btn" type="submit">
                        <img :src="'/images/send.svg'" alt="new" class="icon">
                    </button>
                </div>
            </div>
            <div></div>
        </form>
    </div>
</div>
</template>

<script>
import {
    VEmojiPicker
} from 'v-emoji-picker';
export default {
    name: 'chats',
    components: {
        VEmojiPicker
    },
    data() {
        return {
            groupForm: {
                name: '',
                participants: []
            },
            message: '',
            allUsers: [],
            newConvUsers: [],
            conversations: [],
            openConversation: null,
            messages: [],
            me: null,
<<<<<<< HEAD
            searchQuery:'',
            searchResults:[]
        }
    },
    methods: {searchConv:function(){ 
        var results = [];
     const all = this.conversations;
        if (all.length > 0) {
         $('#noResults').show()
         const allConvs = this.conversations;
         for (let i = 0; i < allConvs.length; i++) {
             const conv = allConvs[i];
             if (conv.participants[0].name.toUpperCase().indexOf(this.searchQuery.toUpperCase()) > -1) {
                 results.push(conv);
             }
         }
        }
        else{
            alert("you have no conversations")
        }
    
     this.searchResults = results;
     if(this.searchResults.length > 0){
          this.conversations = results;
     }
     console.log(this.searchResults);
    },
=======
            searchQuery: '',
            searchResults: []
        }
    },
    methods: {
        searchConv: function () {
            var results = [];
            const all = this.conversations;
            if (this.searchQuery == '') {
               this.getConversations(); 
            }
            if (all.length > 0) {
                $('#noResults').show()
                const allConvs = this.conversations;
                for (let i = 0; i < allConvs.length; i++) {
                    const conv = allConvs[i];
                    if (conv.participants[0].name.toUpperCase().indexOf(this.searchQuery.toUpperCase()) > -1) {
                        results.push(conv);
                    }
                }
            } else {
                alert("you have no conversations")
            }

            this.searchResults = results;
            if (this.searchResults.length > 0) {
                this.conversations = results;
            }
            console.log(this.searchResults);
        },
>>>>>>> b76127416238573a71100617fa38f108f7a02456
        getAllUsers: function () {
            axios.get(location.origin + '/api/all-users')
                .then((res) => {
                    this.allUsers = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        AddParticipantConversation: function (id) {
            if (event.target.checked) {
                this.groupForm.participants.push(id);
            } else {
                //    remove selected person
                for (let i = 0; i < this.groupForm.participants.length; i++) {
                    const person = this.groupForm.participants[i];
                    if (person == id) {
                        this.groupForm.participants.splice(i, 1)
                    }
                }
            }
        },
        createGroupConversation: function () {
            if (this.groupForm.participants.length < 2) {
                $('.alert-danger').show()
            } else {
                $('.alert-danger').hide()
                axios.post(location.origin + `/api/create-group-chat`, {
                    participants: this.groupForm.participants,
                    groupName: this.groupForm.name
                }).then((res) => {
                    $('.text-success').text('group created')
                    this.getConversations()
                })
            }

        },
        deleteConversation: function (id) {
            axios.post(location.origin + `/api/delete-conversation/${id}`).then(() => {
                this.openConversation = null
                this.getConversations();
            });
        },
        makeConversation: function (id) {
            axios.post(location.origin + `/api/create-private-chat/${id}`).then((res) => {
                if (res.data == false) {
                    alert("you already have an ongoing conversation with this person.")
                    $('.alert-success').hide()
                } else {
                    $('.alert-success').show()
                }
                this.getConversations()
                this.messagesReq();
            }).catch((err) => {
                console.log(err);
            });
        },
        openFirstConversation: function () {
            this.openConversation = this.conversations[0]
            this.messagesReq();
            this.getMessages();
        },
        selectEmoji: function (emoji) {
            this.message += emoji.data;
        },
        getConversations: function () {
            axios.get(location.origin + '/api/getConversations').then((res) => {
                this.conversations = res.data
                this.openFirstConversation()
                for (let i = 0; i < this.conversations.length; i++) {
                    const element = this.conversations[i];
                    //  console.log(element);
                }

            }).catch((err) => {
                console.log(err)
            })
        },
        changeOpenConv: function (id) {
            for (let i = 0; i < this.conversations.length; i++) {
                const element = this.conversations[i];
                if (element.conversationId == id) {
                    this.openConversation = element;
                }
            }
            $('.loader').show();
            this.messagesReq();
            this.getMessages();
            this.resetField();

        },
        sendMessage: function (convId) {
            $('#inboxChat').val('');
            const message = this.message
            axios.post(location.origin + `/api/send-message/${convId}`, {
                message: message
            }).then((res) => {
                if (res.data == false) {
                    console.log('failed')
                }
                this.resetField();
                this.messagesReq();
            }).catch((err) => {
                console.log(err)
            });
        },
        scrollToBottom: function () {
            document.querySelector(".inbox-content").scrollTop += document.querySelector(".inbox-content").scrollHeight;
        },
        messagesReq: function () {
            if (this.openConversation != null) {
                axios.get(location.origin + `/api/get-messages/${this.openConversation.conversationId}`).then(
                    (res) => {
                        this.messages = res.data.data;
                        for (let i = 0; i < this.messages.length; i++) {
                            const element = this.messages[i];
                            axios.post(location.origin + `/api/mark-message-as-read/${element.id}`).then((res) => {});
                        }
                        $('.loader').hide();
                    }).then(() => {
                    this.scrollToBottom()
                })
            }
        },
        resetField: function () {

            this.message = '';
        },
        getMessages: function () {
            if (this.conversations.length > 0) {

                this.messageInterval
            } else {
                return false;
            }
        }
    },
    destroyed() {
        clearInterval(this.messageInterval);

    },
    mounted() {
        this.getAllUsers();
        this.getConversations();
        this.countUnreadNotifications();
        $('#noResults').hide()
        //set the interval on mount
        this.messageInterval = setInterval(this.messagesReq, 20000);
        $('.alert-danger').hide()
        $('.alert-success').hide()
        axios.get(location.origin + `/api/user`).then(
            (res) => {
                this.me = res.data
            }
        )

    },
    unmounted() {
        this.clearInterval();
    }
}
</script>

<style scoped>
.home {
    width: 100% !important;
    background-color: transparent;
    flex-direction: row !important;
    justify-content: space-between;
}

.conversations {
    height: 100%;
    width: 300px;
    background-color: white;
    overflow-y: scroll;

}

.conversations::-webkit-scrollbar {
    width: 3px;
}

.conversations::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.conversations::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.flex {
    width: 100%;
    justify-content: space-between;
    align-items: center;
}

.search .form-control {
    border-right: none;
    border-radius: 37px 0px 0px 37px;
}

.form-control:focus {
    box-shadow: 23px 23px 23px white;
}

.search .btn {
    border: solid 1px rgba(141, 141, 141, 0.466);
    border-left: none;
    border-radius: 0px 37px 37px 0px;
}

.tab-content {
    height: 100%;
}

.tab-pane {
    width: 90%;
    margin: auto;
    height: 100%;
}

.profile-card {
    width: 100% !important;
    margin: auto;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
}

.profile-card:hover {
    background-color: #efefef;
}

.profile-card .a-wrapper {
    display: flex;
    align-items: center;
}

.a-wrapper .avatar {
    width: 50px;
    height: 50px;
}

.avatar {
    border-radius: 50%;
    color: white;
    background-color: #2C76DC;
    display: flex;
    justify-content: center;
    align-items: center;
}

.d-wrapper {
    height: fit-content !important;
}

.badge-primary {
    border-radius: 50%;
}

.conversations .header {
    padding: 20px;
    background-color: white;
}

.inbox {
    position: relative;
    flex: 1;
    overflow-y: scroll;
}

.inbox::-webkit-scrollbar {
    width: 3px;
}

.inbox::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.inbox::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.inbox-header {
    background-color: white;
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
    z-index: 0 !important;
}

.inbox-header .avatar {
    width: 50px;
    height: 50px;
    margin: auto;
}

.inbox-header .username {
    font-size: 15px;
}

.inbox-header i {
    font-size: 20px;
    cursor: pointer;
}

.inbox-header .profile-details {
    display: block;
    align-items: center;
    text-align: center;

}

.inbox-footer {
    position: absolute;
    background-color: white;
    width: 100%;
    bottom: 0;
}

.inbox-footer .form-control {
    border-radius: 37px;
    width: 100%;

    background-color: #F0F2F5;
}
.modal{
    z-index: 3000;
}
.modal-body {
    min-height: 600px;
}

.modal-body .container-fluid {
    height: 80%;
}

.modal-body .container-fluid .container {
    height: 100%;
}

.footer-form {
    width: 70%;
}

.inbox-content {
    height: 70%;
    overflow-y: scroll;
}

.profiles-wrapper {
    height: 100%;
    overflow: scroll;
}

.inbox-content::-webkit-scrollbar {
    width: 3px;
}

.inbox-content::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.inbox-content::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.profiles-wrapper::-webkit-scrollbar {
    width: 3px;
}

.profiles-wrapper::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.profiles-wrapper::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.message-to {
    background-color: indigo;
    color: white;
    border-radius: 20px 20px 0px 20px;
    padding: 10px 10px 5px 10px;
    width: 300px;
    height: fit-content;

}

.message-from {
    background-color: white;
    height: fit-content;
    color: indigo;
    border-radius: 0px 20px 20px 20px;
    padding: 10px 10px 5px 10px;
    width: 300px;

}

.message-from-wrapper {
    width: 100%;
    display: flex;
    justify-content: flex-start;
    height: fit-content;
    padding-top: 20px;
    position: relative;
}

.message-to-wrapper {
    width: 100%;
    height: fit-content;
    display: flex;
    justify-content: flex-end;
}

.inbox-content .message-to .date {
    float: right;
    opacity: 0.7;
}

.inbox-content .message-to .seen {
    float: left;
    opacity: 0.7;
}

.inbox-content .message-from .date {
    float: left;
    opacity: 0.7;
}

.inbox-content .message-from .seen {
    float: right;
    opacity: 0.7;
}

.conversations-modal {
    height: 100% !important;
    overflow-y: scroll;
}

.conversations-modal::-webkit-scrollbar {
    width: 3px;
}

.conversations-modal::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.conversations-modal::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.inbox-footer img {
    cursor: pointer;
}

.picker {
    z-index: 10;
    margin-left: -30%;
}

.inbox-jumbo {
    width: 100% !important;
}

.open {
    background-color: #efefef;
}
</style>
