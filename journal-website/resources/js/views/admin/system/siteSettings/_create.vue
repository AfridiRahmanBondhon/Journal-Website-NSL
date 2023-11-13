<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <Fieldset>
        <template v-slot:name>Media</template>
        <template v-slot:content>
          <File1
            title="Logo"
            field="data.logo"
            mime="img"
            :req="true"
            fileClassName="file1"
            :showCrop="true"
            vHeight="200"
            vWidth="200"
            vSizeInKb="300"
          />

          <GlobalCrop
            field="data.logo"
            v-on:update:modelValue="data.logo = $event"
            :image="image.logo"
            :aspectRatio="{ aspectRatio: 200 / 200 }"
            :minWidth="200"
            :minHeight="200"
          ></GlobalCrop>

          <File
            title="Logo Small"
            field="data.logo_small"
            mime="img"
            fileClassName="file2"
            :req="true"
            vHeight="200"
            vWidth="200"
            vSizeInKb="300"
          />

          <File
            title="Favicon Logo"
            field="data.favicon"
            mime="img"
            fileClassName="file3"
            vHeight="200"
            vWidth="200"
            vSizeInKb="300"
          />
        </template>
      </Fieldset>

      <Fieldset>
        <template v-slot:name>Information</template>
        <template v-slot:content>
          <Input
            title="Title"
            field="data.title"
            v-model="data.title"
            :req="true"
            col="6"
          />

          <Input
            title="Short Title"
            field="data.short_title"
            v-model="data.short_title"
            :req="true"
            col="6"
          />

          <Input
            title="Contact Email (Optional)"
            field="data.contact_email"
            v-model="data.contact_email"
            type="email"
            :req="false"
          />

          <Input
            title="Feedback Email (Optional)"
            field="data.feedback_email"
            v-model="data.feedback_email"
            type="email"
            :req="false"
          />

          <Input
            title="Mobile One (Optional)"
            field="data.mobile1"
            v-model="data.mobile1"
            type="text"
            :req="false"
          />

          <Input
            title="Mobile Two (Optional)"
            field="data.mobile2"
            v-model="data.mobile2"
            type="text"
            :req="false"
          />
        </template>
      </Fieldset>

      <div class="w-100 my-2"></div>

      <!-- <Input
        title="Developed By"
        field="data.developed_by"
        v-model="data.developed_by"
        :req="false"
        col="6"
      /> -->
      <!-- <Input
        title="Developed By URL"
        field="data.developed_by_url"
        v-model="data.developed_by_url"
        type="url"
        :req="false"
        col="6"
      /> -->

      <Fieldset>
        <template v-slot:name>Address</template>
        <template v-slot:content>
          <Textarea
            title="Address (Optional)"
            field="data.address"
            v-model="data.address"
            :req="false"
            col="12"
          />

          <Textarea
            title="Map Link (Optional)"
            field="data.map"
            v-model="data.map"
            :req="false"
            col="12"
          />
        </template>
      </Fieldset>

      <Fieldset>
        <template v-slot:name>Links</template>
        <template v-slot:content>
          <Input
            title="Web (Optional)"
            field="data.web"
            v-model="data.web"
            type="url"
            :req="false"
            col="6"
            placeholder="https://abcd.xyz"
          />

          <Input
            title="Facebook (Optional)"
            field="data.fb"
            v-model="data.fb"
            type="url"
            :req="false"
            col="6"
            placeholder="https://facebook.com"
          />

          <Input
            title="Twitter (Optional)"
            field="data.tw"
            v-model="data.tw"
            type="url"
            :req="false"
            col="6"
            placeholder="https://twitter.com"
          />

          <Input
            title="Linkedin (Optional)"
            field="data.ln"
            v-model="data.ln"
            type="url"
            :req="false"
            col="6"
            placeholder="https://linkedin.com"
          />

          <Input
            title="Youtube (Optional)"
            field="data.yt"
            v-model="data.yt"
            type="url"
            :req="false"
            col="6"
            placeholder="https://youtube.com"
          />
        </template>
      </Fieldset>

      <Fieldset>
        <template v-slot:name>Color</template>
        <template v-slot:content>
          <ColorPicker
            title="Navbar (Optional)"
            field="data.navbar_color"
            v-model="data.navbar_color"
            col="2 col-sm-4 col-md-3"
          />

          <ColorPicker
            title="Breadcrumb (Optional)"
            field="data.breadcrumb_color"
            v-model="data.breadcrumb_color"
            col="2 col-sm-4 col-md-3"
          />

          <ColorPicker
            title="Sidebar (Optional)"
            field="data.sidebar_color"
            v-model="data.sidebar_color"
            col="2 col-sm-4 col-md-3"
          />

          <ColorPicker
            title="Sidebar Footer (Optional)"
            field="data.sidebar_footer_color"
            v-model="data.sidebar_footer_color"
            col="2 col-sm-4 col-md-3"
          />

          <ColorPicker
            title="Sidebar Top (Optional)"
            field="data.sidebar_top_color"
            v-model="data.sidebar_top_color"
            col="2 col-sm-4 col-md-3"
          />
        </template>
      </Fieldset>
    </div>

    <Button title="Submit" class="aus-btn" process="" />
  </create-form>
