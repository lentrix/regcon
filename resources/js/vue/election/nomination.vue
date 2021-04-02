<template>
  <div>
    <div
      class="modal fade"
      id="nominateModal"
      tabindex="-1"
      aria-labelledby="nominateModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="nominateModalLabel">
              Confirm Nomination
            </h5>
            <button
              type="button"
              class="close"
              v-on:click="hideModal"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4>You are about to nominate</h4>
            <div
              v-if="selectedUser != null"
              style="display: flex; font-size: 1.2em"
            >
              <img
                :src="selectedUser.imgUrl"
                style="
                  width: 200px;
                  height: 200px;
                  margin-right: 1em;
                  display: inline-block;
                "
                alt="Profile Picture"
              />
              <div style="line-height: 120%; margin-top:40px">
                <strong style="font-size: 1.3em"
                  >{{ selectedUser.lname }}, {{ selectedUser.fname }}</strong
                >
                <br />
                {{ selectedUser.designation }}, <br />
                <i>{{ selectedUser.school }}</i>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              v-on:click="hideModal"
              data-dismiss="modal"
            >
              Cancel
            </button>
            <button
              type="button"
              class="btn btn-primary"
              v-on:click="postNomination"
            >
              Confirm Nomination
            </button>
          </div>
        </div>
      </div>
    </div>

    <h4>Election State: Nomination</h4>
    <div v-if="nominee==null">
      <div class="alert alert-info">
        You may search for a worthy member for nomination.
        <div class="input-group">
          <input
            type="text"
            id="search-key"
            v-model="searchKey"
            class="form-input"
            placeholder="Search for member"
          />
          <div class="input-group-append">
            <button
              class="btn btn-primary btn-sm"
              v-on:click="search()"
              title="Search member for nomination"
            >
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </div>

      <hr />

      <div
        v-if="hasSearched && searchResult.length == 0"
        class="alert alert-warning"
      >
        No results found.
      </div>

      <div class="search-result">
        <div
          v-for="(user, index) in searchResult"
          v-bind:key="index"
          class="item"
          v-on:click="confirm(user)"
        >
          <img :src="user.imgUrl" alt="" />
          <div class="info">
            <strong>{{ user.lname }}, {{ user.fname }}</strong> <br />
            {{ user.designation }}, <br /><i>{{ user.school }}</i>
          </div>
        </div>
      </div>
    </div>

    <div v-if="nominee!=null">
        <div class="alert alert-success">
            You have nominated..
        </div>
        <div style="display: flex; font-size: 1.2em">
        <img
            :src="nominee.imgUrl"
            style="
            width: 150px;
            height: 150px;
            margin-right: 1em;
            display: inline-block;
            "
            alt="Profile Picture"
        />
        <div style="line-height: 120%; margin-top: 30px;">
            <strong style="font-size: 1.3em">{{ nominee.lname }}, {{ nominee.fname }}</strong>
            <br />
            {{ nominee.designation }}, <br />
            <i>{{ nominee.school }}</i>
        </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      searchKey: "",
      searchResult: [],
      hasSearched: false,
      selectedUser: null,
      nominee: null,
    };
  },
  methods: {
    search: function () {
      // var token = $('meta[name="user-token"]').attr('content');

      axios
        .post("/election/search-member", {
          searchKey: this.searchKey,
        })
        .then((response) => {
          if (response.status == 200) {
            this.searchResult = response.data;
            this.hasSearched = true;
          }
        });
    },
    confirm: function (user) {
      this.selectedUser = user;
      $("#nominateModal").modal("show");
    },
    hideModal: function () {
      $("#nominateModal").modal("hide");
    },
    postNomination: function () {
      axios
        .post("/election/nomination", {
          user_id: this.selectedUser.id,
        })
        .then(response=>{
            if(response.status==201) {
                this.nominee = this.selectedUser;
                $("#nominateModal").modal("hide");
            }
        })
    },
    checkNomination: function () {
      axios.get("/election/check-nomination").then((response) => {
        if (response.status == 200) {
          this.nominee = response.data.nominee;
          console.log(this.nominee);
        }
      });
    },
  },
  created() {
    this.checkNomination();
  },
};
</script>


<style scoped>
.search-result {
  display: flex;
  flex-flow: wrap;
  justify-content: center;
}

.item {
  width: 150px;
  background-color: #dfdfdf;
  padding: 8px;
  text-align: center;
  margin: 0.5em 1em;
  cursor: pointer;
}

.item:hover {
  box-shadow: 0px 0px 2px 1px #444;
  background-color: floralwhite;
}

.item > img {
  width: 100px;
  height: 100px;
  margin-bottom: 20px;
  border-radius: 50px;
}
</style>
