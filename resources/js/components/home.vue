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
    <div class="flex py-2" style="justify-content:center;">
        <a class="navbar-brand" :href="location.origin"><img :src="'/images/logo.svg'" class="v-lg-none" alt="" style="opacity:0.6;"></a>
    </div>
    <div class="organisation-details my-4 mx-3">
        <div class="organisation-name text-muted" v-if="organisation != null">
            {{organisation.name}}
        </div>
        <div class="organisation-code" v-if="organisation != null">
            CODE:{{organisation.organisation_code}}
        </div>
    </div>
    <div class="greetings"> howdy, {{user.name}}</div>
    <div class="display:flex;" v-if="organisation != null">
        <div class="notification-card shadow-sm p-3 text-center m-6" style="background-color:#17A2B8 !important;" v-if="requests.length > 0">
            <router-link to="/dashboard/advanced/membership" class="nav-link">
                <div class="font-weight-bolder text-muted" style="margin:auto; color:white !important;">There are {{requests.length}} unattended membership requests</div>
            </router-link>
        </div>
        <div class="notification-card shadow-sm p-3 text-center my-2" v-for="notification in topNotifications" :key="notification.id">
            <div class="font-weight-bolder text-muted">{{notification.data.message}}</div>
            <div class="date text-muted font-weight-bold">
                <small>{{notification.created_at | moment("from","now")}}</small>
            </div>
        </div>

    </div>
    <div class="pending shadow-sm my-3 p-2">
        <div class="header text-info p-3">
            <div class="status">Your assignments</div>
            <div class="count">{{assignments.length}}</div>
        </div>
        <div class="content p-2">
            <div class="card" v-for="assignment in assignments" :key="assignment.id">
                <div class="card-header flex justify-content-between" role="tab" :id="`HeaderId${assignment.id}`">
                    <div>
                        <h5 class="mb-0">
                            <a data-toggle="collapse" :href="`#ContentId${assignment.id}`" aria-expanded="true" class="text-dark nav-link" :aria-controls="`ContentId${assignment.id}`">
                                {{assignment.title}}
                            </a>
                        </h5>
                    </div>
                    <div>
                        <small class="text-muted">due {{assignment.date_due | moment("from","now")}}</small>
                    </div>
                </div>
                <div :id="`ContentId${assignment.id}`" class="collapse in" role="tabpanel" :aria-labelledby="`HeaderId${assignment.id}`">
                    <div class="card-body">
                        {{assignment.description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex my-5" id="first-flex">
        <div class="white-card shadow-sm">
            <router-link to="/dashboard/Tasks" class="nav-link">
                <div class="header py-3">
                    Tasks almost due
                </div>
                <div class="number text-danger">
                    {{activitiesAlmostDue.length}}
                </div>
            </router-link>
        </div>

        <div class="events-card shadow-sm mx-3">
            <div class="header text-center p-3">
                <div>
                    <h5>incoming events</h5>
                </div>
                <div style="font-size:20px">
                    <router-link to="/dashboard/calendar" class="nav-link">
                        <i class="far fa-calendar-alt"></i>
                    </router-link>
                </div>
            </div>
            <div class="content p-4" v-if="eventsAlmostDue != null">
                <div id="accordianId" role="tablist" aria-multiselectable="true">
                    <div class="card" v-for="event in eventsAlmostDue" :key="event.id">
                        <div class="card-header flex" style="justify-content:space-between; align-items:center;" role="tab" :id="`HeaderId${event.id}`">
                            <div>
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" :href="`#ContentId${event.id}`" aria-expanded="true" class="text-muted nav-link" :aria-controls="`ContentId${event.id}`">
                                        {{event.title}}
                                    </a>
                                </h5>
                            </div>
                            <div>

                                <small class="text-muted">{{event.date | moment("from","now")}}</small>
                            </div>
                        </div>
                        <div :id="`ContentId${event.id}`" class="collapse in" role="tabpanel" :aria-labelledby="`HeaderId${event.id}`">
                            <div class="card-body">
                                {{event.description}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jumbotron text-center" v-if="eventsAlmostDue.length == 0">
                    <h5>There are no approaching events</h5>
                </div>
            </div>

        </div>
    </div>
    <div class="container-fluid quote">
        <div class="card">
            <div class="card-body">
                <blockquote class="blockquote">
                    <p>{{quote.body}}</p>
                    <footer class="card-blockquote"><cite title="Source title">{{quote.credits}}</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'home',
    data() {
        return {
            user: [],
            organisation: {},
            allNotifications: [],
            readNotifications: [],
            unreadNotifications: [],
            topNotifications: [],
            activitiesAlmostDue: [],
            eventsAlmostDue: null,
            assignments: [],
            requests: [],
            location: {
                origin: location.origin
            },
            quote: {
                body: '',
                credits: ''
            }
        }
    },
    mounted() {
        fetch(location.origin + '/api/user')
            .then((res) => res.json())
            .then((data) => {
                this.user = data;
            })
            .catch((err) => {
                console.log(err);
            });
        this.getMyAssignments()
        this.getOrg()
        this.getNotifications()
        this.getAlmostDue()
        this.getApproachingEvents()
        this.getQuote()
        this.getJoinRequests()
    },
    methods: {
        getMyAssignments() {
            axios.get(location.origin + '/api/get-assignments').then((res) => {
                this.assignments = res.data;
            });
        },
        getJoinRequests: function () {
            axios.get(location.origin + '/api/get-all-join-requests').then((res) => {
                this.requests = res.data;
            }).catch((err) => {
                alert(err);
            });
        },
        getQuote: function () {
            axios.get(location.origin + '/api/get-quote').then((res) => {
                var expl = res.data.split('-');
                this.quote.body = expl[0]
                this.quote.credits = expl[1]
            })
        },
        getNotifications: function () {
            axios.get(location.origin + '/api/get-unread-notifications').then((res) => res.data).then((data) => {
                this.unreadNotifications = data;
                axios.get(location.origin + '/api/get-read-notifications').then((res) => res.data).then((data) => {
                    this.readNotifications = data;
                }).then(() => {
                    this.combineNotification()
                }).catch((err) => {
                    console.log(err)
                })
            }).catch((err) => {
                console.log(err)
            })

        },
        getApproachingEvents: function () {
            axios.get(location.origin + '/api/approaching-events').then((res) => {
                this.eventsAlmostDue = res.data;
            })
        },
        combineNotification: function () {
            const all = []

            for (let i = 0; i < this.unreadNotifications.length; i++) {
                const element = this.unreadNotifications[i];
                all.push(element)
            }
            for (let i = 0; i < this.readNotifications.length; i++) {
                const element = this.readNotifications[i];
                all.push(element)
            }
            const three = []
            if (all.length >= 2) {
                for (let i = 0; i < 2; i++) {
                    const element = all[i];
                    three.push(element)
                }
                this.topNotifications = three;
            } else {
                this.topNotifications = all
                //console.log( this.topNotifications)
            }
            //console.log(this.topNotifications);
            $('.loader').hide()
        }

    }
}
</script>

<style scoped>
.greetings {
    font-family: 'poppins', sans-serif;
    font-size: 24px;
    width: fit-content;
    margin: auto;
    margin-top: 20px;
}

.home {
    background-color: transparent !important;
    display: block !important;
}

.loader {
    background-color: #F1F5F7;
}

.quote blockquote {
    font-size: 15px;
}

.quote .card {
    background-color: transparent;
    background-color: white;
}

.organisation-details {
    display: flex;
    width: 90%;
    justify-content: space-between;
    font-weight: bold;
}

.organisation-details .organisation-code {
    font-family: 'Courier New', Courier, monospace;
    font-size: 18px;
}

.organisation-details .organisation-name {
    font-size: 18px;
}

.notification-card {
    display: flex;
    justify-content: space-between;
    background-color: white;
    border-bottom: solid 1px #2C76DC;
}

.white-card {
    width: 300px;
    height: 300px;
    border-radius: 5px;
    background-color: white;
}

.white-card .header {
    font-weight: bolder;
    width: 100%;
    text-align: center;
}

@media (min-width:1000px) {
    .lg-none {
        display: none !important;
    }
}

.white-card .number {
    font-size: 100px;
    width: 100%;
    text-align: center;
}

.events-card {
    background-color: white;
    flex: 1 !important;
    overflow-y: scroll;
    height: 300px;
}

.events-card .header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.events-card::-webkit-scrollbar {
    width: 3px;
}

.events-card::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.events-card::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.content .card-header {
    background: white;
    border: none;
    border-bottom: solid 1px #2C76DC;
}

.card-header a {
    font-size: 15px;
}

.card {
    border-top: none;
}

@media (max-width:500px) {
    .organisation-details {
        display: block !important;
    }

    .v-lg-none {
        display: block !important;
    }
}

@media (min-width:500px) {
    .v-lg-none {
        display: none;
    }
}

@media (max-width:1000px) {
    #first-flex {
        flex-direction: column !important;
        justify-content: center;
        align-items: center;
    }

    .greetings {
        font-size: 14px;
    }

    .events-card {
        width: 100%;
        margin-top: 20px;
    }
}

.pending {
    width: 100%;
    background-color: white;
    height: fit-content;
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

.pending .header {
    display: flex;
    justify-content: space-between;
    font-family: roboto;
    font-size: 18px;
    font-weight: bold;
    width: 70%;
    margin: auto;
}
</style>
