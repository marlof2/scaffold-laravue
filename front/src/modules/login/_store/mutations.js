const AUTHENTICATED = (state, authenticated) => {

  state.authenticated = authenticated;
};

const SET_AUTHORIZATION = (state, actualAuthorization) => {
  state.actualAuthorization = actualAuthorization;
};

const PERMISSOES = (state, permissoes) => {
  state.permissoes = permissoes;
};
const USER_ME = (state, me) => {
  state.me = me;
};

export default {
  AUTHENTICATED,
  SET_AUTHORIZATION,
  PERMISSOES,
  USER_ME
};
