import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

axios.defaults.baseURL = 'http://127.0.0.1:8001/api';

export default new Vuex.Store({
	state: {
		token: localStorage.getItem('access_token') || null,
		filter: 'all',
		todos: [],
	},
	getters: {},
	mutations: {
		SET_TOKEN(state, token) {
			state.token = token;
		},
	},
	actions: {
		login(context, { email, password }) {
			return new Promise((resolve, reject) => {
				axios
					.post('/login', {
						email,
						password,
					})
					.then(response => {
						const token = response.data.access_token;

						localStorage.setItem('access_token', token);
						context.commit('SET_TOKEN', token);
						resolve(response);
					})
					.catch(error => {
						console.error(error);
						reject(error);
					});
			});
		},
	},
	modules: {},
});
