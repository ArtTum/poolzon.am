export default {
    actions: {
        async returnParameters(ctx) {

            console.log(this.state.returnParameters.data);

            Vue.axios.post('/parameters', this.state.returnParameters.data).then((response) => {
                const returnParameters = response.data;
                ctx.commit('updateParameters', returnParameters);
            });
        },
    },
    mutations: {
        updateParameters(state, returnParameters) {
            state.returnParameters = returnParameters
        },
        changeParameters(state, data){
            state.data = data;
        },

    },
    state: {
        returnParameters: [],
        data: '',
    },
    getters: {
        allReturnParameters(state) {
            return state.returnParameters
        },
    },
}
