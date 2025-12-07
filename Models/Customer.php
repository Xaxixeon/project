<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'customer_code',
        'name',
        'phone',
        'email',
        'password',
        'member_type',
        'member_type_id',
        'instansi_id',
        'address',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function specialPrices()
    {
        return $this->hasMany(CustomerSpecialPrice::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }

    public function memberType()
    {
        return $this->belongsTo(MemberType::class, 'member_type_id');
    }

    public function prices()
    {
        return $this->hasMany(CustomerPrice::class);
    }
}
