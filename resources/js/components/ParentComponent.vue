<template>
  <div id="template" class="m-auto">
    <modify-component></modify-component>
    <view-component></view-component>
  </div>
</template>

<script>
import ViewComponent from './view/ViewComponent.vue'
export default {
  components: { ViewComponent },

}
</script>

<style scoped>
#template {
  width: 98%;
  background-color: #ffffff;
  box-shadow: 5px 5px 8px #888888;
  border-radius: 10px;
}
</style>

