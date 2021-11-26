<template>
<div class="home py-3 px-6">

    <FunctionalCalendar v-model="calendarData" :sundayStart="true" :date-format="'dd/mm/yyyy'" :is-date-picker="false" :marked-dates="markedDays"></FunctionalCalendar>

    <!-- Button trigger modal -->
    <div class="add-wrapper my-3">
        <div>
            <h5>All events</h5>
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
                    <h5 class="modal-title">Create Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="createEvent">
                        <label for="title">Title:</label>
                        <input type="text" name="title" v-model="fields.title" class="form-control" required />

                        <label for="description">Description:</label>
                        <textarea name="description" v-model="fields.description" placeholder="" class="form-control" required></textarea>

                        <label for="date">Date</label>

                        <input type="date" class="form-control" v-model="fields.date" name="date" id="date" required />

                        <small id="dateError" class="text-danger"></small>
                        <div class="alert my-2 alert-danger feedback">Failed to add event</div>
                        <div class="alert my-2 alert-success feedback">event added</div>
                        <div class=" my-5">
                            <div class="loading my-2"><small>creating...</small> </div>
                            <div class="form-submit">
                                <button class="btn btn-primary" type="submit">
                                    add event
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
    <!-- Event cards -->
    <div class="event-cards grid">
        <div class="loader">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div v-for="event in events" :key="event.id" class="event-card my-3 grid-item shadow-sm p-4">
            <div class="event-header flex">
                <div class="event-title">{{event.title}}</div>
                <div class="event-date"><small>{{event.date | moment('from','now')}}</small> </div>
            </div>
            <div class="content">
                {{event.description}}
                <div class="footer flex my-4">
                    <div></div>
                    <div class="Author">created by <b>{{event.author}}</b></div>
                </div>
            </div>
            <div class="actions py-3">
                <button class="btn btn-danger" v-on:click="deleteEvent(event.id)">Delete</button>
            </div>
        </div>

    </div>
</div>
</template>

<script>
import {
    FunctionalCalendar
} from 'vue-functional-calendar';
export default {
    name: 'events',
    components: {
        FunctionalCalendar
    },
    data() {
        return {
            calendarData: {
                dayClicked: ''
            },
            markedDays: [],
            fields: {
                title: '',
                description: '',
                date: ''
            },
            events: [],
            unreadNotifications: []
        }
    },
    mounted() {
        $('.alert').hide();
        $('.loading').hide();
        this.getEvents();
        this.countUnreadNotifications();
    },
    methods: {
        createEvent: function () {
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
                axios.post(location.origin + '/api/make-event', {
                    title: this.fields.title,
                    description: this.fields.description,
                    date: this.fields.date
                }).then(() => {
                    this.getEvents();
                    $('.loading').hide();
                    $('.alert-success').show();
                    this.countUnreadNotifications();
                }).catch(() => {
                    $('.alert-danger').show();
                    $('.loading').hide();
                });
            } else {
                $('#dateError').html('Please check if the date due you entered  is valid');
                $('.loading').hide();
            }

        },
        getEvents: function () {
            axios.get(location.origin + '/api/get-events').then((res) => {
                // console.log(res.data)
                this.events = res.data
                this.setMarked();
                this.countUnreadNotifications();
                $('.loader').hide();
            }).catch((err) => {
                console.log(err)
            })
        },
        setMarked: function () {
            // This function runs after the API request is successful
            const events = this.events;
            for (let i = 0; i < events.length; i++) {
                const event = events[i];
                // get the dates in yyyy-mm-dd format 

                const date = event.date;
                // change them into the calendar's supported format ie. d/m/yyyy
                // spliting the date into an array of ['year','month','day']
                const dateArray = date.split('-');
                // remove the 0 prefix if the day is below 10
                // splitting the two digit day into an array
                const dayArray = dateArray[2].split('');
                // remove the first zeros
                // declare the day variable outside the if statement
                const day = '';
                // check if the first member of the array is equal to zero.(Tested as both string and integer)
                /*Problem */
                if (dayArray[0] == '0') {
                    //  if so, dispose the zero and take the second member as day
                    day = dayArray[1]
                } else {
                    day = dateArray[2]
                }

                // remove the first zeros
                const monthArray = dateArray[1].split('');
                const month = '';
                if (dateArray[1].charAt(0) == '0') {
                    month = monthArray[1];
                } else {
                    month = dateArray[1]
                }
                this.markedDays.push(day + '/' + month + '/' + dateArray[0]);
            }

        },
        deleteEvent: function (id) {
            axios.get(location.origin + `/api/delete-event/${id}`).then(() => {
                this.getEvents();
                this.countUnreadNotifications();
            })
        }
    }
}
</script>

<style scoped>
.home {
    background-color: transparent !important;
    width: 100% !important;
    position: relative;
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

.event-cards {
    display: flex;
    justify-content: space-between;
    width: 100%;
    flex-wrap: wrap;
    position: relative;
}

.event-card {
    width: 350px;
    height: fit-content;
    background-color: white;
    border-radius: 0px 15px 15px 15px;
}

.loader {
    background-color: #F1F5F7 !important;
    z-index: 3;
}

.event-card .actions {
    width: 100%;
    display: flex;
    justify-content: center;
}

.event-header {
    padding: 20px;
}

.event-title {
    font-weight: bold;
    font-family: poppins;
    width: 70%;
    overflow: hidden;
}

.event-date {
    font-family: roboto;
    opacity: 0.6;
}

.event-card .content {
    background-color: #fafafa;
    padding: 20px;
    text-align: left;
    font-family: roboto;
    height: 300px;
}

.content .footer {
    opacity: 0.6;
}

.footer b {
    color: grey;
}

.flex {
    width: 100%;
    justify-content: space-between;
    align-items: center;
}
.vfc-content .vfc-content{
    z-index: 0 !important;
    position: relative !important;
}
.modal {
    border-radius: 0% !important;
    z-index: 3000;
}
.vfc-day{
font-family: sans-serif !important;
}
</style>
