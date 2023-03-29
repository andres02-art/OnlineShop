import {data} from './data';

export const categories = new Object({
    extends: data,
    methods: {
        async getCategoriesContent() {
            return await this.fetch(`/Categories/CategoryContent/`);
        },
        async getAllCategories(){
            return await this.fetch('/Categories/allCategories');
        },
    },
});
