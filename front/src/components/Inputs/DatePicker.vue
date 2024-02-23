<template>
  <div>
    <span>
      {{ label
      }}<span v-if="required" style="font-size: 14px" class="red--text">
        *</span
      ></span
    >
    <v-menu
      ref="datePickerMenu"
      v-model="datePickerMenu"
      :close-on-content-click="false"
      transition="scale-transition"
      offset-y
      max-width="290px"
      min-width="auto"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          v-model="dateFormatted"
          hint="DD/MM/AAAA"
          persistent-hint
          prepend-inner-icon="mdi-calendar"
          v-bind="attrs"
          v-on="on"
          clearable
          @click:clear="clear"
          outlined
          dense
          :rules="rules"
          :disabled="disabled"
          readonly
        ></v-text-field>
      </template>
      <v-date-picker
        :max="maxDate"
        :min="minDate"
        no-title
        v-model="localValue"
        @input="datePickerMenu = false"
        :disabled="disabled"
        v-if="!restrictDate"
      ></v-date-picker>
      <v-date-picker
        v-if="restrictDate"
        :max="maxDate"
        :min="minDate"
        no-title
        v-model="localValue"
        @input="datePickerMenu = false"
        :disabled="disabled"
        :allowed-dates="allowedDates"
      ></v-date-picker>
    </v-menu>
  </div>
</template>
<script>
import dateFilter from "../../filters/formatDate";
import moment from "moment";
export default {
  name: "DatePicker",
  props: {
    date: {
      type: [Date, String],
      default: null,
    },
    value: {
      type: [String, Date],
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
    maxDate: {
      type: [String, Date],
      default: null,
    },
    minDate: {
      type: [String, Date],
      default: null,
    },
    label: {
      type: String,
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    restrictDate: {
      type: Boolean,
      default: false,
    },
    allowedDates: {
      type: Function,
      default: () => null,
    },
  },
  methods: {
    clear() {
      this.localValue = null;
    },
  },
  data() {
    return {
      datePickerMenu: false,
      dateFormatted: dateFilter.formatDate(this.value),
    };
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
    date(val) {
      this.dateFormatted = moment(val).format("DD/MM/YYYY");
    },
  },
};
</script>
