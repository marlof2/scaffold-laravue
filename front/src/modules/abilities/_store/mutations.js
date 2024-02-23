import { constants } from "../_constants";

const itemsStateName = Object.keys(constants.state);

const STORE_ITEMS = (state, itemsState) => {
  state[itemsStateName[0]] = itemsState;
};

export default {
  STORE_ITEMS,
}
