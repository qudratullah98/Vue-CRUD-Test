<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return response()->json($users);
    }
    public function edit(User $id)
    {
        return response()->json($id);
    }
    public function Delete(User $id)
    {
        $id->delete();
        return response()->json(["message" => "User Deleted Successfully"]);
    }
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "address" => "required",
            "number" => "required",
            "profileImage" => "required",
            "password" => "required",
        ]);
        $image = $request->file('profileImage')->store("/User");
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->number = $request->number;
        $user->password = bcrypt($request->password);
        $user->image = $image;
        $user->save();
        return response()->json("User Saved Successfuly");
    }
    public function update(Request $request,User $id){
        if($request->file('image')){
           $image= $request->file('image')->store('/User');
            $id->image=$image;
        }
        $id->name=$request->name;
        $id->email=$request->email;
        $id->number=$request->number;
        $id->address=$request->address;
        $id->update();
        return response()->json((["message"=>"Data Updateded"]));

    }
}
