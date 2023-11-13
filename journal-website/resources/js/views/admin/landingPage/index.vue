<template>
  <index-page> </index-page>
</template>

<script>
const model = "landingPage";

const tableColumns = [
  { field: "status", title: "Status", align: "center" },
  { field: "banner_title", title: "Banner_title" },
  { field: "banner_description", title: "Banner_description" },
  { field: "order_now_button", title: "Order_now_button" },
  { field: "feature_text", title: "Feature_text" },
  { field: "demo_link_title", title: "Demo_link_title" },
  { field: "demo_link_url", title: "Demo_link_url" },
  { field: "video_link_url", title: "Video_link_url" },
  { field: "video_title", title: "Video_title" },
  { field: "video_description", title: "Video_description" },
  { field: "testimonial_text", title: "Testimonial_text" },
  { field: "sorting", title: "Sorting" },
];

const json_fields = {
  "Feature text": "feature_text",
  "Testimonial text": "testimonial_text",
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