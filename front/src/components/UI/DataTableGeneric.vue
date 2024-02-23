<template>
  <div>
    <v-data-table
      disable-pagination
      :headers="headers"
      :items="items"
      :hide-default-footer="hideDefaultFooter"
      :hide-default-header="hideDefaultHeader"
      :show-expand="showExpand"
      :single-expand="singleExpand"
      :expand-icon="expandIcon"
      :show-select="showSelect"
      :single-select="singleSelect"
      :value="value"
      :customColumnCard="customColumnCard"
      :customColumnTwo="customColumnTwo"
      :customColumnThree="customColumnThree"
      :colunmCustom="colunmCustom"
      @input="onSelect"
      @toggle-select-all="toggleSelectAll"
      @item-expanded="itemExpanded"
      :disable-sort="disableSort"
      :items-per-page="itemsPerPage"
      :height="height"
      :item-key="itemKey"
      :selectAllCustom="selectAllCustom"
      :fixed-header="fixedHeader"
    >
      <template v-slot:top>
        <slot name="top"></slot>
      </template>
      <template
        v-for="colunm in colunmCustom"
        v-slot:[`item.${colunm}`]="{ item }"
      >
        <slot :name="colunm" :item="item"></slot>
      </template>
      <template v-slot:header="{ props }">
        <td :colspan="props.headers.length">
          <slot name="header" :props="props"></slot>
        </td>
      </template>
      <template
        v-if="selectAllCustom"
        v-slot:[`item.data-table-select`]="{ item, isSelected, select }"
      >
        <slot
          name="input-checkbox-all"
          :item="item"
          :isSelected="isSelected"
          :select="select"
        ></slot>
      </template>
      <template v-slot:[`item.${customColumn}`]="{ item, index }">
        <td :class="customColumnRowPadding">
          <slot name="customColumn" :item="item" :index="index"></slot>
        </td>
      </template>
      <template v-slot:[`item.${customColumnCard}`]="{ item, index }">
        <slot name="customColumnCard" :item="item" :index="index"></slot>
      </template>
      <template v-slot:[`item.${customColumnTwo}`]="{ item, index }">
        <slot name="customColumnTwo" :item="item" :index="index"></slot>
      </template>
      <template v-slot:[`item.${customColumnThree}`]="{ item, index }">
        <slot name="customColumnThree" :item="item" :index="index"></slot>
      </template>
      <template v-if="showExpand" v-slot:[`expanded-item`]="{ item, headers }">
        <td :colspan="headers.length">
          <slot name="expanded-item" :item="item"></slot>
        </td>
      </template>
      <template
        v-for="customItem in customItemsProp"
        v-slot:[`item.${customItem.name}`]="{ item }"
      >
        <div :key="customItem.id">
          <div v-if="customItem.filter === 'arithmetic'">
            {{ calculate(customItem, item) }}
          </div>
          <div v-if="customItem.filter === 'lowercase'">
            {{ `${item[customItem.name]}` | lowercase }}
          </div>
          <div v-if="customItem.filter === 'uppercase'">
            {{ `${item[customItem.name]}` | uppercase }}
          </div>
          <div
            v-if="customItem.filter === 'dateformat' && item[customItem.name]"
          >
            {{ `${item[customItem.name]}` | dateformat }}
          </div>
          <div
            v-if="
              customItem.filter === 'formatdatexml' && item[customItem.name]
            "
          >
            {{ `${item[customItem.name]}` | formatdatexml }}
          </div>
          <div
            v-if="
              customItem.filter === 'formatdatehour' && item[customItem.name]
            "
          >
            {{ `${item[customItem.name]}` | formatdatehour }}
          </div>
          <div
            v-if="
              customItem.filter === 'formatDateHourBR' &&
              item[customItem.name] &&
              !customItem.attribute
            "
          >
            {{ item[customItem.name] | formatDateHourBR }}
          </div>
          <div
            v-if="
              customItem.filter === 'formatDateHourBR' && customItem.attribute
            "
          >
            {{ readData(item, customItem) | formatDateHourBR }}
          </div>
          <div v-if="customItem.filter === 'boolean' && item[customItem.name]">
            {{ customItem.valueTrue }}
          </div>
          <div v-if="customItem.filter === 'boolean' && !item[customItem.name]">
            {{ customItem.valueFalse }}
          </div>
          <div
            v-if="customItem.filter === 'hourformat' && item[customItem.name]"
          >
            {{ `${item[customItem.name]}` | hourformat }}
          </div>
          <div v-if="customItem.filter === 'cep' && item[customItem.name]">
            {{ `${item[customItem.name]}` | cep }}
          </div>
          <div
            v-if="customItem.filter === 'formatnumber' && item[customItem.name]"
          >
            {{ `${item[customItem.name]}` | formatnumber }}
          </div>
          <div
            v-if="
              customItem.filter === 'formatpercent' && item[customItem.name]
            "
          >
            {{ formatPercent(item[customItem.name]) }}
          </div>
          <div
            v-if="
              customItem.filter === 'dateFormatMonth' && item[customItem.name]
            "
          >
            {{ `${item[customItem.name]}` | dateFormatMonth }}
          </div>
          <div
            v-if="customItem.filter === 'formatMoney' && item[customItem.name]"
          >
            {{ `${item[customItem.name]}` | formatMoney }}
          </div>
        </div>
      </template>
      <template v-slot:footer>
        <slot name="footer"></slot>
      </template>
      <template v-slot:no-data>
        <slot name="no-data"></slot>
      </template>
      <template v-slot:no-results>
        <slot name="no-results"></slot>
      </template>
    </v-data-table>
    <span v-if="showPaginate && dataProp.length">
      <div class="pt-2 d-flex flex-row align-items-flex-start justify-center">
        <span class="d-flex mt-2">
          <IconButton
            class="v-pagination__item btn-custom"
            :disabled="page === 1"
            :onClick="() => handleFirstPage()"
            :name="'mdi-arrow-collapse-left'"
            :size="16"
            :noTooltip="true"
          />
          <v-pagination
            v-model="page"
            :length="pageCount"
            @input="handlePageChange"
            :total-visible="totalVisible"
            :items-per-page="itemsPerPage"
            color="primary"
          >
          </v-pagination>
          <IconButton
            class="v-pagination__item btn-custom"
            :disabled="page === pageCount"
            :onClick="() => handleLastPage()"
            :name="'mdi-arrow-collapse-right'"
            :size="16"
            :noTooltip="true"
          />
        </span>
      </div>
    </span>
  </div>
