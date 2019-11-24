<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\{Auth, Hash};

class UserController extends Controller {

    protected $jwt;

    public function __construct(JWTAuth $jwt) {
        $this->jwt = $jwt;
        $this->middleware('auth:api', [
            'except' => ['login', 'store']
        ]);
    }

    public function login(Request $request) {
        $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required'
        ]);
        if (!$token = $this->jwt->claims(['email' => $request->email])->attempt($request->only('email', 'password')))
            return response()->json(['message' => 'User not found!'], 404);

        return response()->json(compact('token'));
    }

    public function logout() {
        Auth::logout();
        return response()->json(['message' => 'User successfully logged out!']);
    }

    public function index() {
        return response()->json(User::all());
    }

    public function info() {
        $user = Auth::user();
        return response()->json($user);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'user' => 'required|min:5|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->user = $request->user;
        $user->password = Hash::make($request->password);
        $user->verified = 0;
        $user->save();
        return response()->json($user);
    }

    public function show(int $id) {
        return response()->json(User::findOrFail($id));
    }

    public function update(int $id, Request $request) {
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->user = $request->user;
        $user->password = $request->password;
        $user->verified = $request->verified;
        $user->save();
        return response()->json($user);

    }

    public function destroy(int $id) {

        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'User successfully removed!'
        ], 200);
    }


}
