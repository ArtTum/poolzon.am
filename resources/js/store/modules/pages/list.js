export default {
    actions: {
        async returnPagesIndex(ctx) {
            Vue.axios.post('/pages', this.state.returnPages.data).then((response) => {
                const returnPagesIndex = response.data;
                ctx.commit('updatePagesIndex', returnPagesIndex);
            });
        },
        async returnPageGet(ctx) {
            Vue.axios.post('/page-edit', {
                id: this.state.returnPages.id
            }).then((response) => {
                const returnPageGet = response.data;
                ctx.commit('updatePageGet', returnPageGet);
            });
        },
        async changePageStatus() {
            Vue.axios.post('/change-page-status', {
                id: this.state.returnPages.id
            }).then((response) => {
              return true;
            });
        },
    },
    mutations: {
        updatePagesIndex(state, returnPagesIndex) {
            state.returnPagesIndex = returnPagesIndex
        },
        changePages(state, data) {
            state.data = data;
        },
        updatePageGet(state, returnPageGet) {
            state.returnPageGet = returnPageGet
        },
        changePagesGet(state, dataSort) {
            state.dataSort = dataSort;
        },
        changePageId(state, id) {
            state.id = id;
        }
    },
    state: {
        returnPagesIndex: [],
        returnPageGet: [],
        data: '',
        id: null
    },
    getters: {
        allReturnPagesIndex(state) {
            return state.returnPagesIndex
        },
        returnPageGet(state) {
            return state.returnPageGet
        }
    },
}
