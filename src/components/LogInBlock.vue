<template>
  <div class="logInBlock">
    <form>
      <h1>Log in</h1>
      <p>Not a member yet ? <span @click="goto_Signup">Sign in</span></p>
      <h3>Email</h3>
      <input
        :class="{ error: is_error_email }"
        type="email"
        v-model.trim="email"
        @focus="cancel_error('email')"
      />
      <div>
        <h3>Password</h3>
        <span>Forgot password</span>
      </div>
      <input
        :class="{ error: is_error_password }"
        type="password"
        v-model.trim="password"
        @focus="cancel_error('password')"
      />
      <button @click="go_login" type="button">Log in</button>
      <div class="or_block">
        <span></span>
        or
        <span></span>
      </div>
      <button type="button" class="google_btn" @click="handleClickSignIn">
        <img src="@/assets/img/web_all/googlelogo.png" alt="" />
        Log in with Google
      </button>
    </form>
  </div>
</template>
<script>
import { useStore } from "vuex";
import { ref } from "vue";
import { inject, toRefs } from "vue";

export default {
  name: "LogInBlock",
  components: {},
  methods: {
    async handleClickSignIn() {
      try {
        const googleUser = await this.$gAuth.signIn();
        if (!googleUser) {
          return null;
        }
        console.log("getId", googleUser.getBasicProfile().getEmail());
      } catch (error) {
        console.error(error);
        return null;
      }
    },
  },
  setup(props) {
    // google登入用的
    const { isSignIn } = toRefs(props);
    const Vue3GoogleOauth = inject("Vue3GoogleOauth");

    const store = useStore();

    // 切到註冊頁面
    const goto_Signup = () => {
      store.dispatch("go_change_login", "SignIn");
    };

    // 輸入資料
    const email = ref("");
    const password = ref("");

    // 錯誤紅框框
    const is_error_email = ref(false);
    const is_error_password = ref(false);

    // 使用者點到框框就消除紅框框
    const cancel_error = (which) => {
      switch (which) {
        case "email":
          is_error_email.value = false;
          break;
        case "password":
          is_error_password.value = false;
          break;
      }
    };
    const checked_member = (is_google) => {
      fetch("/api/checked_member.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json;charset=utf-8",
        },
        body: JSON.stringify({
          email: email.value,
          password: password.value,
          is_google: is_google,
        }),
      })
        .then((response) => {
          return response.json(); //json格式
        })
        .then((data) => {
          if (data == "error1") {
            alert("There is an error in the PASSWOED !");
            is_error_password.value = true;
          } else if (data == "error2") {
            alert("There is an error in the ACCOUNT ! Not a member yet ?");
            is_error_email.value = true;
          } else if (data == "error3") {
            alert("There is an error in the ACCOUNT ! Not a member yet ?");
            is_error_email.value = true;
          } else if (data == "error4") {
            alert("There is an error in the PASSWOED !");
            is_error_password.value = true;
          } else {
            alert(`welcome ${data.member_name}`);
            store.dispatch("inser_member_id", data.member_id);
            location.reload();
          }
        })
        .catch((err) => {
          console.log("錯誤:", err);
        });
    };

    // 登入
    const go_login = () => {
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
      if (!is_error_email.value && !is_error_password.value) {
        checked_member(0); //0 : 表示是用email登入
      }
    };

    return {
      Vue3GoogleOauth,
      isSignIn,
      goto_Signup,
      email,
      password,
      go_login,
      cancel_error,
      is_error_password,
      is_error_email,
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
span {
  color: #77002e;
  cursor: pointer;
}
.logInBlock div {
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
input[type="password"].error,
input[type="email"].error {
  outline: 2px solid #85030a;
}
</style>