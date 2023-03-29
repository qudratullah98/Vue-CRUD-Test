<template>
  <div>
    <div class="container">
      <div class="alert alert-success" role="alert" v-if="elertMassage">
  {{ message }}
</div>
      <div class="row mb-3">
        <div class="col-sm-12">
          <router-link
            :to="{ name: 'NewUser' }"
            class="btn btn-outline-success"
          >
            Create New User</router-link
          >
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">phone</th>
                <th scope="col">Image</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="users in users" :key="users">
                <th scope="row">{{ users.id }}</th>
                <td>{{ users.name }}</td>
                <td>{{ users.address }}</td>
                <td>{{ users.number }}</td>
                <td><img :src="'http://localhost:8000/storage/' + users.image" alt="My Image" width="90" height="80"/></td>
                <td>{{ users.email }}</td>
                <td>
                  <router-link
                    :to="{ name: 'EditUser', params: { id: users.id } }"
                    class="btn btn-info m-1 btn-sm"
                    >View</router-link
                  >
                  <button
                    type="button"
                    class="btn btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    @click="DeleteUser(users.id, users.name)"
                  >
                    X
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Confirmation modal -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">delete {{ userTodelete_name }} ?</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              ref="myButton"
            >
              No
            </button>
            <button type="button" class="btn btn-primary" @click="Delete">
              Yes
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axois from "axios";
export default {
  data() {
    return {
      users: [],
      showModal: true,
      userTodelete_id: 0,
      userTodelete_name: "",
      message:"",
      elertMassage:false,
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    DeleteUser(Userid, UserName) {
      this.userTodelete_name = UserName;
      this.userTodelete_id = Userid;
    },
    getData(){
      axois.get("http://localhost:8000/api/users").then((response) => {
      this.users = response.data;
    });
    },
    Delete() {
      
      axois.get("http://localhost:8000/api/users/delete/"+this.userTodelete_id).then((response) => {
        this.$refs.myButton.click();
        this.getData();
        this.elertMassage=true
        setTimeout(() => {
          console.log(response.data.message)          
          this.elertMassage=false
          this.message=response.data.message
      }, 3000);
      
      });
    },
  },
};
</script>