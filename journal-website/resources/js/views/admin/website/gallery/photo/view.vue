
  <template>
  <view-page :defaultTable="false">
    <template v-slot:custom_header>
      <div class="top--title">
        <h4>Album: {{ data?.album?.name }}</h4>
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
                  :src="data.thumb ? data.thumb : emptyImage()"
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
                      <th>Album</th>
                      <th width="50" style="text-align: center">:</th>
                      <td>
                        <router-link
                          :to="{
                            name: 'album.show',
                            params: { id: data?.id },
                          }"
                          >{{ data?.album?.name }}</router-link
                        >
                      </td>
                    </tr>

                    <tr>
                      <th>Title</th>
                      <th width="50" style="text-align: center">:</th>
                      <td>
                        {{ data?.title }}
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
const model = "photo";

export default {
  data() {
    return {
      model: model,
      data: {},
      fields: ["title", "created_at"],
      belongs_to: {
        data: {},
        fields: ["name"],
        model: "album",
      },
    };
  },

  methods: {
    getPhoto() {
      axios.get(`${this.model}/${this.$route.params.id}`).then((res) => {
        this.data = res.data;
      });
    },
  },

  created() {
    this.setBreadcrumbs(this.model, "view");
    this.getPhoto();
  },
};
</script>
