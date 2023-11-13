<template>
  <view-page :defaultTable="false">
    <template v-slot:custom_header>
      <div class="top--title">
        <h4>Title: {{ data?.title }}</h4>
      </div>
    </template>

    <template v-slot:custom_design>
      <div class="col-lg-12 mb-4">
        <div class="event--details--block">
          <h5>Event Details</h5>
          <div class="row">
            <div class="col-lg-2">
              <div class="video--thumbnail--image">
                <img
                  :src="data?.image ? data.thumb_one : emptyImage()"
                  alt=""
                  class="img-fluid w-100"
                />
              </div>
            </div>
            <div class="col-lg-10">
              <div class="table-responsive">
                <table
                  class="table mb-0 table-striped table-bordered"
                  style="border: 1px solid #5f65b9"
                >
                  <tbody>
                    <tr>
                      <th>Category</th>
                      <th width="50" style="text-align: center">:</th>
                      <td>{{ data?.category?.title }}</td>
                    </tr>
                    <tr>
                      <th>Venue</th>
                      <th width="50" style="text-align: center">:</th>
                      <td>
                        <span class="badge bg-dark py-2 fs-6"
                          ><i class="bi bi-geo-alt me-1"></i>
                          {{ data?.venue }}</span
                        >
                      </td>
                    </tr>
                    <tr>
                      <th>Start Date</th>
                      <th width="50" style="text-align: center">:</th>
                      <td>{{ data?.start_date }}</td>
                    </tr>
                    <tr>
                      <th>End Date</th>
                      <th width="50" style="text-align: center">:</th>
                      <td>{{ data?.end_date }}</td>
                    </tr>
                    <tr>
                      <th>Highlight</th>
                      <th width="50" style="text-align: center">:</th>
                      <td>{{ data?.highlighted_text }}</td>
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
      <div class="col-lg-12 mb-4">
        <div class="event--details--block">
          <h5>Event Schedule</h5>
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table
                  class="table mb-0 table-striped table-bordered"
                  style="border: 1px solid #5f65b9"
                >
                  <thead class="table-dark">
                    <tr>
                      <th>Title</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Status</th>
                      <th>Description</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr
                      v-for="(item, index) in data.event_schedules"
                      :key="index"
                    >
                      <td width="250">
                        {{ item?.title }}
                      </td>
                      <td width="120">{{ item?.schedule_date }}</td>
                      <td width="120">{{ item?.schedule_time }}</td>
                      <td width="120">
                        <div
                          :class="[
                            data?.status == 'active'
                              ? 'bg-success'
                              : 'bg-danger ',
                            'text-center',
                            'text-white ',
                          ]"
                        >
                          {{ ucfirst(item?.status) }}
                        </div>
                      </td>
                      <td>{{ item?.description }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 mb-4">
        <div class="event--details--block">
          <h5>Event Description</h5>
          <div class="row">
            <div class="col-lg-12">
              <p v-html="data?.description"></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="event--details--block d-flex flex-column h-100">
          <h5>Meta Keywords</h5>
          <div class="row">
            <div class="col-lg-12">
              <button
                class="btn btn-light border"
                v-for="(item, index) in data.meta_tag"
                :key="index"
              >
                {{ item }}
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="event--details--block d-flex flex-column h-100">
          <h5>Meta Description</h5>
          <div class="row">
            <div class="col-lg-12">
              <p>
                {{ data?.meta_description }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </template>
  </view-page>
</template>

<script>
const model = "events";

export default {
  data() {
    return {
      model: model,
      data: {},
      fileColumns: [{ field: "thumb", title: "Image" }],
    };
  },
  created() {
    this.setBreadcrumbs(this.model, "view");
    this.get_data(`${this.model}/${this.$route.params.id}`);
  },
};
</script>
