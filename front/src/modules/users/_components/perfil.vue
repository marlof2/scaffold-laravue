<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">
          {{ title() }}
        </div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2">
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-row>
          <v-col cols="12" sm="3" md="3">
            <TextField
              v-model="form.name"
              label="Nome"
              :maxlength="50"
              :rules="required"
              required
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="3" md="3">
            <TextField
              v-model="form.email"
              label="E-mail"
              :maxlength="50"
              :rules="required"
              required
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-card-actions>
              <FormButton
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
import SelectAutocomplete from "../../../components/Inputs/SelectAutocomplete.vue";

export default {
  name: "userForm",
  components: {
    FormButton,
    Breadcrumbs,
    TextField,
    SelectAutocomplete,
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
      form: { ...constants.form },
      breadcrumbs: [...constants.breadcrumbsForm],
    };
  },

  async mounted() {
    this.breadcrumbs[1].text = "Editar";
    await this.itemById(this.$route.params.id);
  },

  computed: {
    ...mapGetters({
      getItemById: "$_user/getItemById",
    }),
  },
  methods: {
    ...mapActions({
      itemById: "$_user/getItemById",
      updatePerfil: "$_user/updatePerfil",
    }),
    async save() {
      this.formValidated = await this.$refs.form.validate();
      if (!this.formValidated) {
        return false;
      }
      this.form.id = this.$route.params.id;
      const resp = await this.updatePerfil(this.form);
      if (resp.status == 200) {
          this.$router.push({ name: "pagina-inicial" });
          Swal.messageToast(this.$strings.msg_alterar, "success");
      }
    },
    title() {
     return this.$route.params.id != undefined ? "Edição de Usuário" : "Novo Usuário";
    },
  },
  watch: {
    getItemById(item) {
      if (this.$route.params.id != undefined) {
        let keys = Object.keys(this.form);
        keys.forEach((i) => {
          this.form[i] = item[i];
        });
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
