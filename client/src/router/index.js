import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '@/store';

const AuthLayout = () => import('@/components/layouts/AuthLayout.vue');

Vue.use(VueRouter);

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes: configRoutes(),
});

router.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.requiresAuth)) {
		if (!store.getters.isLoggedIn) {
			next({
				name: 'login',
			});
		} else {
			next();
		}
	} else {
		next();
	}
});

function configRoutes() {
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
			meta: { requiresAuth: true },
			component: () => import('@/views/HomeView.vue'),
		},
        {
            path: '/logout',
            name: 'logout',
            component: () => import('@/components/Logout.vue'),
        },
	];
}

export default router;
