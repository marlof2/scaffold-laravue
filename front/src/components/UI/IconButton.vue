<template>
  <span>
    <v-tooltip v-if="!noTooltip" bottom>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          style="margin-left: -7px"
          text
          icon
          @click="onClick"
          :color="btnColor"
          :disabled="disabled"
        >
          <v-icon v-bind="attrs" v-on="on" :size="size">{{ name }}</v-icon>
        </v-btn>
      </template>
      <span>{{ tooltipName }}</span>
    </v-tooltip>
    <v-btn
      style="margin-left: -7px"
      text
      icon
      @click="onClick"
      :color="btnColor"
      :disabled="disabled"
      v-if="noTooltip"
    >
      <v-icon :size="size">{{ name }}</v-icon>
    </v-btn>
  </span>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      default: undefined,
    },
    tooltipName: {
      type: String,
      default: undefined,
    },
    btnColor: {
      type: String,
      default: "#5abf7a",
    },
    disabled: {
      type: [Boolean, Function],
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
    vOn: {
      type: Object,
      default: null,
    },
    vBind: {
      type: [Object, Array],
      default: null,
    },
    noTooltip: {
      type: Boolean,
      default: false,
    },
  },
};
</script>