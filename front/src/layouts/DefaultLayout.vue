<template>
  <div>
    <!-- Navigation -->
    <v-navigation-drawer
      width="280px"
      v-model="drawer"
      app
      floating
      class="elevation-1"
      :right="$vuetify.rtl"
      :light="menuTheme === 'light'"
      :dark="menuTheme === 'dark'"
    >
      <!-- Navigation menu info -->
      <template v-slot:prepend>
        <div class="pa-2">
          <div class="title font-weight-bold text-uppercase primary--text">
            {{ product.name }}
          </div>
          <div class="overline grey--text">{{ product.version }}</div>
        </div>
      </template>

      <!-- Navigation menu -->
      <main-menu :menu="navigation.menu" />
    </v-navigation-drawer>

    <!-- Toolbar -->
    <v-app-bar
      app
      :color="isToolbarDetached ? 'surface' : undefined"
      :flat="isToolbarDetached"
      :light="toolbarTheme === 'light'"
      :dark="toolbarTheme === 'dark'"
    >
      <v-card
        class="flex-grow-1 d-flex"
        :class="[isToolbarDetached ? 'pa-1 mt-3 mx-1' : 'pa-0 ma-0']"
        :flat="!isToolbarDetached"
      >
        <div class="d-flex flex-grow-1 align-center">
          <div class="d-flex flex-grow-1 align-center">
            <v-app-bar-nav-icon
              @click.stop="drawer = !drawer"
            ></v-app-bar-nav-icon>

            <v-spacer class="d-none d-lg-block"></v-spacer>

            <v-spacer class="d-block d-sm-none"></v-spacer>

            <v-spacer class="d-lg-block"></v-spacer>

            <div style="font-size: 13px" class="mr-3">
              <div>
                <strong>{{ saudacao() }} </strong>
                {{ dadosUser ? dadosUser.name : "carregando." }}
              </div>
              <div>
                <strong>Perfil</strong>:
                {{ dadosUser ? dadosUser.profile.name : "carregando." }}
              </div>
            </div>

            <toolbar-user />
          </div>
        </div>
      </v-card>
    </v-app-bar>

    <v-main>
      <v-container class="fill-height" :fluid="!isContentBoxed">
        <v-layout>
          <slot></slot>
        </v-layout>
      </v-container>

      <v-footer app inset>
        <v-spacer></v-spacer>
        <div class="overline">
          SGC - Todos os direitos reservados
          <a
            class="text-decoration-none"
            href="https://www.linkedin.com/in/marlo-marques-a21b79142/"
            target="_blank"
          >
            By @Marlo Marques</a
          >
        </div>
      </v-footer>
    </v-main>
  </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from "vuex";

// navigation menu configurations
import config from "../configs";

import MainMenu from "../components/navigation/MainMenu";
import ToolbarUser from "../components/toolbar/ToolbarUser.vue";
import store from "../modules/login/_store";
import moment from "moment";

export default {
  components: {
    MainMenu,
    ToolbarUser,
  },
  data() {
    return {
      drawer: null,
      dadosUser: null,
      navigation: config.navigation,
    };
  },
  beforeCreate() {
    const STORE_LOGIN = "$_login";
    if (!(STORE_LOGIN in this.$store._modules.root._children))
      this.$store.registerModule(STORE_LOGIN, store);
  },
  async mounted() {
    await this.dataUser();
  },
  computed: {
    ...mapState("app", [
      "product",
      "isContentBoxed",
      "menuTheme",
      "toolbarTheme",
      "isToolbarDetached",
    ]),
    ...mapGetters({
      geDataUser: "$_login/getMe",
    }),
  },
  methods: {
    ...mapActions({
      dataUser: "$_login/me",
    }),

    saudacao() {
      const now = moment();

      if (now.hour() < 12) {
        return "Bom dia, ";
      } else if (now.hour() < 18) {
        return "Boa tarde, ";
      } else {
        return "Boa noite, ";
      }
    },
  },
  watch: {
    geDataUser(value) {
      this.dadosUser = value.user;
      // window.localStorage.setItem("permissoes", "");
      // window.localStorage.setItem("permissoes", value.abilities);
    },
  },
};
</script>

<style scoped>
.buy-button {
  box-shadow: 1px 1px 18px #ee44aa;
}
</style>
