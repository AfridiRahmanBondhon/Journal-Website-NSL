<template>
  <fieldset class="border border-primary w-100 p-2 rounded">
    <legend class="" style="font-size: 1.2rem">
      <slot name="name"></slot>
    </legend>
    <div class="row">
      <slot name="content"></slot>
    </div>
  </fieldset>
</template>

<script>
export default {};
</script>

<style scoped>
fieldset {
  border: 1px solid #cacbcd;
  padding: 6px 10px;
  margin-bottom: 25px;
}

fieldset legend {
  width: 30%;
  padding: 0px 7px;
  background: #fff;
  font-size: 16px;
  float: none;
  font-weight: bold;
}
</style>
