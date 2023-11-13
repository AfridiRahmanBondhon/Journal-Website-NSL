<template>
  <create-form @onSubmit="submit">
    <div class="row align-items-center">
      <div class="col-xl-2 col-lg-3">
        <div class="row">
          <File
            title="Profile"
            field="data.profile"
            mime="img"
            fileClassName="file2"
            accept=".jpg, .jpeg, .png"
            :showCrop="true"
            vHeight="200"
            vWidth="200"
            vSizeInKb="300"
            :req="true"
            col="11"
          />

          <GlobalCrop
            field="data.profile"
            v-on:update:modelValue="data.profile = $event"
            :image="profile.profile"
            :aspectRatio="{ aspectRatio: 200 / 200 }"
            :minWidth="200"
            :minHeight="200"
          ></GlobalCrop>
        </div>
      </div>

      <div class="col-xl-10 col-xl-9">
        <div class="row">
          <Input
            v-model="data.name"
            field="data.name"
            title="Name"
            :req="true"
          />

          <Input
            v-if="!$route.params.id"
            v-model="data.email"
            field="data.email"
            title="Email"
            :req="true"
          />

          <Input
            v-model="data.password"
            field="data.password"
            title="Password"
            type="password"
            :req="true"
          />

          <v-select-container title="Role" field="data.role_id" :req="true">
            <v-select
              v-model="data.role_id"
              label="name"
              :reduce="(obj) => obj.id"
              :options="extraData.roles"
              placeholder="--Select One--"
              :closeOnSelect="true"
            ></v-select>
          </v-select-container>

          <Input v-model="data.mobile" field="data.mobile" title="Mobile" />
          <Switch
            v-model="data.status"
            on-label="Active"
            off-label="Deactive"
            :req="true"
          ></Switch>
        </div>
      </div>
    </div>
    <Button class="aus-btn" title="Submit" process="" />
  </create-form>
</template>

<script>
const model = "admin";

import { EventBus } from "../../../event-bus.js";

export default {
  data() {
    return {
      model: model,
      data: {
        bug: "",
        profile: "",
        role_id: null,
        status: "active",
        role_id: 1,
      },
      profile: {},
      extraData: {
        roles: [],
      },
    };
  },
  provide() {
    return {
      validate: this.validation,
      data: () => this.data,
      image: this.profile,
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
        }

        var form = document.getElementById("form");
        var formData = new FormData(form);
        formData.append("role_id", this.data.role_id);
        formData.append("profile_base64", this.data.profile);
        formData.append("status", this.data.status);

        if (res) {
          if (this.data.id) {
            this.update(this.model, formData, this.data.id, true);
          } else {
            this.store(this.model, formData);
          }
        }
      });
    },
    emittOn() {
      EventBus.emit("server");
    },
    bindEvents() {
      EventBus.on(
        "server",
        function () {
          console.log("Data", this.data);
        }.bind(this)
      );
    },
  },
  mounted() {
    this.bindEvents();
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, "edit");
      this.get_data(`${this.model}/${this.$route.params.id}`);
    } else {
      this.setBreadcrumbs(this.model, "create");
      this.get_sorting("Admin");
    }
    this.get_paginate("role", { allData: true }, "roles");
  },
  validators: {
    "data.name": function (value = null) {
      return Validator.value(value).required("Name is required");
    },
    "data.email": function (value = null) {
      if (!this.$route.params.id) {
        return Validator.value(value).required("Email is required").email();
      }
    },
    "data.role_id": function (value = null) {
      return Validator.value(value).required("Role is required");
    },
    "data.password": function (value = null) {
      if (!this.$route.params.id) {
        return Validator.value(value)
          .required("Password is required")
          .minLength(6);
      }
    },
    "data.mobile": function (value = null) {
      return Validator.value(value)
        .digit()
        .regex("01+[0-9+-]*$", "Must start with 01.")
        .minLength(11)
        .maxLength(11);
    },
    "data.status": function (value = null) {
      return Validator.value(value).required("Status is required");
    },
  },
};
</script>
