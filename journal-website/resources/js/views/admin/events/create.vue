<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <div class="row">
        <div class="col-xl-2 col-lg-3">
          <File
            title="Image"
            field="data.original_image"
            mime="img"
            fileClassName="file2"
            :showCrop="true"
            col="12"
            vHeight="600"
            vWidth="600"
            vSizeInKb="500"
          />
        </div>
        <div class="col-xl-10 col-lg-9">
          <div class="row">
            <v-select-container
              field="data.category_id"
              :req="true"
              title="Category"
            >
              <v-select
                v-model="data.category_id"
                label="title"
                :reduce="(obj) => obj.id"
                :options="categories"
                placeholder="--Select One--"
                :closeOnSelect="true"
                :req="true"
              ></v-select>
            </v-select-container>

            <Input
              v-model="data.title"
              field="data.title"
              title="Title"
              :req="true"
              col="6"
            />

            <Input
              v-model="data.venue"
              field="data.venue"
              title="Venue"
              :req="false"
            />

            <date-picker
              id="date3"
              field="data.start_date"
              name="start_date"
              v-model="data.start_date"
              title="Start Date"
              placeholder="dd/mm/yyyy"
              :req="true"
              col="3"
            ></date-picker>

            <date-picker
              id="date4"
              field="data.end_date"
              name="end_date"
              v-model="data.end_date"
              title="End Date"
              placeholder="dd/mm/yyyy"
              :req="true"
              col="3"
            ></date-picker>
            <Input
              v-model="data.highlighted_text"
              field="data.highlighted_text"
              title="Highlight"
            />

            <Input
              title="Sorting"
              field="data.sorting"
              v-model="data.sorting"
              req
              col="3"
            />

            <Switch
              v-model="data.status"
              on-label="Active"
              off-label="Deactive"
              :req="true"
            ></Switch>
          </div>
        </div>
      </div>

      <GlobalCrop
        field="data.original_image"
        v-on:update:modelValue="data.original_image = $event"
        :image="image.original_image"
        :aspectRatio="{ aspectRatio: 600 / 600 }"
        :minWidth="600"
        :minHeight="600"
      ></GlobalCrop>

      <div class="col-12 mb-3">
        <button
          v-if="data.event_schedules.length == 0"
          type="button pull-right"
          style="padding: 1px 6px !important; min-width: 10px"
          @click.prevent="
            data.event_schedules.push({
              schedule_date: '',
              schedule_time: '',
              title: '',
              description: '',
              status: 'active',
            })
          "
          class="btn btn-info ms-2 mt-3 text-white"
        >
          Add Schedule <i class="fa fa-plus"></i>
        </button>

        <div
          class=""
          v-for="(schedule, index) in data.event_schedules"
          :key="index"
        >
          <fieldset>
            <legend>Event Schedule ({{ index + 1 }})</legend>

            <div class="row">
              <date-picker
                :id="'event' + `${index}`"
                :name="`event_schedules[${index}][schedule_date]`"
                v-model="schedule.schedule_date"
                title="Date"
                placeholder="dd/mm/yyyy"
                col="3"
                field="schedule.schedule_date"
              ></date-picker>

              <div class="col-3 col-md-2 mb-3">
                <div class="form-element">
                  <label for="" class="w-100"> Time</label>
                  <input
                    type="time"
                    class="from-control w-100 ps-2"
                    :name="`event_schedules[${index}][schedule_time]`"
                    v-model="schedule.schedule_time"
                  />
                </div>
              </div>

              <div class="col-3 col-md-3 mb-3">
                <div class="form-element">
                  <label for="" class="w-100">Title</label>
                  <input
                    type="text"
                    class="from-control w-100 ps-2"
                    placeholder="Enter title"
                    :name="`event_schedules[${index}][title]`"
                    v-model="schedule.title"
                  />
                </div>
              </div>
              <div class="col-3 col-md-2 mb-3">
                <label for="">Status</label><br />
                <div class="form-check form-check-inline mt-3">
                  <input
                    type="radio"
                    class="form-check-input"
                    :name="`event_schedules[${index}][status]`"
                    v-model="schedule.status"
                    :id="'active' + { index }"
                    value="active"
                  /><label :for="'active' + { index }">Active</label>
                </div>

                <div class="form-check form-check-inline">
                  <input
                    type="radio"
                    class="form-check-input"
                    :id="'deactive' + { index }"
                    v-model="schedule.status"
                    :name="`event_schedules[${index}][status]`"
                    value="deactive"
                  /><label :for="'deactive' + { index }">Deactive</label>
                </div>
              </div>
              <!-- add and remove button -->

              <div class="col-12 mb-3">
                <div class="form-element">
                  <label for="">Description</label>
                  <textarea
                    class="form-control"
                    placeholder="Enter description"
                    v-model="schedule.description"
                    :name="`event_schedules[${index}][description]`"
                    rows="3"
                  ></textarea>
                </div>
              </div>

              <div class="col-12 mt-3 text-end">
                <!-- minus button -->
                <button
                  style="padding: 1px 6px !important; min-width: 10px"
                  type="button"
                  @click.prevent="data.event_schedules.splice(index, 1)"
                  v-if="Object.keys(data.event_schedules).length > 1"
                  class="btn btn-danger mt-3 text-white"
                >
                  <i class="fa fa-minus"></i>
                </button>
                <!-- plus button -->

                <button
                  v-if="isLastItem(data.event_schedules,index)"
                  type="button"
                  style="padding: 1px 6px !important; min-width: 10px"
                  @click.prevent="
                    data.event_schedules.push({
                      schedule_date: '',
                      schedule_time: '',
                      title: '',
                      description: '',
                      status: 'active',
                    })
                  "
                  class="btn btn-info ms-2 mt-3 text-white"
                >
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
      <div class="col-12 mb-3">
        <label class="form-label">Description</label>
        <div class="col-12">
          <editor v-model="data.description" />
        </div>
      </div>
      <div class="col-12 mb-3">
        <label class="form-label">Meta Keywords(Optional)</label>
        <v-select
          taggable
          multiple
          name="meta_tag"
          v-model="data.meta_tag"
          no-drop
        ></v-select>
      </div>
      <div class="col-12 mb-3">
        <div class="form-element">
          <label for="" class="form-label">Meta Description(Optional)</label>
          <textarea
            name="meta_description"
            v-model="data.meta_description"
            class="form-control"
            id=""
            cols="30"
            rows="3"
          ></textarea>
        </div>
      </div>
    </div>
    <Button title="Submit" class="aus-btn" process="" />
  </create-form>
