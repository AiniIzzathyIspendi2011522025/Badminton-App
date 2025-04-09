<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordResets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    //
    public function changePassword(Request $request)
    {
        try {
            return view('auth.passwords.change');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function storeChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'required|min:8|same:password',
        ]);

        $validator->validate();
        try {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Berhasil merubah password');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal merubah password');
        }
    }

    public function forgetPasswordAct(Request $request)
    {
        try {
            // Validate the email field
            $validatedData = $request->validate([
                'email' => "required|email|exists:users,email"
            ]);

            $token = Str::random(10);
            // Update or create a password reset record based on the email column
            PasswordResets::updateOrCreate(
                ['email' => $request->email], // Use email as the unique key
                [
                    'token' => $token,
                    'created_at' => now()
                ]
            );

            Mail::to($request->email)->send(new ResetPasswordMail($token));

            return redirect('/forgot-password')->with('success', 'Email berhasil terkirim');
        } catch (\Throwable $th) {
            // Capture any validation errors or other exceptions
            return redirect('/forgot-password')->with('error', $th->getMessage());
        }
    }

    public function forgetPasswordValidate(Request $request, $token)
    {
        try {
            $validate = PasswordResets::where('token', $token)->first();
            if (!$validate) {
                return redirect('/forgot-password')->with('error', "token tidak valid");
            }

            return view('auth.passwords.confirm', compact('token'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function forgetPasswordValidateAct(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:8|same:password_confirmation',
                'password_confirmation' => 'required|min:8|same:password',
            ]);

            $validator->validate();

            $validateToken = PasswordResets::where('token', $request->token)->first();
            if (!$validateToken) {
                return redirect('/forgot-password')->with('error', "token tidak valid");
            }

            $user = User::where('email', $validateToken->email)->first();


            if (!$user) {
                return redirect('/login')->with('error', "Email tidak terdaftar");
            }

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            $validateToken->delete();

            return redirect('/login')->with('success', 'Berhasil merubah password');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal merubah password');
        }
    }
}
