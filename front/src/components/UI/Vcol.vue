<template>
  <v-col :cols="col" :sm="col" :md="col" :lg="col" :xl="col">
    <slot></slot>
  </v-col>
</template>
<script>
export default {
  props: {
    col: {
      type: Number,
      default: 12,
    },
  },
};
</script>
