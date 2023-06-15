<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

/**
 * Class UserController.
 *
 * @author  Fábio Brito <fabioadebrito@gmail.com>
 */

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      tags={"/users"},
     *      summary="Display a listing of the resource",
     *      description="get all users on database",
     *      path="/users",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response="200", description="List of users"
     *      )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * @OA\Get(
     *      tags={"/users/{id}"},
     *      summary="Display the resource",
     *      description="get one user by id on database",
     *      path="/users/{id}",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response="200", description="Data of user"
     *      )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $user = User::find($id);

        return response()->json($user);
    }
}
