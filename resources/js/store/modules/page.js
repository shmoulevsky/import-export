
export default{
    actions :{
        setTitle (context, title) {
            context.commit('setTitle', title)
        }
    },
    mutations :{
        setTitle(state, title){
            state.title = title;
        }
    },
    state :{
        title : 'Dashboard',
    },
    getters :{
        getPage(state){
            return state.title;
        },
    }
}
