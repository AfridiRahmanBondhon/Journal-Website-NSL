<template>
  <view-page :defaultTable="false">
    <template v-slot:custom_header>
      <div class="top--title">
        <h4>Title: {{ data?.title }}</h4>
      </div>
    </template>

    <template v-slot:custom_design>
      <div class="slider--details">
        <div class="slider--details--block">
          <h5>Slider Details</h5>
          <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="slider--image text-center">
                <img :src="data?.thumb_one" alt="" class="img-fluid" />
              </div>
            </div>
            <div class="col-lg-12">
              <div class="slider--info">
                <div class="global-view-table">
                  <div class="table-responsive">
                    <table
                      class="table mb-4 table-striped table-bordered"
                      style="border: 1px solid #5f65b9"
                    >
                      <tbody>
                        <tr>
                          <th>Slider Title (optional)</th>
                          <th width="50" style="text-align: center">:</th>
                          <td>{{ data?.title }}</td>
                        </tr>
                        <tr>
                          <th>Has Button (optional)</th>
                          <th width="50" style="text-align: center">:</th>
                          <td>{{ data?.has_button }}</td>
                        </tr>
                        <tr>
                          <th>Button type</th>
                          <th width="50" style="text-align: center">:</th>
                          <td>{{ data?.button_type }}</td>
                        </tr>
                        <tr>
                          <th>Button name</th>
                          <th width="50" style="text-align: center">:</th>
                          <td>{{ data?.button_name }}</td>
                        </tr>

                        <tr>
                          <th>URL(optional)</th>
                          <th width="50" style="text-align: center">:</th>
                          <td>
                            <a :href="data?.url">{{ data?.url }}</a>
                          </td>
                        </tr>
                        <tr>
                          <th>Status</th>
                          <th width="50" style="text-align: center">:</th>
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
                        </tr>
                        <tr>
                          <th>Sorting</th>
                          <th width="50" style="text-align: center">:</th>
                          <td>{{ data?.sorting }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slider--details--block">
          <h5>Description</h5>
          <div class="row">
            <div class="col-lg-12">
              <div class="slider--description">
                <p v-html="data?.description"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </view-page>
</template>

<script>
const model = "slider-details";

export default {
  data() {
    return {
      model: model,
      data: {},
    };
  },
  created() {
    this.setBreadcrumbs(this.model, "view");
    this.get_data(`${this.model}/${this.$route.params.id}`);
  },
};
</script>
