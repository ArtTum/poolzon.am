export default {
    actions: {
        async returnColorsIndex(ctx) {
            Vue.axios.post('/colors', this.state.returnColors.data).then((response) => {
                const returnColorsIndex = response.data;
                ctx.commit('updateColorsIndex', returnColorsIndex);
            });
        },

        async returnColorSort(ctx, data) {
            Vue.axios.post('/colors-sort', {sort: data}).then((response) => {
                console.log(response)
            });
        },
        async changeColorStatus() {
            Vue.axios.post('/change-color-status', {
                    id:this.state.returnColors.id
                }).then((response) => {
                    return true;
            });
        },
        async returnColorEditGet(ctx) {
            Vue.axios.post('/colors-edit', {
                    id:this.state.returnColors.id
                }).then((response) => {
                const returnColorsIndex = response.data;
                ctx.commit('updateColorsGet', returnColorsIndex);
            });
        },
    },
    mutations: {
        updateColorsIndex(state, returnColorsIndex) {
            state.returnColorsIndex = returnColorsIndex
        },
        changeColorsStates(state, data){
            state.data = data;
        },
        changeColorId(state, id){
            state.id = id;
        },
        updateColorsGet(state, returnColorsGet) {
            state.returnColorsGet = returnColorsGet
        },
        changeColorsGet(state, dataSort){
            state.dataSort = dataSort;
        }
    },
    state: {
        returnColorsIndex: [],
        returnColorsGet: [],
        data: '',
        dataSort: '',
        id: null,
    },
    getters: {
        allReturnColorsIndex(state) {
            return state.returnColorsIndex
        },
        returnColorGet(state) {
            return state.returnColorsGet
        }
    },
}
