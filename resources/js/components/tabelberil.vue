<template>
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
              class="btn btn-secondary"
              tabindex="-1"
              role="button"
              aria-disabled="true"
              >-</a
            >
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {};
</script>

<style></style>
