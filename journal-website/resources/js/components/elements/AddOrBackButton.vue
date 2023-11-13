<template>
  <div class="btn-back position-relative" v-if="inherit == false">
    <router-link
      class="position-absolute btn-back-pos overflow-hidden"
      v-if="$root.checkPermission(route)"
      :to="{
        name: route,
        query: { page: icon != 'plus' ? $route.query.page : '' },
      }"
      :style="icon !== 'plus' ? 'right: -8px;' : ''"
    >
      <div class="combo">
        <template v-if="icon !== 'plus'">
          <i class="fa-solid fa-circle-left text-white"></i>
          <span class="text-white">Back </span>
        </template>

        <template v-else>
          <i class="fa-solid fa-circle-plus text-white"></i>
          <span class="text-white">Add </span>
        </template>
      </div>
    </router-link>
  </div>

  <!-- Gitlab -->

  <!-- <div
    class="col-md-3 col-lg-3 col-xxl-2 ms-auto mt-md-0 mb-3"
    v-if="inherit == false"
  >
    <router-link
      class="add-btn d-flex ms-auto"
      v-if="$root.checkPermission(route)"
      :to="{
        name: route,
        query: { page: icon != 'plus' ? $route.query.page : '' },
      }"
    >
      <div v-if="icon == 'plus'">
        <div class="btn-front">
          <i :class="'fas fa-' + icon" aria-hidden="true"></i> Add
          {{ $filter.capitalize(title ? title : portion) }}
        </div>
        <div class="btn-back">
          <i :class="'fas fa-' + icon" aria-hidden="true"></i> Add
          {{ $filter.capitalize(title ? title : portion) }}
        </div>
      </div>
      <div v-else>
        <div class="btn-front">
          <i :class="'fas fa-' + icon" aria-hidden="true"></i><b>Back</b>
        </div>
        <div class="btn-back">
          <i :class="'fas fa-' + icon" aria-hidden="true"></i><b>Back</b>
        </div>
      </div>
    </router-link>
  </div> -->
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
  props: ["route", "icon", "portion", "title", "extraButtons"],
  computed: {
    ...mapState("inherit", ["backButton"]),
  },
};
</script>

<style scoped>
.btn-back .btn-back-pos {
  top: -20px;
  right: -20px;
  /* width: 30px; */
  border-radius: 20px 0 0 20px;
  transition: 0.6s;
  color: black;
  background-color: #00bcd4;
  box-sizing: border-box;
}
.btn-back .btn-back-pos .combo {
  width: 80px;
  display: flex;
  align-items: center;
}
/* .btn-back .btn-back-pos:hover {
  width: 80px;
} */
.btn-back .btn-back-pos i {
  font-size: 16px;
  padding: 4px 0 5px 5px;
}
.btn-back a span {
  padding-left: 9px;
  text-transform: capitalize;
  font-size: 18px;
  color: white;
  transition: 0.6s ease-out;
}
</style>
