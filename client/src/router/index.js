import Vue from 'vue';
import VueRouter from 'vue-router';

const AuthLayout = () => import('@/components/layouts/AuthLayout.vue');

Vue.use(VueRouter);


const configRoutes = () => {
    return [
        {
            path: '/',
			// redirect: '/login',
			name: 'AuthLayout',
			component: AuthLayout,
			children: [
				{
					path: '/login',
					name: 'login',
					component: () => import('@/views/LoginView.vue'),
				},
				{
					path: '/register',
					name: 'register',
					component: () => import('@/views/RegisterView.vue'),
				},
			],
        },
        {
            path: '/home',
            name: 'home',
            component: () => import('@/views/HomeView.vue')
        }
    ]
}

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes: configRoutes(),
});


export default router;
