<template>
  <div id="template" class="m-auto">
    <div class="row">
      <div class="col-md-6 ps-3">
        <a href="#">Open</a>
        <a href="#">Completed</a>
      </div>
      <div class="col-md-6">
        <div class="float-end pe-3">
          <a href="#">Search</a>
          <a href="#">Export</a>
        </div>
      </div>
      <hr />
    </div>

    <br>

    <div class="status float-end">in progress</div>
    <br>
    
    <div class="row">
      <div class="row">
        <div class="col-md-2">
            <button>Service Instruction</button>
        </div>
        <div class="col-md-2">
            <label for="">Assegned Vendor</label>
            <br>
          <select name="" id="">
            <option value="1">option 1</option>
            <option value="2">option 2</option>
            <option value="3">option 3</option>
          </select>
        </div>
        <div class="col-md-2">
          <label for="">attention of</label>
          <input type="text" />
        </div>
        <div class="col-md-2">
          <label for="">quotation no</label>
          <input type="text" name="" id="" />
        </div>
        <div class="col-md-2">
            <label for="">Invoice To</label>
            <br>
          <select name="" id="">
            <option value="1">option 1</option>
            <option value="2">option 2</option>
            <option value="3">option 3</option>
          </select>
        </div>
        <div class="col-md-2">
            <label for="">Customer contact</label>
            <br>
          <select name="" id="">
            <option value="1">option 1</option>
            <option value="2">option 2</option>
            <option value="3">option 3</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <label for="">Vendor Address</label>
            <input type="text" style="width:100%">
        </div>
        <div class="col-md-2">
            <label for="">Customer PO No</label>
            <input type="text" name="" id="">
        </div>
      </div>
    </div>


    <div class="row">
        <table class="table m-auto">
        <thead>
          <tr>
            <th scope="col">Description</th>
            <th scope="col">QTY</th>
            <th scope="col">UOM</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Discount(%)</th>
            <th scope="col">GST/GVT(%)</th>
            <th scope="col">Currency</th>
            <th scope="col">Vat Amount</th>
            <th scope="col">Sub Total</th>
            <th scope="col">Total</th>
            <th scope="col">Change To</th>
            <th scope="col">. . .</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row"><input type="text" name="" id=""></th>
            <td><input type="text" size="4"></td>
            <td>
                <select name="" id="">
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
            </td>
            <td><input type="text" size="5"></td>
            <td><input type="text" size="4"></td>
            <td><input type="number" style="width: 7em"></td>
            <td>
                <select name="" id="">
                    <option value="1">option 1</option>
                    <option value="2">option 2</option>
                    <option value="3">option 3</option>
                </select>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <select name="" id="">
                    <option value="1">option 1</option>
                    <option value="2">option 2</option>
                    <option value="3">option 3</option>
                </select>
            </td>
            <td>
              <div class="status">-</div>
            </td>
          </tr>

        </tbody>
      </table>
    </div>














    <!-- <div class="row">
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
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>
              <div class="status">in progress</div>
            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
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
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>
              <div class="status">in progress</div>
            </td>
          </tr>
        </tbody>
      </table>
    </div> -->
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
#template {
  width: 98%;
  height: 500px;
  background-color: #ffffff;
  box-shadow: 5px 5px 8px #888888;
  border-radius: 10px;
}

table {
  /* position: relative; */
  margin-top: 30px !important;
  width: 90%;
  /* padding-top: 100px !important; */
}

thead {
  background-color: antiquewhite;
}

hr {
  width: 95%;
  border: 1px solid;
  margin: auto;
  margin-top: 15px;
}

.status {
  width: 100px;
  height: auto;
  border-radius: 10px;
  background-color: lightblue;
  text-align: center;
  font-size: 12px;
}
</style>
