<template>
  <v-list-item link @click="onClick">
    <v-list-item-icon class="me-2">
      <v-icon :color="iconColor" :size="size">{{ iconName }}</v-icon>
    </v-list-item-icon>
    <v-list-item-content>
      <v-list-item-title>{{ title }}</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: undefined,
    },
    iconName: {
      type: String,
      default: undefined,
    },
    iconColor: {
      type: String,
      default: "#5abf7a",
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    size: {
      type: [String, Number],
      default: 22,
    },
    onClick: {
      type: Function,
      default: () => {},
    },
  },
};
</script>
