<template>
  <div id="template" class="m-auto">
    <div class="row pt-4">
      <div class="col-md-6">
        <router-link to="/" class="customOpen">Open</router-link>
        <router-link to="/completed" class="customCompleted"
          >Completed</router-link
        >
        <!-- <a href="/" class="customOpen">Open</a>
        <a href="/completed" class="customCompleted">Completed</a> -->
      </div>
      <div class="col-md-6">
        <div class="row float-end" style="width: 200px">
          <a href="#" class="col-md-2">
            <div class="text-center customSearch">
              <i class="bi bi-search"></i>
            </div>
          </a>
          <a href="/report" class="col-md-8">
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
        <button
          class="accordion-button customButtonCreate p-1"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapseOne"
          aria-expanded="true"
          aria-controls="collapseOne"
        >
          + Create 3rd Party Instruction
        </button>
        <!-- </h2> -->
        <div id="collapseOne" class="accordion-collapse collapse">
          <div class="accordion-body">
            <div class="logisticLink">
              <i class="material-icons"> local_shipping </i>
              <a href="/logistic">Logistic Instruction</a>
            </div>
            <div class="serviceLink">
              <i class="material-icons"> manage_accounts </i>
              <a href="/service">Service Instruction</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- call child components in instruction component -->
    <router-view :instructions="instructions" />

    <h6 class="customDisplay">10 of 60 displayed</h6>
  </div>
</template>

<script>
export default {
  data() {
    return {
      instructions: [],
    };
  },
  mounted() {
    axios.get("/api/instruction/").then((response) => {
      this.instructions = response.data.data;
      console.log(this.instructions);
    });
  },
};
</script>

<style scoped>
#template {
  padding: 0 0 100px 0;
  width: 98%;
  margin-bottom: 100px !important;
  background-color: #ffffff;
  box-shadow: 5px 5px 8px #888888;
  border-radius: 10px;
}
.customOpen {
  font-weight: bold;
  color: #00bfbf;
  margin-right: 20px;
  margin-left: 20px;
}
.customCompleted {
  font-weight: bold;
  color: #adadad;
}
.customSearch {
  border: 1px solid #b9c0c7;
  width: 30px;
  border-radius: 5px;
  color: #00bfbf;
}
.customExport {
  border: 1px solid #b9c0c7;
  border-radius: 5px;
  width: 70px;
  color: #00bfbf;
}
.customExport > span {
  font-weight: bold;
  color: #494949;
}
.customButtonCreate {
  margin: 20px 20px 0 0 !important;
  padding: 7px 0 7px 0;
  width: 220px;
  border-radius: 5px;
  background-color: #00bfbf;
  /* background-color: #1dccb5; */
  font-weight: bold;
  color: white;
  border: 0;
}
.accordion-body {
  background-color: #f1f1f1;
  width: 220px;
}
.logisticLink:hover,
.serviceLink:hover {
  background-color: #dfdfdf;
}
.logisticLink,
.serviceLink {
  padding: 10px 0 10px 0;
}
.logisticLink > i,
.serviceLink > i {
  padding-left: 20px;
  color: #00bfbf;
  vertical-align: bottom;
  font-size: 20px !important;
}
.logisticLink > a,
.serviceLink > a {
  padding-left: 20px;
  padding-bottom: 15px;
  color: black !important;
}

hr {
  width: 95%;
  border: 1px solid;
  margin: auto;
  margin-top: 15px;
}

.customDisplay {
  margin: 20px 0 0 20px;
  color: #b9c0c7;
}
</style>

