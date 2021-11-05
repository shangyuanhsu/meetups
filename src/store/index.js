import { createStore } from "vuex";

export default createStore({
    state: { // 所有在 store 裏的資料
        is_loading: false,
        card_data: [], // 卡片渲染
        member: "member.png",//預設頭像
        user_id: "",//uid
        which_login: "SignIn"//切分頁

    },
    mutations: { // 負責改變 state 裏的資料
        add_card_data(state, data) {
            state.card_data = data;
        },

        is_loading(state, data) {
            state.is_loading = data;
            document.querySelector('body').style.overflow = "";
        },
        change_login(state, data) {
            state.which_login = data;
        },
        change_member(state, data) {
            state.user_id = data;
        }
    },
    actions: {
        // 負責觸發 mutations
        // ajax 要在 Actions 裡面做，不可以在 Mutations 裡面做
        // 可處理非同步程式（e.g: 打 API）
        //==================================================
        // 撈meet的資料
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
            }).catch((err) => {
                console.log('錯誤:', err);
            })
        },
        // loading 處理
        do_load({ commit }) {
            commit('is_loading', false);
            document.querySelector('body').style.overflow = "hidden";
            setTimeout(() => { commit('is_loading', true) }, 2000)

        },
        // 登入登出註冊component切換
        go_change_login({ commit }, c_name) {
            commit('change_login', c_name);
        },
    
        //checked session
        checked_user_id({ commit }) {
            fetch("/api/session.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json;charset=utf-8",
                },
            })
                .then((response) => {
                    return response.json(); //json格式
                })
                .then((data) => {
                    if (data != "no") {
                        commit('change_member', data);
                        commit('change_login', "SignOut");
                    } else {
                        commit('change_login', "LogInBlock");
                    }

                })
                .catch((err) => {
                    console.log("錯誤:", err);
                });
        },
        //session start
        inser_member_id({ commit }, uid) {
            fetch("/api/session_start.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json;charset=utf-8",
                },
                body: JSON.stringify({
                    member_id: uid,
                }),
            })
                .then((response) => {
                    return response.json(); //json格式
                })
                .then((data) => {
                    if (data == "ok") {
                        commit('change_member', uid);
                    }
                })
                .catch((err) => {
                    console.log("錯誤:", err);
                });

        },
        //session destroy
        bye_user_id({ commit }) {
            fetch("/api/session_bye.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json;charset=utf-8",
                },
            })
                .then((response) => {
                    return response.json(); //json格式
                })
                .then((data) => {
                    console.log(data);
                    commit('change_member', "");

                })
                .catch((err) => {
                    console.log("錯誤:", err);
                });

        }

    },
    getters: {
        // 像 computed 一樣？？，運算處理 state 資料
        //==================================================
        // 即時切換loading
        get_is_loading: state => {
            return state.is_loading
        },
        // 即時切換登入登出註冊component
        get_which_login: state => {
            return state.which_login
        },


    },
    modules: {
        // 按需求分拆 module
        // 每個 module 都有自己的state, actions, mutations, getters, modules
    }
})

