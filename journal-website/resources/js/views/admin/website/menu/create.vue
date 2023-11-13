<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <v-select-container field="" title="Parent Menu">
        <v-select
          v-model="data.parent_id"
          label="name"
          :reduce="(obj) => obj.id"
          :options="parentMenu"
          placeholder="--Select One--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>

      <Input
        v-model="data.title"
        field="data.title"
        title="Title"
        :req="true"
        class="col-md-3"
      />
      <v-select-container field="type" title="Menu Type" :req="true">
        <v-select
          v-model="data.type"
          label="name"
          :reduce="(obj) => obj.id"
          :options="menu_types"
          placeholder="--Select One--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>

      <v-select-container
        field="menu_look_type"
        title="Menu Look Type"
        :req="true"
      >
        <v-select
          v-model="data.menu_look_type"
          label="name"
          :reduce="(obj) => obj.id"
          :options="menu_look_types"
          placeholder="--Select One--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>

      <v-select-container title="Content" v-if="data.type == 'content'">
        <v-select
          v-model="data.content_id"
          label="title"
          :reduce="(obj) => obj.id"
          :options="contents"
          placeholder="--Select One--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>

      <Input
        v-if="data.type == 'outside_website' || data.type == 'external_link'"
        :title="data.type == 'outside_website' ? 'URL' : 'Route Name'"
        field="data.url"
        v-model="data.url"
        :req="true"
      />

      <Input title="Params" field="data.params" v-model="data.params" />

      <v-select-container field="position" title="Menu Position" :req="true">
        <v-select
          v-model="data.position"
          label="name"
          :reduce="(obj) => obj.id"
          :options="positions"
          placeholder="--Select One--"
          :closeOnSelect="true"
        ></v-select>
      </v-select-container>

      <Input
        title="Sorting"
        field="data.sorting"
        v-model="data.sorting"
        :req="true"
      />

      <Switch
        v-model="data.status"
        on-label="Active"
        off-label="Deactive"
      ></Switch>
    </div>
    <Button title="Submit" class="aus-btn" process="" />
  </create-form>
</template>

<script>
const model = "frontMenu";

export default {
  data() {
    return {
      selectedValue: null,
      model: model,
      contents: {},
      extraData: {
        contents: [],
      },
      positions: [
        { id: "header", name: "Header" },
        { id: "top_bar", name: "Top Bar" },
        { id: "footer_bottom", name: "Footer Bottom" },
        { id: "footer_information", name: "Footer Information" },
      ],
      menu_look_types: [
        { id: "normal", name: "Normal" },
        { id: "mega", name: "Mega" },
      ],
      menu_types: [
        { id: "content", name: "Content" },
        { id: "external_link", name: "External Link" },
        { id: "outside_website", name: "Outside Website" },
      ],
      parentMenu: [],
      data: {
        parent_id: "",
        content_id: "",
        menu_type: "",
        position: "header",
        menu_look_type: "normal",
        status: "active",
        sorting: 0,
      },
    };
  },
  watch: {
    "data.params"(next, prev) {
      if (next !== prev) {
        if (this.data.params) {
          this.data.params = this.data.params.toLowerCase();
        }
      }
    },
  },
  provide() {
    return {
      validate: this.validation,
    };
  },
  methods: {
    submit: function (e) {
      this.$validate().then((res) => {
        const error = this.validation.countErrors();
        this.$validate().then((res) => {
          if (error > 0) {
            this.$toast(
              "You need to fill " + error + " more empty mandatory fields",
              "warning"
            );
            return false;
          }

          if (res) {
            if (this.data.id) {
              console.log(this.data);
              this.update(this.model, this.data, this.data.id);
            } else {
              this.store(this.model, this.data);
            }
          }
        });
      });
    },
    get_parent: function () {
      axios.get("/parent-menus").then((res) => (this.parentMenu = res.data));
    },
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, "edit", "Frontend Menu");
      this.get_data(`${this.model}/${this.$route.params.id}`);
    } else {
      this.setBreadcrumbs(this.model, "create", "Frontend Menu");
      this.get_sorting("Website-FrontMenu");
    }

    this.get_parent();

    axios.get("get-content?page=1&allData=true").then((res) => {
      this.contents = res.data;
    });
  },
  validators: {
    "data.menu_look_type": function (value = null) {
      return Validator.value(value).required("Menu look is required");
    },
    "data.type": function (value = null) {
      return Validator.value(value).required("Menu Type is required");
    },
    "data.position": function (value = null) {
      return Validator.value(value).required("Menu Position is required");
    },
    "data.params": function (value = null) {
      return Validator.value(value).regex("^[a-z0-9-]+$", "Only lowercase");
    },
    "data.title": function (value = null) {
      return Validator.value(value).required("Title is required");
    },
    "data.url": function (value = null) {
      return Validator.value(value).required("Url is required");
    },
    "data.sorting": function (value = null) {
      return Validator.value(value)
        .digit()
        .regex("^[0-9]*$")
        .required("Sorting is required");
    },
    "data.status": function (value = null) {
      return Validator.value(value).required("Status is required");
    },
  },
};
</script>
