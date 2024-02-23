import Api from "@/api";
const TOKEN = "token";

export default {
  getToken(token) {
    if (token) {
      this.saveToken(token);
      return token;
    }
    return window.localStorage.getItem(TOKEN);
  },

  saveToken(token) {
    window.localStorage.setItem(TOKEN, token);
    Api.init();
  },

  destroyToken() {
    window.localStorage.removeItem(TOKEN);
  },
};
