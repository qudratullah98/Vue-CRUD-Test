<template>
  <div>
    <div class="container">
      <div class="row mb-3">
        <div class="col-sm-12">
          
           <router-link :to="{name:'NewUser'}" class="btn btn-outline-success"> Create New User</router-link>
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
                <td>{{ users.image }}</td>
                <td>{{ users.email }}</td>
                <td>
                  <router-link
                    :to="{ name: 'EditUser', params: { id: users.id } }"
                    class="btn btn-info m-1 btn-sm"
                    >Edit</router-link
                  >
                  <router-link to="edit" class="btn btn-success m-1 btn-sm"
                    >Delete</router-link
                  >
                </td>
              </tr>
            </tbody>
          </table>
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
        };
    },
    mounted() {
        axois.get("http://localhost:8000/api/users").then((response) => {
            this.users = response.data;
        });
    },
};
</script>