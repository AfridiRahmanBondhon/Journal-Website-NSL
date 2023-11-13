<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <v-select-container title="Album">
        <v-select
          v-model="data.album_id"
          name="album_id"
          label="name"
          :reduce="(obj) => obj.id"
          :options="albums"
          placeholder="--Select Any--"
          :closeOnSelect="true"
        ></v-select>
        <span
          v-if="validation.hasError('data.album_id')"
          class="input-message danger"
        >
          {{ validation.firstError("data.album_id") }}
        </span>
      </v-select-container>

      <div class="mb-3 col-sm-6 col-lg-4">
        <label class="form-label">
          Image <sup class="text-danger">*</sup>
        </label>
        <div class="input-group position-relative">
          <input
            class="form-control form-control-sm"
            type="file"
            accept="image/*"
            multiple
            name="files[]"
            v-on:change="previewImages()"
          />
        </div>
      </div>

      <div class="w-100"></div>

      <template v-if="Object.keys(data.uploaded_images).length > 0">
        <div
          v-for="(img, key) in data.uploaded_images"
          :key="key"
          class="col-3"
        >
          <div
            style="
              box-shadow: 0px 5px 30px 0px rgba(0, 0, 0, 0.1);
              border: 1px solid #ddd;
            "
            class="item-blcok mb-2 p-3"
          >
            <div class="img d-flex justify-content-between">
              <img :src="img.image" alt="" style="height: 50px" />
              <input
                v-model="img.sorting"
                style="width: 80px"
                type="number"
                class="text-center form-control form-control-sm rounded-0 mt-2"
                :name="`uploaded_images[${key}][sorting]`"
                placeholder="Sorting"
              />
              <i
                class="fa fa-times text-danger"
                style="cursor: pointer"
                @click="data.uploaded_images.splice(key, 1)"
              ></i>
            </div>
            <div class="text pt-2 mt-3 mb-3">
              <label class="w-100 d-block fw-bold">Title</label>
              <input
                v-model="img.title"
                type="text"
                class="form-control form-control-sm rounded-0"
                placeholder="Title"
                :name="`uploaded_images[${key}][title]`"
              />
            </div>

            <Radio
              :field="`uploaded_images[${key}][status]`"
              title="Status"
              :list="[
                { value: 'active', title: 'Active' },
                { value: 'deactive', title: 'Deactive' },
              ]"
              :req="true"
              col="3"
              :isChecked="true"
            />
          </div>
        </div>
      </template>
    </div>
    <!--
    <Switch
      v-model="data.status"
      on-label="Active"
      off-label="Deactive"
      :req="true"
    ></Switch> -->

    <Button
      v-if="Object.keys(data.uploaded_images).length > 0"
      title="Submit"
      process=""
      class="mt-2"
    />
  </create-form>
</template>

<script>
const model = "photo";

export default {
  data() {
    return {
      model: model,
      data: {
        album_id: null,
        sorting: 0,
        uploaded_images: [],
        status: "active",
      },
      image: { image: "" },
      albums: [],
      image: {},
    };
  },
  provide() {
    return {
      validate: this.validation,
      data: () => this.data,
      image: this.image,
    };
  },
  methods: {
    submit: function (e) {
      this.$validate().then((res) => {
        const error = this.validation.countErrors();
        if (error > 0) {
          console.log(this.validation.allErrors());
          this.$toast(
            "You need to fill " + error + " more empty mandatory fields",
            "warning"
          );
        }

        if (res) {
          var form = document.getElementById("form");
          var formData = new FormData(form);
          formData.append("album_id", this.data.album_id);

          if (Object.keys(this.data.uploaded_images).length == 0) {
            this.notification("Please select image", "error");
            return false;
          }

          this.store(this.model, formData);
        }
      });
    },
    previewImages() {
      let vm = this;
      vm.data.uploaded_images = [];
      let files = $("input[type='file']")[0].files;

      if (files.length > 20) {
        vm.notification("You can select max 20 images", "error");
        return false;
      }

      $.each(files, function (i, file) {
        let obj = {
          image: URL.createObjectURL(file),
          title: "",
          sorting: vm.data.sorting + i + 1,
        };
        vm.data.uploaded_images.push(obj);
      });
    },
    getAlbum() {
      axios.get("/get-album/Photos").then((res) => (this.albums = res.data));
    },
  },
  created() {
    this.setBreadcrumbs(this.model, "create");
    this.getAlbum();
    this.get_sorting("Website-Gallery-Photo");
    this.data.album_id = this.$route.query.id
      ? Number(this.$route.query.id)
      : "";
  },

  validators: {
    "data.album_id": function (value = null) {
      return Validator.value(value).required("Album is required");
    },
  },
};
</script>
