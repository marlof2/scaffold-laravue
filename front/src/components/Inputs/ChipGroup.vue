<template lang="">
  <div>
    <v-chip-group column>
      <v-chip :to="tag[`${link}`]" v-for="tag in tags" :key="tag[`${link}`]">
        {{ tag[`${label}`] }}
      </v-chip>
    </v-chip-group>
  </div>
</template>
<script>
export default {
  props: {
    tags: {
      type: Array,
      default: [],
    },
    label: {
      type: String,
      default: "",
    },
    link: {
      type: String,
      default: "",
    },
  },
};
</script>
<style lang=""></style>
