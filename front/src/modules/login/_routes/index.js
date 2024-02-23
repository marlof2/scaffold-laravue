export default [
  {
    path: "/login",
    name: "login",
    component: () => import("@/modules/login"),
    meta: {
      layout: 'auth'
    }
  },

  {
    path: "/auterarsenhaprimeiroacesso/:id",
    name: "auterarsenhaprimeiroacesso",
    component: () => import("@/modules/users/_components/trocarSenha"),
    meta: {
      layout: 'simple'
    }
  },
];
