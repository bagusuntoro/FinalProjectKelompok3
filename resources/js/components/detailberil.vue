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
      @submit.prevent="save"
    >
      <div class="dropdown">
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
            color="  #0dc7a9"
            style="display: inline-flex"
          >
            <path
              d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"
            />
          </svg>
          Logistic Intruction
        </a>

        <ul class="dropdown-menu">
          <input
            type="email"
            class="form-control"
            id="exampleDropdownFormEmail2"
          />
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
        <!-- form -->
      </div>
      <div
        class="container"
        style="
          background-color: white;
          display: flex;
          flex-direction: row;
          flex-wrap: wrap;
        "
      ></div>
      <div class="mb-1" style="margin-left: 130px; font-size: smaller">
        <label for="exampleInputEmail1" class="form-label"
          >Assigment Vendor</label
        >
        <select
          class="form-select"
          aria-label="Default select example"
          style="inline-size: min-content"
          v-model="instructions.vendor"
        >
          <option selected>Enter Vendor</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <div class="mb-1" style="margin-left: 20px; font-size: smaller">
        <label for="exampleInputEmail1" class="form-label">Attention Off</label>

        <input
          class="form-control"
          placeholder="Enter Attention Off"
          v-model="instructions.attention"
        />
      </div>

      <div class="mb-1" style="margin-left: 20px; font-size: smaller">
        <label for="exampleInputEmail1" class="form-label">Quotation No.</label>
        <input
          class="form-control"
          placeholder="Enter Quotation"
          v-model="instructions.quotation"
        />
      </div>
      <div class="mb-1" style="margin-left: 20px; font-size: smaller">
        <label for="exampleInputEmail1" class="form-label">Invoice To</label>
        <select
          class="form-select"
          aria-label="Default select example"
          style="inline-size: min-content"
          v-model="instructions.invoice"
        >
          <option selected>Select an Option</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <div class="mb-1" style="margin-left: 20px; font-size: smaller">
        <label for="exampleInputEmail1" class="form-label"
          >Customer Contract</label
        >
        <select
          class="form-select"
          aria-label="Default select example"
          style="inline-size: min-content"
          v-model="instructions.custommerContact"
        >
          <option selected>Select Customer</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <div
        class="container"
        style="
          background-color: white;
          /* display: flex;
          flex-direction: row;
          flex-wrap: wrap; */
          margin-top: 30px;
          margin: 12px -8px;
          margin-left: 118px;
        "
      >
        <label
          for="exampleInputEmail1"
          class="form-label"
          style="font-size: smaller"
          >Vendor Address</label
        >
        <select
          class="form-select"
          aria-label="Default select example"
          style="width: 80%"
          v-model="instructions.vendorAddress"
        >
          <option selected>Open this select menu</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <label
        for="exampleInputEmail1"
        class="form-label"
        style="font-size: smaller; margin: -75px 933px"
        >CustomerPONo.</label
      >
      <input
        class="form-control"
        type="text"
        placeholder="Default input"
        aria-label="default input example"
        style="width: 165px; margin: -49px 925px"
        v-model="instructions.customerPoNo"
      />
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
              <tr>
                <th scope="col">Description</th>
                <th scope="col">QTy</th>
                <th scope="col">UOM</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Gst(%)</th>
                <th></th>
                <th scope="col">Curency</th>
                <th scope="col">VAT Amount</th>
                <th scope="col">Sub Total</th>
                <th scope="col">Sub Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input
                    class="form-control"
                    list="datalistOptions"
                    id="exampleDataList"
                    placeholder="Type to search..."
                    style="width: 145px"
                  />
                  <datalist id="datalistOptions">
                    <option value="San Francisco"></option>
                    <option value="New York"></option>
                    <option value="Seattle"></option>
                    <option value="Los Angeles"></option>
                    <option value="Chicago"></option>
                  </datalist>
                </td>
                <td>
                  <input
                    class="form-control"
                    placeholder="Enter Quotation"
                    style="width: 69px"
                  />
                </td>
                <td>
                  <select
                    class="form-select"
                    aria-label="Default select example"
                    style="width: 85px"
                  >
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </td>
                <td>
                  <input
                    class="form-control"
                    placeholder="Enter Quotation"
                    style="width: 69px"
                  />
                </td>
                <td>
                  <input
                    class="form-control"
                    placeholder="Enter Quotation"
                    style="width: 69px"
                  />
                </td>
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
                <td>
                  <select
                    class="form-select"
                    aria-label="Disabled select example"
                    disabled
                  >
                    <option selected>USD</option>
                  </select>
                </td>
                <td>00.00</td>
                <td>00.00</td>
                <td>00.00</td>
                <td>
                  <a
                    href="#"
                    class="btn btn-secondary"
                    tabindex="-1"
                    role="button"
                    aria-disabled="true"
                    >-</a
                  >
                </td>
              </tr>
              <tr>
                <th scope="row"></th>
                <td colspan="9"></td>
                <td>
                  <a
                    href="#"
                    class="btn btn-success"
                    tabindex="-1"
                    role="button"
                    aria-disabled="true"
                    style="background-color: #0dc7a9; border-color: #0dc7a9"
                    >+</a
                  >
                </td>
              </tr>
            </tbody>
          </table>
          <h4 style="margin: 12px 29px"><B>Attachment</B></h4>
          <a
            href="#"
            class="btn btn-success"
            tabindex="-1"
            role="button"
            aria-disabled="true"
            style="
              max-inline-size: max-content;
              margin: 35px 29px;
              background-color: #0dc7a9;
              border-color: #0dc7a9;
            "
            >+ Add Attachment</a
          >

          <form>
            <div class="form-group" style="margin: -150px 300px; width: 785px">
              <h4 label for="comment"><B>Notes</B></h4>
              <textarea class="form-control" rows="3" id="comment"></textarea>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div
      class="container"
      style="
        background-color: white;
        display: block;
        flex-direction: row;
        flex-wrap: wrap;
        margin-top: 30px;
      "
    >
      <div class="dropdown">
        <label for="exampleInputEmail1" class="form-label">Link To</label>
        <button
          class="btn btn-light dropdown-toggle"
          type="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          style="margin: 64px 50px"
        >
          Dropdown button
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div>
    </div>
    <div
      class="container"
      style="
        background-color: white;
        display: block;
        flex-direction: row;
        flex-wrap: wrap;
        margin-top: 30px;
      "
    >
      <div style="margin-left: 775px">
        <a href="/open">
          <button type="button" class="btn btn-light" style="margin: 20px 0px">
            Cancel
          </button>
        </a>
        <button
          type="button"
          class="btn btn-light"
          style="margin-left: 10px; border: solid 1px"
        >
          Save A Draft
        </button>
        <button
          type="submit"
          class="btn btn-success"
          style="
            margin-left: 10px;
            background-color: #0dc7a9;
            border-color: #0dc7a9;
          "
        >
          Submit
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      instructions: [
        {
          vendor: "",
          attention: "",
          quotation: "",
          invoice: "",
          custommerContact: "",
          vendorAddress: "",
          customerPoNo: "",
        },
      ],
    };
  },
  mounted() {},
  methods: {
    async save() {
      try {
        const response = await axios.post(
          "/api/instruction/add/",
          instructions
        );
        this.items = response.data.data;
        this.vendor = "";
        this.attention = "";
        this.quotation = "";
        this.invoice = "";
        this.custommerContact = "";
        this.vendorAddress = "";
        this.customerPoNo = "";
      } catch (e) {
        console.log("err");
      }
    },
  },
};
</script>

<style>
</style>
