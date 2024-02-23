<template>
  <v-menu
    left
    nudge-bottom="14"
    origin="center center"
    transition="scale-transition"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-icon size="22" color="black" v-bind="attrs" v-on="on">
        mdi-dots-vertical</v-icon
      >
    </template>
    <v-list dense>
      <slot name="moreActions"></slot>
    </v-list>
  </v-menu>
</template>

<script>
export default {
  props: {
    onClick: {
      type: Function,
      default: () => {},
    },
    name: {
      type: String,
      default: undefined,
    },
  },
  data() {
    return {};
  },
  mounted() {},
};
</script>
