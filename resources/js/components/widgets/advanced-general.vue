<template>
<div class="general">
    <div class="loader shadow-sm">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="rights jumbotron flex align-items-center justify-content-center shadow-sm text-center" style="height:100%;" v-if="user.position != 'admin' ">
        <h5>You need admin rights to implement general changes</h5>
        <p v-if="admins.length > 0" class="text-muted">
            Contact either of the following members for permission
        </p>
        <ul v-if="admins.length > 0">
            <li v-for="admin in admins" :key="admin.id"><b>{{admin.name}}</b></li>
        </ul>
    </div>
    <!-- feature 1 grant admin rights -->
    <div class="rights" v-if="user.position == 'admin' ">

        <h5 class="text-center text-muted">Change the organisation name</h5>
        <div>
            <form class="flex" style="width:70%;margin:auto;" @submit.prevent="changeOrgName">
                <input type="text" class="form-control" v-model="updates.organisation.name" required>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
        <div class="alert my-5 alert-info" style="width:70%; margin:auto;">
            This tab is only accessible to members with admin rights.Edit member rights below to grant access.
        </div>
        <table class="card" style="width:60%; margin:auto;">
            <tr v-for="user in updates.Users" :key="user.id" class="flex p-2 justify-content-between" style="border-bottom:solid 1px #DFDFDF;">
                <td>{{user.name}}</td>
                <td><select name="position" class="form-control" v-on:change="positionChanged(user.id,user.position)" v-model="user.position">
                        <option value="admin">admin</option>
                        <option value="member">member</option>
                    </select>
                </td>
            </tr></table>
            <div class="jumbotron my-4 mx-5 alert alert-danger">
                <h5 class="text-center">Remove a member from the organisation</h5>
                <table class="card" style="width:60%; margin:auto;">
                    <tr v-for="user in updates.Users" :key="user.id" class="flex p-2 justify-content-between" style="border-bottom:solid 1px #DFDFDF;">
                <td>{{user.name}}</td>
                <td>
                    <button class="btn btn-danger" v-on:click="deletEm(user.id)">
                        remove
                    </button> 
                </td>
            </tr>
                </table>
            </div>
    
    </div>

</div>
</template>

<script>
export default {
    name: 'general',
    data() {
        return {
            user: [],
            allUsers: [],
            admins: [],
            organisation: null,
            updates: {
                organisation: {
                    name: 'name'
                },
                user:{
                    position:''
                },
                Users:[]
            }
        }
    },
    mounted() {
        this.getUser()
        this.getAllUsers()
        this.getOrg()
    },
    methods: {
        getOrg: function () {
            fetch(location.origin+'/api/get-organisation')
                .then((res) => res.json())
                .then((data) => {
                    this.organisation = data;
                    this.updates.organisation.name = this.organisation.name
                    $('.loader').hide();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        changeOrgName:function(){
            axios.post(location.origin+'/api/change-organisation-name',{
                name:this.updates.organisation.name
            }).then((res)=>{
                if (res.data == true) {
                    alert('organisation name has changed');
                    location.reload()
                }
            })
        },
        getAllUsers: function () {
            fetch(location.origin+'/api/all-users')
                .then((res) => res.json())
                .then((data) => {
                    this.allUsers = data;
                    this.updates.Users = data;
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
        positionChanged:function(id,position){
            axios.post(location.origin + `/api/new-position/${id}/${position}`).then((res)=>{
                if (res.data = true) {
                    alert(`userId:${id} has been added as ${position}`);
                }
            });
        },
        deletEm:function(id){
        axios.post(location.origin + '/api/remove-user/'+id).then((res)=>{
            if (res.data = true) {
                alert('user removed');
                location.reload();
            }
            else{
             alert('failed to remove user.Try again later');
            }
        })
        }
    }
}
</script>

<style scoped>
.general {
    min-height: 80%;
    position: relative;
}

.jumbotron {
    flex-direction: column !important;
}
</style>
