import menuPages from './menus/pages.menu'

export default {
  // main navigation - side menu
  menu: [{
    text: '',
    key: '',
    items: [
      { icon: 'mdi-view-dashboard-outline', key: 'Início', text: 'Início', link: '/pagina-inicial', codigoPemissao: null }
    ]
  },
  {
    text: 'ADMINISTRATIVO',
    items: [
      { icon: 'mdi-account-supervisor-outline',
       key: 'Usuários do Sistema',
       text: 'Landing Page',
       link: '/users',
       codigoPemissao: null },
      {
        icon: "mdi-account-supervisor-circle",
        text: "Perfis e Permissões",
        link: "/papel",
        codigoPemissao: null
      },
    ]
  },
    // {
    //   text: 'Pagina',
    //   key: 'menu.pages',
    //   items: menuPages
    // },
    // {
    //   text: 'Other',
    //   key: 'menu.others',
    //   items: [
    //     { icon: 'mdi-file-outline', key: 'menu.blank', text: 'Blank Page', link: '/blank' },
    //     { key: 'menu.levels', text: 'Menu Levels',
    //       items: [
    //         { text: 'Menu Levels 2.1' },
    //         { text: 'Menu Levels 2.2',
    //           items: [
    //             { text: 'Menu Levels 3.1' },
    //             { text: 'Menu Levels 3.2' }
    //           ]
    //         }
    //       ]
    //     },
    //     { key: 'menu.disabled', text: 'Menu Disabled', disabled: true }
    //   ]
    // }
  ],


}
