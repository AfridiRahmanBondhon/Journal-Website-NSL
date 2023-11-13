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
          />
        </div>
        <div class="col-xl-10 col-xl-9">
          <div class="row">
            <date-picker
              id="date"
              v-model="data.date"
              field="data.date"
              name="date"
              title="Date"
              placeholder="dd/mm/yyyy"
              class="mb-lg-0"
              col="2"
              :req="true"
            >
            </date-picker>

            <v-select-container
              field="data.category_id"
              :req="true"
              col="2"
              title="Category"
            >
              <v-select
                v-model="data.category_id"
                label="title"
                :reduce="(obj) => obj.id"
                :options="categories"
                placeholder="--Select One--"
                :closeOnSelect="true"
                :req="true"
              ></v-select>
            </v-select-container>

            <Input
              v-model="data.title"
              field="data.title"
              title="Title"
              :req="true"
              col="7"
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

      <div class="col-12 mb-3">
        <label class="form-label">Description</label>
        <div class="col-12">
          <editor v-model="data.description" />
        </div>
      </div>

      <div class="col-12 mb-3">
        <label class="form-label">Meta Keywords(Optional)</label>
        <v-select
          taggable
          multiple
          name="meta_tag"
          v-model="data.meta_tag"
          no-drop
        ></v-select>
      </div>
      <div class="col-12 mb-3">
        <div class="form-element">
          <label for="" class="form-label">Meta Description(Optional)</label>
          <textarea
            name="meta_description"
            v-model="data.meta_description"
            class="form-control"
            id=""
            cols="30"
            rows="3"
          ></textarea>
        </div>
      </div>
    </div>
    <Button title="Submit" class="aus-btn" process="" />
  </create-form>
</template>

<script>
const model = "news";
import { mapState } from "vuex";
import Editor from "../../../../components/Form/CKEditor";

export default {
  components: { Editor },
  computed: {
    ...mapState("category", ["categories"]),
  },
  data() {
    return {
      model: model,
      data: {
        category_id: "",
        sorting: 0,
        status: "active",
      },
      image: { original_image: "" },
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

          if (this.data.meta_tag) {
            formData.append("meta_tag", this.data.meta_tag);
          }

          formData.append("image_base64", this.data.original_image);
          formData.append("category_id", this.data.category_id);
          formData.append("description", this.data.description);
          formData.append("status", this.data.status);

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
      this.get_sorting("Website-News");
    }
    this.$store.dispatch("category/getCategory", { transfer: "News" });
  },
  validators: {
    "data.date": function (value = null) {
      return Validator.value(value).required("Date is required");
    },
    "data.category_id": function (value = null) {
      return Validator.value(value).required("Category is required");
    },
    "data.original_image": function (value = null) {
      return Validator.value(value).required("Image is required");
    },
    "data.title": function (value = null) {
      return Validator.value(value)
        .maxLength(191)
        .required("Title is required");
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
