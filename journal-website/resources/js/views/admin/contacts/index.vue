<template>
  <index-page :button="false"> </index-page>
</template>

<script>
const model = "contacts";

// Define table columns...
const tableColumns = [
  { field: "name", title: "Name" },
  { field: "email", title: "Email" },
  { field: "subject", title: "Subject" },
  { field: "phone", title: "Phone" },
  { field: "message", title: "Message" },
  { field: "created_at", title: "Created at", date: true },
];

// Define excel column...
const json_fields = {
  Name: "name",
  Email: "email",
  Subject: "subject",
  Phone: "phone",
  Message: "message",
};

const routes = {
  view: "contact.show",
  destroy: "contact.destroy",
};

export default {
  data() {
    return {
      model: model,
      json_fields: json_fields,
      fields_name: {
        0: "Select One",
        name: "Name",
        email: "Email",
        subject: "Subject",
        phone: "Phone",
        message: "Message",
      },
      search_data: {
        pagination: 10,
        field_name: 0,
        value: "",
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
    this.setBreadcrumbs(this.model, "index");
    this.search();
  },
};
</script>

<style>
.search-btn {
  margin-bottom: 15px;
}
</style>
