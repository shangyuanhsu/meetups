<template>
  <div class="card">
    <div class="card_img">
      <img :src="img_src" />
    </div>
    <h2>{{ card_title }}</h2>
    <p>{{ card_address }}</p>
    <p>{{ card_description }}</p>
    <button
      class="button_add"
      :class="{ button_remove: status }"
      @click.stop.prevent="add_remove_card(card_key, status)"
    >
      {{ status ? "remove Favorites" : "To Favorites" }}
    </button>
  </div>
</template>

<script>
import { useStore } from "vuex";
export default {
  name: "Card",
  props: {
    img_src: String,
    card_title: String,
    card_address: String,
    card_description: String,
    card_key: String,
    status: Boolean,
  },
  setup() {
    const store = useStore();
    const no_login = () => {
      let ans = confirm("還沒有登入或註冊嗎?");
      if (ans) {
        location.href = `./Login`;
      }
    };

    const add_remove_card = (id, status) => {
      fetch("/api/change_favorite.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json;charset=utf-8",
        },
        body: JSON.stringify({
          room_id: id,
          status: status,
        }),
      })
        .then((response) => {
          return response.json(); //json格式
        })
        .then((data) => {
          if (data.status == "errorLogin") {
            no_login();
          } else {
            store.dispatch("get_room");
          }
        })
        .catch((err) => {
          console.log("錯誤:", err);
        });
    };

    return {
      add_remove_card,
    };
  },
};
</script>

<style scoped>
.card .card_img {
  width: 100%;
  height: 20em;
  overflow: hidden;
}
.card_img img {
  width: 100%;
}
.card h2 {
  font-size: 32px;
  margin: 20px 0;
}
.card p {
  margin: 10px 0;
}
.card,
.card h2,
.card p {
  text-align: center;
}
.card button {
  margin: 20px 0 45px 0;
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
.card .button_remove {
  color: #77002e;
  border: 1px solid #77002e;
  background-color: white;
}
.card .button_remove:hover {
  color: white;
  background-color: #77002e;
}

.card .button_add:hover {
  color: #77002e;
  background-color: white;
  border: 1px solid #77002e;
}
</style>