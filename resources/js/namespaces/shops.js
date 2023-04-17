import {data} from './data.js';

export const shops = new Object({
    extends: data,
    data() {
        return {
            car: null,
        };
    },
    methods: {
        async showShopsAdmin(redirect = null, request = null) {
            this.fetchBuffers = {
                url: '/Shops/Confirm/Root/shopsAdmin',
                method: 'fetch',
                required: false,
            };
            this.saveQueries();
            return await this.query(`/Shops/Confirm/Root/shopsAdmin/${redirect}`, 'fetch', request, redirect);
        },
        async showShopsUser(id = null, redirect=null, request=null) {
            this.fetchBuffers = {
                url: '/Profile/Owner/usersShops',
                method: 'fetch',
                required: `${id}/${false}`
            };
            this.saveQueries();
            return await this.query(`/Profile/Owner/usersShops/${id}/${redirect}`, 'fetch', request, redirect);
        },
        async buyRequestItem(request=null){
            return await this.query('/Shops/Confirm/buyItem', 'post', request)
        },
        async buyRequestCar(request=null){
            return await this.query('/Shops/Confirm/Car/buyCar', 'post', request)
        }
    },
});
