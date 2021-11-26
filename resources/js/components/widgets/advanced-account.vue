<template>
<div class="account">
    <div class="loader shadow-sm">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="content">
        <p class="text-muted">
            You can update your personal data in the form below.Other members of {{organisation.name}} will get a notification about the changes.
            A confirmation email will be sent to <span class="text-info">{{user.email}}</span>.Confirm the changes to update the email address.
        </p>
        <form @submit.prevent="makeChanges()" class="update-form card p-4">
            <div class="flex">
                <div class="input  mx-3">
                    User name:
                    <input type="text" v-model="updates.name" class="form-control">
                </div>
                <div class="input mx-3" v-if="user != null">
                    
                    Email address: 
                    <input type="email" v-model="updates.email" class="form-control">
                </div>
            </div>
            <div class="update-button my-3">
                <button type="submit" class="btn btn-info">
                    update
                </button>
            </div>
        </form >
        <div class="text-center my-4">
            <p>Your user id might be required when requesting <a href="http://www.expetr.com">Expetr.com</a> to perform custom changes to your account</p>
            <div class="userId">
                your user id is: {{user.userId}}
            </div>
        </div>
        <p>Subscribe to email notifications involving major changes on the organisation account.These notifications will include</p>
        <ul class="list">
            <li>New members</li>
            <li>New downloads</li>
            <li>Changes on your account by admin e.g granted permissions</li>
            <li>News from expetr.com</li>
        </ul>
        <div class="flex justify-content-center my-3">
            <div class="btn btn-primary btn-lg m-auto">
                Subscribe to email notifications
            </div>
        </div>
    <div class="flex my-4 align-items-center justify-content-between" id="critical">
        <div class="card py-9 px-9"><button class="btn btn-lg btn-info" v-on:click="logMeOut">
            Logout
            </button></div>
        <div class="card  alert alert-danger text-dark p-3">
            <div class="card-header text-lg">
                Delete account
            </div>
            <div class="body">
                <div class="alert alert-danger">
                    This action is irreversible
                </div>
                <form autocomplete="off" @submit.prevent="terminateMe()">
                <input type="password" class="form-control my-3" v-model="terminator.password" placeholder="your password is required" required>
               
                <button class="btn btn-danger" type="submit">
                    Delete account
                </button>
                 </form>
            </div>
        </div>
    </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'account',
    data() {
        return {
            organisation: '',
            user: [],
            updates: {
                name: '',
                email: ''
            },
            terminator:{
                password:''
            }
        }
    },
    methods:{
          getUser: function () {
            fetch(location.origin + '/api/user')
                .then((res) => res.json())
                .then((data) => {
                    this.user = data;
                    this.updates.name = this.user.name
                    this.updates.email = this.user.email
                    this.updates.email_verified_at = this.user.email_verified_at
                       $('.loader').hide();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        makeChanges:function(){
            axios.post(location.origin + '/api/update-my-details',{
             'name':this.updates.name,
             'email':this.updates.email,
             'email_verified_at':'NULL'
            }).then((res)=>{
                if (res.data == false) {
                    alert('could not update changes');
                }
                else{
                    alert('changes updated')
                }
            })
        },
        terminateMe:function(){
            axios.post(location.origin + '/api/remove-me',{
                'password':this.terminator.password
            }).then((res)=>{
                if (res.data == false) {
                    alert('could not delete your account.The password you entered could be wrong');
                } else {
                    location.reload();
                }
            })
        },
        logMeOut:function(){
            axios.post(location.origin + '/api/log-me-out').then((res)=>{
                if (res.data == true) {
                      location.reload();
                }
                 else{
                     alert('could not log you out.Please try again later');
                 }
            })
        }
    },
    mounted() {
     
        this.getOrg();
        this.getUser();
    }
}
</script>

<style scoped>
.home {
    display: block !important;
}

.content {
    width: 90%;
    margin: auto;
}

.input {
    flex: 1;
}

.update-button {
    display: flex;
    justify-content: center;
}

.userId {
    font-size: 24px;
    color: indigo;
}

.list li::before {
    content: '\2713';
    margin-right: 8px;
    color: orange;
}
#critical .card{
    flex: 1;
    border: none !important;
}

.m-auto {
    margin: auto !important;
}
.account{
     position:relative;
}
@media (max-width:1000px) {
   #critical{
    display: block !important;
} 
}

</style>
