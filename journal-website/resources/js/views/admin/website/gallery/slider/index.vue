<template>
  <index-page>
    <template v-slot:search-field>
      <StatusDropDown></StatusDropDown>
    </template>
  </index-page>
</template>

<script>
const model = "slider";

// Define table columns...
const tableColumns = [
  { field: "title", title: "Title" },
  { field: "position", title: "Position" },
  { field: "width", title: "  Width(Pixel) " },
  { field: "height", title: "  Height(Pixel) " },
  { field: "max_image", title: "Max(Image file) " },
  { field: "status", title: "Status", align: "center" },
  {
    field: "sorting",
    title: "Sorting",
    sorting: true,
    namespace: "Website-Gallery-Slider",
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
        position: "Position",
        image_height: "Image height",
        image_width: "Image width",
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
      json_fields: this.json_fields,
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
    this.table.routes.array = [
      {
        title: "Slider Details",
        route: "slider-details.create",
        icon: "images",
        class: "text-danger",
        isQuery: true,
      },
    ];
  },
  validators: {
    "search_data.status": function (value = null) {
      return Validator.value(value);
    },
  },
};
</script>
