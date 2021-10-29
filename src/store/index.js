import { createStore } from "vuex";

export default createStore({
    state: {
        // 所有在 store 裏的資料
        card_data: [],
        favorites_arr: []

    },
    mutations: {
        // 負責改變 state 裏的資料
        add_card_data(state, data) {
            state.card_data = data;
        },
        add_favorites_data(state, data) {
            state.favorites_arr = data;
        },
    },
    actions: {
        // 負責觸發 mutations
        // ajax 要在 Actions 裡面做，不可以在 Mutations 裡面做
        // 可處理非同步程式（e.g: 打 API）
        get_room({ commit }) {
            fetch('/api/get_room.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
            }).then((response) => {
                return response.json(); //json格式
            }).then((data) => {
                commit('add_card_data', data['meet_room'])
                commit('add_favorites_data', data['favorites'])
            }).catch((err) => {
                console.log('錯誤:', err);
            })
        },

    },
    getters: {
        // 像 computed 一樣？？，運算處理 state 資料
            // aaa: state => {
            //   return state.dataname
            // }
      
    },
    modules: {
        // 按需求分拆 module
        // 每個 module 都有自己的state, actions, mutations, getters, modules
    }
})

