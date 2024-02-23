<template>
  <div>
    <v-switch v-model="localValue" inset :label="label"></v-switch>
  </div>
</template>
<script>
export default {
  name: "SwitchButton",
  props: {
    label: {
      type: String,
      default: "",
    },
    value: {
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
<style></style>
