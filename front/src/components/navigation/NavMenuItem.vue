<template>
  <div v-if="permissaoMenu === menuItem.codigoPemissao">
    <v-list-item
      v-if="!menuItem.items"
      :input-value="menuItem.value"
      :to="menuItem.link"
      :exact="menuItem.exact"
      :disabled="menuItem.disabled"
      active-class="primary--text"
      link
    >
      <v-list-item-icon>
        <v-icon :small="small" :class="{ 'grey--text': menuItem.disabled }">
          {{ menuItem.icon || "mdi-circle-medium" }}
        </v-icon>
      </v-list-item-icon>
      <v-list-item-content>
        <v-list-item-title>
          {{ menuItem.key ? $t(menuItem.key) : menuItem.text }}
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-list-group
      v-else
      :value="menuItem.regex ? menuItem.regex.test($route.path) : false"
      :disabled="menuItem.disabled"
      :sub-group="subgroup"
      :to="menuItem.link"
      link
    >
      <template v-slot:activator>
        <v-list-item-icon v-if="!subgroup">
          <v-icon :small="small">{{ menuItem.icon || "mdi-circle-medium"}}</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>
            {{ menuItem.key ? $t(menuItem.key) : menuItem.text }}
          </v-list-item-title>
        </v-list-item-content>
      </template>

      <slot></slot>
    </v-list-group>
  </div>
</template>

<script>
/*
|---------------------------------------------------------------------
| Navigation Menu Item Component
|---------------------------------------------------------------------
|
| Navigation items for the NavMenu component
|
*/
import { mapGetters } from "vuex";
export default {
  props: {
    menuItem: {
      type: Object,
      default: () => {},
    },
    subgroup: {
      type: Boolean,
      default: false,
    },
    small: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      permissaoMenu: null,
    };
  },
  computed: {
    ...mapGetters({
      getPermissoes: "$_login/getPermissoes",
    }),
  },
  watch: {
    getPermissoes(value) {
      if (
        value.codigo_permissao != null &&
        this.menuItem.codigoPemissao != null
      ) {
        value.codigo_permissao.forEach((val) => {
          if (val == this.menuItem.codigoPemissao) {
            this.permissaoMenu = val;
          }
        });
      }
    },
  },
};
</script>
