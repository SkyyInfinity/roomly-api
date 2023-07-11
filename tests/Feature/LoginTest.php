<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if login showing.
     */
    public function test_the_login_is_showing(): void
    {
        $response = $this->get('/admin/auth/login');

        $response->assertStatus(200);
    }
    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $this->post('/admin/auth/login', [
            'email' => 'dev.dylan.hautecoeur@gmail.com',
            'password' => 'wrong-password',
        ]);
 
        $this->assertGuest();
    }
}
