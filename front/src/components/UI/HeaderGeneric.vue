<template>
  <v-toolbar
    :flat="flat"
    :color="color"
    :dense="dense"
    :elevation="elevation"
    :outlined="outlined"
    :rounded="rounded"
  >
    <v-toolbar-title
      v-if="withTitle"
      :style="{ color: titleColor }"
      class="font-weight-medium"
      >{{ title }}</v-toolbar-title
    >
    <slot name="addButton"></slot>
    <v-spacer></v-spacer>
    <slot name="buttons"></slot>
  </v-toolbar>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: undefined,
    },
    color: {
      type: String,
      default: undefined,
    },
    dense: {
      type: Boolean,
      default: true,
    },
    elevation: {
      type: Number,
      default: undefined,
    },
    flat: {
      type: Boolean,
      default: true,
    },
    outlined: {
      type: Boolean,
      default: false,
    },
    rounded: {
      type: Boolean,
      default: false,
    },
    titleColor: {
      type: String,
      default: undefined,
    },
    withTitle: {
      type: Boolean,
      default: true,
    },
    withAddButton: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
