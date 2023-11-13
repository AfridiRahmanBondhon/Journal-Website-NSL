<template>
  <index-page>
    <template v-slot:search-field>
      <StatusDropDown></StatusDropDown>

      <!-- <div class="col-sm-4 col-md-3 mb-3">
        <label>Status</label>
        <select v-model="search_data.status" class="form-select shadow-none">
          <option value="">All</option>
          <option value="active">Active</option>
          <option value="deactive">Deactive</option>
        </select>
      </div> -->

      <v-select-container title="Select Role" field="search_data.role_id">
        <v-select
          v-model="search_data.role_id"
          label="name"
          :reduce="(obj) => obj.id"
          :options="extraData.roles"
          placeholder="--Select Role--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>
    </template>
  </index-page>
</template>

<script>
const model = "admin";
import { EventBus } from "../../../event-bus.js";

const tableColumns = [
  {
    field: "profile",
    title: "Profile",
    image: true,
    imgWidth: "30px",
    align: "center",
  },
  { field: "name", title: "Name" },
  { field: "email", title: "Email" },
  { field: "role", title: "Role Name", subfield: "role.name" },
  { field: "mobile", title: "Mobile" },
  { field: "status", title: "Status", align: "center" },
  { field: "created_at", title: "Created at", align: "center", date: true },
];

const json_fields = {
  Name: "name",
  Role: "role.name",
  Email: "email",
  Mobile: "mobile",
  Status: "status",
  CreatedAt: "created_at",
};

export default {
  data() {
    return {
      extraData: {
        roles: [],
      },
      model: model,
      json_fields: json_fields,
      fields_name: {
        0: "Select One",
        name: "Name",
        email: "Email",
        mobile: "Mobile",
      },
      search_data: {
        pagination: 10,
        field_name: 0,
        value: "",
        status: "",
        role_id: "",
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
      validate: this.validation,
    };
  },
  methods: {
    search: function (e) {
      e.preventDefault();

      this.$validate().then((res) => {
        const error = this.validation.countErrors();

        if (error > 0) {
          console.log(this.validation.allErrors());
          this.$toast(
            "You need to fill " + error + " more empty mandatory fields",
            "warning"
          );
        }

        console.log(error);

        this.get_paginate(this.model, this.search_data);
      });
    },
    systemRoleUpdate() {
      axios.get("/systems-update").then((res) => {
        this.notification(res.data.message, "success");
      });
    },
    bindEvents() {
      EventBus.on(
        "server",
        function () {
          console.log("Yaay, Server !!!");
        }.bind(this)
      );
    },
  },

  mounted() {
    this.bindEvents();
    this.get_paginate(this.model, this.search_data);
  },

  created() {
    this.getRouteName(this.model);
    this.setBreadcrumbs(this.model, "index");

    this.get_paginate("role", { allData: true }, "roles");
  },
  validators: {
    "search_data.role_id": function (value = null) {
      return Validator.value(value);
    },
    "search_data.field_name": function (value = null) {
      return Validator.value(value);
    },
    "search_data.value": function (value = null) {
      const app = this;
      return Validator.value(value).required("Ok");
    },
  },
};
</script>

<style scoped>
.vs__dropdown-toggle {
  border: var(--vs-border-width) var(--vs-border-style) var(--vs-border-color);
}
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

