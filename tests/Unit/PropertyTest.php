<?php

namespace Tests\Unit;

use App\Models\Property;

use Tests\TestCase;

class PropertyTest extends TestCase
{
    public function test_it_has_a_path()
    {
        $property = Property::factory()->create();

        $this->assertEquals('/properties/' . $property->id, $property->path());
    }
}
