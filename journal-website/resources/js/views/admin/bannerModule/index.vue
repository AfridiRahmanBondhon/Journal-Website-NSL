<template>
  <index-page> </index-page>
</template>

<script>
const model = "bannerModule";

const tableColumns = [
  { field: "status", title: "Status", align: "center" },
  { field: "banner_heading", title: "Banner_heading" },
  { field: "banner_text", title: "Banner_text" },
  { field: "banner_img1", title: "Banner_img1" },
  { field: "banner_img2", title: "Banner_img2" },
  { field: "banner_img3", title: "Banner_img3" },
  { field: "banner_url", title: "Banner_url" },
];

const json_fields = {
  "Banner heading": "banner_heading",
  "Banner text": "banner_text",
  "Banner img1": "banner_img1",
  "Banner img2": "banner_img2",
  "Banner img3": "banner_img3",
  "Banner url": "banner_url",
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