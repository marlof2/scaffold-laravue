<template>
  <v-checkbox @change="onChange" v-model="localValue" :label="label">
  </v-checkbox>
</template>
<script>
export default {
  name: "Checkbox",
  props: {
    label: {
      type: String,
      default: "",
    },
    value: {
      type: Boolean,
      default: false,
    },
    onChange: {
      type: Function,
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
