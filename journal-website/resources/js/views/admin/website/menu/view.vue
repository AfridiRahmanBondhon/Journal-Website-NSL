<template>
  <view-page></view-page>
</template>

<script>
const model = "frontMenu";

export default {
  data() {
    return {
      model: model,
      data: {},
    };
  },
  created() {
    this.setBreadcrumbs(this.model, "view", "Frontend Menu");
    this.get_data(`${this.model}/${this.$route.params.id}`);
  },
};
</script>
