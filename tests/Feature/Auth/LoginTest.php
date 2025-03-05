<?php

namespace Tests\Feature\Auth;

use App\Enum\RoleEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->user->assignRole(RoleEnum::Admin->value);
    }

    public function test_login()
    {
        $response = $this->post('/api/login', [
            'email' => $this->user->email,
            'password' => 'password',
            'device' => 'web',
        ])->assertOk();
    }
}
