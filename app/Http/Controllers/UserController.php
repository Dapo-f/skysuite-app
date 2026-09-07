<?php

namespace App\Http\Controllers;
use App\Models\AccountVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Registration method
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => "nullable|string|max:10",
            'firstname' => "required|string|max:20",
            'lastname' => "required|string|max:20",
            'email' => "required|email|unique:users,email",
            'password' => "required|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", 
            'tel' => [
                'required',
                'string',
                'unique:users,tel',
                'regex:/^(\+234|0)[789][01]\d{8}$/'
            ],
            'alternative_tel' => [
                'nullable',
                'string',
                'unique:users,tel',
                'regex:/^(\+234|0)[789][01]\d{8}$/'
            ],
            'address' => "nullable|string",
            'id_type' => 'required|string|in:nin,passport,drivers_license,voters_card,lassra',
            'id_number' => 'required|string|min:10|max:16',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "Registation Failed",
                'errors' => $validator->errors(),
            ], 400);
        }

        try{
            DB::beginTransaction();
            $user = new User;
            $user->title = $request->title;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->tel = $request->tel;
            $user->alternative_tel = $request->alternative_tel;
            $user->address = $request->address;
            $user->id_type = $request->id_type;
            $user->id_number = $request->id_number;
            $user->save();

            // Remove existing verification tokens for the user
            DB::table('account_verifications')->where('email', $user->email)->delete();

            // Generate a verification token
            $token = rand(100000, 999999);

            // Store token in the database
            AccountVerification::create([
                'email' => $user->email,
                'token' => $token,
                'expires_at' => now()->addMinutes(10),
            ]);

            $url = config('app.frontend_url') . "/verify-account?token={$token}&email={$user->email}";
            // Send email verification
            Mail::send('emails.user-verification', [
                'user' => $user,
                'url' => $url,
                'token' => $token,
            ], function ($message) use ($user){
                $message->to($user->email)->subject('Verify Your Account');
            });

            DB::commit();
            return response()->json([
                'message' => 'Register Successfully',
                'user' => $user,
            ],201);
        } catch (\Exception $error) {
            DB::rollBack();
            return response()->json([
                'message' => "Server Error",
                'errors' => $error,
            ],500);
        }
    }
}
