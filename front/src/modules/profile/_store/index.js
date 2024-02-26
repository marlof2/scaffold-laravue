import actions from "./actions";
import getters from "./getters";
import mutations from "./mutations";
import { constants } from "../_constants";

const state = constants.state;

export default {
  namespaced: true,
  state,
  actions,
  getters,
  mutations
};