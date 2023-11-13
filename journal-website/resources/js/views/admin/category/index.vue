<template>
  <index-page>
    <template v-slot:search-field>
      <StatusDropDown></StatusDropDown>
    </template>
  </index-page>
</template>

<script>
const model = "category";

const tableColumns = [
  { field: "module_name", title: "Module" },
  { field: "title", title: "Title" },
  {
    field: "sorting",
    title: "Sorting",
    sorting: true,
    namespace: "Category",
    auto: "",
    align: "center",
  },
  { field: "status", title: "Status", align: "center" },
  { field: "created_at", title: "Created at", date: true },
];

const json_fields = {
  "module name": "module_name",
  title: "title",
  status: "status",
  "created at": "created_at",
};

export default {
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: { 0: "Select One", title: "Title", module_name: "Module" },
      search_data: {
        pagination: 10,
        field_name: 0,
        value: "",
        status: "",
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
      json_fields: this.json_fields,
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
  },
  validators: {
    "search_data.status": function (value = null) {
      return Validator.value(value);
    },
  },
};
</script>
