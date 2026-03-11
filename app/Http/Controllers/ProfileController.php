<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    public function showMe(Request $request){
        return response()->json([
            'message' => 'Profile fetched successfully',
            'user' => $request->user()
        ],200);
    }

    public function update(UpdateProfileRequest $request){
        $user = $request->user();
        $user->update($request->only('name','email'));


        return response()->json([
            'message' => 'Profile updated succcessfully',

        ],200);
    }

    public function updatePassword(ChangePasswordRequest $request){
        $user = $request->user();

        if(!Hash::check($request->current_password,$user->password)){
            return response()->json([
                'message' => 'current password is incorrect',

            ],422);
        }
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
        return response()->json(['message' => 'Password updated successfully'], 200);
    }

    public function destroy(Request $request){
        $request->user()->delete();
        return response()->json([
            'message' => 'Account deleted successfully'
        ],200);
    }
}
