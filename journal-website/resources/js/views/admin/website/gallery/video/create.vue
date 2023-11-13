<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <div class="row">
        <div class="col-xl-2 col-lg-3">
          <File
            title="Thumbnail"
            field="data.original_image"
            mime="img"
            fileClassName="file2"
            :req="true"
            :showCrop="true"
            vHeight="400"
            vWidth="400"
            vSizeInKb="500"
          />
        </div>
        <div class="col-xl-10 col-xl-9">
          <div class="row">
            <v-select-container title="Album" :req="true" field="data.album_id">
              <v-select
                v-model="data.album_id"
                label="name"
                :reduce="(obj) => obj.id"
                :options="albums"
                placeholder="--Select Any--"
                :closeOnSelect="true"
                :require="true"
              ></v-select>
            </v-select-container>

            <Input
              v-model="data.title"
              field="data.title"
              title="Title"
              col="9"
              :req="true"
            />

            <Input
              type="url"
              v-model="data.url"
              field="data.url"
              title="URL"
              placeholder="https://www.xyz.com"
              :req="true"
              col="10"
            />

            <Input
              type="number"
              title="Sorting"
              field="data.sorting"
              v-model="data.sorting"
              col="2"
              :req="true"
            />

            <Switch
              v-model="data.status"
              on-label="Active"
              off-label="Deactive"
              :req="true"
            ></Switch>
          </div>
        </div>
      </div>

      <GlobalCrop
        field="data.original_image"
        v-on:update:modelValue="data.original_image = $event"
        :image="image.original_image"
        :aspectRatio="{ aspectRatio: 400 / 400 }"
        :minWidth="400"
        :minHeight="400"
      ></GlobalCrop>
    </div>
    <Button title="Submit" class="aus-btn" process="" />
  </create-form>
</template>

<script>
const model = "video";

export default {
  data() {
    return {
      model: model,
      data: { original_image: "", album_id: "", status: "active" },
      image: { original_image: "" },
      albums: [],
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
          formData.append("image_base64", this.data.original_image);
          formData.append("album_id", this.data.album_id);
          formData.append("url", this.data.url);
          formData.append("status", this.data.status);

          if (this.data.id) {
            this.update(this.model, formData, this.data.id, "image");
          } else {
            this.store(this.model, formData);
          }
        }
      });
    },
    getAlbum() {
      axios.get("/get-album/Videos").then((res) => (this.albums = res.data));
    },
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, "edit");
      this.get_data(`${this.model}/${this.$route.params.id}`);
    } else {
      this.setBreadcrumbs(this.model, "create");
      this.get_sorting("Website-Gallery-Video");
    }
    this.getAlbum();
  },

  validators: {
    "data.title": function (value = null) {
      return Validator.value(value).required("Title is required");
    },
    "data.album_id": function (value = null) {
      return Validator.value(value).required("Album is required");
    },
    "data.original_image": function (value = null) {
      return Validator.value(value).required("Image is required");
    },
    "data.url": function (value = null) {
      return Validator.value(value).required("URL is required").url();
    },
    "data.sorting": function (value = null) {
      return Validator.value(value)
        .digit()
        .regex("^[0-9]*$")
        .required("Sorting is required");
    },
  },
};
</script>