</template>

<script>
const model = "siteSetting";
import { mapState, mapMutations } from "vuex";

import File1 from "../../../../components/Form/File.vue";
import File2 from "../../../../components/Form/File.vue";
import File3 from "../../../../components/Form/File.vue";

export default {
  components: {
    File1,
    File2,
    File1,
  },
  computed: {
    ...mapState("setting", ["colors"]),
  },
  data() {
    return {
      model: model,
      data: {
        logo: "",
        logo_small: "",
        favicon: "",
        sidebar_footer_color: "",
        sidebar_top_color: "",
        sidebar_color: "",
        navbar_color: "",
        breadcrumb_color: "",
      },
      image: { logo: "" },
    };
  },
  watch: {
    "data.sidebar_footer_color"(current, old) {
      if (current !== old) {
        this.setSidebarFooterColor(current);
      }
    },
    "data.sidebar_top_color"(current, old) {
      if (current !== old) {
        this.setSidebarTopColor(current);
      }
    },
    "data.sidebar_color"(current, old) {
      if (current !== old) {
        this.setSidebarColor(current);
      }
    },
    "data.navbar_color"(current, old) {
      if (current !== old) {
        this.setNavbarColor(current);
      }
    },
    "data.breadcrumb_color"(current, old) {
      if (current !== old) {
        this.setBreadcrumbColor(current);
      }
    },
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
          formData.append("logo_base64", this.data.logo);
          this.store(this.model, formData);
        }
      });
    },
    getSiteSetting() {
      axios.get(`${this.model}/${this.$route.params.id}`).then((res) => {
        this.data = res.data;
        this.setSidebarFooterColor(res.data.sidebar_footer_color);
        this.setSidebarTopColor(res.data.sidebar_top_color);
        this.setSidebarColor(res.data.sidebar_color);
        this.setNavbarColor(res.data.navbar_color);
        this.setBreadcrumbColor(res.data.breadcrumb_color);
      });
    },
    ...mapMutations("setting", ["setSidebarFooterColor"]),
    ...mapMutations("setting", ["setSidebarTopColor"]),
    ...mapMutations("setting", ["setFooterColor"]),
    ...mapMutations("setting", ["setNavbarColor"]),
    ...mapMutations("setting", ["setSidebarColor"]),
    ...mapMutations("setting", ["setBreadcrumbColor"]),
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, "edit", "Site Setting");
      this.getSiteSetting();
    } else {
      this.setBreadcrumbs(this.model, "create", "Site Setting");
    }
  },
  validators: {
    "data.title": function (value = null) {
      return Validator.value(value)
        .maxLength(191)
        .required("Title is required");
    },
    "data.short_title": function (value = null) {
      return Validator.value(value)
        .maxLength(191)
        .required("Short Title is required");
    },
    "data.logo": function (value = null) {
      return Validator.value(value).required("Logo is required");
    },
    "data.favicon": function (value = null) {
      return Validator.value(value).required("Favicon is required");
    },
    "data.web": function (value = null) {
      return Validator.value(value).url();
    },
    "data.fb": function (value = null) {
      return Validator.value(value).url();
    },
    "data.tw": function (value = null) {
      return Validator.value(value).url();
    },
    "data.ln": function (value = null) {
      return Validator.value(value).url();
    },
    "data.yt": function (value = null) {
      return Validator.value(value).url();
    },
    "data.contact_email": function (value = null) {
      return Validator.value(value).email();
    },
    "data.feedback_email": function (value = null) {
      return Validator.value(value).email();
    },
    "data.mobile1": function (value = null) {
      return Validator.value(value).digit().maxLength(20);
    },
    "data.mobile2": function (value = null) {
      return Validator.value(value).digit().maxLength(20);
    },
  },
};
</script>
