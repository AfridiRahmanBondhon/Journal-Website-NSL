<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <div class="row">
        <div class="col-xl-2 col-lg-3">
          <File
            title="Image"
            field="data.original_image"
            mime="img"
            fileClassName="file2"
            :showCrop="true"
            col="12"
            vHeight="600"
            vWidth="600"
            vSizeInKb="500"
            :req="true"
          />
        </div>
        <div class="col-xl-10 col-xl-9">
          <div class="row">
            <v-select-container
              title="Type"
              class=""
              field="data.type"
              :req="true"
            >
              <v-select
                v-model="data.type"
                label="name"
                :reduce="(obj) => obj.value"
                :options="types"
                placeholder="--Select One--"
                :closeOnSelect="true"
                :req="true"
              ></v-select>
            </v-select-container>

            <Input
              v-model="data.name"
              field="data.name"
              title="Name"
              :req="true"
              col="6"
            />

            <Input
              title="Sorting"
              field="data.sorting"
              v-model="data.sorting"
              :req="true"
              col="3"
              type="number"
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
        :aspectRatio="{ aspectRatio: 600 / 600 }"
        :minWidth="600"
        :minHeight="600"
      ></GlobalCrop>
    </div>
    <Button title="Submit" class="aus-btn" process="" />
  </create-form>
</template>

<script>
const model = "album";

export default {
  data() {
    return {
      model: model,
      data: { type: "", image: "", sorting: 0, status: "active" },
      image: { original_image: "" },
      types: [
        { name: "Photos", value: "Photos" },
        { name: "Videos", value: "Videos" },
      ],
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
          formData.append("type", this.data.type);
          formData.append("image_base64", this.data.original_image);

          if (this.data.id) {
            this.update(this.model, formData, this.data.slug, "image");
          } else {
            this.store(this.model, formData);
          }
        }
      });
    },
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, "edit");
      this.get_data(`${this.model}/${this.$route.params.id}`);
    } else {
      this.setBreadcrumbs(this.model, "create");
      this.get_sorting("Website-Gallery-Album");
    }
  },

  validators: {
    "data.name": function (value = null) {
      return Validator.value(value).maxLength(191).required("Name is required");
    },
    "data.sorting": function (value = null) {
      return Validator.value(value)
        .digit()
        .regex("^[0-9]*$")
        .required("Sorting is required");
    },
    "data.original_image": function (value = null) {
      return Validator.value(value).required("Image is required");
    },
  },
};
</script>
