<template>
  <div class="d-flex flex-grow-1 flex-column">
    <Overlay v-if="requestPending" :overlay="overlay" />
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">
          {{ "Gerenciar Permissões de Perfil" }}
        </div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-4">
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-row class="mb-4">
          <v-col cols="12" sm="4" md="4">
            <v-switch
              color="primary"
              :label="title"
              :value="marcaDesmarca"
              inset
              v-model="marcaDesmarca"
              @change="marcarTodos(marcaDesmarca)"
            ></v-switch>
          </v-col>
        </v-row>
        <h3 class="text-center mb-3">Usuário</h3>
        <v-row>
          <v-col
            v-for="(permissao, i) in allAbilities['usuario']"
            :key="i"
            cols="12"
            sm="4"
            md="4"
          >
            <v-switch
              color="primary"
              :label="permissao.name"
              :value="permissao.id"
              inset
              v-model="form.permissao"
            ></v-switch>
          </v-col>
        </v-row>
        <hr />
        <h3 class="mt-3 text-center mb-3">Perfil</h3>
        <v-row>
          <v-col
            v-for="(permissao, i) in allAbilities['perfil']"
            :key="i"
            cols="12"
            sm="4"
            md="4"
          >
            <v-switch
              color="primary"
              :label="permissao.name"
              :value="permissao.id"
              inset
              v-model="form.permissao"
            ></v-switch>
          </v-col>
        </v-row>
        <v-row class="mt-2">
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

import storeRequest from "@/modules/request/_store";
import storePermissao from "../../abilities/_store";
import store from "../../profile/_store";
import storeUser from "../../users/_store";
import FormButton from "../../../components/UI/FormButton.vue";
import Breadcrumbs from "../../../components/UI/Breadcrumbs.vue";
import { constants } from "../../profile/_constants";
import TextField from "../../../components/Inputs/TextField.vue";
import SelectAutocomplete from "../../../components/Inputs/SelectAutocomplete.vue";
import SwitchButton from "../../../components/Inputs/SwitchButton.vue";
import Checkbox from "../../../components/Inputs/Checkbox.vue";
import Overlay from "../../../components/UI/Overlay.vue";
import _ from "lodash";

export default {
  name: "userForm",
  components: {
    FormButton,
    Breadcrumbs,
    TextField,
    SelectAutocomplete,
    SwitchButton,
    Checkbox,
    Overlay,
  },
  beforeCreate() {
    const STORE_PERMISSAO = "$_abilities";
    if (!(STORE_PERMISSAO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PERMISSAO, storePermissao);
    const STORE_PAPEL = "$_profile";
    if (!(STORE_PAPEL in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PAPEL, store);
    const STORE_USER = "$_user";
    if (!(STORE_USER in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER, storeUser);
    const STORE_REQUEST = "$_request";
    if (!(STORE_REQUEST in this.$store._modules.root._children))
      this.$store.registerModule(STORE_REQUEST, storeRequest);
  },
  data() {
    return {
      overlay: true,
      valid: true,
      formValidated: true,
      required: [(v) => !!v || "Campo obrigatório"],
      form: {
        permissao: [],
        profile_id: null,
      },
      breadcrumbs: [...constants.breadcrumbsGerenciarPermissoes],
      marcaDesmarca: false,
      title: "",
      allAbilities: [],
    };
  },

  async created() {
    this.form.profile_id = this.$route.params.id;
    this.tituloMarcarEDesmarcar("Marcar");
    this.breadcrumbs[1].text;
    await this.getAbilityByProfile(this.$route.params.id);
    await this.getAllAbilites();
  },

  computed: {
    ...mapGetters({
      getItemAllAbilites: "$_abilities/getItems",
      getItemAbilityByProfile: "$_profile/getAbilityByProfile",
      requestPending: "$_request/requestsPending",
    }),
  },
  methods: {
    ...mapActions({
      getAllAbilites: "$_abilities/getItems",
      getAbilityByProfile: "$_profile/getAbilityByProfile",
      addPermissions: "$_profile/addPermissions",
    }),
    tituloMarcarEDesmarcar(title) {
      this.title = `${title} Todos.`;
    },
    marcarTodos(marcaDesmarca) {
      if (marcaDesmarca) {
        this.tituloMarcarEDesmarcar("Desmarcar");
        this.form.permissao = [];
        this.getItemAllAbilites.forEach((_permissao) => {
          this.form.permissao.push(_permissao.id);
        });
      } else {
        this.form.permissao = [];
        this.tituloMarcarEDesmarcar("Marcar");
      }
      this.marcaDesmarca = false;
    },
    async save() {
      this.formValidated = await this.$refs.form.validate();
      if (!this.formValidated) {
        return false;
      }
      const resp = await this.addPermissions(this.form);
      if (resp.status == 201) {
        this.$router.push({ name: "papel" });
        Swal.messageToast(this.$strings.msg_salvo, "success");
      }
    },
  },
  watch: {
    getItemAbilityByProfile(item) {
      if (item.abilities) {
        if (item.abilities.length >= 1) {
          item.abilities.forEach((abilities) => {
            this.form.permissao.push(abilities);
          });
        }
      }
    },
    getItemAllAbilites(item) {
      this.allAbilities = _.groupBy(item, "functionality");
    },
  },
};
</script>

<style lang="scss" scoped></style>
