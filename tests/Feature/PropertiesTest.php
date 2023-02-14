<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Property;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class PropertiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_crud_properties()
    {
        $property = Property::factory()->create();

        $this->get('/properties')->assertRedirect('login');
        $this->get('/properties/create')->assertRedirect('login');
        $this->get($property->path().'/edit')->assertRedirect('login');
        $this->get($property->path())->assertRedirect('login');
        $this->post('/properties', $property->toArray())->assertRedirect('login');
        $this->patch($property->path())->assertRedirect('login');
        $this->delete($property->path())->assertRedirect('login');
    }
}
