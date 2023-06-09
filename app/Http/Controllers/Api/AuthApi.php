<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthApi extends Controller
{
    public function changePassword(Request $request){
        $user_id = $request->user_id;
        $current_password = $request->currentPassword;
        $new_password = $request->newPassword;

        $user = User::where('id',$user_id)->first();
        if(Hash::check($current_password, $user->password)){
            //change
           User::where('id',$user->id)->update([
                'password' => Hash::make($new_password)
            ]);
            return response()->json([
                'message' => true,
                'data' => null
            ]);
        }else{
            return response()->json([
                'message' => false,
                'data' => null
            ]);
        }
    }
}
