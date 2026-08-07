export default {
    actions: {
        async returnAppointmentsIndex(ctx) {
            Vue.axios.post('/appointments', this.state.returnAppointments.data).then((response) => {
                const returnAppointmentsIndex = response.data;
                ctx.commit('updateAppointmentsIndex', returnAppointmentsIndex);
            });
        },
        async changeAppointmentStatus() {
            Vue.axios.post('/change-appointment-status', {
                    id:this.state.returnAppointments.id
                }).then((response) => {
                    return true;
            });
        },
        async returnAppointmentEditGet(ctx) {
            Vue.axios.post('/appointments-edit', {
                    id:this.state.returnAppointments.id
                }).then((response) => {
                const returnAppointmentsIndex = response.data;
                ctx.commit('updateAppointmentsGet', returnAppointmentsIndex);
            });
        },
        async returnAppointmentSort(ctx, data) {
            Vue.axios.post('/appointments-sort', {sort: data}).then((response) => {
                console.log(response)
            });
        },
    },
    mutations: {
        updateAppointmentsIndex(state, returnAppointmentsIndex) {
            state.returnAppointmentsIndex = returnAppointmentsIndex
        },
        changeAppointmentsStates(state, data){
            state.data = data;
        },
        changeAppointmentId(state, id){
            state.id = id;
        },
        updateAppointmentsGet(state, returnAppointmentsGet) {
            state.returnAppointmentsGet = returnAppointmentsGet
        },
        changeAppointmentsGet(state, dataSort){
            state.dataSort = dataSort;
        }
    },
    state: {
        returnAppointmentsIndex: [],
        returnAppointmentsGet: [],
        data: '',
        dataSort: '',
        id: null,
    },
    getters: {
        allReturnAppointmentsIndex(state) {
            return state.returnAppointmentsIndex
        },
        returnAppointmentGet(state) {
            return state.returnAppointmentsGet
        }
    },
}
