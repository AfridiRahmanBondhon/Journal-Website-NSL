<template>
  <div class="content-part">
    <div class="inner-content">
      <AddOrBackButton
        :route="model + '.index'"
        :portion="model"
        :icon="'fas fa-backward'"
      />

      <div class="box box-success" v-if="!$root.spinner">
        <div class="box-header with-border">
          <h3 class="box-title">{{ ucfirst(model) + " View" }}</h3>

          <!--============ Add or Back Button Start ============-->
          <div class="row">
            <div class="col-12">
              <div class="box-tools pull-right float-end">
                <router-link
                  :to="{ name: model + '.edit' }"
                  class="btn btn-xs btn-info pull-left text-white me-2"
                  title="Add File"
                >
                  <i class="fas fa-edit"></i>
                  <span class="text-capitalize"> Update</span>
                </router-link>
                <router-link
                  :to="{ name: model + '.file' }"
                  class="btn btn-xs btn-info pull-left text-white me-2"
                  title="Add File"
                >
                  <i class="fa fa-plus"></i>
                  <span class=""> File</span>
                </router-link>
              </div>
            </div>
          </div>

          <!--============ Add or Back Button End ============-->
        </div>

        <div class="box-body mt-4">
          <div class="row">
            <div class="col-12 col-sm-12">
              <h5 class="des-ti">Title : {{ data.title }}</h5>
            </div>
          </div>

          <div class="row mt-3" style="text-align: justify">
            <div class="col-sm-8 col-12 order-1 order-sm-0 pt-3 pt-sm-0">
              <div class="content-text p-4" v-html="data.description"></div>
            </div>
            <div class="col-12 col-sm-4 order-0 order-sm-1">
              <div class="content-img">
                <img
                  class="img-width"
                  :src="
                    data.thumb_one
                      ? data.thumb_one
                      : `${$root.baseurl}/images/noimage.png`
                  "
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- content file -->
      <slot v-if="data && data.content_files">
        <div
          class="box box-success pt-3"
          v-if="Object.keys(data.content_files).length > 0"
        >
          <div class="box-header with-border">
            <h3 class="box-title">{{ ucfirst(model) + " File" }}</h3>
          </div>

          <div class="box-body pt-3">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th class="sl text-center">#</th>
                  <th>Title</th>
                  <th class="action">File</th>
                </tr>
              </thead>
              <tbody>
                <slot v-for="(dataFile, index) in data.content_files">
                  <tr :key="index">
                    <td class="text-center" width="5%;">{{ index + 1 }}</td>
                    <td>{{ dataFile.title }}</td>
                    <td class="action" width="20%;">
                      <a
                        target="_blank"
                        :href="
                          $root.baseurl + '/public/storage/' + dataFile.file
                        "
                        class="delete view action-view me-2"
                      >
                        <i class="fa fa-eye"></i>
                      </a>
                      <a
                        v-if="$root.checkPermission('content.destroy')"
                        @click="destroy(dataFile.id, index)"
                        class="delete delete-btn"
                        title="Delete"
                      >
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                </slot>
              </tbody>
            </table>
          </div>
        </div>
      </slot>
      <!-- content file -->
    </div>
  </div>
</template>

<script>
const model = "content";

export default {
  data() {
    return {
      model: model,
      data: [],
    };
  },
  methods: {
    destroy(id, index) {
      if (confirm("Are you sure want to delete?")) {
        this.$root.spinner = true;
        const params = { file: true };
        axios
          .delete("/" + this.model + "/" + id, { params })
          .then((res) => {
            if (index !== -1) {
              this.data.content_files.splice(index, 1);
            }
          })
          .catch((error) => console.log(error))
          .then((alw) => setTimeout(() => (this.$root.spinner = false), 200));
      }
    },
  },
  created() {
    this.setBreadcrumbs(this.model, "view");
    this.get_data(`${this.model}/${this.$route.params.slug}`);
  },
};
</script>

<style scoped>
.img-width {
  width: 80%;
  max-width: 100%;
}
</style>
