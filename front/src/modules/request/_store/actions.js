const setPending = async (context, value) => {
  context.commit("STORE_REQUETS_PENDING", value);
};
const showOverlay = async (context, value) => {
  context.commit("STORE_SHOW_OVERLAY", value);
};


export default {
  setPending,
  showOverlay
};
