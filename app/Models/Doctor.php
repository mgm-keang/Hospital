<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name', 'email', 'phone_number', 'gender', 'address',
        'country_id', 'role', 'image', 'specialty',
        'credentials', 'availability_schedule', 'status_id'
    ];

    protected $casts = [
        'availability_schedule' => 'array',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}


