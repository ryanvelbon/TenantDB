<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;
use App\Models\Tenant;
use App\Models\User;

class TenantsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->user->assignRole('landlord');

        $this->user->tenants()->createMany([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '123-456-6789',
                // 'nationality' => 14,
                'passport' => 251917371230,
                'id_card' => 392683340027,
                'dob' => '1957-05-10',
            ], [
                'first_name' => 'Mary',
                'last_name' => 'Jane',
                'email' => 'mary@example.com',
                'phone' => '385-948-3391',
                // 'nationality' => 42,
                'passport' => 91231282129,
                'id_card' => 47475741189,
                'dob' => '1976-07-18',
            ],
        ]);
    }

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

    public function test_a_landlord_can_view_tenants()
    {
        $this->actingAs($this->user)
            ->get('/tenants')
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Frontend/Tenant/Index')
                ->has('tenants.data', 2)
                ->has('tenants.data.0', fn (Assert $assert) => $assert
                    ->where('firstName', 'John')
                    ->where('lastName', 'Doe')
                )
                ->has('tenants.data.1', fn (Assert $assert) => $assert
                    ->where('firstName', 'Mary')
                    ->where('lastName', 'Jane')
                )
            );
    }

    public function test_a_landlord_can_retrieve_a_tenant()
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

    public function test_two_landlords_can_create_their_own_tenant_record_for_the_same_individual()
    {
        $this->assertTrue(false);
    }

    public function test_a_landlord_cannot_create_two_tenants_with_the_same_email()
    {
        $this->assertTrue(false);
    }

    public function test_a_landlord_cannot_create_two_tenants_with_the_same_passport()
    {
        $this->assertTrue(false);
    }

    public function test_a_tenant_requires_a_first_name()
    {
        $this->assertTrue(false);
    }
}
