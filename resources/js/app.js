/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import router from './router.js'
import Vue from 'vue'
import EventBus from './event-bus';
import FunctionalCalendar from 'vue-functional-calendar';

require('./bootstrap');
Vue.use(require('vue-moment'));

window.Vue = require('vue').default;
/*
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('dashboard', require('./dashboard.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// global methods//
Vue.use(FunctionalCalendar, {
    dayNames: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']
});
Vue.mixin({
    methods: {
        // mark notifications as read
        markRead: function () {
            var unread = this.unreadNotifications;
            for (let i = 0; i < unread.length; i++) {
                const element = unread[i];
                const id = element.id;
                // mark as read API request
                axios.get(location.origin + `/api/mark-as-read/${id}`).then(function () {
                    // console.log(`id:${id}`)
                }).catch((err) => {
                    console.log(`error:${err}`)
                })
            }
            this.countUnreadNotifications;
        },


        countUnreadNotifications: function () {
            axios.get(location.origin + '/api/get-unread-notifications').then((res) => res.data).then((data) => {
                this.unreadNotifications = data;
                this.unreadCount = this.unreadNotifications.length;
                // console.log(this.unreadCount)
            }).catch((err) => {
                console.log(err)
            })

        },


        getNotifications: function () {
            axios.get(location.origin + '/api/get-unread-notifications').then((res) => res.data).then((data) => {
                this.unreadNotifications = data;
                this.markRead();
                $('.loader').hide();
            }).catch((err) => {
                console.log(err)
            })
            axios.get(location.origin + '/api/get-read-notifications').then((res) => res.data).then((data) => {
                this.readNotifications = data;
                $('.loader').hide();
            }).catch((err) => {
                console.log(err)
            })

        },


        getExp: function () {
            axios.get(location.origin + '/api/all-expenses').then((res) => res.data).then((data) => {
                this.expenses = data
                //  split time
                const exp = this.expenses;
                for (let i = 0; i < exp.length; i++) {
                    const element = exp[i];
                    const dateTime = element.created_at;
                    const dateArray = dateTime.split('T');
                    const dateAlone = dateArray[0];
                    element.created_at = dateAlone
                }
                //totals
                var totalArray = []
                for (let i = 0; i < exp.length; i++) {
                    const element = exp[i];
               if(element.status == 'approved'){
                    totalArray.push(element.amount);
                }
                }
                var total = parseInt(0);
                for (let i = 0; i < totalArray.length; i++) {
                    const element = totalArray[i];
                    total += parseInt(element)
                }
                this.expenseTotal = total
                //get category totals
                this.getCatTotals();
                axios.post(location.origin + `/api/update-history/${this.organisation.organisation_code}`, {
                    expenses:this.expenseTotal,
         rental:this.categoryTotals.rental,
         salaries:this.categoryTotals.salaries,
         medical:this.categoryTotals.medical,
         utilities:this.categoryTotals.utilities,
         food:this.categoryTotals.food,
         insurance:this.categoryTotals.insurance,
         delivery:this.categoryTotals.delivery,
         marketing:this.categoryTotals.marketing,
         gifts:this.categoryTotals.gifts,
         other:this.categoryTotals.other,
                 }).catch(err=>{
                     console.log(err)
                 })
                //get contributors
                this.getContributors()
                //recount notifications
                this.countUnreadNotifications();
                $('.loader').hide();
            }).catch((err) => {
                console.log(err)
            });
        },





        getUser: function () {
            fetch(location.origin + '/api/user')
                .then((res) => res.json())
                .then((data) => {
                    this.user = data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getAllUsers: function () {
            fetch(location.origin + '/api/all-users')
                .then((res) => res.json())
                .then((data) => {
                    this.allUsers = data;
                    // console.log(this.allUsers)
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getContributors: function () {
            var allAuth = []
            var AuthCount = allAuth.length;
            var expe = this.expenses
            for (let i = 0; i < expe.length; i++) {
                const element = expe[i];
                var author = element.author
                allAuth.push(author)
            }
            //get unique array
            var uni = [...new Set(allAuth)]
            AuthCount += uni.length
            this.contributors = AuthCount
        },
        getOrg: function () {
            fetch(location.origin + '/api/get-organisation')
                .then((res) => res.json())
                .then((data) => {
                    this.organisation = data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getCatTotals: function () {
            // categories
            var rental = []
            var salaries = []
            var medical = []
            var utilities = []
            var food = []
            var marketing = []
            var insurance = []
            var delivery = []
            var gifts = []
            var other = []
            //  loop through all expenses and group them into categories
            // creating a for loop for each one of them was a baaad idea
            var exp = this.expenses;
            //rental
            for (let i = 0; i < exp.length; i++) {
                const element = exp[i];
                var cat = element.category;
                if (cat == 'rental cost' && element.status=='approved') {
                    rental.push(element.amount)
                }
            }
            //salaries
            for (let i = 0; i < exp.length; i++) {
                const element = exp[i];
                var cat = element.category;
                if (cat == 'salaries & wages' && element.status=='approved') {
                    salaries.push(element.amount)
                }
            }
            //medical
            for (let i = 0; i < exp.length; i++) {
                const element = exp[i];
                var cat = element.category;
                if (cat == 'medical' && element.status=='approved') {
                    medical.push(element.amount)
                }
            }
            //utilities
            for (let i = 0; i < exp.length; i++) {
                const element = exp[i];
                var cat = element.category;
                if (cat == 'utilities' && element.status =='approved') {
                    utilities.push(element.amount)
                }
            }
            // food
            for (let i = 0; i < exp.length; i++) {
                const element = exp[i];
                var cat = element.category;
                if (cat == 'food' && element.status =='approved') {
                    food.push(element.amount)
                }
            }
            //insurance
            for (let i = 0; i < exp.length; i++) {
                const element = exp[i];
                var cat = element.category;
                if (cat == 'insurance' && element.status=='approved') {
                    insurance.push(element.amount)
                }
            }
            //delivery & freight
            for (let i = 0; i < exp.length; i++) {
                const element = exp[i];
                var cat = element.category;
                if (cat == 'Delivery & freight' && element.status=='approved') {
                    delivery.push(element.amount)
                }
                // console.log(delivery)
            }
            //gifts & entertainment
            for (let i = 0; i < exp.length; i++) {
                const element = exp[i];
                var cat = element.category;
                if (cat == 'gifts & entertainment' && element.status=='approved') {
                    gifts.push(element.amount)
                }
            }
            //marketing & advertising
            for (let i = 0; i < exp.length; i++) {
                const element = exp[i];
                var cat = element.category;
                if (cat == 'marketing & advertising' && element.status=='approved') {
                    marketing.push(element.amount)
                }
            }
            //gifts & entertainment
            for (let i = 0; i < exp.length; i++) {
                const element = exp[i];
                var cat = element.category;
                if (cat == 'other' && element.status=='approved') {
                    other.push(element.amount)
                }
            }
            ///// find the sum of the arrays
            var rentalTotal = ''
            var salariesTotal = ''
            var medicalTotal = ''
            var utilitiesTotal = ''
            var foodTotal = ''
            var marketingTotal = ''
            var insuranceTotal = ''
            var deliveryTotal = ''
            var giftsTotal = ''
            var otherTotal = ''

            // array method 101
            const add = (categ, property, categTotal) => {
                var all = 0
                for (let i = 0; i < categ.length; i++) {
                    const element = categ[i];
                    all += parseInt(element);
                }
                categTotal = all;
                this['categoryTotals'][property] = categTotal
            }
            //map the function
            add(rental, 'rental', rentalTotal)
            add(salaries, 'salaries', salariesTotal)
            add(medical, 'medical', medicalTotal)
            add(utilities, 'utilities', utilitiesTotal)
            add(food, 'food', foodTotal)
            add(marketing, 'marketing', marketingTotal)
            add(insurance, 'insurance', insuranceTotal)
            add(delivery, 'delivery', deliveryTotal)
            add(gifts, 'gifts', giftsTotal)
            add(other, 'other', otherTotal)
        },
        getAlmostDue:function(){
            axios.get(location.origin + '/api/get-almost-due-activities').then((res)=>{
                this.activitiesAlmostDue =  res.data
            }).catch((err)=>{
                console.log(err)
            })
        }
    }
})

//end global methods
const app = new Vue({
    el: '#content',
    router: router
});
