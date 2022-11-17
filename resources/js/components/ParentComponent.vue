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
      <hr>
    </div>

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
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
#template {
  width: 80%;
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

hr{
  width: 95%;
  border: 1px solid;
  margin: auto;
  margin-top: 15px;
}

.status{
  width: 100px;
  height: auto;
  border-radius: 10px;
  background-color: lightblue;
  text-align: center;
  font-size: 12px;
}
</style>
