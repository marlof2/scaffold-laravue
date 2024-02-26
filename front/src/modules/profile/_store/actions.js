import api from "../_api";

const getItems = async (context, params) => {
  const result = await api.getItems(params);
  context.commit("STORE_ITEMS", result);
  return result;
};

const getItemById = async (context, params) => {
  const result = await api.getItemById(params);
  context.commit("STORE_ITEM_BY_ID", result);
};

const createItem = async (context, object) => {
  return await api.createItem(object);
};

const addPermissions = async (context, object) => {
  return await api.addPermissions(object);
};

const updateItem = async (context, object) => {
  return await api.updateItem(object);
};

const deleteItem = async (context, id) => {
  const result = await api.deleteItem(id);
};

const getAbilityByProfile = async (context, id) => {
  const result = await api.getAbilityByProfile(id);
  context.commit("STORE_PERMISSAO", result);
};

export default {
  getItems,
  getItemById,
  createItem,
  updateItem,
  deleteItem,
  getAbilityByProfile,
  addPermissions
};
