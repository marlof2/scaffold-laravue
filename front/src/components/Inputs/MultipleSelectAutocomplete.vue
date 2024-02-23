<template>
  <div>
    <span>
      {{ label
      }}<span v-if="required" style="font-size: 14px" class="red--text"
        >*</span
      ></span
    >
    <span v-if="pagination">
      <div class="mb-1"></div>
    </span>
    <v-autocomplete
      v-model="localValue"
      :items="items"
      :search-input.sync="search"
      :item-value="itemValue"
      :placeholder="placeholder"
      :rules="rules"
      @keyup.enter="enterPressed"
      clearable
      outlined
      dense
      no-filter
      :disabled="disabled"
      :hint="hint"
      persistent-hint
      :prepend-inner-icon="showIconSearch ? 'mdi-magnify' : ''"
    >
      <template v-slot:selection="{ item }">
        <slot v-if="isSlotSelection" name="selection" :item="item"></slot>
        <span v-if="!isSlotSelection && itemValue">
          <span v-for="field in fields" :key="field">
            <div class="my-1">
              <strong>{{ (field + ": ") | capitalize }}</strong
              >{{ item[`${field}`] }}
            </div>
          </span>
        </span>
      </template>
      <template v-slot:item="{ item }">
        <slot v-if="isSlotContent" name="content" :item="item"></slot>
        <p v-if="fields.length > 0 && !isSlotContent">
          <span v-for="field in fields" :key="field">
            <span>
              <strong>{{ (field + ": ") | capitalize }}</strong
              >{{ item[`${field}`] | capitalize }}
            </span>
            <br />
          </span>
        </p>
      </template>
    </v-autocomplete>
  </div>
</template>
<script>
export default {
  name: "SelectAutocomplete",
  data() {
    return {
      search: null,
    };
  },
  props: {
    label: {
      type: String,
      default: "",
    },
    placeholder: {
      type: String,
      default: "",
    },
    items: {
      type: Array,
      default: () => [],
    },
    itemValue: {
      type: [String, Number, Boolean, Array],
      default: null,
    },
    rules: {
      type: Array,
      default: () => [],
    },
    enterPressed: {
      type: Function,
      default: () => {},
    },
    required: {
      type: Boolean,
      default: false,
    },
    fields: {
      type: Array,
      default: () => [],
    },
    legendas: {
      type: Array,
      default: () => [],
    },
    value: {
      type: [String, Number, Boolean, Array],
      default: null,
    },
    pagination: {
      type: Boolean,
      default: false,
    },
    isSlotSelection: {
      type: Boolean,
      default: false,
    },
    isSlotContent: {
      type: Boolean,
      default: false,
    },
    returnObject: {
      type: Boolean,
      default: false,
    },
    searchData: {
      type: [Function, Promise],
      default: () => {},
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    hint: {
      type: String,
      default: "",
    },
    showIconSearch: {
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
  watch: {
    search(val) {
      this.searchData(val);
    },
  },
};
</script>
<style></style>
