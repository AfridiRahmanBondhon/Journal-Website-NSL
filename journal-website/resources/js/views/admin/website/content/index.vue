<template>
  <index-page>
    <template v-slot:search-field>
      <StatusDropDown></StatusDropDown>
    </template>
  </index-page>
</template>

<script>
const model = "content";

const tableColumns = [
  { field: "title", title: "Title", to: "content.show", slug: "slug" },
  {
    field: "thumb_one",
    title: "Image",
    image: true,
    imgWidth: "30px",
    align: "center",
  },
  { field: "status", title: "Status", align: "center" },
  { field: "created_at", title: "Created at", date: true },
];

const json_fields = {
  title: "title",
  "created at": "created_at",
};

const routes = {
  destroy: "content.destroy",
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
        status: "",
      },
      table: {
        columns: tableColumns,
        routes: routes,
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
      customDataUrl: this.model,
      customRouteName: "content.index",
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
    this.scrollTop();
    this.setBreadcrumbs(this.model, "index", "Content");
    this.search();

    this.table.routes.array = [
      {
        title: "View",
        route: "content.show",
        icon: "eye",
        class: "text-primary",
        isQuery: true,
        slug: true,
      },
      {
        title: "Edit",
        route: "content.edit",
        icon: "pencil-alt",
        class: "text-info",
        isQuery: true,
        slug: true,
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

<style>
.vs--searchable .vs__dropdown-toggle {
  border: 1px solid #ced4da !important;
}
.form-element input {
  border: 1px solid #ced4da !important;
}

.form-element select {
  border: 1px solid #ced4da !important;
}
</style>
