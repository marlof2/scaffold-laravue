export default [
  {
    path: "/users",
    name: "users",
    component: () => import("@/modules/users"),
  },
  {
    path: "/users/cadastrar",
    name: "users-cadastrar",
    component: () => import("@/modules/users/_components/form"),
  },
  {
    path: "/users/editar/:id",
    name: "users-editar",
    component: () => import("@/modules/users/_components/form"),
  },
  {
    path: "/users/visualizar/:id",
    name: "users-visualizar",
    component: () => import("@/modules/users/_components/show"),
  },
  {
    path: "/users/perfil/:id",
    name: "users-pefil",
    component: () => import("@/modules/users/_components/perfil"),
  },
  {
    path: "/users/trocar-senha/:id",
    name: "users-trocar-senha",
    component: () => import("@/modules/users/_components/trocarSenha"),
  },
];
