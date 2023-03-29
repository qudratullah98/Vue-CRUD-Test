<template>
  <div class="row">
    <div class="alert alert-success" role="alert" v-if="elertMassage">
  User Updated Successfully !
</div>
    <div class="col-sm-7 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4"> <img
        :src="'http://localhost:8000/storage/' + users.image"
          class="card-img-top rounded-circle  d-block"
          alt="User Profile Image"
          width="50"
          height="100"
        /></div>
          <div class="col-sm-4"></div>
        </div>
       
        <div class="card-body">
          <h5 class="card-title text-center">{{ users.name }}</h5>
          <hr />
          <div class="row">
            <div class="col-sm-6">
              <p>
                <i class="bi bi-person-fill"></i> <strong> id:</strong>
                {{ users.id }}
              </p>
              <p>
                <i class="bi bi-envelope-fill"></i><strong> Email:</strong>
                {{ users.email }}
              </p>
              <p>
                <i class="bi bi-telephone-fill"></i> <strong>Phone:</strong>
                {{ users.number }}
              </p>
            </div>
            <div class="col-sm-6">
              <p>
                <i class="bi bi-globe"></i><strong> Website:</strong>
                <a href="#"> {{ users.email }}</a>
              </p>
              <p>
                <i class="bi bi-instagram"></i><strong> Address:</strong>
                {{ users.address }}
              </p>
            </div>
          </div>
          <hr />
          <div class="text-center">
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
            >
              Edit User
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- model -->
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
            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <form @submit.prevent="submitForm" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"
                >Name</label
              >
              <input
                type="text"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="name"
                 
                v-model="newData.name"
              />
            </div>

            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"
                >Phone</label
              >
              <input
                type="text"
                class="form-control"
                id="phone number"
                placeholder="phone number"
                
                v-model="newData.number"
              />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"
                >Email address</label
              >
              <input
                type="email"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="name@example.com"
                
                v-model="newData.email"
              />
            </div>

            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label"
                >Address</label
              >
              <textarea
                class="form-control"
                id="exampleFormControlTextarea1"
                rows="3"
               
                v-model="newData.address"
              ></textarea>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label"
                >Image</label
              >
              <input
                type="file"
                class="form-control"
                id="exampleFormControlInput1"
                placeholder="name"
                ref="file" accept="image/*"
                 
              />
            </div>
          </div>
          <div class="modal-footer">
            <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
            ref="close"
            >
            Close
          </button>
          <button type="submit" class="btn btn-primary" >Save changes</button>
        </div>
      </form>
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
      users:[],
      elertMassage:false,
      newData: {
        name: "",
        number: "",
        email: "",
        address: "", 
        image:"",
      },
    };
  },
  mounted() {
   this.getData();
  },
 
  methods: {
    getData(){
      const id = this.$route.params.id;
    axois.get("http://localhost:8000/api/users/edit/" + id).then((response) => {
      this.users=response.data
      this.newData.name = response.data.name;
      this.newData.email = response.data.email;
      this.newData.address = response.data.address;
      this.newData.number = response.data.number;

    });
    },
 
    UpdateUser(){
      alert(this.users.id)
    },
    submitForm() {
      const formData = new FormData();
      formData.append('image', this.$refs.file.files[0]);
      formData.append("name", this.newData.name);
      formData.append("email", this.newData.email);
      formData.append("number", this.newData.number);
      formData.append("address", this.newData.address);

      axois.post("http://localhost:8000/api/users/update/"+this.users.id, formData)
        
      .then(response => {
        console.log(response)
        // Handle successful response
        this.getData();
        this.$refs.close.click();
        this.elertMassage=true
        setTimeout(() => {
          console.log(response.data.message)          
          this.elertMassage=false
          this.message=response.data.message
      }, 3000);
      })
      .catch(error => {
        console.log(error)

        // Handle error
      });
    }
  }
};
</script>