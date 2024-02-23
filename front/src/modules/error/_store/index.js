import actions from "./actions";
import getters from "./getters";
import mutations from "./mutations";

const state = {
  errors: [],
  errorData: [],
};

export default {
  namespaced: true,
  state,
  actions,
  getters,
  mutations,
};
