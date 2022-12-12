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
        <tr v-for="(item, index) in instruction" :key="index">
          <th scope="row" v-if="item.status == 'in progress'">
            {{ item.instructionId }}
          </th>
          <td v-if="item.status == 'in progress'">{{ item.linkTo }}</td>
          <td v-if="item.status == 'in progress'">
            <i class="material-icons"> local_shipping </i>
          </td>
          <td v-if="item.status == 'in progress'">{{ item.assignedVendor }}</td>
          <td v-if="item.status == 'in progress'">{{ item.attentionOf }}</td>
          <td v-if="item.status == 'in progress'">{{ item.quotationNo }}</td>
          <td v-if="item.status == 'in progress'">{{ item.customerPo }}</td>
          <td v-if="item.status == 'in progress'">
            <div class="status">{{ item.status }}</div>
          </td>
        </tr>
        <!-- <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td><i class="material-icons"> local_shipping </i></td>
          <td>@fat</td>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td>
            <div class="status">in progress</div>
          </td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry the Bird</td>
          <td><i class="material-icons"> local_shipping </i></td>
          <td>@fat</td>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
          <td>
            <div class="status">in progress</div>
          </td>
        </tr> -->
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