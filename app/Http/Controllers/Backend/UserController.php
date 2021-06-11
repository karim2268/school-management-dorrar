<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function UserView(){
        //  dd('user view');
        $allUsers= User::all();

        $data['allData']= User::all();
        return view('backend.user.view_user', $data);




    }

public function UserEdit($id){

   $editData= User::find($id);

   return view('backend.user.edit_user' ,compact('editData'));
}


public function UserUpadte(Request $request, $id){

       $data = User::find($id);
 
        $data->usertype =$request->usertype;
        
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->save();
        $notification = array(
    		'message' => 'User Updated Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('users.view')->with($notification);

}

public function UserDelete($id){
   // dd('delete user');
$user =User::find($id);
$user->delete();
$notification = array(
    'message' => 'User deleted Successfully',
    'alert-type' => 'success'
);

return redirect()->route('users.view')->with($notification);




}


public function UserAdd(){

   return view('backend.user.add_user');
}

public function UserStore(Request $request){
    $validateData = $request->validate([

        'email' => 'required|unique:users',
        'name' => 'required'

    ]);

    $data = new User();
        // $code = rand(0000,9999);
    	// $data->usertype = 'Admin';
        $data->usertype =$request->usertype;
        //$data->role = $request->role;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->password = bcrypt($request->password);
        //$data->code = $code;
    	$data->save();

    	$notification = array(
    		'message' => 'User Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('users.view')->with($notification);



}






}



