import menuPages from './menus/pages.menu'

export default {
  // main navigation - side menu
  menu: [{
    text: '',
    key: '',
    items: [
      { icon: 'mdi-view-dashboard-outline', key: 'menu.dashboard', text: 'Dashboard', link: '/dashboard/analytics', codigoPemissao: null }
    ]
  },
  {
    text: 'ADMINISTRATIVO',
    items: [
      { icon: 'mdi-airplane-landing', key: 'menu.landingPage', text: 'Landing Page', link: '/landing',codigoPemissao: null },
      { icon: 'mdi-cash-usd-outline', key: 'menu.pricingPage', text: 'Pricing Page', link: '/landing/pricing',codigoPemissao: null }
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
