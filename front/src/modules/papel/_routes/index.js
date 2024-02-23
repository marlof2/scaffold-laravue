export default [
  {
    path: "/papel",
    name: "papel",
    component: () => import("@/modules/papel"),
  },
  {
    path: "/papel/cadastrar",
    name: "papel-cadastrar",
    component: () => import("@/modules/papel/_components/form"),
  },
  {
    path: "/papel/editar/:id",
    name: "papel-editar",
    component: () => import("@/modules/papel/_components/form"),
  },
  {
    path: "/papel/visualizar/:id",
    name: "papel-visualizar",
    component: () => import("@/modules/papel/_components/show"),
  },
  {
    path: "/papel/gerenciar-permissoes/:id",
    name: "papel-gerenciar-permissoes",
    component: () => import("@/modules/papel/_components/gerenciarPermissoes"),
  },
];
