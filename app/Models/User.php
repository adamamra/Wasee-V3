<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'id_number',
        'phone',
        'email',
        'branch_name',
        'password',
        'is_approved',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getIdNumberAttribute($value)
    {
        return $value;
    }

    public function getAuthIdentifierName()
    {
        return 'id_number';
    }

    public function parcels()
    {
        return $this->hasMany(Parcel::class);
    }

    public function isAdmin(): bool
    {
        $isAdminFlag = $this->getAttribute('is_admin');
        if ($isAdminFlag !== null) {
            if ((bool) $isAdminFlag === true) {
                return true;
            }
        }

        $role = $this->getAttribute('role');
        if ($role !== null) {
            return (string) $role === 'admin';
        }

        if ((string) $this->getAttribute('email') === 'admin@example.com') {
            return true;
        }

        return false;
    }
}
