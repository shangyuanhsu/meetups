<template>
  <div class="login">
    <component :is="is_login"></component>
  </div>
</template>
<script>
import { useStore } from "vuex";
import { onMounted, computed } from "vue";
import LogInBlock from "@/components/LogInBlock.vue";
import SignOut from "@/components/SignOut.vue";
import SignIn from "@/components/SignIn.vue";
export default {
  name: "Login",
  components: {
    LogInBlock,
    SignOut,
    SignIn,
  },

  setup() {
    const store = useStore();
    // loading
    const get_loading = () => {
      store.dispatch("do_load");
      store.dispatch("checked_user_id"); //會員有沒有登入啦!
    };
    onMounted(get_loading);

    //登入還是未登入

    // 判斷切換的component
    const is_login = computed(() => {
      return store.getters.get_which_login;
    });

    return {
      is_login,
    };
  },
};
</script>

<style scoped>
.login {
  width: 65%;
  max-width: 1000px;
  margin: 40px auto 80px auto;
}
</style>