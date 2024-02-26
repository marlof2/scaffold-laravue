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
          <v-col cols="12" sm="6" md="3">
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
          <v-col cols="12" sm="6" md="3">
            <TextField
              v-model="form.sobrenome"
              label="Sobrenome"
              :maxlength="50"
              :rules="required"
              required
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="6" md="3">
            <TextField
              v-model="form.cpf"
              label="CPF"
              v-mask="'###.###.###-##'"
              :maxlength="14"
              :rules="required"
              required
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="6" md="3">
            <SelectAutocomplete
              :loading="loadingInput"
              :items="getItemPapel"
              :itemValue="'id'"
              :itemText="'name'"
              :label="'Perfil'"
              v-model="form.profile_id"
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="6" md="3">
            <TextField
              v-model="form.email"
              label="E-mail"
              :maxlength="50"
              :rules="required"
              required
            />
          </v-col>
        </v-row>
        <v-row class="mb-6">
          <v-col cols="12" sm="4" md="4">
            <v-switch
              color="primary"
              label="Trocar a senha no primeiro login ?"
              inset
              v-model="form.primeiro_acesso"
            ></v-switch>
            <span style="font-size: 14px; color: #972c2c"
              >A primeira senha será "12345" e no primeiro <br />
              acesso será possível fazer a trocar da senha.</span
            >
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
import storeProfile from "../../profile/_store";
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
    const STORE_PAPEL = "$_profile";
    if (!(STORE_PAPEL in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PAPEL, storeProfile);
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
    this.breadcrumbs[1].text = "Cadastrar";
    if (this.$route.params.id != undefined) {
      this.breadcrumbs[1].text = "Editar";
      await this.itemById(this.$route.params.id);
    }
    await this.actionPapel({ limit: "-1" });
  },

  computed: {
    ...mapGetters({
      getItemById: "$_user/getItemById",
      getItemPapel: "$_profile/getItems",
    }),

    loadingInput() {
      return this.getItemPapel.length > 0 ? false : true;
    },
  },
  methods: {
    ...mapActions({
      itemById: "$_user/getItemById",
      updateItem: "$_user/updateItem",
      createItem: "$_user/createItem",
      actionPapel: "$_profile/getItems",
    }),
    async save() {
      this.formValidated = await this.$refs.form.validate();
      if (!this.formValidated) {
        return false;
      }

      if (this.$route.params.id != undefined) {
        this.form.id = this.$route.params.id;
        const resp = await this.updateItem(this.form);
        if (resp.status == 200) {
          this.$router.push({ name: "users" });
          Swal.messageToast(this.$strings.msg_alterar, "success");
        }
      } else {
        const resp = await this.createItem(this.form);
        if (resp.status == 201) {
          this.$router.push({ name: "users" });
          Swal.messageToast(this.$strings.msg_adicionar, "success");
        }
      }
    },
    title() {
      this.$route.params.id != undefined ? "Edição de Usuário" : "Novo Usuário";
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
