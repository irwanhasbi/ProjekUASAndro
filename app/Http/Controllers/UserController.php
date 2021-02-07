<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->json('email');
        $pass = $request->json('password');
        $user = User::where('email', $email)->first();

        if ($user) {
            if (Hash::check($pass, $user->password)) {
                return response()->json([
                    'data' => $user
                ]);
            }

            return response()->json([
                'message' => 'Password salah'
            ], 400);
        }
        
        return response()->json([
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'id_user' => uniqid('user-'),
            'name' => $request->json('name'),
            'email' => $request->json('email'),
            'password' => Hash::make($request->json('password'))
        ]);

        if ($user) {
            return response()->json([
                'message' => 'User berhasil di daftar'
            ]);
        }

        return response()->json([
            'message' => 'Gagal mendaftar user'
        ], 400);
    }
    
}
