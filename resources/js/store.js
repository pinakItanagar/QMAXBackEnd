import { createStore } from 'vuex'



export default createStore({
    state: {
        appUserName: '',
        appUserID: '',
        appUserEmail: '',
        appMSG: '',
        appLoginState: false,
        interComponentReferer: false
    },

    getters: {
        getUserName: function (state) {
            return `${state.appUserName}`
        },

        getUserEmail: function (state) {
            return `${state.appUserEmail}`
        },

        getAppLoginState: function (state) {
            return `${state.appLoginState}`
        },

        getAppMSG: function (state) {
            return `${state.appMSG}`
        },

        getInterComponentReferer: function (state) {
            return `${state.interComponentReferer}`
        }
    },

    mutations: {
        UPDATE_APPMSG(state, payload) {
            state.appMSG = payload
        },

        UPDATE_USER_NAME(state, payload) {
            state.appUserName = payload
        },

        UPDATE_USER_EMAIL(state, payload) {
            state.appUserEmail = payload
        },

        UPDATE_LOGIN_STATE(state, payload) {
            state.appLoginState = payload
        },

        UPDATE_INTER_COMPONENT_REF_STATE(state, payload) {
            state.interComponentReferer = payload
        },
    },

    actions: {
        updateAppMessage({commit}, message) {
          commit('UPDATE_APPMSG', message );
        },

        updateAppUserName({commit}, message) {
            commit('UPDATE_USER_NAME', message );
        },

        updateAppUserEmail({commit}, message) {
            commit('UPDATE_USER_EMAIL', message );
        },

        updateAppLoginState({commit}, message) {
            commit('UPDATE_LOGIN_STATE', message );
        },

        updateInterComponentReferer({commit}, message) {
            commit('UPDATE_INTER_COMPONENT_REF_STATE', message );
        }
    }
});