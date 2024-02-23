import api from "../_api";

const authenticate = async (context, object) => {
  const result = await api.authenticate(object);
  context.commit("AUTHENTICATED", result);
};

const permissoes = async (context, id) => {
  const result = await api.permissoes(id);
  context.commit("PERMISSOES", result);
};

const setAuthorization = async (context, object) => {
  context.commit("SET_AUTHORIZATION", object);
};

const checkToken = async (context) => {
  const result = await api.checkToken();
  context.commit("AUTHENTICATED", result.data);
};

const logout = async (context) => {
  const result = await api.logout();
  if (result) {
    context.commit("AUTHENTICATED", []);
  }
  return result;
};

const me = async (context, object) => {
  const result = await api.me(object);
  context.commit("USER_ME", result);
};

export default {
  authenticate,
  permissoes,
  checkToken,
  setAuthorization,
  logout,
  me,
};
