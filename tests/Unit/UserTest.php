<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Role;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_it_is_assigned_user_role_by_default()
    {
        $user = User::factory()->create();

        $this->assertTrue($user->roles->contains(Role::find(2)));
    }

    public function test_it_can_be_assigned_additional_roles()
    {
        $user = User::factory()->create();
        $this->assertFalse($user->roles->contains(Role::find(1)));
        $this->assertTrue($user->roles->contains(Role::find(2)));
        $this->assertFalse($user->roles->contains(Role::find(3)));

        $user->assignRole('landlord'); $user->refresh();
        $this->assertFalse($user->roles->contains(Role::find(1)));
        $this->assertTrue($user->roles->contains(Role::find(2)));
        $this->assertTrue($user->roles->contains(Role::find(3)));

        $user->removeRole('landlord'); $user->refresh();
        $this->assertFalse($user->roles->contains(Role::find(1)));
        $this->assertTrue($user->roles->contains(Role::find(2)));
        $this->assertFalse($user->roles->contains(Role::find(3)));
    }

    public function test_it_can_be_unassigned_a_role()
    {
        $user = User::factory()->create();

        $roles = Role::all();

        foreach ($roles as $role) {
            $user->assignRole($role->title); $user->refresh();
            $this->assertTrue($user->roles->contains($role));
            $user->removeRole($role->title); $user->refresh();
            $this->assertFalse($user->roles->contains($role));
        }
    }
}
