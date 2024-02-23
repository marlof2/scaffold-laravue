<template>
  <v-menu offset-y left transition="slide-y-transition">
    <template v-slot:activator="{ on }">
      <v-btn icon class="elevation-2" v-on="on">
        <v-badge
          color="success"
          dot
          bordered
          offset-x="10"
          offset-y="10"
        >
          <v-avatar size="40">
            <v-img src="/images/avatars/avatar1.svg"></v-img>
          </v-avatar>
        </v-badge>
      </v-btn>
    </template>

    <!-- user menu list -->
    <v-list dense nav>
      <!-- <v-list-item link :to="perfil()">
        <v-list-item-icon>
          <v-icon small>mdi-account-box-outline</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Perfil</v-list-item-title>
        </v-list-item-content>
      </v-list-item> -->

      <!-- <v-divider class="my-1"></v-divider> -->

      <v-list-item link :to="trocarSenha()">
        <v-list-item-icon>
          <v-icon small>mdi-lock-reset</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Trocar Senha</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-divider class="my-1"></v-divider>

      <v-list-item @click="sair()">
        <v-list-item-icon>
          <v-icon small>mdi-logout-variant</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Sair</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import config from "../../configs";
import store from "../../modules/login/_store";
import { mapActions, mapGetters } from "vuex";

/*
|---------------------------------------------------------------------
| Toolbar User Component
|---------------------------------------------------------------------
|
| Quickmenu for user menu shortcuts on the toolbar
|
*/
export default {
  data() {
    return {
      menu: config.toolbar.user
    }
  },
  async mounted() {},
  methods: {
    ...mapActions({
      logout: "$_login/logout",
    }),
    async sair() {
      const { status } = await this.logout();
      if (status) {
        router.push({ name: "autenticar" });
      }
    },
    // perfil() {
    //   return `/users/perfil/${window.localStorage.getItem("user_id")}`;
    // },
    trocarSenha() {
        return `/users/trocar-senha/${window.localStorage.getItem("user_id")}`
    },
  },
  computed: {
    ...mapGetters({}),
  },
  beforeCreate() {
    const STORE_LOGIN = "$_login";
    if (!(STORE_LOGIN in this.$store._modules.root._children))
      this.$store.registerModule(STORE_LOGIN, store);
  },
}
</script>
