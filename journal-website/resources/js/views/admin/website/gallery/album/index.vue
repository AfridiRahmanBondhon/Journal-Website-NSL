<template >
  <index-page :defaultTable="false" :searchBlock="true">
    <template v-slot:search-field>
      <StatusDropDown></StatusDropDown>
      <div class="col-sm-3 mb-3">
        <label for="">Type</label>
        <select
          v-model="search_data.type"
          @change="search()"
          class="form-select shadow-none"
        >
          <option value="">Type</option>
          <option value="">All</option>
          <option value="Photos">Photos</option>
          <option value="Videos">Videos</option>
        </select>
      </div>
    </template>

    <template v-slot:table-list>
      <div class="gallery-list">
        <div class="row">
          <div
            v-for="(item, index) in this.table.datas"
            :key="index"
            class="col-sm-3"
          >
            <div class="image">
              <img :src="item.thumb_two" :alt="item.name" />
              <div class="overlay">
                <div class="info">
                  <template v-if="item.type == 'Photos'">
                    <h4 class="mb-2">
                      <i class="fa-regular fa-images"></i>
                      <sup>{{ item.photos_count }}</sup>
                    </h4>
                  </template>

                  <template v-else>
                    <!-- <div class="sm-icon"></div> -->
                    <h4 class="mb-2">
                      <i class="fa-solid fa-video"></i>
                      <sup>{{ item.videos_count }}</sup>
                    </h4>
                  </template>

                  <h4 class="mb-2">{{ item.name }}</h4>
                  <router-link
                    v-if="
                      table.routes.view &&
                      $root.checkPermission(table.routes.view)
                    "
                    :to="{
                      name: table.routes.view,
                      params: { id: item.id },
                      query: { page: $route.query.page },
                    }"
                    class="delete view"
                    title="View"
                  >
                    <i class="fa-solid fa-eye"></i>
                  </router-link>

                  <router-link
                    v-if="
                      table.routes.edit &&
                      $root.checkPermission(table.routes.edit)
                    "
                    :to="{
                      name: table.routes.edit,
                      params: { id: item.id },
                      query: { page: $route.query.page },
                    }"
                    class="delete edit"
                    title="Edit"
                  >
                    <i class="fas fa-pencil-alt"> </i>
                  </router-link>

                  <button
                    v-if="
                      table.routes.destroy &&
                      $root.checkPermission(table.routes.destroy)
                    "
                    v-on:click="destroy(item.id)"
                    class="delete delete-btn"
                    title="Delete"
                  >
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <!-- <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" class="delete view"><i
                        class="fa-solid fa-eye"></i></span>
                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" class="delete edit"><i
                        class="fas fa-pencil-alt"></i></span>
                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"
                      class="delete delete-btn"><i class="far fa-trash-alt"></i></span> -->
                  <div>
                    <template v-if="item.type == 'Photos'">
                      <router-link
                        v-if="
                          table.routes.view &&
                          $root.checkPermission(table.routes.view)
                        "
                        :to="{
                          name: 'photo.create',
                          query: { id: item.id },
                        }"
                        title="View"
                        ><button
                          class="manage-gallery text-white btn btn-info aus-btn shadow-none mt-4"
                        >
                          <i class="fas fa-plus"></i>
                          Add Photos
                        </button>
                      </router-link>
                    </template>

                    <template v-else>
                      <router-link
                        v-if="
                          table.routes.view &&
                          $root.checkPermission(table.routes.view)
                        "
                        :to="{
                          name: 'video.create',
                          query: { id: item.id },
                        }"
                        title="View"
                        ><button
                          class="manage-gallery text-white btn btn-info aus-btn shadow-none mt-4"
                        >
                          <i class="fas fa-plus"></i>
                          Add Videos
                        </button>
                      </router-link>
                    </template>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-2 p-1 bg-info text-white">
              <h6 class="text-center">
                {{ item.type }} Album : {{ item.name }}
              </h6>
            </div>
          </div>
        </div>
      </div>

      <!-- modal -->
      <div
        class="modal fade"
        id="deleteModal"
        tabindex="-1"
        aria-labelledby="deleteModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-black" id="deleteModalLabel">
                Are you sure want to delete this?
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <h6 class="mb-3 text-black">
                Please confirm your login password
              </h6>
              <div class="d-flex justify-content-center">
                <input
                  v-model="delete_password"
                  type="password"
                  placeholder="********"
                  class="form-c ontrol form-control-sm text-center border"
                  style="width: 350px"
                />
              </div>
              <div class="d-flex justify-content-center">
                <button
                  @click="deleteConfirm()"
                  type="button"
                  class="btn btn-success btn-sm text-white my-3"
                >
                  <span v-if="$root.submit">
                    <i class="fa fa-spinner fa-spin"></i>
                    processing...
                  </span>
                  <span v-else> Confirm </span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </index-page>
</template>

<script>
const model = "album";

// Define table columns...
const tableColumns = [
  { field: "name", title: "Name", to: "photo.create" },
  { field: "type", title: "Type", align: "center" },
  {
    field: "image",
    title: "Image",
    image: true,
    imgWidth: "50px",
    height: "50px",
    align: "center",
  },
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
      model: model,
      json_fields: json_fields,
      fields_name: { 0: "Select One", name: "Name" },
      search_data: {
        pagination: 10,
        field_name: 0,
        value: "",
        status: "",
        type: "",
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
      // axios.get(this.model, this.search_data).then(e => {
      //   this.albums = e.data.data
      // });
    },
    destroy(id) {
      this.deleted_id = id;
      $("#deleteModal").modal("show");
    },
    deleteConfirm() {
      if (!this.delete_password) {
        this.$toast("Password field is required", "error");
        return false;
      }
      let data = {
        for_delete: true,
        id: this.user.id,
        old_password: this.delete_password,
      };
      this.$root.submit = true;
      axios
        .post("/check-old-password", data)
        .then((res) => {
          if (res.data) {
            this.destroy_data(this.model, this.deleted_id, this.search_data);
            this.deleted_id = "";
            this.delete_password = "";

            $("#deleteModal").modal("hide");
          } else {
            this.$toast("Password does not match", "error");
            return false;
          }
        })
        .finally((res) => (this.$root.submit = false));
    },
  },

  created() {
    this.getRouteName(this.model);
    this.setBreadcrumbs(this.model, "index");
    this.search();
  },
  validators: {
    "search_data.status": function (value = null) {
      return Validator.value(value);
    },
  },
};
</script>
