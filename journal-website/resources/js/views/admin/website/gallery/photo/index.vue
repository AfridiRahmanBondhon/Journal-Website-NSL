<template>
  <index-page>
    <template v-slot:search-field>
      <StatusDropDown></StatusDropDown>

      <v-select-container title="" field="search_data.album_id">
        <label>Select Album</label>
        <v-select
          v-model="search_data.album_id"
          label="name"
          :reduce="(obj) => obj.id"
          :options="extraData.albums"
          placeholder="--Select Album--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>
    </template>
  </index-page>
</template>

<script>
const model = "photo";

// Define table columns...
const tableColumns = [
  {
    field: "album",
    title: "Album Name",
    subfield: "album.name",
    // to: "album.show",
    // id: "id",
  },
  { field: "title", title: "Title" },
  {
    field: "thumb",
    title: "Image",
    image: true,
    imgWidth: "50px",
    align: "center",
  },
  { field: "status", title: "Status", align: "center" },
  {
    field: "sorting",
    title: "Sorting",
    sorting: true,
    namespace: "Website-FrontMenu",
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
      extraData: {
        albums: [],
      },
      model: model,
      json_fields: json_fields,
      fields_name: {
        0: "Select One",
        title: "Title",
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
    this.get_paginate("album", { allData: true, type: "Photos" }, "albums");
  },
  validators: {
    "search_data.status": function (value = null) {
      return Validator.value(value);
    },
  },
};
</script>
