<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Registration method
    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => "nullable|string|max:10", 
            'firstname' => "required|string|max:20", 
            'lastname' => "required|string|max:20", 
            'email' => "required|email|unique:users,email", 
            'password' => "required|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", 
            'tel' =>"required|string|unique:users,tel|regex:/^(\+234|0)[789][01]\d{8}$/", 
            'alternative_tel' =>"nullable|string|unique:users,tel|regex:/^(\+234|0)[789][01]\d{8}$/", 
            'address' => "nullable|string", 
            'id_type' => 'required|string|in:nin,passport,drivers_license,voters_card,lassra', 
            'id_number' => 'required|string|min:10|max:16',
        ],[
            'firstname.required' => 'Seun is disturbing our class',
            'firstname.max' => 'Seun lies alot',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => "Registation Failed",
                'errors' => $validator->errors(),
            ], 400);
        }
    }
}
