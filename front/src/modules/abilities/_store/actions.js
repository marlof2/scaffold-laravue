import api from "../_api";

const getItems = async (context, params) => {
  const result = await api.getItems(params);
  context.commit("STORE_ITEMS", result);
  return result;
};


export default {
  getItems,
};
