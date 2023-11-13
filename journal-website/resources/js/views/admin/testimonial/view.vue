<template>
  <view-page> </view-page>
</template>

<script>

const model = "testimonial";

export default {
  data() {
    return {
      model: model,
      data: {

      },
      fileColumns :[],
    };
  },
  created() {
    this.setBreadcrumbs(this.model, "view");
    this.get_data(`${this.model}/${this.$route.params.id}`);
  },
};
</script>