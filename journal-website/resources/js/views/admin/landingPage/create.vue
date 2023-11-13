<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <Input
        v-model="data.banner_title"
        field="data.banner_title"
        title="Banner_title"
        :req="false"
      />
      <Input
        v-model="data.banner_description"
        field="data.banner_description"
        title="Banner_description"
        :req="false"
      />
      <Input
        v-model="data.order_now_button"
        field="data.order_now_button"
        title="Order_now_button"
        :req="false"
      />
      <Input
        v-model="data.feature_text"
        field="data.feature_text"
        title="Feature_text"
        :req="false"
      />
      <Input
        v-model="data.demo_link_title"
        field="data.demo_link_title"
        title="Demo_link_title"
        :req="false"
      />
      <Input
        v-model="data.demo_link_url"
        field="data.demo_link_url"
        title="Demo_link_url"
        :req="false"
      />
      <Input
        v-model="data.video_link_url"
        field="data.video_link_url"
        title="Video_link_url"
        :req="false"
      />
      <Input
        v-model="data.video_title"
        field="data.video_title"
        title="Video_link_url"
        :req="false"
      />
      <Input
        v-model="data.video_description"
        field="data.video_description"
        title="Video_link_url"
        :req="false"
      />
      <Input
        v-model="data.testimonial_text"
        field="data.testimonial_text"
        title="Testimonial_text"
        :req="false"
      />
      <!-- <Input
        v-model="data.sorting"
        field="data.sorting"
        title="Sorting"
        :req="false"
      /> -->
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
const model = "landingPage";

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

  validators: {},
};
</script>