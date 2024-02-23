export default [
  {
    icon: 'mdi-file-lock-outline', key: 'menu.auth', text: 'Auth Pages', regex: /^\/auth/, codigoPemissao: null,
    items: [
      { icon: 'mdi-file-outline', key: 'menu.authLogin', text: 'Signin / Login', link: '/auth/signin', codigoPemissao: null },
      { icon: 'mdi-file-outline', key: 'menu.authRegister', text: 'Signup / Register', link: '/auth/signup', codigoPemissao: null },
      { icon: 'mdi-file-outline', key: 'menu.authVerify', text: 'Verify Email', link: '/auth/verify-email', codigoPemissao: null },
      { icon: 'mdi-file-outline', key: 'menu.authForgot', text: 'Forgot Password', link: '/auth/forgot-password', codigoPemissao: null },
      { icon: 'mdi-file-outline', key: 'menu.authReset', text: 'Reset Password', link: '/auth/reset-password', codigoPemissao: null }
    ]
  },
  {
    icon: 'mdi-file-cancel-outline', key: 'menu.errorPages', text: 'Error Pages', regex: /^\/error/,codigoPemissao: null,
    items: [
      { icon: 'mdi-file-outline', key: 'menu.errorNotFound', text: 'Not Found / 404', link: '/error/not-found', codigoPemissao: null },
      { icon: 'mdi-file-outline', key: 'menu.errorUnexpected', text: 'Unexpected / 500', link: '/error/unexpected',  codigoPemissao: null }
    ]
  },
  {
    icon: 'mdi-file-cog-outline', key: 'menu.utilityPages', text: 'Utility Pages', regex: /^\/utility/, codigoPemissao: null,
    items: [
      { icon: 'mdi-file-outline', key: 'menu.utilityMaintenance', text: 'Maintenance', link: '/utility/maintenance', codigoPemissao: null },
      { icon: 'mdi-file-outline', key: 'menu.utilitySoon', text: 'Coming Soon', link: '/utility/coming-soon', codigoPemissao: null },
      { icon: 'mdi-file-outline', key: 'menu.utilityHelp', text: 'FAQs / Help', link: '/utility/help', codigoPemissao: null }
    ]
  }
]
