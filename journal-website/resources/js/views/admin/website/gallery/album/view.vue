
<template>
  <view-page :defaultTable="false">
    <template v-slot:custom_header>
      <div class="top--title">
        <h4>Album: {{ data?.name }}</h4>
      </div>
    </template>

    <template v-slot:custom_design>
      <div class="col-lg-7">
        <div class="video--details--block d-flex flex-column h-100">
          <h5>{{ ucfirst(model) }} Details</h5>
          <div class="row">
            <div class="col-lg-4">
              <div class="video--thumbnail--image">
                <img
                  :src="data?.thumb_one ? data.thumb_one : emptyImage()"
                  alt=""
                  class="img-fluid w-100"
                />
              </div>
            </div>
            <div class="col-lg-8">
              <div class="table-responsive">
                <table
                  class="table mb-4 table-striped table-bordered"
                  style="border: 1px solid #5f65b9"
                >
                  <tbody>
                    <tr>
                      <th>Type</th>
                      <th width="50" style="text-align: center">:</th>
                      <td>
                        {{ data?.type }}
                      </td>
                    </tr>

                    <tr>
                      <th>Status</th>
                      <th width="50" style="text-align: center">:</th>
                      <td>
                        <span
                          :class="[
                            data?.status == 'active'
                              ? 'bg-success'
                              : 'bg-danger ',
                            'badge mt-1 mx-2',
                            'text-white ',
                          ]"
                        >
                          {{ ucfirst(data?.status) }}
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <template v-if="data?.type == 'Photos'">
        <div class="col-lg-12 mt-5">
          <div class="gallery-list">
            <div class="row">
              <template v-for="(item, index) in data?.photos" :key="index">
                <div class="col-sm-3">
                  <div class="image">
                    <img
                      style="object-fit: contain"
                      :src="item?.thumb"
                      :alt="item?.title"
                    />
                  </div>
                  <div class="mt-2 p-1 bg-info text-white" v-if="item.title">
                    <h6 class="text-center">{{ item.title }}</h6>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>
      </template>
    </template>
  </view-page>
</template>

<script>
const model = "album";

export default {
  data() {
    return {
      model: model,
      data: {},
      fileColumns: [],
    };
  },
  created() {
    this.setBreadcrumbs(this.model, "view");
    this.get_data(`${this.model}/${this.$route.params.id}`);
  },
};
</script>
