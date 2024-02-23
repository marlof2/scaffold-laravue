<template>
  <div>
    <v-expansion-panels
      :flat="flat"
      v-model="localValue"
      focusable
      :readonly="readOnly"
    >
      <v-expansion-panel @click="onClick">
        <v-expansion-panel-header :color="color">
          <div
            v-if="customPromptuary"
            class="d-flex flex-row bg-surface-variant"
          >
            <v-sheet
              style="border-radius: 5px"
              :color="colorSheet"
              class="ma-1 pa-1 elevation-1"
              ><h1>{{ title }}</h1></v-sheet
            >
            <p style="font-size: 26px" class="pt-2 pl-1">{{ subTitle }}</p>
          </div>
          <h4 v-if="!customPromptuary">{{ title }}</h4>
        </v-expansion-panel-header>
        <v-expansion-panel-content :class="classPadding">
          <slot></slot>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </div>
</template>
<script>
export default {
  data() {
    return {
      open: -1,
    };
  },
  props: {
    classPadding: {
      type: String,
      default: "pa-2",
    },
    title: {
      type: String,
      default: "",
    },
    readOnly: {
      type: Boolean,
      default: false,
    },
    flat: {
      type: Boolean,
      default: false,
    },
    customPromptuary: {
      type: Boolean,
      default: false,
    },
    subTitle: {
      type: String,
      default: "",
    },
    color: {
      type: String,
      default: "white",
    },
    colorSheet: {
      type: String,
      default: "white",
    },
    onClick: {
      type: Function,
      default: () => {},
    },
     value: {
      type: [String, Number, Boolean, Array, Object],
      default: -1,
    },
  },
  computed: {
    localValue: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("change", value);
      },
    },
  },
};
</script>
<style scoped>
::v-deep .v-expansion-panel-content__wrap {
  padding: 0px 1px 0px 2px !important;
}
</style>
