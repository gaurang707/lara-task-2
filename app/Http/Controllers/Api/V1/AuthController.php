<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Api\Traits\ApiResponse;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $credentials = $request->only("email", "password");
        $user = User::where("email", $credentials["email"])->first();

        if (!$user && Hash::check($request->password, $user->password)) {
            $this->error("Invalid credentials");
        }


        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->success([
            'user' => $user,
            'token' => $token
        ], "User Logged Successfully");

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|unique:users,email",
            "name" => "required|string|max:50",
            "password" => 'required|string|min:3'
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            $viewerRole = Role::where("name", 'viewer')->first()->id;
            $user->roles()->attach($viewerRole);
        }
        //assign default role to user


        return $this->success($user, 'User registered successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
