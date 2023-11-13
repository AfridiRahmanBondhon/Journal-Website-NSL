<template>
  <view-page :defaultTable="false">
    <template v-slot:custom_header>
      <div class="top--title">
        <h4>Question: {{ data?.question }}</h4>
      </div>
    </template>

    <template v-slot:custom_design>
      <div class="col-lg-12 mb-4">
        <div class="event--details--block">
          <h5>Faq Details</h5>
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table
                  class="table mb-0 table-striped table-bordered"
                  style="border: 1px solid #5f65b9"
                >
                  <tbody>
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

      <div class="col-lg-12">
        <div class="event--details--block">
          <h5>Faq Answer</h5>
          <div class="row">
            <div class="col-lg-12">
              <p v-html="data?.answer"></p>
            </div>
          </div>
        </div>
      </div>
    </template>
  </view-page>
</template>

<script>
const model = "faq";

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
