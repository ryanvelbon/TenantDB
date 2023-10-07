<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
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
        $tenantData = Tenant::factory()->make()->toArray();

        $response = $this->actingAs($this->user)->post(route('frontend.tenants.store'), $tenantData);

        $response->assertRedirect(route('frontend.tenants.index'));

        $this->assertDatabaseHas('tenants', [
            'first_name' => $tenantData['first_name'],
            'last_name' => $tenantData['last_name'],
            'email' => $tenantData['email']
        ]);

        $this->assertTrue($this->user->tenants()->where('email', $tenantData['email'])->exists());
    }

    public function test_a_landlord_can_view_tenants()
    {
        $this->actingAs($this->user)
            ->get('/tenants')
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Frontend/Tenant/Index')
                ->has('tenants.data', 2)
                ->where('tenants.data.0.firstName', 'John')
                ->where('tenants.data.0.lastName', 'Doe')
                ->where('tenants.data.0.email', 'john@example.com')
                ->where('tenants.data.0.phone', '123-456-6789')
                ->where('tenants.data.0.passport', '251917371230')
                ->where('tenants.data.0.idCard', '392683340027')
                // ->where('tenants.data.0.dob', '1957-05-10')
                // ->has('tenants.data.1', fn (Assert $assert) => $assert
                //     ->where('firstName', 'Mary')
                //     ->where('lastName', 'Jane')
                // )
            );
    }

    public function test_a_landlord_can_search_tenants()
    {
        $this->assertEquals(2, $this->user->roles->count());
        $this->actingAs($this->user)
            ->get('/tenants?search=John')
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Frontend/Tenant/Index')
                ->where('filters.search', 'John')
                ->has('tenants.data', 1)
        );
    }

    public function test_a_landlord_can_retrieve_a_tenant()
    {
        $tenant = Tenant::factory()->create(['created_by' => $this->user->id]);

        $response = $this->actingAs($this->user)->get(route('frontend.tenants.show', $tenant->id));

        $response->assertStatus(200);
    }

    public function test_a_landlord_can_update_a_tenant()
    {
        $tenant = Tenant::factory()->create(['created_by' => $this->user->id]);
        $updatedData = ['first_name' => 'Taylor'];

        // Attempt to update the tenant's data
        $response = $this->actingAs($this->user)->patch(route('frontend.tenants.update', $tenant->id), $updatedData);

        $response->assertRedirect(route('frontend.tenants.show', $tenant->id));
        $this->assertEquals('Taylor', $tenant->fresh()->first_name);
    }

    public function test_a_landlord_can_delete_a_tenant()
    {
        $tenant = Tenant::factory()->create(['created_by' => $this->user->id]);

        // Attempt to delete the tenant
        $response = $this->actingAs($this->user)->delete(route('frontend.tenants.destroy', $tenant->id));

        $response->assertRedirect(route('frontend.tenants.index'));
        $this->assertSoftDeleted($tenant);
    }

    public function test_two_landlords_can_create_their_own_tenant_record_for_the_same_individual()
    {
        $anotherUser = User::factory()->create();
        $anotherUser->assignRole('landlord');
        $tenantData = Tenant::factory()->make(['email' => 'sameemail@example.com'])->toArray();

        $this->actingAs($this->user)->post(route('frontend.tenants.store'), $tenantData);
        $this->actingAs($anotherUser)->post(route('frontend.tenants.store'), $tenantData);

        $this->assertEquals(1, $this->user->tenants->count());
        $this->assertEquals(1, $anotherUser->tenants->count());
    }

    public function test_a_landlord_cannot_create_two_tenants_with_the_same_email()
    {
        $tenantData = Tenant::factory()->make(['email' => 'duplicateemail@example.com'])->toArray();

        // Insert the tenant data twice
        $this->actingAs($this->user)->post(route('frontend.tenants.store'), $tenantData);
        $response = $this->actingAs($this->user)->post(route('frontend.tenants.store'), $tenantData);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_a_landlord_cannot_create_two_tenants_with_the_same_passport()
    {
        $tenantData = Tenant::factory()->make(['passport' => '12345678'])->toArray();

        // Insert the tenant data twice
        $this->actingAs($this->user)->post(route('frontend.tenants.store'), $tenantData);
        $response = $this->actingAs($this->user)->post(route('frontend.tenants.store'), $tenantData);

        $response->assertSessionHasErrors(['passport']);
    }
}
