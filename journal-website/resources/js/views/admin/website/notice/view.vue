<template>
  <view-page :defaultTable="false">
    <template v-slot:custom_header>
      <div class="top--title">
        <h4>Title: {{ data?.title }}</h4>
      </div>
    </template>

    <template v-slot:custom_design>
      <div class="box-body mt-4">
        <div class="row mt-3" style="text-align: justify">
          <div class="col-12 col-sm-6 order-1 order-sm-0 pt-3 pt-sm-0">
            <div class="content-text p-4 d-flex">
              <div class="card position-relative w-100 border-0">
                <div class="card-img" v-if="data.file">
                  <a :href="data.file" target="_blank">
                    <img
                      :src="pdfImage()"
                      class="card-img-top img-fluid"
                      alt=""
                    />
                  </a>
                </div>
                <hr />
                <div class="table-cont position-relative">
                  <div class="overly"><p>Notice Details</p></div>
                  <table
                    class="table table-bordered table-striped"
                    style="width: 100%"
                  >
                    <tbody>
                      <tr>
                        <th>Notice Start</th>
                        <td>:</td>
                        <td>{{ enFormat(data?.notice_date) }}</td>
                      </tr>
                      <tr>
                        <th>Notice End</th>
                        <td>:</td>
                        <td>{{ enFormat(data?.notice_end) }}</td>
                      </tr>
                      <tr>
                        <th>Type</th>
                        <td>:</td>
                        <td>{{ data?.type }}</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td>:</td>
                        <td>
                          <div
                            :class="[
                              data?.status == 'active'
                                ? 'bg-success'
                                : 'bg-danger ',
                              'text-center',
                              'text-white ',
                            ]"
                          >
                            {{ ucfirst(data?.status) }}
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th>Created At</th>
                        <td>:</td>
                        <td>{{ enFormat(data?.created_at) }}</td>
                      </tr>
                      <tr>
                        <th>Updated At</th>
                        <td>:</td>
                        <td>{{ enFormat(data?.updated_at) }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div
            class="col-12 col-sm-6 order-1 order-sm-0 pt-3 pt-sm-0"
            v-if="notice?.type !== 'file'"
          >
            <div class="content-text p-4 d-flex">
              <div class="card-body">
                <h5 class="card-title">Notice Description</h5>
                <p class="card-text" v-html="data?.description"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </view-page>
</template>

<script>
const model = "notice";

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
