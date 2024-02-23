import Api from "@/api";
import { constants } from "../_constants";

const apiUrl = process.env.VUE_APP_URL_API + constants.routeMain;


const updateItem = async (params) => {
  const id = params.papel_id;
  delete params.id;
  const result = await Api.put(apiUrl, id, params);
  if (result) {
    return result;
  }
  return false;
};

const createItem = async (params) => {
  const result = await Api.post(apiUrl, params);
  if (result) {
    return result;
  }
  return false;
};


export default {
  createItem,
  updateItem,
};
