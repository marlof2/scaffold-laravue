<template>
  <v-card light elevation="0">
    <span>
      {{ label
      }}<span v-if="required" style="font-size: 14px" class="red--text"
        >*</span
      ></span
    >
    <v-autocomplete
      v-model="localValue"
      :items="items"
      :search-input.sync="search"
      :item-text="itemText"
      :item-value="itemValue"
      :placeholder="placeholder"
      :rules="rules"
      :disabled="disabled"
      :hint="hint"
      :persistent-hint="persistentHint"
      @click:clear="clear"
      @keyup.enter="enterPressed"
      @change="onChange"
      hide-no-data
      hide-selected
      auto-select-first
      clearable
      outlined
      dense
      :no-filter="noFilter"
      :return-object="returnObject"
      :prepend-inner-icon="showIconSearch ? 'mdi-magnify' : ''"
      v-on="on"
      v-bind="bind"
    >
      <template v-if="useSlotSelection" v-slot:selection="{ item }">
        <slot name="selection" :item="item"></slot>
      </template>
      <template v-if="useSlotItem" v-slot:item="{ item }">
        <slot name="item" :item="item"></slot>
      </template>
    </v-autocomplete>
  </v-card>
</template>

<script>
export default {
  name: "AutocompleteSearchApi",
  data() {
    return {
      search: null,
    };
  },
  props: {
    value: {
      type: [String, Number, Boolean, Array, Object],
      default: null,
    },
    items: {
      type: Array,
      default: () => [],
    },
    itemValue: {
      type: [String, Number, Boolean, Array],
      default: null,
    },
    itemText: {
      type: [String, Function],
      default: "",
    },
    label: {
      type: String,
      default: "",
    },
    placeholder: {
      type: String,
      default: "",
    },
    searchData: {
      type: [Function, Promise],
      default: () => {},
    },
    required: {
      type: Boolean,
      default: false,
    },
    rules: {
      type: Array,
      default: () => [],
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    hint: {
      type: String,
      default: "",
    },
    persistentHint: {
      type: Boolean,
      default: false,
    },
    useSlotSelection: {
      type: Boolean,
      default: false,
    },
    useSlotItem: {
      type: Boolean,
      default: false,
    },
    noFilter: {
      type: Boolean,
      default: true,
    },
    returnObject: {
      type: Boolean,
      default: false,
    },
    enterPressed: {
      type: [Function, Promise],
      default: () => {},
    },
    showIconSearch: {
      type: Boolean,
      default: false,
    },
    onChange: {
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
  methods: {
    clear() {
      this.localValue = null;
    },
  },
  watch: {
    search(val) {
      if (val != null && !this.value) this.searchData(val);
    },
  },
};
</script>
