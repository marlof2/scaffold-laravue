const STORE_REQUETS_PENDING = (state, requestsPending) => {
  state.requestsPending = requestsPending;
};

const STORE_SHOW_OVERLAY = (state, showOverlay) => {
  state.showOverlay = showOverlay;
};


export default {
  STORE_REQUETS_PENDING,
  STORE_SHOW_OVERLAY
};
