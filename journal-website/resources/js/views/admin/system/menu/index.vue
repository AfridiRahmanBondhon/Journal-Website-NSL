<template>
  <index-page></index-page>
</template>

<script>
const model = "menu";

// Define table columns...
const tableColumns = [
  { field: "parent", title: "Parent Menu", subfield: "menu_name" },
  { field: "menu_name", title: "Menu Name" },
  { field: "route_name", title: "Route Name", align: "center" },
  { field: "params", title: "Params", align: "center" },
  {
    field: "sorting",
    title: "Sorting",
    sorting: true,
    namespace: "System-Menu",
    auto: "",
    align: "center",
  },
];
// Define excel column...
const json_fields = {
  "Role Name": "name",
  "Created at": "created_at",
};

export default {
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: { 0: "Select One", menu_name: "Menu Name" },
      search_data: {
        pagination: 10,
        field_name: "menu_name",
        value: "",
        status: "active",
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
      search: this.search,
    };
  },

  methods: {
    search() {
      this.get_paginate(this.model, this.search_data);
    },
    systemRoleUpdate() {
      axios.get("/systems-update").then((res) => {
        this.notification(res.data.message, "success");
      });
    },
  },
  created() {
    this.getRouteName(this.model);
    this.setBreadcrumbs(this.model, "index", "Backend Menu");
    this.search();
  },
};
</script>
