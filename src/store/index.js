import { createStore } from "vuex";

export default createStore({
    state: { // 所有在 store 裏的資料
        is_loading: false,
        card_data: [], // 卡片渲染
        favorites_arr: [], // 收藏

    },
    mutations: { // 負責改變 state 裏的資料
        add_card_data(state, data) {
            state.card_data = data;
        },
        add_favorites_data(state, data) {
            state.favorites_arr = data;
        },
        is_loading(state, data) {
            state.is_loading = data;
            document.querySelector('body').style.overflow = "";
        }
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
        do_load({ commit }) {
            commit('is_loading', false);
            document.querySelector('body').style.overflow = "hidden";
            setTimeout(() => { commit('is_loading', true) }, 2000)
        }

    },
    getters: {
        // 像 computed 一樣？？，運算處理 state 資料
        get_is_loading: state => {
            return state.is_loading
        }

    },
    modules: {
        // 按需求分拆 module
        // 每個 module 都有自己的state, actions, mutations, getters, modules
    }
})

