<template>
  <div class="row">
    <table class="table m-auto">
      <thead>
        <tr>
          <th scope="col">Instruction ID</th>
          <th scope="col">Link To</th>
          <th scope="col">Instruction Type</th>
          <th scope="col">Assigned Vendor</th>
          <th scope="col">Attention Of</th>
          <th scope="col">Quotation No</th>
          <th scope="col">Customer PO</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
          <tr v-for="(item, index) in instruction" :key="index" class='clickable-row' data-href='url://'>
            <th scope="row" v-if="item.status == 'in progress'">
              <a href="/service">

                {{ item.instructionId }}
              </a>
            </th>
            <td v-if="item.status == 'in progress'">
              <a href="/service">

                {{ item.linkTo }}
              </a>
            </td>
            <td v-if="item.status == 'in progress'">
              <i class="material-icons"> local_shipping </i>
            </td>
            <td v-if="item.status == 'in progress'">
              <a href="/service">

                {{ item.assignedVendor }}
              </a>
            </td>
            <td v-if="item.status == 'in progress'">
              <a href="/service">

                {{ item.attentionOf }}
              </a>
            </td>
            <td v-if="item.status == 'in progress'">
              <a href="/service">

                {{ item.quotationNo }}
              </a>
            </td>
            <td v-if="item.status == 'in progress'">
              <a href="/service">

                {{ item.customerPo }}
              </a>
            </td>
            <td v-if="item.status == 'in progress'">
              <a href="/service">
                <div class="status">
                  {{ item.status }}
                </div>
              </a>
            </td>
          </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    instruction: {
      type: Array,
      default: () => {
        return [];
      },
    },
  },
  mounted(){
    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
  }

};
</script>

<style scoped>
table {
  /* position: relative; */
  margin-top: 30px !important;
  width: 90%;
  /* padding-top: 100px !important; */
}
thead {
  background-color: #b9c0c7;
  /* background-color: #bbbbbb; */
  color: white;
}
td > i {
  color: #b9c0c7;
}
.status {
  padding: 5px 8px 5px 8px;
  height: auto;
  border-radius: 10px;
  background-color: #e2ebf9;
  color: #637ca0;
  text-align: center;
  font-size: 12px;
}
a{
  color: black;
}
</style>