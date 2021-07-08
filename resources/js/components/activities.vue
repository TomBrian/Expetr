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
                                <small class="text-muted">{{activityAlmostDue.date_due}}</small>
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
                                <small class="text-muted">{{activityFailed.date_due}}</small>
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
                                <small class="text-muted">{{activityComplete.date_due}}</small>
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
    <!-- Button trigger modal -->
    <div class="add-wrapper my-3">
        <div>
            <h5>All Tasks</h5>
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
                    <h5 class="modal-title">Create Activity</h5>
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
                        <div class="alert my-2 alert-danger feedback">Failed to add activity</div>
                        <div class="alert my-2 alert-success feedback">activity added</div>
                        <div class=" my-5">
                            <div class="loading my-2"><small>creating...</small> </div>
                            <div class="form-submit">
                                <button class="btn btn-primary" type="submit">
                                    add activity
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
            activitiesComplete: []
        }
    },
    mounted() {
        $('.loading').hide();
        $('.alert-success').hide();
        $('.alert-danger').hide();

        this.getActivities()

    },
    methods: {
        addActivity: function () {
            $('.loading').show();
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
                axios.post(location.origin + '/api/make-activity', {
                    title: this.fields.title,
                    description: this.fields.description,
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
                axios.post(location.origin + `/api/delete-activity/${this.actions.targetId}`).then(() => {
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
.flex {
    justify-content: space-between;
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
</style>
