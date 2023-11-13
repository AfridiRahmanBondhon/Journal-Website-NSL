<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <Input v-model="data.name" field="data.name" title="Name" :req="true" />
      <Input
        v-model="data.designation"
        field="data.designation"
        title="Designation"
        :req="true"
      />
      <Input
        v-model="data.description"
        field="data.description"
        title="Description"
        :req="false"
      />
      <File
          title="Image"
          field="data.image"
          mime="img"
          fileClassName="file2"
          :req="true"
          vHeight="10"
          vWidth="10"
          vSizeInKb="400"
          :deleteButton="false"
        />
      <Switch
        v-model="data.status"
        field="data.status"
        title="status"
        on-label="Active"
        off-label="Deactive"
        :req="true"
      ></Switch>
    </div>
    <Button
      title="Submit"
      class="mt-5 btn btn2 shadow-none btn-primary aus-btn"
      process=""
    />
  </create-form>
</template>

<script>
const model = "testimonial";

export default {
  data() {
    return {
      model: model,
      data: {
        image:'',
      },
      image:{
        image:'',
      }
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
          return false;
        }

        if (res) {
          var form = document.getElementById("form");
          var formData = new FormData(form);
          formData.append("status", this.data.status);
          if (this.data.id) {
            this.update(this.model, formData, this.data.id, true);
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
    }
  },

  validators: {
    "data.name": function (value = null) {
      return Validator.value(value)
        .required("Name is required")
        .minLength(3)
        .maxLength(35);
    },
    "data.designation": function (value = null) {
      return Validator.value(value).required("Designation is required");
    },
  },
};
</script>