export default {
    actions: {
        async returnSubCategoriesIndex(ctx) {
            Vue.axios.post('/sub-categories', this.state.returnSubCategories.data).then((response) => {
                const returnSubCategoriesIndex = response.data;
                ctx.commit('updateSubCategoriesIndex', returnSubCategoriesIndex);
            });
        },
        async returnCategoriesList(ctx) {
            Vue.axios.get('/categories-list').then((response) => {
                const returnCategoriesList = response.data;
                ctx.commit('updateCategoriesList', returnCategoriesList);
            });
        },

    },
    mutations: {
        updateSubCategoriesIndex(state, returnSubCategoriesIndex) {
            state.returnSubCategoriesIndex = returnSubCategoriesIndex
        },
        changeSubCategories(state, data){
            state.data = data;
        },

        updateSubCategoriesGet(state, returnSubCategoriesGet) {
            state.returnSubCategoriesGet = returnSubCategoriesGet
        },
        changeSubCategoriesGet(state, dataSort){
            state.dataSort = dataSort;
        },
        updateCategoriesList(state, returnCategoriesList) {
            state.returnCategoriesList = returnCategoriesList
        },
        changeCategoriesList(state, dataCategories){
            state.dataCategories = dataCategories;
        }
    },
    state: {
        returnSubCategoriesIndex: [],
        returnSubCategoriesSort: [],
        returnCategoriesList: [],
        data: '',
        dataCategories: '',
        dataSort: '',
    },
    getters: {
        allReturnSubCategoriesIndex(state) {
            return state.returnSubCategoriesIndex
        },
        allReturnSubCategoriesGet(state_get) {
            return state_get.returnSubCategoriesGet
        },
        allCategoriesList(state) {
            return state.returnCategoriesList
        }
    },
}
