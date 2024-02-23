import Api from "@/api";
import { constants } from "../_constants";

const apiUrl = process.env.VUE_APP_URL_API + constants.routeMain;

const getItems = async (params) => {
  const result = await Api.query(apiUrl, params);
  if (result) {
    return result.data;
  }
  return false;
};


export default {
  getItems,
};
