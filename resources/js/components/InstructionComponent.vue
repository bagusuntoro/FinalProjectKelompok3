<template>
  <div id="template" class="m-auto">
    <div class="row pt-4">
      <div class="col-md-6">
        <router-link to="/" class="customOpen teal" id="open">Open</router-link>
        <router-link to="/completed" class="customCompleted" id="completed"
          >Completed</router-link
        >
      </div>

      <div class="col-md-2"></div>

      <div class="col-md-4">
        <div class="row" style="width: 200px">
          <a href="#" class="col-md-10">
            <!-- search -->
            <div class="search-box ms-4">
              <input type="text" placeholder="  search...." id="search" />
              <a href="#" class="icon">
                <i class="fas fa-search"></i>
              </a>
            </div>

            <!-- export -->
          </a>
          <a href="/report" class="col-md-2">
            <div class="text-center customExport ms-5">
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
        <div class="dropdown float-end me-5">
          <button
            class="btn customButtonCreate"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            + Create 3rd Party Instruction
          </button>
          <div class="dropdown-menu customMenu">
            <div class="logisticLink">
              <a href="/logistic" class="dropdown-item"
                ><i class="material-icons"> local_shipping </i>Logistic
                Instruction</a
              >
            </div>
            <div class="serviceLink">
              <a href="/service" class="dropdown-item"
                ><i class="material-icons"> manage_accounts </i> Service
                Instruction</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- call child components in instruction component -->
    <router-view :instructions="instructions" />
    <!-- <open-instruction /> -->

    <h6 class="customDisplay">10 of 60 displayed</h6>
  </div>
</template>

<script>
// import { mapGetters } from "vuex";
export default {
  data() {
    return {
      instructions: [],
    };
  },
  // computed: {
  //   ...mapGetters({
  //     instruction: "getData",
  //   }),
  // },
  mounted() {
    let completed = document.getElementById("completed");
    let open = document.getElementById("open");

    completed.addEventListener("click", function () {
      completed.classList.toggle("teal");
      open.classList.toggle("teal");
    });

    axios.get("/api/instruction/").then((response) => {
      this.instructions = response.data.data;
      console.log(this.instructions);
    });

    // $('button').text('Hello World!');
  },
};
</script>

<style scoped>
#template {
  padding: 0 0 100px 0;
  width: 98%;
  margin-bottom: 100px !important;
  background-color: #fff;
  box-shadow: 5px 5px 8px #888888;
  border-radius: 10px;
}

.customOpen {
  font-weight: bold;
  margin-right: 20px;
  margin-left: 20px;
  color: #adadad;
}

.customCompleted {
  font-weight: bold;
  color: #adadad;
}

.teal {
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

.customMenu {
  border: none;
  width: 220px;
}

.logisticLink > a > i,
.serviceLink > a > i {
  padding-right: 20px !important;
  color: #00bfbf !important;
  vertical-align: bottom !important;
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

/* search */
.search-box {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #b9c0c7;
  height: 40px;
  border-radius: 40px;
  color: white;
}

.search-box:hover > input {
  width: 200px !important;
  padding: 0 200px;
}

.search-box:hover > .icon {
  transform: rotate(360deg) scale(0.7);
  margin-top: -40px;
}
input::placeholder {
  color: white;
}
input {
  text-indent: 20px;
}

input#search {
  width: 0;
  border: none;
  outline: none;
  padding: 0;
  background: none;
  font-size: 1.1rem;
  transition: 0.5s ease;
  line-height: 40px;
  color: #fff;
}

.icon {
  color: #21dfcd;
  float: right;
  width: 40px;
  font-size: 1.3rem;
  height: 40px;
  border-radius: 50%;
  background: #ffffff;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: 0.4s;
  cursor: pointer;
  text-decoration: none;
}
</style>

