<template>
  <div id="template" class="m-auto">
    <div class="row pt-4">
      <div class="col-md-6">
        <a href="#" class="customOpen">Open</a>
        <a href="#" class="customCompleted">Completed</a>
      </div>
      <div class="col-md-6">
        <div class="row float-end" style="width:200px;">
          <a href="#" class="col-md-2">
            <div class="text-center customSearch">
              <i class="bi bi-search"></i>
            </div>
          </a>
          <a href="#" class="col-md-8">
            <div class="text-center customExport">
              <i class="bi bi-file-earmark-zip"></i><span> Export</span>
            </div>
          </a>
        </div>
      </div>
    </div>
    <hr />


    <!-- button create instruction -->
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-5"></div>
      <div class="col-md-3">
        <!-- <button class="">+ Create 3rd Party Instruction</button> -->
        <div class="accordion" id="accordionExample">
          <!-- <div class="accordion-item"> -->
            <!-- <h2 class="accordion-header" id="headingOne"> -->
              <button class="accordion-button customButtonCreate p-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                + Create 3rd Party Instruction
              </button>
            <!-- </h2> -->
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <ul>
                  <li>
                    <a href="/logistic">Logistic Instruction</a>
                  </li>
                  <li>
                    <a href="/service">Service Instruction</a>
                  </li>
                </ul>
              </div>
            </div>
          <!-- </div> -->
        </div>
      </div>
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




    <h6 class="customDisplay">10 of 60 displayed</h6>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
#template {
  width: 98%;
  height: 500px;
  background-color: #ffffff;
  box-shadow: 5px 5px 8px #888888;
  border-radius: 10px;
}
.customOpen{
  font-weight: bold;
  color:#1dccb5;
  margin-right: 20px;
  margin-left: 20px;
}
.customCompleted{
  font-weight: bold;
  color:#adadad;
}
.customSearch{
  border: 1px solid #adadad; 
  width:30px;
  border-radius: 5px;
  color:#1dccb5;
}
.customExport{
  border: 1px solid #adadad; 
  border-radius: 5px;
  width:70px;
  color:#1dccb5;
}
.customExport>span{
  font-weight: bold;
  color: #494949;
}
.customButtonCreate{
  margin:20px 20px 0 0 !important;
  padding: 7px 0 7px 0;
  width: 220px;
  border-radius: 5px;
  background-color: #1dccb5;
  font-weight: bold;
  color:white;
  border:0;
}
table {
  /* position: relative; */
  margin-top: 30px !important;
  width: 90%;
  /* padding-top: 100px !important; */
}
thead {
  background-color: #bbbbbb;
  color: white;
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
.customDisplay{
  margin: 20px 0 0 20px;
  color:#c7c4c4;
}
</style>

