
<template>
  <!-- Consultency Action Modal -->
  <div
    class="modal fade"
    id="showCropModal"
    tabindex="-1"
    aria-labelledby="deleteModalLabel"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <template v-if="minHeight">
            <h5 class="modal-title text-black" id="deleteModalLabel">
              <i class="fa-solid fa-crop"></i>
              {{
                `Crop Image [Minimum Height: ${minHeight}px & Width: ${minHeight}px]`
              }}
            </h5>
          </template>
          <template v-else>
            <h5 class="modal-title text-black" id="deleteModalLabel">
              <i class="fa-solid fa-crop"></i>
              {{ `Crop Image (Height: ${height}px,Width: ${height}px)` }}
            </h5>
          </template>

          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            @click.prevent="removeImage"
          ></button>
        </div>
        <div class="modal-body">
          <cropper
            ref="cropper"
            :src="image"
            :stencil-props="aspectRatio"
            :default-size="defaultSize"
            :minHeight="minHeight"
            :minWidth="minWidth"
            :lines="lines"
            backgroundClassname="cropper-background"
          ></cropper>

          <div class="text-center">
            <button
              class="btn btn-sm text-white bg-dark mx-1 my-2"
              @click.prevent="zoom(2)"
            >
              <i class="fa-solid fa-magnifying-glass-plus"></i>
            </button>
            <button
              class="btn btn-sm text-white bg-dark mx-1 my-2"
              @click.prevent="zoom(0.5)"
            >
              <i class="fa-solid fa-magnifying-glass-minus"></i>
            </button>
            <button
              class="btn btn-sm text-white bg-dark mx-1 my-2"
              @click.prevent="flip(true, false)"
            >
              <i class="fa-solid fa-arrow-right-arrow-left"></i>
            </button>
            <button
              @click.prevent="flip(false, true)"
              class="btn btn-sm text-white bg-dark mx-1 my-2"
            >
              <i class="fa-solid fa-arrow-up-long"></i>
              <i class="fa-solid fa-arrow-down-long"></i>
            </button>

            <button
              class="btn btn-sm text-white bg-dark mx-1 my-2"
              @click.prevent="rotate(90)"
            >
              <i class="fa-solid fa-rotate-left"></i>
            </button>
            <button
              class="btn btn-sm text-white bg-dark mx-1 my-2"
              @click.prevent="rotate(-90)"
            >
              <i class="fa-solid fa-rotate-right"></i>
            </button>
            <button
              class="btn btn-sm text-white bg-dark mx-1 my-2"
              @click.prevent="reset"
            >
              <i class="fa fa-refresh" aria-hidden="true"></i>
            </button>
          </div>

          <div class="col-12 text-center">
            <hr />
            <span
              class="btn btn-lg text-white bg-dark mx-1 my-2"
              @click="cropImage"
            >
              <i class="fa-solid fa-crop"></i> Crop Image
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { Cropper } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";
import { mapState, mapMutations } from "vuex";

export default {
  name: "CropImage",
  components: {
    Cropper,
  },
  props: {
    image: String,
    aspectRatio: Object,
    width: Number,
    height: Number,
    field: String,
    minHeight: Number,
    minWidth: Number,
  },
  data() {
    return {
      lines: {
        north: true,
        west: true,
        south: true,
        east: true,
      },
    };
  },
  methods: {
    zoom(value) {
      this.$refs.cropper.zoom(value);
    },
    reset() {
      this.$refs.cropper.reset();
    },
    flip(x, y) {
      this.$refs.cropper.flip(x, y);
    },
    rotate(angle) {
      this.$refs.cropper.rotate(angle);
    },
    defaultSize() {
      return {
        width: this.width,
        height: this.height,
      };
    },
    removeImage() {
      console.log("Remove Image!");
      this.setRemove(true);
    },
    cropImage() {
      const result = this.$refs.cropper.getResult();
      this.$emit("update:modelValue", result.canvas.toDataURL("image/jpeg"));
      this.$toast("Image Cropped Successfully", "success");
      $("#showCropModal").modal("hide");
    },
    ...mapMutations("crop", ["setRemove"]),
  },
};
</script>

<style >
.vue-advanced-cropper {
  height: 350px !important;
  background: #ddd !important;
}
.cropper-background {
  background: white;
}
</style>
