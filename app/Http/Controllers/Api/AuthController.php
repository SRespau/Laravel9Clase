<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    //Que haga resgricción de todos metodos si no estoy registrado, menos login y register, ya que no hace falta estar registrado para acceder a ellos
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //Genera un token que manda al cliente para que se identifique
        try {
            if ($token = auth()->attempt($credentials)) {
                return $this->respondWithToken($token); //OK
            } else {
                return response()->json(['error' => 'Credenciales inválidas'], 400);
            }
        } catch (JWTException $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'No se pudo crear el token'], 500);
        }
    }


    public function logout()
    {
        // auth()->logout();
        Auth::logout();

        return response()->json(['message' => 'Salió con éxito']);
    }


    public function me()
    {
        return response()->json(auth()->user());
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }



    protected function respondWithToken($token, $status = 200)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ], $status);
    }
}
