import {data} from './data.js';

export const profile = new Object({
	extends: data,
	data() {
		return {
			userRoles: null,
			admin: false,
			user: false,
		};
	},
	methods: {
		async getProfile(id = Number) {
			return await this.query(`/Profile/Owner/getUser/${id}`);
		},
		async deleteProfile(id = null, request = null) {
			console.log('deleting');
			return await this.query(`/Profile/Owner/Root/deleteProfile/${id}`, 'delete', request);
		},
		async editProfile(id = null, request = null) {
			return await this.query(`/Profile/Owner/Root/editProfile/${id}`, 'post', request);
		},
		async createProfile(request = null) {
			return await this.query('/Profile/Owner/Root/createProfile', 'post', request);
		},
		async showUsersAdmin(redirect = null, request = null) {
			this.fetchBuffers = {
				url: '/Profile/Owner/Root/users',
				method: 'fetch',
				required: false,
			};
			this.saveQueries();
			return await this.query(`/Profile/Owner/Root/users/${redirect}`, 'fetch', request, redirect);
		},
		async showAccount(id = null, redirect = null, request = null) {
			this.fetchBuffers = {
				url: '/Profile/Owner/getProfile',
				method: 'fetch',
				required: `${id}/${false}`,
			};
			this.saveQueries();
			return await this.query(`/Profile/Owner/getProfile/${id}/${redirect}`, 'fetch', request, redirect);
		},
		async registerProfile(request = Object) {
			return await this.query('/register/create', 'post', request);
		},
		async setRoleConfig() {
			if (this.authUser) {
				this.userRoles = await this.getRoles(this.authUser);
				for (const e of this.userRoles) {
					switch (e) {
						case 'admin': { this.admin = true; break;
						}

						case 'user': { this.user = true; break;
						}
					}
				}
			}
		},
		async getRoles(id = null) {
			const {userRole} = await this.query(`/Profile/Owner/getRole/${id}`);
			return userRole;
		},
		async getAllRoles() {
			return await this.query('/Profile/Owner/Root/getAllRoles');
		},
	},
});
