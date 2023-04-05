export let FETCH_RESPONSE_DATA = null;
export let FETCH_RESPONSE_STATUS = null;
export let FETCH_RESPONSE_HEADERS = null;
export let FETCH_RESPONSE_ERROR = null;
export let FETCH_RESPONSE_REQUEST = null;
export const FETCH_RESPONSE = [];

export const data = new Object({
	data() {
		return {
			fetchResponse: null,
			fetchBuffers: null,
		};
	},
	methods: {
		saveQueries() {
			window.localStorage.setItem('fetchBuffers', JSON.stringify(this.fetchBuffers));
		},
		retriveQueries() {
			this.fetchBuffers = JSON.parse(window.localStorage.getItem('fetchBuffers'));
		},
		deleteQueries() {
			window.localStorage.removeItem('fetchBuffers');
		},
		async resolve() {
			return this.uploadResponses();
		},
		async reject(reject = null) {
			await this.alertError(reject.status);
			return {
				reject: true,
				data: reject.data,
			};
		},
		resetResponses() {
			FETCH_RESPONSE_DATA = null;
			FETCH_RESPONSE_HEADERS = null;
			FETCH_RESPONSE_STATUS = false;
			FETCH_RESPONSE.push(this.fetchBuffers);
			FETCH_RESPONSE_ERROR = null;
		},
		uploadResponses() {
			FETCH_RESPONSE_DATA = this.fetchResponse.data;
			FETCH_RESPONSE_HEADERS = this.fetchResponse.headers;
			FETCH_RESPONSE_REQUEST = this.fetchResponse.request;
			FETCH_RESPONSE_ERROR = this.fetchResponse.error;
			FETCH_RESPONSE_STATUS = true;
			return FETCH_RESPONSE_DATA;
		},
		finishResponses() {},
		async query(url = null, method = 'get', request = null, redirect = true) {
			try {
				switch (method) {
					case 'put': {
						await this.axiosPut(url, request);
						break;
					}

					case 'patch': {
						await this.axiosFetch(url, request);
						break;
					}

					case 'delete': {
						await this.axiosDelete(url, request);
						break;
					}

					case 'get': {
						await this.axiosGet(url, request);
						break;
					}

					case 'post': {
						await this.axiosPost(url, request);
						break;
					}

					case 'fetch': {
						this.resetResponses();
						await this.axiosFetch(url, request, redirect);
						break;
					}
				}

				if (!(method === 'get' || method === 'fetch')) {
					await this.alertSucces();
				}

				return await this.resolve();
			} catch (error) {
				this.fetchBuffers = {url, method};
				console.error(error);
				return await this.reject(error.response);
			}
		},
		async alertSucces() {
			window.swal.fire({
				title: 'Success',
				position: 'bottom-start',
				timer: 3000,
				toast: true,
				timerProgressBar: true,
				showConfirmButton: false,
				icon: 'success',
				confirmButtonText: 'aceptar',
				text: 'hecho',
			});
		},
		async alertError(error = null) {
			window.swal.fire({
				title: `Error ${error}`,
				position: 'bottom-start',
				showConfirmButton: false,
				icon: 'error',
				timer: 3000,
				toast: true,
				timerProgressBar: true,
				confirmButtonText: 'aceptar',
				text: this.retriveErrorMessage(error),
			});
		},
		retriveErrorMessage(status = null) {
			switch (status) {
				case 400: { return 'Usted intenta realizar una peticion erronea';
				}

				case 422: { return 'Usted tiene errores en su peticion';
				}

				case 410: { return 'La peticion es imposible de resolver';
				}

				case 404: { return 'Su peticion no fue encontrada o no esta registrada';
				}

				default: { return 'algo salio mal';
				}
			}
		},
		async axiosFetch(url = null, request = null, redirect = null) {
			this.fetchResponse = await window.axios.get(url, request);
			this.uploadResponses();
			if (redirect) {
				return window.location.assign(this.fetchResponse.request.responseURL);
			}
		},
		async axiosGet(url = null) {
			this.fetchResponse = await window.axios.get(url);
			this.uploadResponses();
		},
		async axiosPost(url = null, request = null) {
			this.fetchResponse = await window.axios.post(url, request);
			this.uploadResponses();
		},
		async axiosDelete(url = null, request = null) {
			this.fetchResponse = await window.axios.delete(url, request);
			this.uploadResponses();
		},
	},
});
