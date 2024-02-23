const SET_ERRORS = (state, errors) => {
  state.errors = errors;
};

const SET_ERROR_DATA = (state, errorData) => {
  state.errorData = errorData;
};

export default {
  SET_ERRORS,
  SET_ERROR_DATA,
};
