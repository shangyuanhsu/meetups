<template>
  <header>
    <router-link to="/"> <h1>Vue Meetups</h1></router-link>
    <div id="nav">
      <router-link to="/All_meetups">All Meetups</router-link> |
      <router-link to="/AddNew">Add New Meetup</router-link> |
      <router-link to="/Favorites">My Favorites</router-link>
      <router-link to="/Login">
        <img :src="require('./assets/img/member_img/' + member)" />
      </router-link>
    </div>
  </header>
  <router-view />
  <Loading v-show="!is_loading" />
</template>
<script>
import { useStore } from "vuex";
import { ref, onMounted, computed } from "vue";
import Loading from "@/components/Loading.vue";

export default {
  components: {
    Loading,
  },
  setup() {
    const store = useStore();
    const member = ref(""); // 會員頭像
    const get_loading = () => {
      // 現在有沒有登入
      store.dispatch("do_load");
    };
    onMounted(get_loading);

    // 之後要去抓會員頭像
    member.value = store.state.member;

    // 是否loading
    const is_loading = computed(() => {
      return store.getters.get_is_loading;
    });

    return {
      is_loading,
      member,
    };
  },
};
</script>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-align: left;
}
body {
  background-color: #fcf3f6;
}
header {
  background-color: #77002e;
  padding: 30px 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #ffffff;
  margin-bottom: 80px;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #3b3b3b;
}
header a {
  font-weight: bold;
  text-decoration: none;
  color: #ffffff;
}
#nav {
  display: flex;
  align-items: center;
}
#nav a {
  margin: 0 10px;
  font-weight: bold;
  text-decoration: none;
  color: #ffffff;
}

#nav a:not(:last-child).router-link-exact-active {
  color: #ffffff;
  border-bottom: 2px solid #ffffff;
}

#nav a img {
  width: 30px;
}
</style>
