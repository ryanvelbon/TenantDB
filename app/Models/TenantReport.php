<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\MultiTenantModelTrait;

class TenantReport extends Model
{
    use SoftDeletes;
    use HasFactory;
    use MultiTenantModelTrait;

    public const LEASE_BROKEN_RADIO = [
        '1' => 'yes',
        '0' => 'no',
    ];

    public const PROPERTY_DAMAGED_RADIO = [
        '1' => 'yes',
        '0' => 'no',
    ];

    public $table = 'tenant_reports';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'n_months',
        'lease_broken',
        'outstanding_rent',
        'property_damaged',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}