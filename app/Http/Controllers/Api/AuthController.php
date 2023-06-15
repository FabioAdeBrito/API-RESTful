<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class AuthController.
 *
 * @author  Fábio Brito <fabioadebrito@gmail.com>
 */

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      tags={"/auth/login"},
     *      summary="Get a JWT via given credentials.",
     *      description="Get a JWT via given credentials.",
     *      path="/auth/login",
     *      @OA\Response(
     *          response="200", description="Bearrer Token"
     *      )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
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
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
