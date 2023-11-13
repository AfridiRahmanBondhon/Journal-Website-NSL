<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <Input
        v-model="data.banner_heading"
        field="data.banner_heading"
        title="Banner_heading"
        :req="false"
      />
      <Input
        v-model="data.banner_text"
        field="data.banner_text"
        title="Banner_text"
        :req="false"
      />
      <div class="col-xl-2 col-lg-3">
        <File
          title="banner_img1"
          field="data.banner_img1"
          mime="img"
          fileClassName="file2"
          :req="true"
          vHeight="10"
          vWidth="10"
          vSizeInKb="400"
          :deleteButton="false"
        />
      </div>
      <!-- <div class="col-xl-2 col-lg-3">
        <File
          title="banner_img2"
          field="data.banner_img2"
          mime="img"
          fileClassName="file2"
          :req="true"
          vHeight="50"
          vWidth="50"
          vSizeInKb="300"
          :deleteButton="false"
        />
      </div>
      <div class="col-xl-2 col-lg-3">
        <File
          title="banner_img3"
          field="data.banner_img3"
          mime="img"
          fileClassName="file2"
          :req="true"
          vHeight="50"
          vWidth="50"
          vSizeInKb="300"
          :deleteButton="false"
        />
      </div> -->
      <Input
        v-model="data.banner_url"
        field="data.banner_url"
        title="Banner_url"
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
const model = "bannerModule";

export default {
  data() {
    return {
      model: model,
      data: {
        banner_img1:'',
      },
      // image:{
      //   banner_img1:'',
      // }
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
          //formData.append("image_base64", this.data.banner_img1);
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