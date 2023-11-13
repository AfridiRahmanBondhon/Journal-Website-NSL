<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <File
        title="Image"
        field="data.original_image"
        mime="img"
        fileClassName="file2"
        :showCrop="true"
        vHeight="300"
        vWidth="300"
        vSizeInKb="500"
        col="3 col-xl-2"
      />

      <GlobalCrop
        field="data.original_image"
        v-on:update:modelValue="data.original_image = $event"
        :image="image.original_image"
        :aspectRatio="{ aspectRatio: 477 / 365 }"
        :minWidth="477"
        :minHeight="365"
      ></GlobalCrop>

      <Input
        v-model="data.title"
        field="data.title"
        title="Title"
        :req="true"
        col="12 col-sm-12"
      />

      <div class="col-12">
        <label class="form-label">Description</label>
        <div class="col-12">
          <editor v-model="data.description" name="description" />
        </div>
      </div>

      <div class="col-lg-2 mb-3">
        <label class="form-label">Meta</label>
        <div class="d-flex justify-content-between">
          <div class="form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="exampleCheck1"
              :checked="data.is_meta == true ? true : false"
              v-model="data.is_meta"
            />
            <label class="form-check-label" for="radio0">Active</label>
          </div>
        </div>
      </div>

      <template v-if="data.is_meta == true">
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
      </template>

      <Switch
        v-model="data.status"
        on-label="Active"
        off-label="Deactive"
        :req="true"
      ></Switch>
    </div>
    <Button title="Submit" class="aus-btn mt-3" process="" />
  </create-form>
</template>

<script>
const model = "content";
import Editor from "../../../../components/Form/CKEditor";

export default {
  components: { Editor },
  data() {
    return {
      model: model,
      data: {
        status: "active",
        original_image: "",
        description: "",
        meta_tag: [],
        meta_description: "",
        is_meta: false,
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
  watch: {
    $route: {
      handler: "asyncData",
      immediate: true,
    },
  },
  methods: {
    asyncData() {
      if (this.$route.params.slug) {
        this.get_data(`${this.model}/${this.$route.params.slug}`);
        var breadcrumb = [
          {
            route: model + ".create",
            title: model + " Create",
            slug: this.$route.params.slug ? this.$route.params.slug : "",
          },
        ];
        this.$store.dispatch("breadcrumb/storeLevels", breadcrumb);
      }
    },

    submit: function () {
      const error = this.validation.countErrors();
      this.$validate().then((res) => {
        if (error > 0) {
          this.toast(
            "You need to fill " + error + " more empty mandatory fields",
            "warning"
          );
          return false;
        }

        if (res) {
          this.$root.submit = true;
          var form = document.getElementById("form");
          var formData = new FormData(form);

          if (this.data.description) {
            formData.append("description", this.data.description);
          }

          if (this.data.meta_tag) {
            formData.append("meta_tag", this.data.meta_tag);
          }
          if (this.data.meta_description) {
            formData.append("meta_description", this.data.meta_description);
          }

          formData.append("slug", this.$route.params.slug);
          formData.append("image", this.data.image);
          formData.append("image_base64", this.data.original_image);
          formData.append("is_meta", this.data.is_meta);

          axios
            .post("/content", formData)
            .then((res) => {

              if (res.data.slug) {
                this.$toast(res.data.message, res.data.type);
                this.$router.push({
                  name: "content.show",
                  params: { slug: res.data.slug },
                });
                return;
              }

              if (res.data.message) {
                this.$toast(res.data.message, "success");
                this.$router.push({
                  name: "content.show",
                  params: { slug: this.$route.params.slug },
                });
              } else if (res.data.error) {
                this.$toast(res.data.error, "error");
                setTimeout(() => {
                  location.reload();
                }, 100);
              } else if (res.data.warning) {
                this.$toast(res.data.warning, "warning");
                this.$router.push({
                  name: "content.show",
                  params: { slug: this.$route.params.slug },
                });
              }
            })
            .catch((error) => console.log(error))
            .then((alw) => setTimeout(() => (this.$root.submit = false), 200));
        }
      });
    },
  },
  created() {
    if (this.$route.params.slug) {
      let slug = this.$route.params.slug;
      let title = slug.replace("-", " ");
      this.setBreadcrumbs(this.model, "edit", title);
    } else {
      this.setBreadcrumbs(this.model, "create");
    }
  },
  validators: {
    "data.title": function (value = null) {
      return Validator.value(value).required("Title is required");
    },
    "data.status": function (value = null) {
      return Validator.value(value).required("Status is required");
    },
  },
};
</script>
