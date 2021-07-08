import Vue from 'vue';
import VueRouter from 'vue-router';
'../../node_modules/nprogress/nprogress.css'
import notifications from './components/notifications.vue';
import home from './components/home.vue';
import expenses from './components/expenses.vue';
import downloads from './components/downloads.vue';
import activities from './components/activities.vue';
import events from './components/events.vue';
import members from './components/members.vue';
import advanced from './components/advanced.vue';
import chats from './components/chats.vue';
import profile from './components/profile.vue';
import help from './components/help.vue';
import charts from './components/charts.vue';
import account from './components/widgets/advanced-account.vue'
import membership from './components/widgets/advanced-membership.vue'
import general from './components/widgets/advanced-general.vue'

Vue.use(VueRouter);

export default new VueRouter({
    routes: [{
            path: '/dashboard/expenses',
            components:{d:expenses}
        },
        {
            path: '/dashboard/home',
            components:{d:home
  }      },
        {
            path: '/dashboard/notifications',
            components:{d:notifications}
        },
        {
            path: '/dashboard/downloads',
            components:{d:downloads}
        },
        {
            path: '/dashboard/tasks',
            components:{d:activities}
        },
        {
            path: '/dashboard/calendar',
            components:{d:events
}        },
        {
            path: '/dashboard/members',
            components:{d:members}
        },
        {
            path: '/dashboard/advanced',
            components:{  
                d:advanced
            },
            children:[
                {
                    path:'/dashboard/advanced',
                    components:{
                        a:account
                    }
                },
                {
                    path:'/dashboard/advanced/general',
                    components:{
                        a:general
                    }
                },
                {
                    path:'/dashboard/advanced/membership',
                    components:{
                        a:membership
                    }
                }
            ]
        },
        {
            path: '/dashboard/chats',
            components:{d:chats
 }       },
        {
            path: '/dashboard/profile',
            components:{d:profile}
        },
        {
            path: '/dashboard/help',
            components:{
                d:help
                }      
},
        {
            path: '/dashboard/charts',
            components:{
                d:charts
            }       
 }

    ],
    mode: 'history'
});
