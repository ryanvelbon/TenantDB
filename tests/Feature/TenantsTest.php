<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tenant;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class TenantsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_crud_tenants()
    {
        $tenant = Tenant::factory()->create();

        $this->get('/tenants')->assertRedirect('login');
        $this->get('/tenants/create')->assertRedirect('login');
        $this->get($tenant->path().'/edit')->assertRedirect('login');
        $this->get($tenant->path())->assertRedirect('login');
        $this->post('/tenants', $tenant->toArray())->assertRedirect('login');
        $this->patch($tenant->path())->assertRedirect('login');
        $this->delete($tenant->path())->assertRedirect('login');
    }

    public function test_a_landlord_can_create_a_tenant()
    {
        $this->assertTrue(false);
    }

    public function test_a_landlord_can_update_a_tenant()
    {
        $this->assertTrue(false);
    }

    public function test_a_landlord_can_delete_a_tenant()
    {
        $this->assertTrue(false);
    }
}
