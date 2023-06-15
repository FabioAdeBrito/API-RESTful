<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersTest extends TestCase
{
    public function testGettingAllUsers()
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        $response = $this->json('GET', '/api/users?token='.$token);
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                [
                    "id",
                    "name",
                    "email",
                    "email_verified_at",
                    "created_at",
                    "updated_at"
                ]
            ]
        );
    }

    public function testGettingOneUser()
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        $response = $this->json('GET', '/api/users/1?token='.$token);
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                "id",
                "name",
                "email",
                "email_verified_at",
                "created_at",
                "updated_at"
            ]
        );
    }
}
