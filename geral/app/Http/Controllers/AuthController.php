<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
       //$this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     
    public function login($args)
    {
     
        // $credentials = ['STR_EMAIL' => $args['email'], 'password' => $args['password']];

        // if (! $token = auth()->attempt($credentials)) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // return $this->respondWithToken($token);

        $user = User::where('STR_EMAIL', $args['email'])->first();
 
        if (! $user || ! Hash::check($args['password'], $user->SHA1_SENHA)) {
            return response()->json(['error' => 'Login ou senha incorretos'], 401);
            // throw ValidationException::withMessages([
            //     'email' => ['Login ou senha incorretos.'],
            // ]);
        }

        $INT_LOGIN_COUNT = $user->INT_LOGIN_COUNT + 1;
        User::where('INT_USU',$user->INT_USU)->update(['INT_LOGIN_COUNT' => $INT_LOGIN_COUNT ]);
        
        // $User2 = new User();

        // $User2->INT_USU   = $user->INT_USU;
        // $User2->
        // $User2->update();

        $token =  $user->createToken($args['device'])->plainTextToken;

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {   

        
        //$request->user()->currentAccessToken()->delete();
        
    }

    

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
        
    }
}
