<template>
  <div>
    <label
      >{{ label
      }}<span v-if="required" style="font-size: 14px" class="red--text">
        *</span
      ></label
    >
    <v-text-field
      :rules="rules"
      dense
      outlined
      v-model="localValue"
      :maxlength="maxlength"
      :disabled="disabled"
      :autofocus="autofocus"
      :placeholder="placeholder"
      :type="type"
      :clearable="clearable"
      @keyup="keyUp"
      @blur="blur"
      @focus="focus"
      @change="change"
      @keyup.enter="enterPressed"
      @click:append="clickAppend"
      :append-icon="appendIcon"
      :hint="hint"
      persistent-hint
      v-on="on"
      v-bind="bind"
    ></v-text-field>
  </div>
</template>
<script>
export default {
  name: "TextField",
  props: {
    rules: {
      type: Array,
      default: () => [],
    },
    label: {
      type: String,
      default: "",
    },
    autofocus: {
      type: Boolean,
      default: false,
    },
    value: {
      type: [String, Number],
      default: "",
    },
    required: {
      type: Boolean,
      default: false,
    },
    maxlength: {
      type: Number,
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    clearable: {
      type: Boolean,
      default: false,
    },
    placeholder: {
      type: String,
      default: undefined,
    },
    type: {
      type: String,
      default: undefined,
    },
    keyUp: {
      type: Function,
      default: () => {},
    },
    blur: {
      type: Function,
      default: () => {},
    },
    focus: {
      type: Function,
      default: () => {},
    },
    change: {
      type: Function,
      default: () => {},
    },
    appendIcon: {
      type: String,
      default: undefined,
    },
    enterPressed: {
      type: Function,
      default: () => {},
    },
    hint: {
      type: String,
      default: "",
    },
    clickAppend: {
      type: Function,
      default: () => {},
    },
    on: {
      type: Object,
      default: () => {},
    },
    bind: {
      type: Object,
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
