import actions from "./actions";
import getters from "./getters";
import mutations from "./mutations";

const state = {
  requestsPending: 0,
  showOverlay: true,
};

export default {
  namespaced: true,
  state,
  actions,
  getters,
  mutations
};
