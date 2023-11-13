<template>
  <index-page> </index-page>
</template>

<script>
const model = "testimonial";

const tableColumns = [
  { field: "status", title: "Status", align: "center" },
  { field: "name", title: "Name" },
  { field: "designation", title: "Designation" },
  { field: "description", title: "Description" },
  { field: "image", title: "Image", image:true },
];

const json_fields = {
  Name: "name",
  Designation: "designation",
  Description: "description",
  Image: "image",
};

export default {
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: { 0: "Select One", title: "Title" },
      search_data: {
        pagination: 10,
        field_name: 0,
        value: "",
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
};
</script>