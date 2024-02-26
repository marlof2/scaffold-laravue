<template>
  <div>
    <span
      >{{ label
      }}<span v-if="required" style="fontsize: 14px" class="red--text"> *</span>
    </span>
    <v-textarea
      v-model="localValue"
      :value="localValue"
      outlined
      :maxlength="maxlength"
      :rows="rows"
      :row-height="rowHeight"
      :counter="maxlength"
      :rules="rules"
      :disabled="disabled"
    ></v-textarea>
  </div>
</template>
<script>
export default {
  name: "TextArea",
  props: {
    rules: {
      type: Array,
      default: () => [],
    },
    label: {
      type: String,
      default: "",
    },
    value: {
      type: String,
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
    rows: {
      type: Number,
      default: 0,
    },
    rowHeight: {
      type: Number,
      default: 0,
    },
    disabled: {
      type: Boolean,
      default: false,
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
