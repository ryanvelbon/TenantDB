<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ContractsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
                        ->hasProperties(2)
                        ->hasTenants(2)
                        ->create();

        $this->user->assignRole('landlord');

        $this->user->contracts()->createMany([
            [
                'start_date' => '2023-01-01',
                'end_date' => '2024-01-01',
                'rent' => 1000,
                'deposit' => 2000,
                'tenant_id' => $this->user->tenants->get(0)->id,
                'property_id' => $this->user->properties->get(0)->id,
            ],
            [
                'start_date' => '2023-06-15',
                'end_date' => '2025-06-15',
                'rent' => 2500,
                'deposit' => 5000,
                'tenant_id' => $this->user->tenants->get(1)->id,
                'property_id' => $this->user->properties->get(1)->id,
            ],
        ]);
    }

    public function test_can_view_contracts()
    {
        $this->actingAs($this->user)
            ->get('/contracts')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Frontend/Contract/Index')
                ->has('contracts.data', 2)
                ->where('contracts.data.0.rent', '1000')
                ->where('contracts.data.0.deposit', '2000')
                ->where('contracts.data.1.rent', '2500')
                ->where('contracts.data.1.deposit', '5000')
            );
    }

    public function test_cannot_view_deleted_contracts()
    {
        $this->user->contracts->get(0)->delete();

        $this->actingAs($this->user)
            ->get('/contracts')
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Frontend/Contract/Index')
                ->has('contracts.data', 1)
                ->where('contracts.data.0.rent', '2500')
            );
    }
}
