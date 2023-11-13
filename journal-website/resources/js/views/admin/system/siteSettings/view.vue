<template>
  <view-page :defaultTable="false">
    <template v-slot:custom_design>
      <div class="col-lg-12 mb-4">
        <div class="site--setting--details--block">
          <h5>Media</h5>
          <div class="row">
            <div class="col-lg-4">
              <div class="media--logos">
                <h4>Logo</h4>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="image--box text-center">
                      <img
                        :src="data?.logo"
                        alt=""
                        class="img-fluid"
                        width="170"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="media--logos">
                <h4>Logo Small</h4>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="image--box text-center">
                      <img
                        :src="data?.logo_small"
                        alt=""
                        class="img-fluid"
                        width="170"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="media--logos">
                <h4>Favicon Logo</h4>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="image--box text-center">
                      <img
                        :src="data?.favicon"
                        alt=""
                        class="img-fluid"
                        width="50"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="site--setting--details--block d-flex flex-column h-100">
          <h5>Information</h5>
          <div class="table-responsive">
            <table
              class="table mb-0 table-striped table-bordered"
              style="border: 1px solid #5f65b9"
            >
              <tbody>
                <tr>
                  <th>Title</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.title }}</td>
                </tr>
                <tr>
                  <th>Short Title</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.short_title }}</td>
                </tr>
                <tr>
                  <th>Contact Email</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.contact_email }}</td>
                </tr>
                <tr>
                  <th>Feedback Email</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.feedback_email }}</td>
                </tr>
                <tr>
                  <th>Mobile One</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.mobile1 }}</td>
                </tr>
                <tr>
                  <th>Mobile Two</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.mobile2 }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="site--setting--details--block d-flex flex-column h-100">
          <h5>Address</h5>
          <div class="sub--info--block mb-4">
            <!-- <h4 class="pb-2">Address</h4> -->
            <h6>
              {{ data?.address }}
            </h6>
          </div>
          <div class="sub--info--block">
            <h4 class="pb-2">Map</h4>
            <div class="address--maps">
              <iframe
                :src="data?.map"
                width="100%"
                height="180px"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="site--setting--details--block d-flex flex-column h-100">
          <h5>Links</h5>
          <div class="table-responsive">
            <table
              class="table mb-0 table-striped table-bordered"
              style="border: 1px solid #5f65b9"
            >
              <tbody>
                <tr>
                  <th>Web</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.web }}</td>
                </tr>
                <tr>
                  <th>Facebook</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.fb }}</td>
                </tr>
                <tr>
                  <th>Twitter</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.tw }}</td>
                </tr>
                <tr>
                  <th>Linkedin</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.ln }}</td>
                </tr>
                <tr>
                  <th>Youtube</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.yt }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="site--setting--details--block d-flex flex-column h-100">
          <h5>Color</h5>
          <div class="table-responsive">
            <table
              class="table mb-0 table-striped table-bordered"
              style="border: 1px solid #5f65b9"
            >
              <tbody>
                <tr>
                  <th>Sidebar footer color</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.sidebar_footer_color }}</td>
                </tr>
                <tr>
                  <th>Sidebar top color</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.sidebar_top_color }}</td>
                </tr>
                <tr>
                  <th>Sidebar color</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.sidebar_color }}</td>
                </tr>
                <tr>
                  <th>Navbar color</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.navbar_color }}</td>
                </tr>
                <tr>
                  <th>Breadcrumb color</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ data?.breadcrumb_color }}</td>
                </tr>
                <tr>
                  <th>Created at</th>
                  <th width="50" style="text-align: center">:</th>
                  <td>{{ enFormat(data?.created_at) }}</td>
                </tr>
                <tr>
                  <th>Updated at</th>
                  <th width="45" style="text-align: center">:</th>
                  <td>{{ enFormat(data?.updated_at) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </template>
  </view-page>
</template>

<script>
const model = "siteSetting";

export default {
  data() {
    return {
      model: model,
      data: {},
    };
  },
  async created() {
    this.setBreadcrumbs(this.model, "view");
    await this.get_data(`${this.model}/${this.$route.params.id}`);
  },
};
</script>
