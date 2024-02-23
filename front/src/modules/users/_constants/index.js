const routeMain = "users";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];

const form = {
  id: null,
  cpf: "",
  name: "",
  sobrenome: "",
  email: "",
  profile_id: "",
  primeiro_acesso: true
};


const permissions = {
  listar: "user_list_all",
  incluir: "user_create",
  alterar: "user_edit",
  excluir: "user_delete",
};

const breadcrumbsIndex = [
  {
    text: "Usuário",
    disabled: false,
    href: "#",
  },
  {
    text: "Listar",
  },
];

const breadcrumbsForm = [
  {
    text: "Usuário",
    disabled: false,
    to: "/users",
    exact: true,
  },
  {
    text: "Visualizar",
  },
];

const breadcrumbsShow = [
  {
    text: "Usuário",
    disabled: false,
    to: "/users",
    exact: true,
  },
  {
    text: "Visualizar",
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
  { text: "CPF", value: "cpf", align: "left" },
  { text: "Email", value: "email", align: "left" },
  { text: "Perfil", value: "profile.name", align: "left" },
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
};
