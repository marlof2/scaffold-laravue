import { constants } from "../_constants";

const getItems = (state) => state[constants.routeMain];
const getItemById = (state) => state[`${constants.routeMain}ById`];
const getAbilityByProfile = (state) => state[`permissoes`];

export default {
  getItems,
  getItemById,
  getAbilityByProfile
};
