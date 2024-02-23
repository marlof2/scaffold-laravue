import Api from "@/api";
import Jwt from "@/api/jwt";
import router from "../../../router";

const url = process.env.VUE_APP_URL_API;

const authenticate = async (params) => {
  const result = await Api.post(`${url}login`, params);
  if (result) {
    if (result.data.token) {
      Jwt.saveToken(result.data.token);
      return result.data;
    }
  }
  return false;
};

const checkToken = async () => {
  const result = await Api.query("auth/usuario");
  if (result) {
    if (result.data.token) await Jwt.saveToken(result.data.token);

    return result;
  }
  return false;
};

const me = async () => {
  const result = await Api.query(`${url}me`, {});
  if (result) {
    return result.data;
  }
  return false;
};

const permissoes = async (id) => {
  const result = await Api.get(`${url}permissaouser`, id);
  if (result) {
    return result.data;
  }
  return false;
};

const logout = async () => {
  const result = await Api.post(`${url}logout`);
  if (result.status == 200) {
    await Jwt.destroyToken();
    window.localStorage.removeItem('permissoes')
    window.localStorage.removeItem('user_id')
    router.push({ name: "login" });
  }
  return false;
};

export default {
  authenticate,
  permissoes,
  checkToken,
  logout,
  me
};
