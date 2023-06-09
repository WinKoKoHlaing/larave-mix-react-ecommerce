<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileApi extends Controller
{
    public function updateProfile(Request $request){
        // find-user
        $user_id = $request->user_id;
        $user = User::where('id',$user_id);
        if($user){
            // image-upload
            $file = $request->file('image');
            if($file){
                $file_name = uniqid() . $file->getClientOriginalName();
                $file->move(public_path('/images'),$file_name);
                File::delete(public_path('images/').$user->first()->image);
            }else{
                $file_name = $user->first()->image;
            }
    
            // user-update
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => $file_name,
                'address' => $request->address
            ]);
    
            return response()->json([
                'message' => true,
                'data' => $user->first()
            ]);

        }else{
            return response()->json([
                'message' => false,
                'data' => 'User Not Found'
            ]);
        }



    }


}
