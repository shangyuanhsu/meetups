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
    };
    onMounted(get_loading);

    //登入還是未登入
    if (store.state.user_id) {
      store.dispatch("go_change_login", "SignOut");
    } else {
      store.dispatch("go_change_login", "LogInBlock");
    }

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
</style>