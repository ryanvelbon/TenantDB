<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use App\Models\User;
use Tests\TestCase;


class PermissionsTest extends TestCase
{
    public function test_landlord_can_access_their_features()
    {
        $user = User::factory()->create();
        $user->assignRole('landlord');

        $this->actingAs($user);
        $this->get('/dashboard')->assertStatus(200);
        $this->get('/properties')->assertStatus(200);
        $this->get('/tenants')->assertStatus(200);
    }

    public function test_non_admin_cannot_access_admin_features()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $this->get('/admin/dashboard')->assertStatus(403);
        $this->get('/admin/users')->assertStatus(403);
        $this->get('/admin/roles')->assertStatus(403);
        $this->get('/admin/permissions')->assertStatus(403);

        
    }
}
