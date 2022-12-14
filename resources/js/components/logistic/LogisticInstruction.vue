<template>
  <div id="template" class="m-auto">
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data: function () {
    return {};
  },
  computed: {
    ...mapGetters({
      instruction: "getData",
    }),
  },
  mounted() {
  },
};
</script>

<style scoped>
#template {
  padding: 0 0 100px 0;
  width: 98%;
  margin-bottom: 100px !important;
  background-color: #fff;
  box-shadow: 5px 5px 8px #888888;
  border-radius: 10px;
}
</style>

