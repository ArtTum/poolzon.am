export default {
    actions: {
        async returnAdIndex(ctx) {
            Vue.axios.get('/ad-blocks?statusID='+this.state.returnAd.data).then((response) => {
                    const returnAdIndex = response.data;
                    ctx.commit('updateAdIndex', returnAdIndex);
            })
        },
        async returnAdEdit(ctx)
        {
            Vue.axios.put('/ad-blocks/'+this.state.returnAd.data.id, this.state.returnAd.data).then((response) => {
                const returnAdEdit = response.data;
                ctx.commit('updateAdEdit', response.data.success);
                ctx.commit('success', returnAdEdit);
            }).catch(error => {
                const returnAdEdit = error.response.data;
                ctx.commit('updateAdEdit', returnAdEdit);
            });
        },
        async returnAdGet(ctx) {
            Vue.axios.get('/ad-blocks/'+this.state.returnAd.data.id+'/edit ').then((response) => {
                const returnAdGet = response.data;
                ctx.commit('updateAdGet', returnAdGet);
            })
        },
    },
    mutations: {
        updateAdIndex(state, returnAdIndex) {
            state.returnAdIndex = returnAdIndex
        },
        changeAd(state, data){
            state.data = data;
        },
        updateAdEdit(state, returnAdEdit) {
            state.returnAdEdit = returnAdEdit
        },
        success(state, returnAdEdit) {
            state.returnAdEdit = returnAdEdit
        },
        changeAdEdit(state, data){
            state.data = data;
        },
        updateAdGet(state, returnAdGet) {
            state.returnAdGet = returnAdGet
        },
        changeAdGet(state, data){
            state.data = data;
        }
    },
    state: {
        returnAdIndex: [],
        returnAdEdit: [],
        returnAdGet: [],
        data: '',
        success: '',
    },
    getters: {
        allReturnAdIndex(state) {
            return state.returnAdIndex
        },
        allReturnAdEdit(state_edit) {
            return state_edit.returnAdEdit
        },
        allReturnAdGet(state_get) {
            return state_get.returnAdGet
        }
    },
}
