import VueRouter from 'vue-router'
import helper from './services/helper'

let routes = [
    {
        path: '/',
        component: require('./layouts/default-page.vue').default,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/electionmonitor/dashboard',
                component: require('./views/pages/Dashboard.vue').default
            },

            {
                path: '/electionmonitor/polling',
                component: require('./views/pages/Pollings.vue').default
            },
            {
                path: '/electionmonitor/county',
                component: require('./views/pages/Counties.vue').default
            },
            {
                path: '/electionmonitor/constituency',
                component: require('./views/pages/Constituencies.vue').default
            },
            {
                path: '/electionmonitor/ward',
                component: require('./views/pages/Wards.vue').default
            },
            {
                path: '/electionmonitor/aspirant',
                component: require('./views/aspirant/index.vue').default
            },
            {
                path: '/electionmonitor/aspirant/add',
                component: require('./views/aspirant/add.vue').default
            },
            {
                path: '/electionmonitor/aspirant/:id/edit',
                component: require('./views/aspirant/edit.vue').default
            },
            {
                path: '/electionmonitor/user',
                component: require('./views/user/index.vue').default
            },
            {
                path: '/electionmonitor/user/add',
                component: require('./views/user/add.vue').default
            },
            {
                path: '/electionmonitor/user/:id/edit',
                component: require('./views/user/edit.vue').default
            },
            {
                path: '/electionmonitor/logs',
                component: require('./views/pages/Logs.vue').default
            },
            {
                path: '/electionmonitor/home/:id/agent',
                name: 'agentHome',
                component: require('./views/pages/Home.vue').default
            },
            {
                path: '/electionmonitor/enter-results/:electoral_area/:location',
                name: 'agentHome',
                component: require('./views/pages/EnterResults.vue').default
            },
            {
                path: '/electionmonitor/surveys',
                component: require('./views/pages/surveys/index.vue').default
            },
            {
                path: '/electionmonitor/edit-survey/:id/edit',
                component: require('./views/pages/surveys/edit-survey.vue').default
            },
            {
                path: '/electionmonitor/add-survey',
                component: require('./views/pages/surveys/add-survey.vue').default
            },
            {
                path: '/electionmonitor/questions',
                component: require('./views/pages/questions/index.vue').default
            },
            {
                path: '/electionmonitor/add-question',
                component: require('./views/pages/questions/add-question.vue').default
            },
            {
                path: '/electionmonitor/edit-question/:id/edit',
                component: require('./views/pages/questions/edit-question.vue').default
            },
            {
                path: '/electionmonitor/questions',
                component: require('./views/pages/questions/index.vue').default
            },
            {
                path: '/electionmonitor/question/:id/answers',
                component: require('./views/pages/questions/view-answers.vue').default
            },
            {
                path: '/electionmonitor/add-question',
                component: require('./views/pages/questions/add-question.vue').default
            },
            {
                path: '/electionmonitor/answers',
                component: require('./views/pages/answers/index.vue').default
            },
            {
                path: '/electionmonitor/announcements',
                component: require('./views/pages/announcements/index.vue').default
            },
            {
                path: '/electionmonitor/add-announcement',
                component: require('./views/pages/announcements/add-announcement.vue').default
            },
            {
                path: '/electionmonitor/edit-announcement/:id/edit',
                component: require('./views/pages/announcements/edit-announcement.vue').default
            },
        ]
    },
    {
        path: '/electionmonitor',
        component: require('./layouts/guest-page.vue').default,
        meta: { requiresGuest: true },
        children: [
            {
                path: '/electionmonitor',
                name: 'login',
                component: require('./views/auth/login.vue').default
            },
            {
                path: '/electionmonitor/login',
                name: 'login',
                component: require('./views/auth/login.vue').default
            },
            // {
            //     path: '/password',
            //     component: require('./views/auth/password.vue').default
            // },
            // {
            //     path: '/register',
            //     component: require('./views/auth/register.vue').default
            // },
            // {
            //     path: '/auth/:token/activate',
            //     component: require('./views/auth/activate.vue').default
            // },
            // {
            //     path: '/password/reset/:token',
            //     component: require('./views/auth/reset.vue').default
            // },
            // {
            //     path: '/auth/social',
            //     component: require('./views/auth/social-auth.vue').default
            // },
        ]
    },
    {
        path: '*',
        component : require('./layouts/error-page.vue').default,
        children: [
            {
                path: '*',
                component: require('./views/errors/page-not-found.vue').default
            }
        ]
    }
];

const router = new VueRouter({
	routes,
    linkActiveClass: 'active',
    mode: 'history'
});

router.beforeEach((to, from, next) => {

    if (to.matched.some(m => m.meta.requiresAuth)){
        return helper.check().then(response => {
            if(!response){
                return next({ path : '/electionmonitor/login'})
            }

            return next()
        })
    }

    if (to.matched.some(m => m.meta.requiresGuest)){
        return helper.check().then(response => {
            if(response){
                return next({ path : '/electionmonitor/'})
            }

            return next()
        })
    }

    return next()
});

export default router;
