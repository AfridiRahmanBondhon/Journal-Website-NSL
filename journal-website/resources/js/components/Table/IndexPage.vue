<template>
  <div class="content-part">
    <div v-if="!$root.spinner" class="inner-content">
<slot name="button" v-if="button">
              <AddOrBackButton
                :route="$parent.model + '.create'"
                :portion="$parent.model"
                :icon="'plus'"
              />
            </slot>
      <div class="global-form">
        <div class="global-form-header">
                <div class="row">
              <!-- search form -->
              <div
                :class="button
                    ? 'col-sm-12 col-lg-12 col-md-9 mb-md-5'
                    : 'col-sm-12 col-lg-12 col-md-9 mb-md-5'
                  "
              >
                <!-- <div :class="button ? 'col-lg-10' : 'col-lg-10'"> -->
                <slot name="left-side">
                    <form v-on:submit.prevent="$parent.search" class="bg-fix">
                  <div class="row">
                    <slot name="search-field"></slot>

                    <template v-if="default_search">
                      <Search
                        :fields_name="$parent.fields_name"
                        v-if="$parent.fields_name && searchBlock"
                      />
                    </template>
                  </div>
                </form>
              </slot>
            </div>
            <!-- search form -->

            <!-- add or back button -->
            <slot name="button" v-if="button">
              <!-- <AddOrBackButton
                :route="$parent.model + '.create'"
                :portion="$parent.model"
                :icon="'plus'"
              /> -->
            </slot>
            <!-- add or back button -->
          </div>
        </div>
      </div>

      <!-- default -->
      <slot name="table-list"></slot>

      <!-- base-table -->
      <base-table v-if="defaultTable"></base-table>
      <!-- base-table -->

      <Pagination />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    defaultTable: {
      type: Boolean,
      default: true,
    },
    button: {
      type: Boolean,
      default: true,
    },
    searchBlock: {
      type: Boolean,
      default: true,
    },
    default_search: {
      type: Boolean,
      default: true,
    },
  },
};
</script>
