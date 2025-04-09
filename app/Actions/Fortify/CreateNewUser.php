<?php

namespace App\Actions\Fortify;

use App\Models\Membership;
use App\Models\PointBalance;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        try {


            if ($input['role'] == 'admin') {
                $validator = Validator::make($input, [
                    'first_name' => ['required', 'string', 'max:40'],
                    'last_name' => ['required', 'string', 'max:40'],
                    'email' => [
                        'required',
                        'string',
                        'email',
                        'max:255'
                    ],
                    'password' => $this->passwordRules(),
                    '
            ' => ['required', 'string', 'min:8'],
                ]);

                $validator->validate();


                $user = new User;
                $user->email = $input['email'];
                $user->password = Hash::make($input['password']);
                $user->first_name = $input['first_name'];
                $user->last_name = $input['last_name'];
                $user->user_id = $user->id;
                $user->save();
            } elseif ($input['role'] == 'owner') {
                $validator = Validator::make($input, [
                    'first_name' => ['required', 'string', 'max:40'],
                    'last_name' => ['required', 'string', 'max:40'],
                    'email' => [
                        'required',
                        'string',
                        'email',
                        'max:255'
                    ],
                    'phone' => ['required', 'numeric', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
                    'password' => $this->passwordRules(),
                    'password_confirmation' => ['required', 'string', 'min:8'],
                ]);
                $validator->validate();
                $user = new User;
                $user->email = $input['email'];
                $user->password = Hash::make($input['password']);
                $user->first_name = $input['first_name'];
                $user->last_name = $input['last_name'];
                $user->handphone = $input['phone'];
                $user->role = 'owner';
                $user->save();
            } elseif ($input['role'] == 'customer') {
                $validator = Validator::make($input, [
                    'first_name' => ['required', 'string', 'max:40'],
                    'last_name' => ['required', 'string', 'max:40'],
                    'email' => [
                        'required',
                        'string',
                        'email',
                        'max:255'
                    ],
                    'phone' => ['required', 'numeric', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
                    'password' => $this->passwordRules(),
                    'password_confirmation' => ['required', 'string', 'min:8'],
                ]);

                $validator->validate();

                $user = new User;
                $user->email = $input['email'];
                $user->password = Hash::make($input['password']);
                $user->handphone = $input['phone'];
                $user->first_name = $input['first_name'];
                $user->last_name = $input['last_name'];
                $user->save();

                $pointBalance = new PointBalance;
                $pointBalance->user_id = $user->id;
                $pointBalance->point_balance = 0; // Atur saldo awal 
                $pointBalance->save();
            }

            return $user;
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => ['Email Sudah digunakan'],
            ]);
        }
    }
}
