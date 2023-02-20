<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'created_by');
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'created_by');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'created_by');
    }

    public function reports()
    {
        return $this->hasMany(TenantReport::class, 'created_by');
    }

    /**
     * assigns user with a role (without deleting already-existing roles)
     * 
     * @param  String  $title
     * @return void
     */
    public function assignRole($title)
    {
        $this->roles()->syncWithoutDetaching(Role::where('title', $title)->first());
    }

    /**
     * unassigns user a role
     * 
     * @param  String  $title
     * @return void
     */
    public function removeRole($title)
    {
        $this->roles()->detach(Role::where('title', $title)->first());
    }
}
