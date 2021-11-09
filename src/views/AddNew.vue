<template>
  <div class="addNew">
    <HelloWorld msg="Add New Meetup" />
    <form>
      <h3>Meetup Title</h3>
      <input
        type="text"
        placeholder="Limit 15 words"
        v-model="title"
        maxlength="15"
      />
      <h3>Meetup Image</h3>
      <div class="image_box">
        <input
          type="text"
          placeholder="Please upload a picture"
          v-model="image"
          disabled
        />
        <label class="image" for="image"></label>
      </div>
      <input type="file" id="image" accept="image/*" @change="upload_img" />
      <div id="show_img"></div>
      <h3>Address</h3>
      <label class="online"
        ><input
          type="radio"
          name="online"
          value="0"
          v-model="online"
          checked
        />not online</label
      >
      <label class="online"
        ><input
          type="radio"
          name="online"
          value="1"
          v-model="online"
        />online</label
      >
      <GMapAutocomplete
        placeholder="Where"
        @place_changed="setPlace"
        v-if="online == 0"
      ></GMapAutocomplete>

      <h3>Description</h3>
      <textarea v-model="text"></textarea>
      <button type="button" @click="new_meetup">Add Meetup</button>
    </form>
  </div>
</template>

<script>
import { useStore } from "vuex";
import { ref, onMounted } from "vue";
import HelloWorld from "@/components/HelloWorld.vue";

export default {
  name: "Home",
  components: {
    HelloWorld,
  },

  setup() {
    const title = ref(""); // 會議名稱
    const image = ref(""); // 會議圖片
    const text = ref(""); // 會議描述
    const address = ref(""); // 地址
    const online = ref(0); //是線上還是實體

    // loading
    const store = useStore();
    const get_loading = () => {
      store.dispatch("do_load");
    };
    onMounted(get_loading);

    // 地點
    const setPlace = (location) => {
      address.value = location.formatted_address;
    };

    // 預覽圖2
    const upload_img2 = (url) => {
      const show_img = document.querySelector("#show_img");
      const img = new Image();
      img.src = window.URL.createObjectURL(url);
      img.style.width = "100%";
      show_img.append(img);
    };
    // 預覽圖1
    const upload_img = (e) => {
      if (e.target.files.length == 0) {
        return;
      }
      if (e.target.files[0].type.split("/")[0] != "image") {
        alert("File error");
        return;
      }
      let file = e.target.files[0];
      image.value = file.name;
      upload_img2(e.target.files[0]);
    };

    // 送出
    const new_meetup = () => {
      if (title.value.length == 0 || title.value.length > 15) {
        alert("Title error");
      } else if (image.value == "") {
        alert("Image error");
      } else if (text.value.replace(/\s*/g, "") == "") {
        alert("Description error");
      } else if (online.value == 0 && address.value == "") {
        alert("Address error");
      } else {
        var formData = new FormData();
        formData.append("file", document.querySelector("#image").files[0]);
        formData.append("title", title.value);
        formData.append("text", text.value);
        formData.append("address", address.value);
        formData.append("online", online.value);

        fetch("/api/insert_meetup.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => {
            return response.json(); //json格式
          })
          .then((data) => {
            console.log(data);
            if (data == "ok") {
              store.dispatch("do_load");
              setTimeout(() => {
                location.href = "./All_meetups";
              }, 1000);
            } else {
              alert("data error QQ Please try again");
            }
          })
          .catch((err) => {
            console.log("錯誤:", err);
          });
      }
    };

    return {
      title,
      image,
      text,
      address,
      setPlace,
      new_meetup,
      online,
      upload_img,
    };
  },
};
</script>
<style scoped>
.vue-map-container {
  height: 500px;
}
.addNew{
 width: 65%;
  max-width: 1000px;
    margin: 40px auto 80px auto;
}
form {
  padding: 30px;

  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgb(0 0 0 / 20%);
  text-align: left;
}
h3 {
  font-size: 20px;
}
input[type="text"],
.pac-target-input,
textarea {
  display: block;
  width: 100%;
  padding: 8px;
  font: inherit;
  border-radius: 4px;
  border: 1px solid #ccc;
  margin: 8px 0 20px 0;
}
input[type="file"] {
  display: none;
}
textarea {
  resize: none;
  height: 150px;
}
input[type="radio"] {
  margin-right: 4px;
  vertical-align: middle;
}
.online {
  display: inline-block;
  margin: 10px 20px 10px 0;
  cursor: pointer;
}
.image_box {
  position: relative;
}
.image {
  display: block;
  width: 100%;
  height: 36px;
  position: absolute;
  top: 0;
  cursor: pointer;
}
#show_img {
  margin-bottom: 10px;
}
button {
  margin: 20px 0 45px 0;
  font-size: 20px;
  padding: 10px;
  border-radius: 4px;
  color: #77002e;
  border: 1px solid #77002e;
  background-color: white;
  outline: none;
  cursor: pointer;
  transition: all 0.5s;
}
button:hover {
  color: white;
  background-color: #77002e;
}
</style>