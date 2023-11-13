<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <Input
        v-model="data.category_id"
        field="data.category_id"
        title="Category_id"
        :req="true"
      />
      <Input
        v-model="data.title"
        field="data.title"
        title="Title"
        :req="false"
      />
      <Input
        v-model="data.description"
        field="data.description"
        title="Description"
        :req="true"
      />
      <Input
        v-model="data.sorting"
        field="data.sorting"
        title="Sorting"
        :req="false"
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
const model = "feature";

export default {
  data() {
    return {
      model: model,
      data: {},
    };
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
    "data.category_id": function (value = null) {
      return Validator.value(value).required("Category id is required");
    },
    "data.description": function (value = null) {
      return Validator.value(value).required("Description is required");
    },
  },
};
</script>