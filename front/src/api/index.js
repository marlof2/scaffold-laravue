import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";

import Jwt from "@/api/jwt";

import storeError from "../modules/error/_store";
import storeRequest from "../modules/request/_store";
import store from "../store";

import Router from "../router";
import swal from "sweetalert2";
import { result } from "lodash";

const Api = {
  init() {
    Vue.use(VueAxios, axios);
    this.setupHeaders();

    Vue.axios.defaults.baseURL = process.env.VUE_APP_URL_API;

    Vue.axios.interceptors.response.use(function (response) {
      store.dispatch("$_error/setErrors", []);
      store.dispatch("$_error/setErrorData", []);
      return response;
    }, this.handleError.bind(this));

    const STORE_KEY_ERROR = "$_error";
    if (!(STORE_KEY_ERROR in store._modules.root._children)) {
      store.registerModule(STORE_KEY_ERROR, storeError);
    }

    const STORE_KEY_REQUEST = "$_request";
    if (!(STORE_KEY_REQUEST in store._modules.root._children)) {
      store.registerModule(STORE_KEY_REQUEST, storeRequest);
    }

    this.addIntercepetRequest();
  },

  async addIntercepetRequest() {
    var numberOfAjaxCAllPending = 0;

    axios.interceptors.request.use(
      async function (config) {
        numberOfAjaxCAllPending++;
        await store.dispatch("$_request/setPending", numberOfAjaxCAllPending);
        return config;
      },
      function (error) {
        return Promise.reject(error);
      }
    );

    axios.interceptors.response.use(
      async function (response) {
        numberOfAjaxCAllPending--;
        await store.dispatch("$_request/setPending", numberOfAjaxCAllPending);

        return response;
      },
      async function (error) {
        numberOfAjaxCAllPending--;
        await store.dispatch("$_request/setPending", numberOfAjaxCAllPending);

        return Promise.reject(error);
      }
    );
  },
  setupHeaders() {
    Vue.axios.defaults.headers.common["Content-Type"] = "application/json";
    Vue.axios.defaults.headers.common["Accept"] = "application/json";
    Vue.axios.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${Jwt.getToken()}`;
    ["get", "post", "put", "patch"].forEach(function (method) {
      Vue.axios.defaults.headers[method]["Content-Type"] = "application/json";
    });
  },
  checkResponse(response) {
    if (!response) {
      return {
        data: "",
        status: 500,
        statusText: "",
      };
    }
    return response;
  },
  async handleError(errRef) {
    if (!errRef.response) {
      return;
    }
    let response = errRef.response;
    let dataResponse = this.checkResponse(response);

    await store.dispatch("$_error/setErrors", []);

    const code = dataResponse.status ? dataResponse.status : 0;
    var errorMsg = "";
    let typeMessage = "warning";
    if (Object.prototype.hasOwnProperty.call(dataResponse.data, "message"))
      errorMsg = dataResponse.data.message;
    switch (code) {
      case 400:
        this.messageError(dataResponse, dataResponse.data.message);
        break;

      case 0:
      case 401:
        if (dataResponse.data.message == "Unauthenticated.") {
          Jwt.destroyToken();
          // window.location =  process.env.VUE_APP_FRONT_MAIN;
          Router.push({ path: "/login" });
        } else {
          this.messageError(
            dataResponse,
            dataResponse.data.message,
            dataResponse.data.title,
            dataResponse.data.type
          );
        }
        break;

      case 404:
        const { error } = dataResponse.data;
        store.dispatch("$_error/setErrors", error);
        store.dispatch("$_error/setErrorData", dataResponse.data);
        this.messageError(null, error, "Atenção!", "warning", null, "orange");
        break;

      case 406:
        let erros = null;
        let bodyMessage = "";
        let messageTitle = "Atenção!";

        store.dispatch("$_error/setErrors", dataResponse);

        if (!dataResponse.data.message) {
          bodyMessage = ["Falha na comunicação com o banco de dados."];
        } else {
          erros = dataResponse.data.error;

          if (typeof erros === "string") {
            bodyMessage = "<p style='text-align:center; line-height: 1.6;'>";
            bodyMessage += erros.length ? erros : dataResponse.data?.message;
          }
          // if (typeof erros === "object") {
          //   bodyMessage = "<p style='text-align:center; line-height: 1.6;'>";
          //   bodyMessage += erros.length ? erros[0] : dataResponse.data?.message;
          // }
          else {
            bodyMessage = "<p style='text-align:start; line-height: 1.6;'>";
            Object.keys(erros).forEach((item, index) => {
              bodyMessage += `${index + 1}º-  ${erros[item]} <br/>`;
            });
          }
          bodyMessage += "</p>";
        }

        this.messageError(
          dataResponse,
          bodyMessage,
          messageTitle,
          (typeMessage = "error")
        );
        break;
      case 500:
        if (errorMsg != "") {
          errorMsg =
            "Ocorreu um erro interno, aguarde um pouco e tente novamente.";
        }
        // console.log(dataResponse);
        this.messageError(
          dataResponse,
          errorMsg,
          "Erro interno do servidor!",
          "error"
        );
        break;
      case 422:
        if (dataResponse) {
          store.dispatch("$_error/setErrors", dataResponse);
        }
        break;
    }
    if (code === 406) {
      return new Promise((resolve, reject) => {
        reject(dataResponse);
      });
    }
  },

  async messageError(
    response,
    message,
    messageTitle,
    messageType,
    iconColor = "red",
    confirmButtonColor = "red"
  ) {
    swal.fire({
      icon: messageType,
      title: messageTitle,
      html: message,
      iconColor: iconColor,
      confirmButtonColor: confirmButtonColor,
    });

    // if (Object.prototype.hasOwnProperty.call(response.data, "status")) {
    //   if (response.data.status === 401) {
    //     Jwt.destroyToken();
    //     Router.push({ name: "login" });
    //   }
    // }
  },

  async query(resource, data) {
    const promiseData = new Promise((resolve) => {
      const result = Vue.axios.get(resource, { params: data });
      resolve(result);
    });
    return promiseData;
  },

  async queryDownload(resource, data) {
    const promiseData = new Promise((resolve) => {
      const result = Vue.axios.get(
        resource,
        { params: data },
        {
          responseType: "blob",
        }
      );
      resolve(result);
    });
    return promiseData;
  },

  async queryDownloadXlsx(resource, data) {
    const promiseData = new Promise((resolve) => {
      Vue.axios({
        method: "get",
        url: resource,
        resource,
        params: data,
        responseType: "arraybuffer",
        headers: {
          Accept:
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        },
      }).then((response) => {
        resolve(response);
      });
    });
    return promiseData;
  },

  async get(resource, slug = "") {
    const promiseData = new Promise((resolve) => {
      const result = Vue.axios.get(`${resource}/${slug}`);
      resolve(result);
    });
    return promiseData;
  },

  async getDownload(resource, slug) {
    const promiseData = new Promise((resolve) => {
      const result = Vue.axios.get(`${resource}/${slug}`, {
        responseType: "blob",
      });
      resolve(result);
    });
    return promiseData;
  },

  async queryId(resource, id, data) {
    const promiseData = new Promise((resolve) => {
      const result = Vue.axios.get(`${resource}/${id}`, { params: data });
      resolve(result);
    });
    return promiseData;
  },

  async post(resource, params) {
    const result = await Vue.axios.post(`${resource}`, JSON.stringify(params));
    return result;
  },

  async postDownload(resource, params) {
    const promiseData = new Promise((resolve) => {
      const result = Vue.axios.post(`${resource}`, JSON.stringify(params), {
        responseType: "blob",
      });
      resolve(result);
    });
    return promiseData;
  },

  async postFormData(resource, params) {
    return new Promise((resolve) => {
      const result = Vue.axios.post(`${resource}`, params, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });
      resolve(result);
    });
  },

  async put(resource, id, params) {
    const route = id ? `${resource}/${id}` : resource;
    const result = await Vue.axios.put(route, JSON.stringify(params));
    return result;
  },

  patch(resource, id, params) {
    if (id) {
      return Vue.axios.patch(`${resource}/${id}`, JSON.stringify(params));
    } else {
      return Vue.axios.patch(`${resource}`, JSON.stringify(params));
    }
  },

  delete(resource, id) {
    return new Promise((resolve) => {
      const result = Vue.axios.delete(`${resource}/${id}`);
      resolve(result);
    });
  },
};

export default Api;
