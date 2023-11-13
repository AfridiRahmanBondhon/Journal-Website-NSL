<template>
    <view-page :defaultTable="false">
      <template v-slot:custom_header>
        <div class="top--title">
          <h4>Title: {{ data?.title }}</h4>
        </div>
      </template>

      <template v-slot:custom_design>
        <div class="col-lg-7">
          <div class="video--details--block d-flex flex-column h-100">
            <h5>{{ ucfirst(model) }} Details</h5>
            <div class="row">

              <div class="col-lg-12">
                <div class="table-responsive">
                  <table
                    class="table mb-4 table-striped table-bordered"
                    style="border: 1px solid #5f65b9"
                  >
                    <tbody>
                      <tr>
                        <th>Module Name</th>
                        <th width="50" style="text-align: center">:</th>
                        <td>
                          {{ data?.module_name }}
                        </td>
                      </tr>

                      <tr>
                        <th>Sorting</th>
                        <th width="50" style="text-align: center">:</th>
                        <td>
                          {{ data?.sorting }}
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
      </template>
    </view-page>
  </template>

  <script>
  const model = "category";

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
