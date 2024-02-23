<template>
  <v-btn
    :block="block"
    :color="color"
    :dark="dark"
    :elevation="elevation"
    :loading="loading"
    @click="onClick"
    :disabled="disabled"
    :outlined="outlined"
    :rounded="rounded"
    v-on="vOn"
    v-bind="vBind"
  >
    <span :style="{ color: labelColor }">
      {{ label }}
    </span>
    <v-icon v-if="nameIcon" class="ml-1" :style="{ color: iconColor }">{{ nameIcon }}</v-icon>
  </v-btn>
</template>

<script>
export default {
  name: "Button",
  props: {
    label: {
      type: String,
    },
    nameIcon: {
      type: String,
      default: null,
    },
    block: {
      type: Boolean,
      default: false,
    },
    color: {
      type: String,
      default: "#10A375",
    },
    dark: {
      type: Boolean,
      default: false,
    },
    labelColor: {
      type: String,
      default: "#fff",
    },
    iconColor: {
      type: String,
      default: "#fff",
    },
    elevation: {
      type: [String, Number],
      default: undefined,
    },
    loading: {
      type: Boolean,
      default: false,
    },
    disabled: {
      type: [Boolean, Function],
      default: false,
    },
    outlined: {
      type: Boolean,
      default: false,
    },
    rounded: {
      type: Boolean,
      default: false,
    },
    onClick: {
      type: Function,
      default: () => {},
    },
    vOn: {
      type: Object,
      default: null,
    },
    vBind: {
      type: [Object, Array],
      default: null,
    },
  },
};
</script>
