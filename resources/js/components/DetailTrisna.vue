    <template>
  <div class="button">
    <div
      class="container"
      style="
        background-color: white;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
      "
    >
      <!-- back button -->
      <a
        class="w3-left ws-btn"
        href="/open"
        style="margin: 16px 16px; color: #0dc7a9"
        >❮ Back</a
      >
      <!-- terminate -->
      <button class="btn" style="color: #0dc7a9; margin: 16px 16px 16px 376px">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="currentColor"
          class="bi bi-x-circle"
          viewBox="0 0 16 16"
        >
          <path
            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"
          />
          <path
            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
          />
        </svg>
        Terminate
      </button>
      <!-- modify -->
      <button class="btn" style="color: #0dc7a9; margin: 8px 16px">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="8"
          height="11"
          fill="currentColor"
          class="bi bi-pencil-fill"
          viewBox="0 0 16 16"
        >
          <path
            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"
          />
        </svg>
        Modify
      </button>

      <!-- <div class="dropdown">
            <a
            class="btn dropdown-toggle"
            style="
                background-color: #f8fafc;
                margin: 41px 12px;
                font-size: smaller;
            "
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-truck"
                viewBox="0 0 16 16"
                color="green"
                style="display: inline-flex"
            >
                <path
                d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"
                />
            </svg>
            Dropdown link
            </a>

            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            <button
            class="button"
            style="
                float: right;
                background-color: #f8fafc;
                font-size: smaller;
                float: right;
                border-radius: 10px;
                margin: 47px 29px;
                padding: 1px 29px;
                margin-left: 50.5rem;
            "
            >
            Draft
            </button>
            
        </div> -->
      <!-- detail -->
      <div
        class="container"
        style="
          background-color: white;
          display: flex;
          flex-direction: row;
          flex-wrap: wrap;
        "
      ></div>
      <div class="form-floating mb-3">
        <input
          type="text"
          readonly
          class="form-control-plaintext"
          id="floatingPlaintextInput"
          placeholder="instruction"
          v-model="detail.instruction_type"
        />
        <label for="floatingPlaintextInput">Type</label>
      </div>

      <div class="form-floating mb-3">
        <input
          type="text"
          readonly
          class="form-control-plaintext"
          id="floatingPlaintextInput"
          placeholder="name@example.com"
          v-model="detail.instruction_id"
        />
        <label for="floatingPlaintextInput">Si No.</label>
      </div>

      <div class="form-floating mb-3">
        <input
          type="text"
          readonly
          class="form-control-plaintext"
          id="floatingPlaintextInput"
          placeholder="name@example.com"
          value="INSP-2020-0001"
        />
        <label for="floatingPlaintextInput">Transfer No.</label>
      </div>

      <div class="form-floating mb-3">
        <input
          type="text"
          readonly
          class="form-control-plaintext"
          id="floatingPlaintextInput"
          placeholder="name@example.com"
          v-model="detail.customer_contract"
        />
        <label for="floatingPlaintextInput">Customer</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="text"
          readonly
          class="form-control-plaintext"
          id="floatingPlaintextInput"
          placeholder="name@example.com"
          v-model="detail.customer_po"
        />
        <label for="floatingPlaintextInput">Customer PO</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="text"
          readonly
          class="form-control-plaintext"
          id="floatingPlaintextInput"
          placeholder="name@example.com"
          v-model="detail.status"
        />
        <label for="floatingPlaintextInput">Status</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="text"
          readonly
          class="form-control-plaintext"
          id="floatingPlaintextInput"
          placeholder="name@example.com"
          v-model="detail.attention_of"
        />
        <label for="floatingPlaintextInput">Atention of</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="text"
          readonly
          class="form-control-plaintext"
          id="floatingPlaintextInput"
          placeholder="name@example.com"
          v-model="detail.assigned_vendor"
        />
        <label for="floatingPlaintextInput">Assigned vendor</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="text"
          readonly
          class="form-control-plaintext"
          id="floatingPlaintextInput"
          placeholder="name@example.com"
          v-model="detail.vendor_quotation"
        />
        <label for="floatingPlaintextInput">Vendor Quotation</label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="text"
          readonly
          class="form-control-plaintext"
          id="floatingPlaintextInput"
          placeholder="name@example.com"
          v-model="detail.vendor_address"
        />
        <label for="floatingPlaintextInput">Vendor Address</label>
      </div>

      <!-- ctable cost detail -->
      <div
        class="container"
        style="
          background-color: white;
          /* display: flex;
                flex-direction: row;
                flex-wrap: wrap; */
          margin-top: 30px;
          margin: 12px -8px;
        "
      >
        <hr class="my-8" style="border-top: 1px solid rgb(0 0 0)" />
        <h4><B>Cost Detail</B></h4>

        <div class="row">
          <table class="table m-auto">
            <thead>
              <tr style="background-color: #efefef">
                <th scope="col">Description</th>
                <th scope="col">Qty</th>
                <th scope="col">UOM</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Discount(%)</th>
                <th scope="col">GST/VAT(%)</th>
                <th></th>
                <th scope="col">Curency</th>
                <th scope="col">GST/VAT Amount</th>
                <th scope="col">Sub Total</th>
                <th scope="col">Total</th>
                <th scope="col">Charge To</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Transportation from trip</td>
                <td>1</td>
                <td>TRIP</td>
                <td>1,400.00</td>
                <td>0</td>
                <td>5</td>
                <td>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-arrow-right"
                    viewBox="0 0 16 16"
                    style="margin-top: 9px"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"
                    />
                  </svg>
                </td>
                <td>usd</td>
                <td>70.00</td>
                <td>1,400.00</td>
                <td>1,470.00</td>
                <td>MITME</td>
              </tr>
            </tbody>
          </table>

          <div class="container-fluid">
            <hr class="my-8" style="border-top: 1px solid rgb(0 0 0)" />
            <h4><B>Vendor Invoice</B></h4>

            <!-- <AddvendorinvoiceComponentVue /> -->

            <table class="table m-auto">
              <thead>
                <tr style="background-color: #efefef">
                  <th scope="col">Invoice No.</th>
                  <th scope="col">Invoice Attachment.</th>
                  <th scope="col">Support Document</th>
                </tr>
              </thead>
              <tbody>
                <td>AAL-008</td>
                <td>
                  <i> {icon} </i>
                </td>
                <td></td>
              </tbody>

              <button type="button" class="btn btn-success">
                All Received
              </button>
            </table>
          </div>

          <h4 style="margin: 12px 29px"><B>Attachment</B></h4>
          <a
            href="#"
            class="btn btn-success"
            tabindex="-1"
            role="button"
            aria-disabled="true"
            style="max-inline-size: max-content; margin: 5px 29px"
            >+ Add Attachment</a
          >
          <h4 style="margin: -91px 554px"><B>Notes</B></h4>
        </div>
      </div>
    </div>
  </div>
</template>

    <script>
import { mapGetters } from "vuex";
// import AddvendorinvoiceComponent from './AddvendorinvoiceComponent.vue';
export default {
  data() {
    return {
      // detail: [],
    };
  },
  mounted() {
    this.$store.dispatch("showDetail");
    // this.$store.dispatch("showData");
    console.log(this.detail);
  },
  computed: {
    ...mapGetters({
      detail: "getDetail",
    }),
  },
};
</script>

    <style></style>