</template>

<script>
const model = "events";
import { mapState } from "vuex";
import Editor from "../../../components/Form/CKEditor";

export default {
  components: { Editor },
  computed: {
    ...mapState("category", ["categories"]),
  },
  data() {
    return {
      model: model,
      data: {
        original_image: "",
        sorting: 0,
        status: "active",
        meta_tag: null,
        event_schedules: [
          {
            schedule_date: "",
            schedule_time: "",
            title: "",
            description: "",
            status: "active",
          },
        ],
      },
      image: { original_image: "" },
    };
  },

  provide() {
    return {
      validate: this.validation,
      data: () => this.data,
      image: this.image,
    };
  },
  methods: {
    submit: function (e) {
      this.$validate().then((res) => {
        const error = this.validation.countErrors();

        if (error > 0) {
          console.log(this.validation.allErrors());
          this.$toast(
            "You need to fill " + error + " more empty mandatory fields",
            "warning"
          );
          return false;
        }

        if (res) {
          var form = document.getElementById("form");
          var formData = new FormData(form);

          const description = this.data.description
            ? this.data.description
            : "";

          formData.append("status", this.data.status);
          formData.append("description", description);
          formData.append("category_id", this.data.category_id);

          if (this.data.meta_tag) {
            formData.append("meta_tag", this.data.meta_tag);
          }

          if (this.data.original_image) {
            formData.append("image_base64", this.data.original_image);
          }

          if (this.data.id) {
            this.update(this.model, formData, this.data.id, "image");
          } else {
            this.store(this.model, formData);
          }
        }
      });
    },
    isLastItem(data, index) {
      if (data) {
        if (Array.isArray(data)) {
          return index === data.length - 1;
        } else if (typeof data === "object") {
          const keys = Object.keys(data);
          return index === keys.length - 1;
        }
      }
      return false;
    },
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, "edit");
      this.get_data(`${this.model}/${this.$route.params.id}`);
    } else {
      this.setBreadcrumbs(this.model, "create");
      this.get_sorting("Events");
    }
    this.$store.dispatch("category/getCategory", { transfer: "Events" });
  },

  validators: {
    "data.title": function (value = null) {
      return Validator.value(value).required("Title is required");
    },
    "data.category_id": function (value = null) {
      return Validator.value(value).required("Category is required");
    },
    "data.original_image": function (value = null) {
      return Validator.value(value);
    },
    "data.start_date": function (value = null) {
      return Validator.value(value).required("Start date is required");
    },
    "data.end_date": function (value = null) {
      const that = this;
      return Validator.value(value).custom(function () {
        if (!Validator.isEmpty(value) && that.data.start_date) {
          const end = new Date(value);
          const start = new Date(that.data.start_date);

          if (start > end) {
            return "End date must higher";
          }
        }
      });
    },
    "data.sorting": function (value = null) {
      return Validator.value(value)
        .digit()
        .regex("^[0-9]*$")
        .required("Sorting is required");
    },
    "data.status": function (value = null) {
      return Validator.value(value).required("Status is required");
    },
  },
};
</script>
<style scoped>
fieldset {
  border: 1px solid #cacbcd;
  padding: 6px 10px;
}

fieldset legend {
  width: 10%;
  padding: 0px 7px;
  background: #fff;
  font-size: 16px;
  float: none;
  font-weight: bold;
}
</style>
