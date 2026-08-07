export default {
    actions: {
        async returnQuickSearch(ctx) {

            console.log(this.state.returnQuickSearch.data);

            Vue.axios.post('/quick-search', this.state.returnQuickSearch.data).then((response) => {
                const returnQuickSearch = response.data;
                ctx.commit('updateQuickSearch', returnQuickSearch);
            });
        },
    },
    mutations: {
        updateQuickSearch(state, returnQuickSearch) {
            state.returnQuickSearch = returnQuickSearch
        },
        changeQuickSearch(state, data){
            state.data = data;
        },

    },
    state: {
        returnQuickSearch: [],
        data: '',
    },
    getters: {
        allReturnQuickSearch(state) {
            return state.returnQuickSearch
        },
    },
}
