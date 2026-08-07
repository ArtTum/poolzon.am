export default {
    actions: {
        async returnCategoriesIndex(ctx) {
            Vue.axios.post('/categories', this.state.returnCategories.data).then((response) => {
                const returnCategoriesIndex = response.data;
                ctx.commit('updateCategoriesIndex', returnCategoriesIndex);
            });
        },
        async returnCategoryGet(ctx) {
            Vue.axios.post('/category-edit', {
                id: this.state.returnCategories.id
            }).then((response) => {
                const returnCategoryGet = response.data;
                ctx.commit('updateCategoryGet', returnCategoryGet);
            });
        },
        async changeCategoryStatus() {
            Vue.axios.post('/change-category-status', {
                id: this.state.returnCategories.id
            }).then((response) => {
              return true;
            });
        },
        async returnCategorySort(ctx, data) {
            Vue.axios.post('/categories-sort', {sort: data}).then((response) => {
                console.log(response)
            });
        },
    },
    mutations: {
        updateCategoriesIndex(state, returnCategoriesIndex) {
            state.returnCategoriesIndex = returnCategoriesIndex
        },
        changeCategories(state, data) {
            state.data = data;
        },
        updateCategoryGet(state, returnCategoryGet) {
            state.returnCategoryGet = returnCategoryGet
        },
        changeCategoriesGet(state, dataSort) {
            state.dataSort = dataSort;
        },
        changeCategoryId(state, id) {
            state.id = id;
        }
    },
    state: {
        returnCategoriesIndex: [],
        returnCategoryGet: [],
        data: '',
        id: null
    },
    getters: {
        allReturnCategoriesIndex(state) {
            return state.returnCategoriesIndex
        },
        returnCategoryGet(state) {
            return state.returnCategoryGet
        }
    },
}
