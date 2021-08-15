<template>
<div class="home px-4">
    <div class="loader cards-loader">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="completion-rate sm-none py-4 container-fluid text-center">
        <div class="percentage">
            almost due<span class="text-warning font-weight-bolder">{{Math.round((activitiesAlmostDue.length > 0)?(activitiesAlmostDue.length * 100 )/activities.length:'0')}}%</span>
        </div>
        <div class="percentage">
            failed<span class="text-danger font-weight-bolder">{{Math.round((activitiesFailed.length > 0)?(activitiesFailed.length * 100 )/activities.length:'0')}}%</span>
        </div>
        <div class="percentage">
            completed<span class="text-success font-weight-bolder">{{Math.round((activitiesComplete.length > 0)?(activitiesComplete.length * 100 )/activities.length:'0')}}%</span>
        </div>
        <div class="percentage">
            underway<span class="text-info font-weight-bolder">{{Math.round((activitiesUnderway.length > 0)?(activitiesUnderway.length * 100 )/activities.length:'0')}}%</span>
        </div>
    </div>
    <div class="cards-row-wrapper">

        <div class="cards-row px-1">

            <div class="card-column my-3 shadow-sm">
                <div class="header text-warning p-3">
                    <div class="status">Almost due</div>
                    <div class="count">{{activitiesAlmostDue.length}}</div>
                </div>
                <div class="content p-2">
                    <div class="card" v-for="activityAlmostDue in activitiesAlmostDue" :key="activityAlmostDue.id">
                        <div class="card-header flex" role="tab" :id="`HeaderId${activityAlmostDue.id}`">
                            <div>
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" :href="`#ContentId${activityAlmostDue.id}`" aria-expanded="true" class="text-dark nav-link" :aria-controls="`ContentId${activityAlmostDue.id}`">
                                        {{activityAlmostDue.title}}
                                    </a>
                                </h5>
                            </div>
                            <div>
                                <small class="text-muted">{{activityAlmostDue.date_due | moment("from","now")}}</small>
                            </div>
                        </div>
                        <div :id="`ContentId${activityAlmostDue.id}`" class="collapse in" role="tabpanel" :aria-labelledby="`HeaderId${activityAlmostDue.id}`">
                            <div class="card-body">
                                {{activityAlmostDue.description}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-column my-3 shadow-sm">
                <div class="header text-danger p-3">
                    <div class="status">failed</div>
                    <div class="count">{{activitiesFailed.length}}</div>
                </div>
                <div class="content p-2">
                    <div class="card" v-for="activityFailed in activitiesFailed" :key="activityFailed.id">
                        <div class="card-header flex" role="tab" :id="`HeaderId${activityFailed.id}`">
                            <div>
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" :href="`#ContentId${activityFailed.id}`" aria-expanded="true" class="text-dark nav-link" :aria-controls="`ContentId${activityFailed.id}`">
                                        {{activityFailed.title}}
                                    </a>
                                </h5>
                            </div>
                            <div>
                                <small class="text-muted">{{activityFailed.date_due | moment("from","now")}}</small>
                            </div>
                        </div>
                        <div :id="`ContentId${activityFailed.id}`" class="collapse in" role="tabpanel" :aria-labelledby="`HeaderId${activityFailed.id}`">
                            <div class="card-body">
                                {{activityFailed.description}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-column my-3 shadow-sm">
                <div class="header text-success p-3">
                    <div class="status">Completed</div>
                    <div class="count">{{activitiesComplete.length}}</div>
                </div>
                <div class="content p-2">
                    <div class="card" v-for="activityComplete in activitiesComplete" :key="activityComplete.id">
                        <div class="card-header flex" role="tab" :id="`HeaderId${activityComplete.id}`">
                            <div>
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" :href="`#ContentId${activityComplete.id}`" aria-expanded="true" class="text-dark nav-link" :aria-controls="`ContentId${activityComplete.id}`">
                                        {{activityComplete.title}}
                                    </a>
                                </h5>
                            </div>
                            <div>
                                <small class="text-muted">{{activityComplete.date_due | moment("from","now")}}</small>
                            </div>
                        </div>
                        <div :id="`ContentId${activityComplete.id}`" class="collapse in" role="tabpanel" :aria-labelledby="`HeaderId${activityComplete.id}`">
                            <div class="card-body">
                                {{activityComplete.description}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="pending shadow-sm p-2">
        <div class="header text-info p-3">
            <div class="status">Tasks underway</div>
            <div class="count">{{activitiesUnderway.length}}</div>
        </div>
        <div class="content p-2">
            <div class="card" v-for="activityUnderway in activitiesUnderway" :key="activityUnderway.id">
                <div class="card-header flex" role="tab" :id="`HeaderId${activityUnderway.id}`">
                    <div>
                        <h5 class="mb-0">
                            <a data-toggle="collapse" :href="`#ContentId${activityUnderway.id}`" aria-expanded="true" class="text-dark nav-link" :aria-controls="`ContentId${activityUnderway.id}`">
                                {{activityUnderway.title}}
                            </a>
                        </h5>
                    </div>
                    <div>
                        <small class="text-muted">due {{activityUnderway.date_due | moment("from","now")}}</small>
                    </div>
                </div>
                <div :id="`ContentId${activityUnderway.id}`" class="collapse in" role="tabpanel" :aria-labelledby="`HeaderId${activityUnderway.id}`">
                    <div class="card-body">
                        {{activityUnderway.description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <div class="add-wrapper my-3">
        <div>
            <h5>All Tasks</h5>
        </div>
        <div class="search my-2 flex">
            <input type="text" placeholder="search for task..." v-model="searchQuery" v-on:keyup="searchAc()" class="form-control"><button class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <div class="add shadow-sm" data-toggle="modal" data-target="#modelId">
            <i class="fas fa-plus"></i>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addActivity">
                        <label for="title">Title:</label>
                        <input type="text" name="title" v-model="fields.title" class="form-control" required />
                        <label for="description">Description:</label>
                        <textarea name="description" v-model="fields.description" placeholder="" class="form-control" required></textarea>
                        <label for="date">Date due</label>
                        <input type="date" class="form-control" v-model="fields.date" name="date" id="date" required />
                        <small id="dateError" class="text-danger"></small>
                        <p class="font-weight-bold text-muted">assigned_to:</p>
                        <div class="card empty" v-if="allUsers.length == 0" id="select-users">
                            <div class="jumbotron text-center">
                                <h5 class="text-center">
                                    You have no members in your organisation
                                </h5>
                            </div>
                        </div>
                        <div class="card" v-if="allUsers.length > 0" id="select-users">
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
                                    <input type="checkbox" v-on:change="addSelectedUsers(user.id)" style="background-color:blue; color:white; border-radius:50% !important;" :name="user.name" />
                                </div>
                            </div>
                        </div>
                        <div class="alert my-2 alert-danger feedback">Failed to add task</div>
                        <div class="alert my-2 alert-success feedback">task added</div>
                        <div class=" my-5">
                            <div class="loading my-2"><small>creating...</small> </div>
                            <div class="form-submit">
                                <button class="btn btn-primary" type="submit">
                                    add task
                                </button>
                                <button class="btn btn-outline-primary" type="reset">
                                    clear fields
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <div class="activities-table shadow-sm">
        <table class="table table-striped table-inverse  table-hover table-bodered">
            <thead class="thead-inverse">
                <tr>

                    <th>title</th>
                    <th>description</th>
                    <th>date due</th>
                    <th>Author</th>
                    <th>assigned to</th>
                    <th>status</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="description" v-for="activity in activities" :key="activity.id">
                    <td>{{activity.title}}</td>
                    <td>{{activity.description}}</td>

                    <td>{{activity.date_due}}</td>
                    <td>{{activity.author}}</td>
                    <td>
                        <ul>
                            <li v-for="user in activity.assigned_to " :key="user">
                                {{user}}
                            </li>
                        </ul>
                    </td>
                    <td>
                        <select class="form-control" v-model="activity.status" v-on:change="changeStatus(activity.id,activity.status)" id="status" name="status">
                            <option value="NULL">select status</option>
                            <option value="doing">Doing</option>
                            <option value="done">Done</option>
                        </select>
                    </td>
                    <td>

                        <button class="btn btn-danger" v-on:click="deletesAct(activity.id)">delete</button>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
export default {
    name: 'activities',
    data() {
        return {
            allUsers: [],
            selectedUsers: [],
            fields: {
                title: '',
                description: '',
                date: ''
            },
            activities: [],
            unreadNotifications: '',
            actions: {
                targetId: ''
            },
            activitiesAlmostDue: [],
            activitiesFailed: [],
            activitiesComplete: [],
            activitiesUnderway: [],
            searchQuery: ''
        }
    },
    mounted() {
        $('.loading').hide();
        $('.alert-success').hide();
        $('.alert-danger').hide();
        this.getPending();
        this.getActivities();
        this.getAllUsers();
        fetch(location.origin + '/api/user')
            .then(res => res.json())
            .then((data) => {
                this.allUsers.push(data)
            })
            .catch(err => console.log(err))
    },
    methods: {
        getPending() {
            axios.get(location.origin + '/api/get-underway-activities').then((res) => {
                // console.log(res.data);
                this.activitiesUnderway = res.data;
            })
        },
        addSelectedUsers: function (user) {
            if (event.target.checked) {
                this.selectedUsers.push(user);
                // console.log(this.selectedUsers);
            } else {
                for (let i = 0; i < this.selectedUsers.length; i++) {
                    const person = this.selectedUsers[i];
                    if (person == user) {
                        this.selectedUsers.splice(i, 1);
                        // console.log(this.selectedUsers);
                    }
                }
            }

        },
        searchAc: function () {
            var results = [];
            const all = this.activities;
            if (this.searchQuery == '') {
                this.getActivities();
            }
            if (all.length > 0) {
                $('#noResults').show()
                const allConvs = this.activities;
                for (let i = 0; i < allConvs.length; i++) {
                    const conv = allConvs[i];
                    if (conv.title.toUpperCase().indexOf(this.searchQuery.toUpperCase()) > -1) {
                        results.push(conv);
                    }
                }
            } else {
                alert("you have no tasks")
            }

            this.searchResults = results;
            if (this.searchResults.length > 0) {
                this.activities = results;
            }
            // console.log(this.searchResults);
        },
        addActivity: function () {

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }

            today = mm + '/' + dd + '/' + yyyy;
            today
            var dateNow = new Date(today);
            var dateDue = new Date(this.fields.date);
            if (dateNow < dateDue) {
                $('#dateError').hide();
                if (this.selectedUsers.length > 0) {
                    $('.loading').show();
                    axios.post(location.origin + '/api/make-activity', {
                        title: this.fields.title,
                        description: this.fields.description,
                        assigned_to: this.selectedUsers,
                        date: this.fields.date
                    }).then(() => {
                        this.getActivities();
                        $('.loading').hide();
                        $('.alert-success').show();

                    }).catch(() => {
                        $('.alert-danger').show();
                        $('.loading').hide();
                    });
                } else {
                    alert('you need to assign the task to someone');
                }
            } else {
                $('#dateError').html('Please check if the date due you entered  is valid');
                $('.loading').hide();
                $('.alert-success').hide();
            }
        },
        getActivities: function () {
            axios.get(location.origin + '/api/get-activities').then((res) => {
                this.activities = res.data;
                const act = this.activities;
                for (let i = 0; i < act.length; i++) {
                    const element = act[i];
                    const dateTime = element.created_at;
                    const dateArray = dateTime.split('T');
                    const dateAlone = dateArray[0];
                    element.created_at = dateAlone
                }

                this.countUnreadNotifications()
                this.getPending()
                this.getFailed()
                this.getComplete()
                this.getAlmostDue()
                $('.loader').hide();
            }).catch(function (err) {
                console.log(err);
            });

        },
        deletesAct: function (id) {
            //dialogue
            if (confirm(`Are you sure you want to delete the activity ${id}`)) {
                axios.post(location.origin + `/api/delete-activity/${id}`).then(() => {
                    this.getActivities();
                }).catch((err) => {
                    console.log(err);
                })
            }
        },
        changeStatus: function (id, status) {
            if (confirm(`set status to ${status}?`)) {
                axios.post(location.origin + `/api/set-activity-status/${id}/${status}`).then(() => {
                    this.getActivities();
                }).catch((err) => {
                    console.log(err);
                })
            }
        },
        getAlmostDue: function () {
            axios.get(location.origin + '/api/get-almost-due-activities').then((res) => {
                this.activitiesAlmostDue = res.data
            }).catch((err) => {
                console.log(err)
            })
        },
        getFailed: function () {
            axios.get(location.origin + '/api/get-failed-activities').then((res) => {
                this.activitiesFailed = res.data

            }).catch((err) => {
                console.log(err)
            })
        },
        getComplete: function () {
            axios.get(location.origin + '/api/get-completed-activities').then((res) => {
                this.activitiesComplete = res.data
            }).catch((err) => {
                console.log(err)
            })
        }
    }
}
</script>

<style scoped>
.completion-rate .percentage {
    font-size: 18px;
    font-weight: bold;
    color: rgba(128, 128, 128, 0.596);
}

.completion-rate {
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin: auto;
    align-items: center;
}

.percentage span {
    font-size: 36px;
    margin-left: 10px;
}

.search .form-control {
    border-right: none;
    border-radius: 37px 0px 0px 37px;
}

.form-control:focus {
    box-shadow: 23px 23px 23px transparent;
}

.search .btn {
    border: solid 1px rgba(141, 141, 141, 0.466);
    border-left: none;
    border-radius: 0px 37px 37px 0px;
}

.flex {
    justify-content: space-between;
    align-items: center;
}

.jumbotron {
    height: 100%;
    display: flex;
    align-items: center;
}

.card-header h5 {
    font-size: 14px;
    font-family: roboto;
    font-weight: bolder;
    font-smooth: inherit;
}

.card,
.card .card-header {
    background: white;
}

.modal {
    border-radius: 0% !important;
    z-index: 3000;
}

.avatar {
    border-radius: 50%;
    color: white;
    background-color: #2C76DC;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
    height: 50px;
}

.profile-card {
    width: 100% !important;
}

#select-users {
    width: 100%;
    height: 200px;
    margin: auto;
    position: relative;
    overflow: scroll;

}

.empty {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
}

#select-users::-webkit-scrollbar {
    width: 3px;
}

#select-users::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

#select-users::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.table td {
    min-width: 150px;
    width: fit-content;
    max-width: 250px;
    border-right: solid 1px #DEE2E6;
}

.table th {
    border-right: solid 1px #DEE2E6;
}

td::-webkit-scrollbar {
    width: 3px;
}

td::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

td::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.table {
    height: fit-content;
}

.activities-table {
    background: white;
    width: 100%;
    min-height: 500px !important;
    max-height: 500px !important;
    padding: 20px;
    overflow-y: scroll;
    overflow-x: scroll;
}

.activities-table::-webkit-scrollbar {
    width: 3px;
}

.activities-table::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.activities-table ::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.home {
    background-color: transparent !important;
    width: 100% !important;
}

.cards-row {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;

}

.cards-row-wrapper {
    position: relative;
    height: fit-content;

}

.card-column {
    background-color: white;
    padding-left: 15px;
    padding-right: 15px;
    padding-bottom: 15px;
    border-radius: 10px;
    height: 350px;
    width: 350px;
    display: flex;
    flex-direction: column;
}

@media (max-width:800px) {
    .card-column {
        margin: auto;
    }

    .sm-none {
        display: none;
    }
}

.card-column .content::-webkit-scrollbar {
    width: 3px;
}

.card-column .content::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.card-column .content::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.card-column .header {
    display: flex;
    justify-content: space-between;
    font-family: roboto;
    font-size: 18px;
    font-weight: bold;
}

.pending .header {
    display: flex;
    justify-content: space-between;
    font-family: roboto;
    font-size: 18px;
    font-weight: bold;
    width: 70%;
    margin: auto;
}

.card-column .content {
    flex: 1;
    width: 100%;
    overflow-y: scroll;
    background-color: #fafafa;
}

.cards-loader {
    /* background-color: #F1F5F7 !important; */
    opacity: 1;
    width: 100%;
    backdrop-filter: blur(10px);
    background: #F1F5F7 !important;
}

.cards-loader .lds-ellipsis {
    opacity: 1 !important;
}

.add-wrapper {
    width: 90%;
    margin: auto;
    position: relative;
    margin-top: 10px !important;
    margin-bottom: 10px !important;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pending {
    width: 100%;
    background-color: white;
    height: 350px;
}

.pending .content {
    flex: 1;
    width: 100%;
    overflow-y: scroll;
    background-color: #fafafa;
}

.pending .content::-webkit-scrollbar {
    width: 3px;
}

.pending .content::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.pending .content::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.add {
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    background-color: #2C76DC;
    border-radius: 50%;
    cursor: pointer;
}

@media (max-width:500px) {
    .home {
        width: 100%;
        padding: 0% !important;
    }

}
</style>
