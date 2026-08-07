export default {
    actions: {
        async returnTypesIndex(ctx) {
            Vue.axios.post('/types', this.state.returnTypes.data).then((response) => {
                const returnTypesIndex = response.data;
                ctx.commit('updateTypesIndex', returnTypesIndex);
            });
        },
        async changeTypeStatus() {
            Vue.axios.post('/change-type-status', {
                    id:this.state.returnTypes.id
                }).then((response) => {
                    return true;
            });
        },
        async returnTypeEditGet(ctx) {
            Vue.axios.post('/types-edit', {
                    id:this.state.returnTypes.id
                }).then((response) => {
                const returnTypesIndex = response.data;
                ctx.commit('updateTypesGet', returnTypesIndex);
            });
        },
        async returnTypeSort(ctx, data) {
            Vue.axios.post('/types-sort', {sort: data}).then((response) => {
                console.log(response)
            });
        },
    },
    mutations: {
        updateTypesIndex(state, returnTypesIndex) {
            state.returnTypesIndex = returnTypesIndex
        },
        changeTypesStates(state, data){
            state.data = data;
        },
        changeTypeId(state, id){
            state.id = id;
        },
        updateTypesGet(state, returnTypesGet) {
            state.returnTypesGet = returnTypesGet
        },
        changeTypesGet(state, dataSort){
            state.dataSort = dataSort;
        }
    },
    state: {
        returnTypesIndex: [],
        returnTypesGet: [],
        data: '',
        dataSort: '',
        id: null,
    },
    getters: {
        allReturnTypesIndex(state) {
            return state.returnTypesIndex
        },
        returnTypeGet(state_get) {
            return state_get.returnTypesGet
        }
    },
}
