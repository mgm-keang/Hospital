<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'patient_id', 'doctor_id', 'medication_details',
        'issue_date', 'expiry_date', 'notes', 'status_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}