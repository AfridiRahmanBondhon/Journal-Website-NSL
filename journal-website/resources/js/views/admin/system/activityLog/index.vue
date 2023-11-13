<template>
  <index-page>
    <template v-slot:search-field>
      <date-picker
        id="date1"
        field="search_data.from_date"
        name="from_date"
        v-model="search_data.from_date"
        title="From Date"
        placeholder="dd/mm/yyyy"
        :req="true"
        col="3"
        label="From Date"
      ></date-picker>

      <date-picker
        id="date2"
        field="search_data.to_date"
        name="to_date"
        v-model="search_data.to_date"
        title="To Date"
        placeholder="dd/mm/yyyy"
        :req="true"
        col="3"
        label="To Date"
      ></date-picker>

      <v-select-container title="Select User" field="search_data.description">
        <v-select
          v-model="search_data.description"
          label="name"
          :reduce="(obj) => obj.name"
          :options="extraData.admins"
          placeholder="--Select User--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>

      <v-select-container title="Select Type" field="search_data.action">
        <v-select
          v-model="search_data.action"
          label="name"
          :reduce="(obj) => obj.name"
          :options="modules.types"
          placeholder="--Select Type--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>

      <v-select-container title="Select Status" field="search_data.status">
        <v-select
          v-model="search_data.status"
          label="name"
          :reduce="(obj) => obj.name"
          :options="modules.status"
          placeholder="--Select Status--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>
    </template>

    <!-- <template v-slot:button>
      <div class="col-md-3 col-lg-3 col-xxl-2 ms-auto mt-md-0">
        <button
          type="button"
          @click="allRead()"
          class="btn btn-sm btn-info text-white add-btn d-flex ms-auto"
        >
          <i class="fa fa-newspaper-o mt-2" aria-hidden="true"></i>Mark Read
        </button>
      </div>
    </template> -->
  </index-page>
</template>

<script>
const model = "activityLog";

// Define table columns...
const tableColumns = [
  { field: "log_name", title: "Module" },
  { field: "description", title: "Description" },
  { field: "status", title: "Status", align: "center" },
  { field: "created_at", title: "Created at", date: true },
];

// Define excel column...
const json_fields = {
  Module: "log_name",
  Description: "description",
  Status: "status",
  "Created at": "created_at",
};

export default {
  data() {
    return {
      modules: {
        types: [
          { name: "all", value: "all" },
          { name: "created", value: "created" },
          { name: "updated", value: "updated" },
          { name: "deleted", value: "deleted" },
        ],
        status: [
          { name: "all", value: "all" },
          { name: "read", value: "read" },
          { name: "unread", value: "unread" },
        ],
      },
      model: model,
      json_fields: json_fields,
      fields_name: {
        0: "Select One",
        log_name: "Module",
        description: "Description",
      },
      search_data: {
        pagination: 10,
        field_name: 0,
        value: "",
        description: "",
        action: "",
        status: "ur",
        date: "",
      },
      extraData: {
        admins: [],
      },
      table: {
        columns: tableColumns,
        routes: {
          view: model + ".show",
          destroy: model + ".destroy",
        },
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
    };
  },
  methods: {
    destroy(id) {
      this.destroy_data(this.model, id, this.search_data);
    },
    search() {
      this.get_paginate(this.model, this.search_data);
    },
    allRead() {
      this.$root.spinner = true;
      axios
        .get("/allRead")
        .then((res) => {
          this.search();
          this.$toast(res.data.message, "success");
        })
        .catch((error) => console.log())
        .then((alw) => setTimeout(() => (this.$root.spinner = false), 200));
    },
  },
  created() {
    this.getRouteName(this.model);
    this.setBreadcrumbs(this.model, "index", "Activity Log");
    this.search();
    this.get_paginate("admin", { allData: true }, "admins");
  },

  validators: {
    "search_data.to_date": function (value = null) {
      return Validator.value(value);
    },
  },
};
</script>
