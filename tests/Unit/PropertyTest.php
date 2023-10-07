<?php

namespace Tests\Unit;

use App\Models\Property;
use App\Models\User;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    public function test_it_belongs_to_a_user()
    {
        $property = Property::factory()->create();

        $this->assertInstanceOf(User::class, $property->createdBy);
    }

    public function test_it_has_a_path()
    {
        $property = Property::factory()->create();

        $this->assertEquals('/properties/' . $property->id, $property->path());
    }
}
