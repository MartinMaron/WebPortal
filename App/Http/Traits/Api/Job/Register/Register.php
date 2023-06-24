<?php
namespace App\Http\Traits\Api\Job\Register;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait Register
{
    public function register(Array $data)
    {

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'function' => 'JobController.register',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0,
                ]);
        }

        $user = User::updateOrcreate(
            ['email' => $data['email']],
            ['name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'isUser' => $data['isUser'],
            'isAdmin' => $data['isAdmin'],
            'isMieter' => $data['isMieter'],
            ]
            );


        return response()->json([
            'function' => 'JobController.register',
            'result' => 'success',
            'id' => $user->id,
            'data' => $data,
        ]);

    }
}