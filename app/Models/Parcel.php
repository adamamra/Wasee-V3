<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Parcel extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_DELIVERED = 'delivered';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'organization_id',
        'parcel_number',
        'agent_name',
        'agent_phone',
        'agent_id_number',
        'branch_name',
        'serial_number',
        'status',
        'sender_name',
        'sender_phone',
        'sender_id_number',
        'sender_address',
        'receiver_name',
        'receiver_phone',
        'receiver_id_number',
        'receiver_address',
        'delivered_at',
        'expires_at'
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'delivered_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($parcel) {
            $parcel->serial_number = strtoupper(Str::random(8));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
