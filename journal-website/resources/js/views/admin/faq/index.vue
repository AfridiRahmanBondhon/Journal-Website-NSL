<template>
  <index-page>
    <template v-slot:search-field>
      <StatusDropDown></StatusDropDown>
    </template>
  </index-page>
</template>

<script>
const model = "faq";

const tableColumns = [
  { field: "question", title: "Question" },
  { field: "status", title: "Status", align: "center" },
  {
    field: "sorting",
    title: "Sorting",
    sorting: true,
    namespace: "Faq",
    auto: "",
    align: "center",
  },
  { field: "created_at", title: "Created at", date: true },
];

const json_fields = {
  Question: "question",
  Answer: "answer",
  Status: "status",
};

export default {
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: { 0: "Select One", question: "Question" },
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
      model: this.model,
      fields_name: this.fields_name,
      search_data: this.search_data,
      table: this.table,
      json_fields: this.json_fields,
      search: this.search,
      validate: this.validation,
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
    "search_data.category_id": function (value = null) {
      return Validator.value(value);
    },
  },
};
</script>
