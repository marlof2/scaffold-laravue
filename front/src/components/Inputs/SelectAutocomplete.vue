<template>
  <div>
    <span>
      {{ label
      }}<span v-if="required" style="font-size: 14px" class="red--text"
        >*</span
      ></span
    >
    <v-autocomplete
      :items="items"
      :item-text="itemText"
      :item-value="itemValue"
      :rules="rules"
      v-model="localValue"
      dense
      outlined
      :clearable="clearable"
      :disabled="disabled"
      @change="onChange"
      @blur="onBlur"
      :multiple="multiple"
      :return-object="returnObject"
      :hint="hint"
      :persistent-hint="persistentHint"
      :prepend-inner-icon="showIconSearch ? 'mdi-magnify' : ''"
      v-on="on"
      v-bind="bind"
      :loading="loading"
    ></v-autocomplete>
  </div>
</template>
<script>
export default {
  name: "SelectAutocomplete",
  props: {
    label: {
      type: String,
      default: "",
    },
    items: {
      type: [Array, Object],
      default: () => [],
    },
    itemText: {
      type: [String, Function],
      default: undefined,
    },
    itemValue: {
      type: [String, Number, Boolean, Array],
      default: null,
    },
    rules: {
      type: Array,
      default: () => [],
    },
    required: {
      type: Boolean,
      default: false,
    },
    value: {
      type: [String, Number, Boolean, Array, Object],
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    onChange: {
      type: [Function, Promise],
      default: () => {},
    },
    onBlur: {
      type: [Function, Promise],
      default: () => {},
    },
    multiple: {
      type: Boolean,
      default: false,
    },
    loading: {
      type: Boolean,
      default: false,
    },
    returnObject: {
      type: Boolean,
      default: false,
    },
    clearable: {
      type: Boolean,
      default: true,
    },
    hint: {
      type: String,
      default: "",
    },
    persistentHint: {
      type: Boolean,
      default: false,
    },
    showIconSearch: {
      type: Boolean,
      default: false,
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
<style></style>
