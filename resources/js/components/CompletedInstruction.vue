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
          <th scope="col">Invoice</th>
          <th scope="col">Customer PO</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in instructions" :key="index">
          <td scope="row" v-if="item.status != 'On Progress'">
            {{ item.instruction_id }}
          </td>
          <td v-if="item.status != 'On Progress'">
            {{ item.link_to }}
          </td>
          <td v-if="item.status != 'On Progress'">
            <i class="material-icons"> local_shipping </i>
          </td>
          <td v-if="item.status != 'On Progress'">
            {{ item.assigned_vendor }}
          </td>
          <td v-if="item.status != 'On Progress'">
            {{ item.attention_of }}
          </td>
          <td v-if="item.status != 'On Progress'">
            {{ item.quotation_no }}
          </td>
          <td v-if="item.status != 'On Progress'">
            <select
              class="form-select form-select-sm"
              aria-label=".form-select-sm example"
            >
              <option selected>0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </td>
          <td v-if="item.status != 'On Progress'">
            {{ item.customer_po }}
          </td>
          <td v-if="item.status != 'On Progress'">
            <div class="status">{{ item.status }}</div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    instructions: {
      type: Array,
      default: () => {
        return [];
      },
    },
  },
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
td > select {
  background-color: #00bfbf;
}
.status {
  /* width: 100px; */
  padding: 5px 8px 5px 8px;
  height: auto;
  border-radius: 10px;
  background-color: #00c060;
  color: #ffffff;
  text-align: center;
  font-size: 12px;
}
</style>