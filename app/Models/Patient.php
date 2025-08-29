<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name', 'DOB', 'phone_number', 'gender', 'image',
        'contact_info', 'medical_history', 'country_id', 'status_id'
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

