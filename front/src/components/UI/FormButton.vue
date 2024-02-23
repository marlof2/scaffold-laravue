<template>
  <v-btn
    :min-width="small ? '' : '150px'"
    :min-height="small ? '' : '42px'"
    class="label"
    v-on="$listeners"
    :dark="dark"
    :outlined="isBack"
    :color="'primary'"
    :loading="isLoading"
    :disabled="disabled"
    >{{ label }}</v-btn
  >
</template>
<script>
export default {
  props: {
    isBack: Boolean,
    label: String,
    dark: Boolean,
    click: Function,
    isLoading: Boolean,
    small: Boolean,
    disabled: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style scoped>
.label {
  font-size: 12pt;
  margin-left: -7px;
}
</style>
