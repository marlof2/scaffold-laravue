<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Usuários</div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2 elevation-3">
      <v-row class="pl-2">
        <v-col cols="12" sm="6" md="6" v-permissions="permissions.adicionar">
          <Button
            class="mb-1"
            :nameIcon="'mdi-plus'"
            :color="'primary'"
            :onClick="() => $router.push({ name: 'users-cadastrar' })"
            :label="'Adicionar'"
            :block="this.$vuetify.breakpoint.name == 'xs'"
          />
        </v-col>
        <v-col cols="12" sm="6" md="6">
          <v-text-field
            v-model="buscar"
            append-icon="mdi-magnify"
            @click:append="search"
            @keyup.enter="search"
            hide-details
            dense
            outlined
            clearable
            placeholder="Buscar"
          ></v-text-field>
        </v-col>
      </v-row>

      <DataTableGeneric
        :headersProp="headers"
        :dataProp="items"
        :lastPageProp="paginate.lastPage"
        :pageProp="paginate.page"
        :itemsPerPageProp="paginate.perPages"
        :colunmCustom="['cpf', 'acao']"
        @handlePageChange="handlePageChange"
        :permissions="permissions"
      >
        <template v-slot:cpf="{ item }">
          <copy-label :text="item.cpf | cpf" />
        </template>

        <template v-slot:acao="{ item }">
          <IconButton
            v-permissions="permissions.alterar"
            :onClick="() => editUser(item)"
            :name="'mdi-square-edit-outline'"
            :size="22"
            :tooltipName="'Editar'"
            :btnColor="'blue'"
          />
          <IconButton
            v-permissions="permissions.excluir"
            :onClick="() => deletePerfil(item)"
            :name="'mdi-trash-can-outline'"
            :size="22"
            :tooltipName="'Deletar'"
            :btnColor="'#be5b59'"
          />
        </template>
      </DataTableGeneric>
    </v-card>
  </div>
</template>
<script>
import store from "./_store";
import Breadcrumbs from "../../components/UI/Breadcrumbs.vue";
import { mapActions, mapGetters } from "vuex";
import { constants } from "./_constants";
import FormButton from "../../components/UI/FormButton.vue";
import TextField from "../../components/Inputs/TextField.vue";
import DataTableGeneric from "../../components/UI/DataTableGeneric.vue";
import HeaderGeneric from "../../components/UI/HeaderGeneric.vue";
import Button from "../../components/UI/Button.vue";
import IconButton from "../../components/UI/IconButton.vue";
import Api from "../../api/index";
import storeRequest from "@/modules/request/_store";
import CopyLabel from "../../components/common/CopyLabel.vue";

export default {
  name: "userModule",
  components: {
    Breadcrumbs,
    TextField,
    FormButton,
    DataTableGeneric,
    HeaderGeneric,
    Button,
    IconButton,
    CopyLabel,
  },
  data() {
    return {
      buscar: null,
      breadcrumbs: [...constants.breadcrumbsIndex],
      items: [],
      paginate: {
        ...constants.paginate,
      },
      headers: [...constants.headers],
      permissions: { ...constants.permissions },
      filter: {},
      drawer: null,
    };
  },
  async mounted() {
    // this.ActionShowOverlay(true);
    await this.search();
  },
  methods: {
    ...mapActions({
      users: "$_user/getItems",
      ActionShowOverlay: "$_request/showOverlay",
    }),
    async search() {
      await this.users({
        search: this.buscar,
        page: this.paginate.page,
        per_page: this.paginate.perPage,
      });
    },
    async handlePageChange(paginate) {
      const { per_page, page } = paginate;
      let data = {
        per_page,
        page,
        search: this.buscar,
      };
      await this.users(data);
    },
    editUser(item) {
      return this.$router.push({ path: `users/editar/${item.id}` });
    },
    deletePerfil(item) {
      const pathRoute = this.$router.currentRoute.name;
      this.$swal
        .fire({
          title: `Tem certeza que deseja apagar?`,
          text: "Esta ação não poderá ser desfeita!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#ff0000",
          confirmButtonText: "Excluir",
          cancelButtonText: "Cancelar",
        })
        .then(async (result) => {
          if (result.isConfirmed) {
            const response = await Api.delete(
              `${process.env.VUE_APP_URL_API}${pathRoute}`,
              item.id
            );
            if (!response) return false;
            await this.search();
            this.$swal.fire({
              title: "Deletado com Sucesso!",
              icon: "success",
            });
          }
        });
    },
  },
  beforeCreate() {
    const STORE_USER = "$_user";
    if (!(STORE_USER in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER, store);
    const STORE_REQUEST = "$_request";
    if (!(STORE_REQUEST in this.$store._modules.root._children))
      this.$store.registerModule(STORE_REQUEST, storeRequest);
  },
  computed: {
    ...mapGetters({
      getItems: "$_user/getItems",
      showOverlay: "$_request/showOverlay",
    }),
  },
  watch: {
    getItems(value) {
      const resp = value;
      this.items = resp.data;

      this.items.map((el) => {
        el.name = el.name + " " + el.sobrenome;
      });
      this.paginate.totalPages = resp.total;
      this.paginate.page = resp.current_page;
      this.paginate.lastPage = resp.last_page;
    },
  },
};
</script>
<style lang="scss" scoped></style>
