import api from "../_api";


const createItem = async (context, object) => {
  return await api.createItem(object);
};

const updateItem = async (context, object) => {
  return await api.updateItem(object);
};


export default {
  createItem,
  updateItem,
};
