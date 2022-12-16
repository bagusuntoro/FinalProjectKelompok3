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
        <tr v-for="(item, index) in instructions" :key="index">
          <th scope="row">{{ item.instruction_id }}</th>
          <td>{{ item.link_to }}</td>
          <td><i class="material-icons"> local_shipping </i></td>
          <td>{{ item.assigned_vendor }}</td>
          <td>{{ item.attention_of }}</td>
          <td>{{ item.quotation_no }}</td>
          <td>{{ item.customer_po }}</td>
          <td>
            <div class="status">{{ item.status }}</div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
// import { response } from "express";
// import axios from "axios";

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
.status {
  padding: 5px 8px 5px 8px;
  height: auto;
  border-radius: 10px;
  background-color: #e2ebf9;
  color: #637ca0;
  text-align: center;
  font-size: 12px;
}
</style>