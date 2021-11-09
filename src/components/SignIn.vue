<template>
  <div class="signIn">
    <form>
      <h1>Sign in</h1>
      <p>
        Already a member ?
        <span class="go_Login" @click="goto_Login">Log in</span>
      </p>
      <h3>Your name</h3>
      <input
        type="text"
        :class="{ error: is_error_name }"
        placeholder="30 characters"
        maxlength="30"
        v-model.trim="name"
        @focus="cancel_error('name')"
      />
      <h3>Email address</h3>
      <input
        :class="{ error: is_error_email }"
        type="email"
        v-model.trim="email"
        @focus="cancel_error('email')"
      />
      <div>
        <h3>Password</h3>
        <span>{{ password_result }}</span>
      </div>
      <input
        type="password"
        maxlength="10"
        placeholder="10 characters"
        v-model.trim="password"
        :class="{ error: is_error_password }"
        @focus="cancel_error('password')"
      />

      <button type="button" @click="go_sign">Sign</button>
      <div class="or_block">
        <span></span>
        or
        <span></span>
      </div>
      <button type="button" class="google_btn" @click="handleClickSignIn">
        <img src="@/assets/img/web_all/googlelogo.png" alt="" />
        Sign in with Google
      </button>
    </form>
  </div>
</template>
<script>
import { useStore } from "vuex";
// import { ref, onMounted } from "vue";
import { computed, inject, ref, toRefs } from "vue";

export default {
  name: "SignIn",
  components: {},

  methods: {
    async handleClickSignOut() {
      try {
        await this.$gAuth.signOut();
        // console.log("isAuthorized", this.Vue3GoogleOauth.isAuthorized);
        console.log(this.$store.state.user_id);
      } catch (error) {
        console.error(error);
      }
    },
  },
  setup(props) {
    // google登入用
    const { isSignIn } = toRefs(props);
    const Vue3GoogleOauth = inject("Vue3GoogleOauth");

    const store = useStore();

    // 輸入資料
    const name = ref("");
    const email = ref("");
    const password = ref("");
    // 錯誤框框
    const is_error_name = ref(false);
    const is_error_email = ref(false);
    const is_error_password = ref(false);

    // 去login
    const goto_Login = () => {
      if (name.value || email.value || password.value) {
        alert("Are you sure ? Data will be cleared");
      }
      store.dispatch("go_change_login", "LogInBlock");
    };

    // 使用者點到框框就消除紅框框
    const cancel_error = (which) => {
      switch (which) {
        case "name":
          is_error_name.value = false;
          break;
        case "email":
          is_error_email.value = false;
          break;
        case "password":
          is_error_password.value = false;
          break;
      }
    };

    // 驗證密碼
    const password_result = computed(() => {
      if (password.value != "") {
        let score = password.value.length;
        if (/[A-Z]/.test(password.value)) score *= 2;
        if (/[a-z]/.test(password.value)) score *= 2;
        if (/[0-9]/.test(password.value)) score *= 2;
        if (/[^A-Za-z0-9]/.test(password.value)) score *= 2;
        if (score > 40) return "Perfect";
        if (score > 20) return "Great";
        if (score > 10) return "Good";
        return "Week";
      } else {
        return "";
      }
    });

    // 進php驗證資料與寫入資料
    const insert_member = (is_google) => {
      fetch("/api/insert_member.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json;charset=utf-8",
        },
        body: JSON.stringify({
          name: name.value,
          email: email.value,
          password: password.value,
          is_google: is_google,
        }),
      })
        .then((response) => {
          return response.json(); //json格式
        })
        .then((data) => {
          if (data == "errorH") {
            alert("This email has already been registered !");
            store.dispatch("do_load");
            store.dispatch("go_change_login", "LogInBlock");
          } else if (data == "errorN") {
            is_error_name.value = true;
          } else if (data == "errorE") {
            is_error_email.value = true;
          } else if (data == "errorP") {
            is_error_password.value = true;
          } else {
            store.dispatch("inser_member_id", data);
            store.dispatch("do_load");
            location.href = "./#/All_meetups";
          }
        })
        .catch((err) => {
          console.log("錯誤:", err);
        });
    };

    // 按sign in
    const go_sign = () => {
      if (name.value == "") {
        is_error_name.value = true;
      }

      if (
        email.value.replace(/\s+/g, "") == "" ||
        email.value.replace(/\s+/g, "").indexOf("@") == -1
      ) {
        is_error_email.value = true;
      }

      if (
        password.value.replace(/\s+/g, "") == "" ||
        password.value.replace(/\s+/g, "").length != 10
      ) {
        is_error_password.value = true;
      }
      if (
        !is_error_name.value &&
        !is_error_email.value &&
        !is_error_password.value
      ) {
        insert_member(0); //0 : 表示是用email登入
      }
    };

    return {
      Vue3GoogleOauth,
      isSignIn,
      goto_Login,
      password_result,
      password,
      name,
      email,
      is_error_name,
      is_error_email,
      is_error_password,
      go_sign,
      cancel_error,
    };
  },
};
</script>

<style scoped>
form {
  padding: 30px;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgb(0 0 0 / 20%);
  text-align: left;
}

p {
  margin: 20px 0 40px 0;
}
.password_result {
  color: #77002e;
  margin: -5px 0 -10px 0;
}
span {
  color: #77002e;
}
.go_Login {
  cursor: pointer;
}
.signIn div {
  display: flex;
  justify-content: space-between;
}
.or_block {
  color: #77002e;
  align-items: center;
}
.or_block span {
  width: 45%;
  border-top: 1px solid #77002e;
  cursor: unset;
}
input[type="text"],
input[type="email"],
input[type="password"] {
  display: block;
  width: 100%;
  padding: 8px;
  font: inherit;
  border-radius: 4px;
  border: 1px solid #ccc;
  margin: 8px 0 20px 0;
}
button {
  display: block;
  width: 100%;
  margin: 30px 0;
  font-size: 20px;
  padding: 10px;
  border-radius: 4px;
  color: white;
  border: 1px solid #77002e;
  background-color: #77002e;
  outline: none;
  cursor: pointer;
  transition: all 0.5s;
}
button:hover {
  color: #77002e;
  background-color: white;
}
.google_btn {
  background-color: white;
  color: #77002e;
  display: flex;
  justify-content: center;
  align-items: center;
}
.google_btn img {
  width: 22px;
  margin: 0 20px 0 0;
}

input[type="text"].error,
input[type="password"].error,
input[type="email"].error {
  outline: 2px solid #85030a;
}
</style>