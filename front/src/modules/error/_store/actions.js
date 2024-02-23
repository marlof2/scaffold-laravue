const setErrors = async (context, errors) => {
  context.commit("SET_ERRORS", errors);
};

const destroyErrors = async (context) => {
  context.commit("SET_ERRORS", []);
};

const setErrorData = async (context, errorData) => {
  context.commit("SET_ERROR_DATA", errorData);
};

const destroyErrorData = async (context) => {
  context.commit("SET_ERROR_DATA", []);
};

export default {
  setErrors,
  destroyErrors,
  setErrorData,
  destroyErrorData,
};
