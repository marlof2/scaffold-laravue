import { constants } from "../_constants";

const getItems = (state) => state[constants.routeMain];
const getItemById = (state) => state[`${constants.routeMain}ById`];

export default {
  getItems,
  getItemById,
};
