<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $validation_string = ($input['type'] == 2) ? ['sometimes'] : ['required', 'string', 'min:7', 'max:11'];


        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'uid' => $validation_string,
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'type' => ['required', 'numeric']
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'student_uid' => $input['uid'] ?? null,
            'email' => $input['email'],
            'type' => $input['type'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
