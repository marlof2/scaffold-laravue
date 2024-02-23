import { constants } from "../_constants";

const itemsStateName = Object.keys(constants.state);

const STORE_ITEMS = (state, itemsState) => {
  state[itemsStateName[0]] = itemsState;
};

const STORE_ITEM_BY_ID = (state, itemState) => {
  state[itemsStateName[1]] = itemState;
}
const STORE_PERMISSAO = (state, itemState) => {
  state[itemsStateName[2]] = itemState;
}
export default {
  STORE_ITEMS,
  STORE_ITEM_BY_ID,
  STORE_PERMISSAO
}