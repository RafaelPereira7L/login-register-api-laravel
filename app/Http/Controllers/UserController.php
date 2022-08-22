<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        return response()->json([User::all()]);
    }

    public function show(User $user) {
            return response()->json([$user]);
    }

    public function store(StoreUserRequest $request) {
        $request->header('Accept', 'application/json');

        if($input = $request->validated()) {

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);

        return response()->json([
            'status' => 'Registrado com sucesso!',
            'user' => $user], 201);
        }
            else {
                return response()->json([validator()->errors()], 400);
        }
    }

    public function login(User $user, Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = true;
            return response()->json([
                'auth' => $auth,
                'status' => 'Logado com sucesso!',
                'user' => Auth::user()]);
        }

        $auth = false;
        return response()->json([
            'auth' => $auth,
            'error' => 'Erro ao realizar login!'], 401);
    }
}
