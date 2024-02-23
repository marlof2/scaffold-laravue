<template>
  <div>
    <v-radio-group
      :mandatory="mandatory"
      :row="row"
      :column="column"
      v-model="localValue"
      :disabled="disabled"
      :rules="rules"
    >
      <v-radio
        v-for="option in items"
        :key="option.id"
        :label="option[`${label}`]"
        :value="option[`${valueOption}`]"
      ></v-radio>
    </v-radio-group>
  </div>
</template>

<script>
export default {
  name: "RadioButton",
  props: {
    items: {
      type: [Array, Object],
      default: () => [],
    },
    rules: {
      type: Array,
      default: () => [],
    },
    label: {
      type: String,
      default: "",
    },
    valueOption: {
      type: [String, Number, Boolean, Object],
      default: null,
    },
    value: {
      type: [String, Number, Boolean, Object],
      default: null,
    },
    required: {
      type: Boolean,
      default: false,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    row: {
      type: Boolean,
      default: true,
    },
    column: { type: Boolean, default: true },
    mandatory: { type: Boolean, default: false },
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
<style></style>
