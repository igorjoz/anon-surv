<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_guest_is_redirected_to_login_page()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_regitered_user_can_access_panel_page()
    {
        $user = User::factory()->create()->assignRole('user');
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_user_can_access_panel_page()
    {
        $user = User::factory()->create()->assignRole('admin');
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
}
