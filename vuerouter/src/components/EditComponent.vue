<template>
    <div class="row">
        
        <div class="col-sm-7 mx-auto">
                <div class="card">
  <img src="https://via.placeholder.com/150" class="card-img-top rounded-circle mx-auto d-block" alt="User Profile Image" width="200px" height="200px">
  <div class="card-body">
    <h5 class="card-title text-center">{{users.name}}</h5>
    <hr>
    <div class="row">
      <div class="col-sm-6">
        <p><i class="bi bi-person-fill"></i> Age: {{users.id}}</p>
        <p><i class="bi bi-envelope-fill"></i> Email:  {{users.email}}</p>
        <p><i class="bi bi-telephone-fill"></i> Phone:  07777777777777</p>
      </div>
      <div class="col-sm-6">
        <p><i class="bi bi-globe"></i> Website: <a href="#"> {{users.email}}</a></p>
        <p><i class="bi bi-instagram"></i> Instagram: <a href="#"> {{users.email}}</a></p>
      </div>
    </div>
    <hr>
    <div class="text-center">
      <a href="#" class="btn btn-primary">Edit User</a>
    </div>
  </div>
</div>
        </div>
    </div>

</template>
<script>
import axois from 'axios';
export default{
    
    data(){
        return {
         
            users:'',
        }
    },
    mounted(){
        const id= this.$route.params.id;
        axois.get('http://localhost:8000/api/users/edit/'+id).then((response)=>{
            this.users=response.data
        })
    }
}
</script>