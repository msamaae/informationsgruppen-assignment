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
			],
        }
    ]
}

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes: configRoutes(),
});


export default router;
