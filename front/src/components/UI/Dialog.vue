<template>
  <v-dialog
    style="z-index: 20001"
    v-model="localValue"
    persistent
    :max-width="maxWidth"
  >
    <v-card>
      <v-toolbar class="elevation-1">
        <v-toolbar-items class="flex-toolbar-dialog">
          <v-toolbar-title class="font-weight-bold"
            >{{ title }}
          </v-toolbar-title>
          <v-icon @click="closeClick">mdi-close</v-icon>
        </v-toolbar-items>
      </v-toolbar>
      <v-container>
        <slot></slot>
      </v-container>
      <v-card-actions>
        <v-spacer></v-spacer>
        <FormButton
          v-if="showBtnCancel"
          :small="true"
          dark
          :label="labelBtnCancel"
          @click="closeClick"
          :background="'#b0b0b0'"
        />
        <FormButton
          v-if="!isDelete && showBtnSave"
          :dark="dark"
          :small="true"
          :label="labelBtnSave"
          @click="saveClick"
          :disabled="disabledBtnSave"
        />
        <FormButton
          v-if="isDelete"
          dark
          :small="true"
          :label="'Excluir'"
          @click="deleteClick"
          :background="'#be5b59'"
        />
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import FormButton from "./FormButton.vue";
export default {
  components: {
    FormButton,
  },
  props: {
    value: {
      type: Boolean,
      default: false,
    },
    maxWidth: {
      type: [String, Number],
      default: "60%",
    },
    title: {
      type: String,
      default: "",
    },
    labelBtnCancel: {
      type: String,
      default: "Cancelar",
    },
    labelBtnSave: {
      type: String,
      default: "Salvar",
    },
    isDelete: {
      type: Boolean,
      default: false,
    },
    showBtnSave: {
      type: Boolean,
      default: true,
    },
    showBtnCancel: {
      type: Boolean,
      default: true,
    },
    disabledBtnSave: {
      type: Boolean,
      default: false,
    },
    dark: {
      type: Boolean,
      default: true,
    },
    saveClick: {
      type: Function,
      default: () => {},
    },
    closeClick: {
      type: Function,
      default: () => {},
    },
    deleteClick: {
      type: Function,
      default: () => {},
    },
  },
  computed: {
    localValue: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      },
    },
  },
};
</script>

<style scoped>
.v-dialog > .v-card > .v-toolbar {
  position: sticky;
  top: 0;
  z-index: 999;
}
</style>
