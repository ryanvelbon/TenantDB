<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;
    use HasFactory;
    use MultiTenantModelTrait;

    public const TYPE_SELECT = [
        [
            'label' => 'Home',
            'value' => 'home',
        ],
        [
            'label' => 'Cabin',
            'value' => 'cabin',
        ],
        [
            'label' => 'Villa',
            'value' => 'villa',
        ],
        [
            'label' => 'Townhouse',
            'value' => 'townhouse',
        ],
        [
            'label' => 'Cottage',
            'value' => 'cottage',
        ],
        [
            'label' => 'Bungalow',
            'value' => 'bungalow',
        ],
    ];

    public $table = 'properties';

    protected $appends = [
        'type_label',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'address',
        'type',
        'size',
        'n_bedrooms',
        'n_bathrooms',
    ];

    protected $filterable = [
        'id',
        'address',
        'type',
        'size',
        'n_bedrooms',
        'n_bathrooms',
    ];

    protected $fillable = [
        'address',
        'type',
        'size',
        'n_bedrooms',
        'n_bathrooms',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function path()
    {
        return "/properties/{$this->id}";
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getTypeLabelAttribute()
    {
        return collect(static::TYPE_SELECT)->firstWhere('value', $this->type)['label'] ?? '';
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}