</template>
<script>
import IconButton from "./IconButton.vue";
export default {
  name: "DatatableGeneric",
  components: {
    IconButton,
  },
  props: {
    headersProp: {
      type: Array,
      default: () => [],
    },
    showExpand: {
      type: Boolean,
      default: false,
    },
    singleExpand: {
      type: Boolean,
      default: false,
    },
    expandedItem: {
      type: Function,
      default: () => {},
    },
    expandIcon: {
      type: String,
      default: "mdi-chevron-down",
    },
    customColumn: {
      type: String,
      default: null,
    },
    customColumnCard: {
      type: String,
      default: null,
    },
    customColumnTwo: {
      type: String,
      default: null,
    },
    customColumnThree: {
      type: String,
      default: null,
    },
    colunmCustom: {
      type: Array,
      default: () => [],
    },
    showSelect: {
      type: Boolean,
      default: false,
    },
    singleSelect: {
      type: Boolean,
      default: true,
    },
    onSelect: {
      type: Function,
      default: () => {},
    },
    toggleSelectAll: {
      type: Function,
      default: () => {},
    },
    itemExpanded: {
      type: Function,
      default: () => {},
    },
    value: {
      type: Array,
      default: () => [],
    },
    disableSort: {
      type: Boolean,
      default: false,
    },
    hideDefaultFooter: {
      type: Boolean,
      default: true,
    },
    hideDefaultHeader: {
      type: Boolean,
      default: false,
    },
    pageProp: {
      type: Number,
      default: 1,
    },
    lastPageProp: {
      type: Number,
      default: 1,
    },
    itemsPerPageProp: {
      type: Number,
      default: 10,
    },
    dataProp: {
      type: Array,
      default: () => [],
    },
    showPaginate: {
      type: Boolean,
      default: true,
    },
    customItemsProp: {
      type: Array,
      default: () => [],
    },
    selectAllCustom: {
      type: Boolean,
      default: false,
    },
    customColumnRowPadding: {
      type: String,
      default: "pa-2",
    },
    height: {
      type: [String, Number],
      default: undefined,
    },
    totalVisible: {
      type: Number,
      default: 5,
    },
    itemKey: {
      type: String,
      default: "id",
    },
    fixedHeader: {
      type: Boolean,
      default: false,
    },
  },
  mounted() {
    this.headers = this.headersProp;
    this.items = this.dataProp;
    this.page = this.pageProp;
    this.itemsPerPage = this.itemsPerPageProp;
    this.pageCount = this.lastPageProp;
  },
  data() {
    return {
      headers: [],
      items: [],
      page: 0,
      pageCount: 0,
      itemsPerPage: 0,
    };
  },
  methods: {
    calculate(customItem, item) {
      let _a, _b, _operator, _result;
      _operator = customItem.operator;
      _a = parseInt(item[customItem.value_a]);
      _b = parseInt(item[customItem.value_b]);

      switch (_operator) {
        case "+":
          _result = _a + _b;
          break;
        case "-":
          _result = _a - _b;
          break;
        case "*":
          _result = _a * _b;
          break;
        case "/":
          _result = _a / _b;
          break;
        default:
          break;
      }
      return _result;
    },
    formatPercent(percentual) {
      if (!percentual) return "";
      let _percentual = String(percentual).replace(".", ",");
      return `${_percentual} %`;
    },
    readData(item, customItem) {
      const info = item[customItem.attribute];
      if (info) return info[customItem.name];
    },
    async handlePageChange() {
      const paginate = { page: this.page, per_page: this.itemsPerPage };
      this.$emit("handlePageChange", paginate);
    },
    async handleFirstPage() {
      const paginate = { page: 1, per_page: this.itemsPerPage };
      this.page = 1;
      this.$emit("handlePageChange", paginate);
    },
    async handleLastPage() {
      const paginate = { page: this.pageCount, per_page: this.itemsPerPage };
      this.page = this.pageCount;
      this.$emit("handlePageChange", paginate);
    },
    countPages() {
      let i = 0;
      let array = [];
      while (i < this.pageCount) {
        i++;
        array.push(i);
      }
      return array;
    },
  },
  watch: {
    dataProp: function (value) {
      this.items = value;
    },
    lastPageProp: function (value) {
      this.pageCount = value;
    },
    pageProp: function (value) {
      this.page = value;
    },
  },
};
</script>
<style scoped>
::v-deep .v-data-table table tbody tr:nth-of-type(even) {
  background-color: rgba(236, 237, 237, 0.4);
}
</style>
