<?php

namespace Tests\Unit;

use App\Models\Tenant;
use App\Models\User;

use Tests\TestCase;

class TenantTest extends TestCase
{
    public function test_it_belongs_to_a_user()
    {
        $tenant = Tenant::factory()->create();

        $this->assertInstanceOf(User::class, $tenant->createdBy);
    }

    public function test_it_has_a_path()
    {
        $tenant = Tenant::factory()->create();

        $this->assertEquals('/tenants/' . $tenant->id, $tenant->path());
    }
}
