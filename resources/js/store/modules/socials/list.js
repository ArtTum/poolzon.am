export default {
    actions: {
        async returnSocialsIndex(ctx) {
            Vue.axios.post('/socials', this.state.returnSocials.data).then((response) => {
                const returnSocialsIndex = response.data;
                ctx.commit('updateSocialsIndex', returnSocialsIndex);
            });
        },
        async returnSocialsGet(ctx) {
            Vue.axios.post('/socials-edit', {
                id: this.state.returnSocials.id
            }).then((response) => {
                const returnSocialsGet = response.data;
                ctx.commit('updateSocialsGet', returnSocialsGet);
            });
        },
    },
    mutations: {
        updateSocialsIndex(state, returnSocialsIndex) {
            state.returnSocialsIndex = returnSocialsIndex
        },
        changeSocialsStates(state, data) {
            state.data = data;
        },
        updateSocialsGet(state, returnSocialsGet) {
            state.returnSocialsGet = returnSocialsGet
        },
        changeSocialsGet(state, id) {
            state.id = id;
        },
    },
    state: {
        returnSocialsIndex: [],
        returnSocialsGet: [],
        data: null,
        id: null,
    },
    getters: {
        allReturnSocialsIndex(state) {
            return state.returnSocialsIndex
        },
        allReturnSocialsGet(state) {
            return state.returnSocialsGet
        },
    },
}
