const routeMain = "profiles";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];
state[`permissoes`] = [];

const form = {
  id: '',
  name: "",
  descricao: "",
};

const permissions = {
  listar: "profile_list",
  listarAbilitiByProfile: "profile_list_ability",
  incluir: "profile_inset",
  alterar: "profile_edit",
  excluir: "profile_delete",
};

const breadcrumbsIndex = [
  {
    text: "Perfil",
    disabled: false,
    href: "#",
  },
  {
    text: "Listar",
  },
];

const breadcrumbsForm = [
  {
    text: "Perfil",
    disabled: false,
    to: "/papel",
    exact: true,
  },
  {
    text: "Visualizar",
  },
];

const breadcrumbsShow = [
  {
    text: "Perfil",
    disabled: false,
    to: "/papel",
    exact: true,
  },
  {
    text: "Visualizar",
  },
];

const breadcrumbsGerenciarPermissoes = [
  {
    text: "Usuário",
    disabled: false,
    to: "/users",
    exact: true,
  },
  {
    text: "Gerenciar",
  },
];

const paginate = {
  totalPages: 0,
  page: 1,
  lastPage: null,
  perPages: 15,
};

const headers = [
  { text: "Nome", value: "name", align: "left" },
  { text: "Descricão", value: "descricao", align: "left" },
  { text: "Ação", value: "acao", align: "right" },
];

export const constants = {
  routeMain,
  state,
  form,
  breadcrumbsIndex,
  breadcrumbsForm,
  breadcrumbsShow,
  paginate,
  headers,
  permissions,
  breadcrumbsGerenciarPermissoes
};
