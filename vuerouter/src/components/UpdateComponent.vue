<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-6 mx-auto">
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <h4 class="card-title text-center mb-4">Create User</h4>
              <form @submit.prevent="createUser">
                <div class="mb-3">
                  <label for="name" class="form-label">Full Name</label>
                  <input
                    type="text"
                    id="name"
                    v-model="newUser.name"
                    required
                    class="form-control"
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input
                    type="email"
                    id="email"
                    v-model="newUser.email"
                    required
                    class="form-control"
                  />
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label"  > Phone Number</label>
                  <input
                    type="tel"
                    class="form-control"
                    id="phone"
                    placeholder="Enter employee phone number"
                    required
                    v-model="newUser.number"
                  />
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <textarea
                    class="form-control"
                    id="address"
                    placeholder="Enter employee address"
                    required
                    v-model="newUser.address"
                  ></textarea>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Image</label>
                    <input
                    type="file"
                    id="profileImage"
                    @change="handleFileUpload"
                    required
                    class="form-control"
                    />
                </div>
                <div class="mb-3">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    v-model="newUser.password"
                    required
                  />
                </div>
                
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">
                        Create Employee
                    </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  In your Vue.js component, define the newUser data object and a handleFileUpload method to handle file uploads. In the createUser method, use Axios to send a POST request to your server with the new user information and image:
  
  <script>
import axios from "axios";

export default {
  data() {
    return {
      newUser: {
        name: "",
        number: "",
        address: "",
        email: "",
        password: "",
        profileImage: "",
      },
    };
  },
  methods: {
    handleFileUpload(event) {
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = (event) => {
        const img = new Image();
        img.onload = () => {
          const canvas = document.createElement("canvas");
          const ctx = canvas.getContext("2d");
          canvas.width = 128;
          canvas.height = 128;
          ctx.drawImage(img, 0, 0, 128, 128);
          canvas.toBlob(
            (blob) => {
              const correctedFile = new File([blob], file.name, {
                type: file.type,
              });
              this.newUser.profileImage = correctedFile;
            },
            file.type,
            1
          );
        };
        img.src = event.target.result;
      };
      reader.readAsDataURL(file);
    },
    createUser() {
      const formData = new FormData();
      formData.append("name", this.newUser.name);
      formData.append("email", this.newUser.email);
      formData.append("password", this.newUser.password);
      formData.append("profileImage", this.newUser.profileImage);
      formData.append("number", this.newUser.number);
      formData.append("address", this.newUser.address);
      axios
        .post("http://localhost:8000/api/users/create/", formData)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>