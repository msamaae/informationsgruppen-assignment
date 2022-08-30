import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

axios.defaults.baseURL = 'http://127.0.0.1:8001/api';

export default new Vuex.Store({
	state: {
		userId: localStorage.getItem('user_id') || null,
		name: localStorage.getItem('user_name') || null,
		token: localStorage.getItem('access_token') || null,
		filter: 'all',
		todoLists: [],
		todos: [],
	},
	getters: {
		isLoggedIn(state) {
			return state.token !== null;
		},
		name(state) {
			return state.name;
		},
		todoLists(state) {
			return state.todoLists;
		},
		todos(state) {
			return state.todos;
		},
	},
	mutations: {
		SET_USER_ID(state, userId) {
			state.userId = userId;
		},
		SET_NAME(state, name) {
			state.name = name;
		},
		SET_TOKEN(state, token) {
			state.token = token;
		},
		CLEAR_USER_ID(state) {
			state.userId = null;
		},
		CLEAR_NAME(state) {
			state.name = null;
		},
		CLEAR_TOKEN(state) {
			state.token = null;
		},
		SET_TODOLISTS(state, todoLists) {
			state.todoLists = todoLists;
		},
		ADD_TODOLIST(state, todoList) {
			state.todoLists.push({
				id: todoList.id,
				name: todoList.name,
			});
		},
        SET_TODOS(state, todos) {
			state.todos = todos;
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
						const {
							user: { id, name },
							token,
						} = response.data;

						localStorage.setItem('user_id', id);
						localStorage.setItem('user_name', name);
						localStorage.setItem('access_token', token);

						context.commit('SET_USER_ID', id);
						context.commit('SET_NAME', name);
						context.commit('SET_TOKEN', token);

						resolve(response);
					})
					.catch(error => {
						console.error(error);
						reject(error);
					});
			});
		},
		register(context, { name, email, password, password_confirmation }) {
			return new Promise((resolve, reject) => {
				axios
					.post('/register', {
						name,
						email,
						password,
						password_confirmation,
					})
					.then(response => {
						resolve(response);
					})
					.catch(error => {
						console.error(error);
						reject(error);
					});
			});
		},
		logout(context) {
			axios.defaults.headers.common['Authorization'] = `Bearer ${context.state.token}`;

			if (context.getters.isLoggedIn) {
				return new Promise((resolve, reject) => {
					axios
						.post('/logout')
						.then(response => {
							localStorage.removeItem('user_id');
							localStorage.removeItem('user_name');
							localStorage.removeItem('access_token');

							context.commit('CLEAR_USER_ID');
							context.commit('CLEAR_NAME');
							context.commit('CLEAR_TOKEN');

							resolve(response);
						})
						.catch(error => {
							localStorage.removeItem('user_id');
							localStorage.removeItem('user_name');
							localStorage.removeItem('access_token');

							context.commit('CLEAR_USER_ID');
							context.commit('CLEAR_NAME');
							context.commit('CLEAR_TOKEN');

							reject(error);
						});
				});
			}
		},
		getTodoLists(context) {
			axios.defaults.headers.common['Authorization'] = `Bearer ${context.state.token}`;

			if (context.getters.isLoggedIn) {
				return new Promise((resolve, reject) => {
					axios
						.get('/todolists')
						.then(response => {
							context.commit('SET_TODOLISTS', response.data);
							resolve(response);
						})
						.catch(error => {
							console.error(error);
							reject(error);
						});
				});
			}
		},
		addTodoList(context, { name }) {
			axios.defaults.headers.common['Authorization'] = `Bearer ${context.state.token}`;

			if (context.getters.isLoggedIn) {
				return new Promise((resolve, reject) => {
					axios
						.post('/todolists', { name })
						.then(response => {
							console.log(response);
							context.commit('ADD_TODOLIST', response.data);
							resolve(response);
						})
						.catch(error => {
							console.error(error);

							reject(error);
						});
				});
			}
		},
        getTodos(context, { todoListId }) {
			axios.defaults.headers.common['Authorization'] = `Bearer ${context.state.token}`;

			if (context.getters.isLoggedIn) {
				return new Promise((resolve, reject) => {
					axios
						.get(`/todolists/${todoListId}/todos`)
						.then(response => {
							context.commit('SET_TODOS', response.data);
							resolve(response);
						})
						.catch(error => {
							console.error(error);
							reject(error);
						});
				});
			}
		},
	},
	modules: {},
});
