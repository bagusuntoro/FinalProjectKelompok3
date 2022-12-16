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
        <tr
          v-for="(item, index) in instructions"
          :key="index"
          class="clickable-row"
          data-href="/service"
          id="rowColor"
        >
          <td scope="row" v-if="item.status == 'On Progress'">
            {{ item.instruction_id }}
          </td>
          <td v-if="item.status == 'On Progress'">
            {{ item.link_to }}
          </td>
          <td v-if="item.status == 'On Progress'">
            <i class="material-icons"> local_shipping </i>
          </td>
          <td v-if="item.status == 'On Progress'">
            {{ item.assigned_vendor }}
          </td>
          <td v-if="item.status == 'On Progress'">
            {{ item.attention_of }}
          </td>
          <td v-if="item.status == 'On Progress'">
            {{ item.quotation_no }}
          </td>
          <td v-if="item.status == 'On Progress'">
            {{ item.customer_po }}
          </td>
          <td v-if="item.status == 'On Progress'">
            <div class="status">
              {{ item.status }}
            </div>
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
  mounted() {
    let tr = document.getElementsByClassName("clickable-row");

    for (var i = 0; i < tr.length; i++) {
      tr[i].addEventListener("mousemove", function () {
        // Mengganti warna elemen ketika cursor mendekat
        this.style.cursor = "pointer";
        this.style.color = "#00bfbf";
      });
      tr[i].addEventListener("mouseout", function () {
        // Mengganti warna elemen ketika kursor menjauh;
        this.style.color = "black";
      });
    }

    // link with jquery
    jQuery(document).ready(function ($) {
      $(".clickable-row").click(function () {
        window.location = $(this).data("href");
      });
    });
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
a {
  color: black;
}
</style>