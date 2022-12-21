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
          v-bind:class="{ highlight: isHighlighted(index) }"
          @mouseover="highlightRow(index)"
          @mouseout="unhighlightRow(index)"
          @click="
            goToLink('/service');
            sendIndex(item._id);
          "
        >
          <td scope="row" v-if="item.status == 'On Progress'">
            {{ item.instruction_id }}
          </td>
          <td v-if="item.status == 'On Progress'">
            {{ item.link_to }}
          </td>
          <td v-if="item.status == 'On Progress'">
            <i class="material-icons customIcon"> local_shipping </i>
            {{ item.instruction_type }}
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
import { mapMutations, mapGetters } from "vuex";
export default {
  props: {
    instructions: {
      type: Array,
      default: () => {
        return [];
      },
    },
  },
  data() {
    return {
      highlightedRow: -1,
    };
  },
  mounted() {
    // this.$store.dispatch("setIndex");
    // console.log(`local${this.index}`);
  },
  computed: {
    // ...mapGetters({
    //   index: "getIndex",
    // }),
  },
  methods: {
    // vuex
    // ...mapActions(["saveData"]),
    // sendIndex(index) {
    //   // this.$store.commit('setCurrentIndex', index)
    //   this.$store.dispatch("SET_DATA", index);
    // },
    ...mapMutations(["SET_DATA"]),
    sendIndex(index) {
      this.SET_DATA(index);
      console.log(index);
    },
    // sendIndex(index) {
    //   console.log(index);
    // },

    //set data index
    // setIndex(index) {
    //   this.index = index;
    //   console.log(this.index);
    // },

    // ketika row di sorot
    highlightRow(index) {
      this.highlightedRow = index;
    },
    unhighlightRow(index) {
      this.highlightedRow = -1;
    },
    isHighlighted(index) {
      return index === this.highlightedRow;
    },
    goToLink(link) {
      window.location.href = link;
    },
  },
};
</script>

<style scoped>
.highlight {
  background-color: #f0f0f0;
}
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

.customIcon {
  padding-right: 5px !important;
  /* color: #00bfbf !important; */
  vertical-align: bottom !important;
  font-size: 20px !important;
}
</style>