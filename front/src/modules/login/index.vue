<template>
  <div>
    <v-card class="text-center pa-1">
      <!-- <img
        class="image-logo"
        height="100"
        width="100"
        src="../../../public/images/logo.jpeg"
      /> -->
      <v-card-title class="justify-center display-1 mb-2"
        >BEM VINDO</v-card-title
      >
      <v-card-subtitle>FAÇA LOGIN PARA INICIAR SUA SESSÃO</v-card-subtitle>

      <!-- sign in form -->
      <v-card-text>
        <v-form ref="form" v-model="isFormValid" lazy-validation>
          <v-text-field
            v-model="form.cpf"
            :rules="[rules.required]"
            :validate-on-blur="false"
            :error="error"
            label="CPF"
            name="email"
            outlined
            v-mask="'###.###.###-##'"
            @keyup.enter="submit"
            @change="resetErrors"
          ></v-text-field>

          <v-text-field
            v-model="form.password"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.required]"
            :type="showPassword ? 'text' : 'password'"
            :error="error"
            :error-messages="errorMessages"
            :label="$t('login.password')"
            name="password"
            outlined
            @change="resetErrors"
            @keyup.enter="submit"
            @click:append="showPassword = !showPassword"
          ></v-text-field>

          <v-btn
            :loading="isLoading"
            :disabled="isSignInDisabled"
            block
            x-large
            color="primary"
            @click="submit"
            >Entrar</v-btn
          >

          <div class="mt-5">
            <router-link to="/auth/forgot-password">
              {{ $t("login.forgot") }}
            </router-link>
          </div>
        </v-form>
      </v-card-text>
    </v-card>

    <div class="text-center mt-6">
      {{ $t("login.noaccount") }}
      <router-link to="/auth/signup" class="font-weight-bold">
        {{ $t("login.create") }}
      </router-link>
    </div>
  </div>
</template>

<script>
import store from "./_store";
import { mapActions, mapGetters } from "vuex";
import seguranca from "../../seguranca/index";


export default {
  data() {
    return {
      // sign in buttons
      isSignInDisabled: false,
      isLoading: false,

      // form
      isFormValid: true,
      form: {
        cpf: "03296244581",
        password: "123",
      },

      // form error
      error: false,
      errorMessages: "",

      // show password field
      showPassword: false,

      // input rules
      rules: {
        required: (value) => (value && Boolean(value)) || "Campo obrigatório",
      },
    };
  },
  async mounted() {
    // console.log(
    //   "HELLO DEV, WELCOME TO MY SYSTEM. MY CONTACT IS marlosilva.f2@gmail.com"
    // );
  },
  methods: {
    ...mapActions({
      login: "$_login/authenticate",
      me: "$_login/me",
      permissoes: "$_login/permissoes",
    }),
    async submit() {
      if (this.$refs.form.validate()) {
        // this.isLoading = true;
        this.isSignInDisabled = true;
        await this.login(this.form);
        const result = this.authenticate;

        if (result.token) {
          await this.me();
          const getDataUser = this.getMe;

          window.localStorage.setItem("user_id", getDataUser.user.id);
          window.localStorage.setItem("permissoes", getDataUser.abilities);

          if (getDataUser.user.primeiro_acesso) {
            this.$router.push({
              path: `/auterarsenhaprimeiroacesso/${result.user.id}`,
            });
          } else {
            this.$router.push("pagina-inicial");
          }

          this.$router.push("pagina-inicial");
        } else {
          this.isSignInDisabled = false;
          this.isLoading = false;
        }
      }
    },
    resetErrors() {
      this.error = false;
      this.errorMessages = "";
    },
  },
  computed: {
    ...mapGetters({
      authenticate: "$_login/authenticated",
      getPermissoes: "$_login/getPermissoes",
      getMe: "$_login/getMe",
    }),
  },
  beforeCreate() {
    const STORE_LOGIN = "$_login";
    if (!(STORE_LOGIN in this.$store._modules.root._children))
      this.$store.registerModule(STORE_LOGIN, store);
  },
};
</script>
<style scoped>
.image-logo {
  margin-top: 20px;
  width: 150px;
  object-fit: contain;
}
</style>
