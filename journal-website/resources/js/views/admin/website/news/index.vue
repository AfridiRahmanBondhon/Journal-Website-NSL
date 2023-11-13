Website-FrontMenu<template>
  <index-page>
    <template v-slot:search-field>
      <StatusDropDown></StatusDropDown>

      <v-select-container
        field="search_data.category_id"
        title="Category"
        :tooltip="false"
      >
        <v-select
          v-model="search_data.category_id"
          label="title"
          :reduce="(obj) => obj.id"
          :options="categories"
          placeholder="--Select One--"
          :closeOnSelect="true"
          :req="true"
          col="2"
        ></v-select>
      </v-select-container>

      <date-picker
        id="date1"
        field="search_data.from_date"
        name="from_date"
        v-model="search_data.from_date"
        title="From Date"
        placeholder="dd/mm/yyyy"
        :req="true"
        col="2"
        label="From Date"
      ></date-picker>

      <date-picker
        id="date2"
        field="search_data.to_date"
        name="from_date"
        v-model="search_data.to_date"
        title="To Date"
        placeholder="dd/mm/yyyy"
        :req="true"
        col="2"
        label="To Date"
      ></date-picker>
    </template>
  </index-page>
</template>

<script>
const model = "news";
import { mapState } from "vuex";

// Define table columns...
const tableColumns = [
  { field: "date", title: "Date", date: true },
  { field: "title", title: "Title" },
  {
    field: "thumb_one",
    title: "Image",
    image: true,
    imgWidth: "30px",
    align: "center",
  },
  { field: "status", title: "Status", align: "center" },
  {
    field: "sorting",
    title: "Sorting",
    sorting: true,
    namespace: "Website-News",
    auto: "",
    align: "center",
  },
  { field: "created_at", title: "Created at", date: true },
];
// Define excel column...
const json_fields = {
  Title: "title",
  "Created at": "created_at",
};

export default {
  computed: {
    ...mapState("category", ["categories"]),
  },
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: {
        0: "Select One",
        title: "Title",
      },
      search_data: {
        pagination: 10,
        field_name: 0,
        value: "",
        status: "",
        from_date: "",
        to_date: "",
      },
      table: {
        columns: tableColumns,
        routes: {},
        datas: [],
        meta: [],
        links: [],
      },
    };
  },
  provide() {
    return {
      validate: this.validation,
      model: this.model,
      fields_name: this.fields_name,
      search_data: this.search_data,
      table: this.table,
      search: this.search,
    };
  },
  methods: {
    search() {
      this.get_paginate(this.model, this.search_data);
    },
  },
  created() {
    this.getRouteName(this.model);
    this.setBreadcrumbs(this.model, "index");
    this.search();
    this.$store.dispatch("category/getCategory", { transfer: "News" });
  },
  validators: {
    "search_data.category_id": function (value = null) {
      return Validator.value(value);
    },
  },
};
</script>
