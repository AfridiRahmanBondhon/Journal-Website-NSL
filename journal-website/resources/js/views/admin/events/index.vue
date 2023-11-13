<template>
  <index-page>
    <template v-slot:search-field>
      <StatusDropDown></StatusDropDown>
      <date-picker
        id="date4"
        field="search_data.from_date"
        name="start_date"
        v-model="search_data.from_date"
        title="Start Date"
        placeholder="dd/mm/yyyy"
        col="3"
        label="From Date"
        :tooltip="false"
      ></date-picker>
      <date-picker
        id="date5"
        field="search_data.to_date"
        name="end_date"
        v-model="search_data.to_date"
        title="End Date"
        placeholder="dd/mm/yyyy"
        col="3"
        label="To Date"
        :tooltip="false"
      ></date-picker>

      <v-select-container
        title=""
        field="search_data.category_id"
        col="col-md-3 col-lg-3 pb-3"
      >
        <label for="">Select Category</label>
        <v-select
          v-model="search_data.category_id"
          label="title"
          :reduce="(obj) => obj.id"
          :options="extraData.categories"
          placeholder="--Select Category--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>
    </template>
  </index-page>
</template>

<script>
const model = "events";

// Define table columns...
const tableColumns = [
  {
    field: "original_image",
    title: "Image",
    image: true,
    imgWidth: "50px",
    align: "center",
  },
  { field: "title", title: "Title" },
  { field: "category", title: "Category", subfield: "category.title" },
  { field: "venue", title: "Venue" },
  { field: "start_date", title: "Start_date" },
  { field: "end_date", title: "End_date" },
  {
    field: "sorting",
    title: "Sorting",
    sorting: true,
    namespace: "Events",
    auto: "",
    align: "center",
  },
  { field: "status", title: "Status", align: "center" },
  { field: "created_at", title: "Created at", date: true },
];

// Define excel column...
const json_fields = {
  Title: "title",
  Image: "image",
  Venue: "venue",
  "Start date": "start_date",
  "End date": "end_date",
  Sorting: "sorting",
  Status: "status",
  Description: "description",
};

export default {
  data() {
    return {
      extraData: {
        categories: [],
      },
      model: model,
      json_fields: json_fields,
      fields_name: { 0: "Select One", title: "Title", venue: "Venue" },
      search_data: {
        pagination: 10,
        field_name: 0,
        value: "",
        status: "",
        from_date: "",
        to_date: "",
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
    this.get_paginate(
      "category",
      { allData: true, module_name: "events" },
      "categories"
    );
  },
  validators: {
    "search_data.category_id": function (value = null) {
      return Validator.value(value);
    },
  },
};
</script>
