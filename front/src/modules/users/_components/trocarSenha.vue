<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1 ml-5">
          {{ "Alterar Senha" }}
        </div>
        <Breadcrumbs
          v-if="routeAlterarSenha() == 'auterarsenhaprimeiroacesso'"
          :breadcrumbs="breadcrumbs"
        />
      </div>
    </div>
    <v-card class="pa-2 ma-5">
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-row>
          <v-col cols="12" sm="3" :md="routeAlterarSenha() ? 4 : 3">
            <TextField
              v-model="form.senhaAntiga"
              label="Senha antiga"
              :maxlength="50"
              :rules="required"
              required
              :type="'password'"
            />
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12" sm="3" :md="routeAlterarSenha() ? 4 : 3">
            <TextField
              v-model="form.senhaNova"
              label="Nova senha"
              :maxlength="50"
              :rules="required"
              required
              :type="'password'"
            />
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12" sm="3" :md="routeAlterarSenha() ? 4 : 3">
            <TextField
              v-model="form.confirmaSenhaNova"
              label="Confirmar nova senha"
              :maxlength="50"
              :rules="required"
              required
              :type="'password'"
            />
          </v-col>
        </v-row>

        <v-row>
          <v-col>
            <v-card-actions>
              <FormButton
                v-if="$router.name == 'auterarsenhaprimeiroacesso'"
                :isBack="true"
                :label="this.$strings.btn_voltar"
                dark
                @click="$router.go(-1)"
                small
              />
              <FormButton
                :label="this.$strings.btn_salvar"
                dark
                @click="save"
                small
              />
            </v-card-actions>
          </v-col>
        </v-row>
      </v-form>
    </v-card>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import store from "../_store";
import FormButton from "../../../components/UI/FormButton.vue";
import Breadcrumbs from "../../../components/UI/Breadcrumbs.vue";
import { constants } from "../_constants";
import TextField from "../../../components/Inputs/TextField.vue";

export default {
  name: "userForm",
  components: {
    FormButton,
    Breadcrumbs,
    TextField,
  },
  beforeCreate() {
    const STORE_USER = "$_user";
    if (!(STORE_USER in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER, store);
  },
  data() {
    return {
      valid: true,
      formValidated: true,
      required: [(v) => !!v || "Campo obrigatório"],
      form: {
        senhaAntiga: null,
        senhaNova: null,
        confirmaSenhaNova: null,
      },
      breadcrumbs: [...constants.breadcrumbsForm],
    };
  },

  async mounted() {
    this.breadcrumbs[1].text = "Alterar Senha";
  },

  computed: {
    ...mapGetters({}),
  },
  methods: {
    ...mapActions({
      alterarSenha: "$_user/alterarSenha",
    }),
    routeAlterarSenha() {
      return this.$route.name == "auterarsenhaprimeiroacesso" ? true : false;
    },
    async save() {
      this.formValidated = await this.$refs.form.validate();
      if (!this.formValidated) {
        return false;
      }

      this.form.id = this.$route.params.id;
      const resp = await this.alterarSenha(this.form);
      if (resp.status == 200) {
        this.$router.push({ name: "pagina-inicial" });
        Swal.messageToast(this.$strings.msg_alterar, "success");
      }
    },
  },
  watch: {},
};
</script>

<style lang="scss" scoped></style>
