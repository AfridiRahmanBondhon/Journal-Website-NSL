<template>
  <index-page>
    <template v-slot:search-field>
      <StatusDropDown></StatusDropDown>

      <v-select-container title="Select Type" field="search_data.type">
        <v-select
          v-model="search_data.type"
          label="name"
          :reduce="(obj) => obj.value"
          :options="modules"
          placeholder="--Select Type--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>
    </template>
  </index-page>
</template>

<script>
const model = "frontMenu";

// Define table columns...
const tableColumns = [
  { field: "parent", title: "Parent", subfield: "title" },
  { field: "title", title: "Title" },
  { field: "type", title: "Menu Type", align: "center" },
  { field: "content", title: "Content", subfield: "title" },
  {
    field: "sorting",
    title: "Sorting",
    sorting: true,
    namespace: "Website-FrontMenu",
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
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: {
        0: "Select One",
        title: "Title",
        content: "Content",
        parent: "Parent",
      },
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
      modules: [
        { name: "content", value: "content" },
        { name: "external_link", value: "external_link" },
        { name: "outside_website", value: "outside_website" },
      ],
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
    this.setBreadcrumbs(this.model, "index", "Frontend Menu");
    this.search();
  },

  validators: {
    "search_data.status": function (value = null) {
      return Validator.value(value);
    },
  },
};
</script>
