<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
   {
        $users= User::get();
        return response()->json($users);
   }
   public function edit(User $id){
    return response()->json($id);
   }
   public function store(Request $request){
    $request->file('profileImage')->store("Users");
    return response()->json("dd");
   }
}
