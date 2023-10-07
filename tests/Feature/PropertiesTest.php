<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Property;
use App\Models\User;

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

    public function test_user_can_access_properties()
    {
        $this->signIn();

        $this->get('/properties')->assertStatus(200);
    }

    public function test_a_user_can_retrieve_a_property()
    {
        $user = User::factory()->create();
        $property = Property::factory()->create(['created_by' => $user->id]);

        $response = $this->actingAs($user)->get($property->path());
        $response->assertStatus(200);
    }

    public function test_a_user_cannot_retrieve_a_property_of_others()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $property = Property::factory()->create(['created_by' => $userB->id]);

        $response = $this->actingAs($userA)->get($property->path());
        $response->assertStatus(403);
    }
}
